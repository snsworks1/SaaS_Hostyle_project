<?php

namespace App\Services;

use App\Models\CyberpanelServer;
use App\Models\Server;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use phpseclib3\Net\SSH2;
use phpseclib3\Crypt\PublicKeyLoader;

class ServerProvisionService
{
    public function provision(array $input, $user)
    {
        $servers = CyberpanelServer::where('region', $input['region'])
            ->where('status', 'active')->get();
        $selected = null;
        foreach ($servers as $server) {
            if ($this->isAvailable($server)) {
                $selected = $server;
                break;
            }
        }
        if (!$selected) {
            return ['success' => false, 'reason' => '가용 서버 없음'];
        }
        $cyberResult = $this->provisionOnCyberpanel($selected, $input, $user);
        if (!$cyberResult['success']) {
            Log::error('CyberPanel 생성 실패', $cyberResult);
            return ['success' => false, 'reason' => $cyberResult['reason']];
        }
        $fqdn = $input['domain'] . '.hostylefree.xyz';
        $expiresAt = Carbon::now()->addMonths($input['months']);
        $serverModel = Server::create([
            'user_id' => $user->id,
            'site_name' => $input['site_name'],
            'domain' => $input['domain'],
            'fqdn' => $fqdn,
            'region' => $input['region'],
            'platform' => $input['platform'],
            'plan' => $input['plan'],
            'months' => $input['months'],
            'expires_at' => $expiresAt,
            'cyberpanel_server_id' => $selected->id,
            'status' => 'active',
        ]);
        $cfResult = $this->createCloudflareDNS($fqdn, $selected->ip_address);
        if (!$cfResult['success']) {
            Log::error('Cloudflare DNS 생성 실패', $cfResult);
        }
        return ['success' => true, 'server_id' => $serverModel->id];
    }

    public function isAvailable($server)
    {
        try {
            $ssh = new SSH2($server->ip_address, 22);
            $key = PublicKeyLoader::load(file_get_contents('/var/www/.ssh/id_ed25519'));
            if (!$ssh->login($server->ssh_user ?? 'root', $key)) {
                Log::warning('SSH 로그인 실패', ['server_id' => $server->id]);
                return false;
            }
            $disk = $ssh->exec('df -h /');
            $memory = $ssh->exec('free -m');
            $diskLines = explode("\n", trim($disk));
            $diskData = preg_split('/\s+/', $diskLines[1] ?? '');
            $diskAvail = $diskData[3] ?? '0G';
            $diskUsePercent = $diskData[4] ?? '100%';
            $diskAvailGB = (int)filter_var($diskAvail, FILTER_SANITIZE_NUMBER_INT);
            $diskUsePercentInt = (int)str_replace('%', '', $diskUsePercent);
            $memLines = explode("\n", trim($memory));
            $memData = preg_split('/\s+/', $memLines[1] ?? '');
            $memAvailable = (int)($memData[6] ?? 0);
            return ($diskAvailGB >= 20 && $diskUsePercentInt <= 80 && $memAvailable >= 2048);
        } catch (\Exception $e) {
            Log::warning('가용성 체크 중 예외', ['server_id' => $server->id, 'msg' => $e->getMessage()]);
            return false;
        }
    }

    public function provisionOnCyberpanel($server, $input, $user)
    {
        try {
            $cpHost = $server->host;
            $cpPort = $server->api_port;
            $cpUser = $server->api_user;
            $cpPass = $server->api_password;
            $cpToken = $server->api_token;
            $cpSSL = $server->ssl;
            $protocol = $cpSSL ? 'https' : 'http';
            $cpUrl = "$protocol://$cpHost:$cpPort/cloudAPI/";
            $cpAuth = $cpToken ?: base64_encode($cpUser . ':' . $cpPass);
            $userName = $input['domain'];
            $dbName = $input['domain'];
            $dbUsername = $input['domain'];
            $dbPassword = $input['user_password'];
            // 1. 사용자 생성
            $userPayload = [
                'serverUserName' => $cpUser,
                'controller' => 'submitUserCreation',
                'firstName' => $user->name,
                'lastName' => $user->name,
                'email' => $user->email,
                'userName' => $userName,
                'password' => $dbPassword,
                'websitesLimit' => 1,
                'selectedACL' => 'user'
            ];
            $res1 = Http::timeout(20)
                ->withHeaders([
                    'Authorization' => $cpAuth,
                    'Content-Type' => 'application/json'
                ])
                ->withOptions(['verify' => false])
                ->post($cpUrl, $userPayload);
            $json1 = $res1->json();
            if (!($json1['status'] ?? 0)) {
                return ['success' => false, 'reason' => 'CyberPanel 사용자 생성 실패: ' . ($json1['error_message'] ?? '')];
            }
            // 2. 웹사이트 생성
            $sitePayload = [
                'serverUserName' => $cpUser,
                'controller' => 'submitWebsiteCreation',
                'domainName' => $input['domain'] . '.hostylefree.xyz',
                'package' => $input['plan'],
                'adminEmail' => $user->email,
                'phpSelection' => 'PHP 8.0',
                'websiteOwner' => $userName,
                'ssl' => 1,
                'dkimCheck' => 1,
                'openBasedir' => 1
            ];
            Log::info('CyberPanel 웹사이트 생성 요청', $sitePayload);
            $res2 = Http::timeout(20)
                ->withHeaders([
                    'Authorization' => $cpAuth,
                    'Content-Type' => 'application/json'
                ])
                ->withOptions(['verify' => false])
                ->post($cpUrl, $sitePayload);
            $json2 = $res2->json();
            Log::info('CyberPanel 웹사이트 생성 응답', $json2);
            if (!($json2['status'] ?? 0)) {
                return ['success' => false, 'reason' => 'CyberPanel 웹사이트 생성 실패: ' . ($json2['error_message'] ?? '')];
            }
            sleep(3); // 또는 sleep(5);

            // 3. DB 생성
            $dbPayload = [
                'serverUserName' => $cpUser,
                'controller' => 'submitDBCreation',
                'databaseWebsite' => $input['domain'] . '.hostylefree.xyz',
                'dbName' => $dbName,
                'dbUsername' => $dbUsername,
                'dbPassword' => $dbPassword,
                'webUserName' => $userName
            ];
            Log::info('CyberPanel DB 생성 요청', $dbPayload);
            $maxTries = 20; // 최대 20초까지 시도
            $success = false;
            for ($i = 0; $i < $maxTries; $i++) {
                $res3 = Http::timeout(20)
                    ->withHeaders([
                        'Authorization' => $cpAuth,
                        'Content-Type' => 'application/json'
                    ])
                    ->withOptions(['verify' => false])
                    ->post($cpUrl, $dbPayload);
                $json3 = $res3->json();
                Log::info('CyberPanel DB 생성 재시도', ['try' => $i+1, 'response' => $json3]);
                if ($json3['status'] ?? 0) {
                    $success = true;
                    break;
                }
                sleep(1);
            }
            if (!$success) {
                return ['success' => false, 'reason' => 'CyberPanel DB 생성 실패: Websites matching query does not exist.'];
            }
            return ['success' => true];
        } catch (\Exception $e) {
            return ['success' => false, 'reason' => 'CyberPanel API 예외: ' . $e->getMessage()];
        }
    }

    public function createCloudflareDNS($fqdn, $ip)
    {
        try {
            $cfToken = env('CLOUDFLARE_API_TOKEN');
            $cfZone = env('CLOUDFLARE_ZONE_ID');
            $res = Http::withHeaders([
                'Authorization' => 'Bearer ' . $cfToken,
                'Content-Type' => 'application/json'
            ])->post("https://api.cloudflare.com/client/v4/zones/$cfZone/dns_records", [
                'type' => 'A',
                'name' => $fqdn,
                'content' => $ip,
                'ttl' => 3600,
                'proxied' => true
            ]);
            $cfJson = $res->json();
            if (!($cfJson['success'] ?? false)) {
                return ['success' => false, 'reason' => 'Cloudflare DNS 생성 실패: ' . json_encode($cfJson['errors'] ?? [])];
            }
            return ['success' => true];
        } catch (\Exception $e) {
            return ['success' => false, 'reason' => 'Cloudflare API 예외: ' . $e->getMessage()];
        }
    }
} 