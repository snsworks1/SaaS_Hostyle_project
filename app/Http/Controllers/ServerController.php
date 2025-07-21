<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\Server;
use App\Models\Order;
use App\Services\TossPaymentService;
use App\Models\Plan;

class ServerController extends Controller
{
    /**
     * 서버 목록 페이지
     */
    public function index()
    {
        $user = Auth::user();
        
        // 임시 서버 데이터 (나중에 실제 데이터베이스에서 가져올 예정)
        $servers = [
            [
                'id' => 1,
                'name' => '내 블로그',
                'domain' => 'myblog.hostyle.com',
                'platform' => 'WordPress',
                'plan' => 'Starter',
                'status' => '정상',
                'region' => '서울',
                'price' => '9,900'
            ]
        ];

        return Inertia::render('Server/Select', [
            'servers' => $servers
        ]);
    }

    /**
     * 서버 생성 페이지
     */
    public function create()
    {
        $plans = Plan::with('features')->get()->map(function($plan) {
            return [
                'value' => $plan->name,
                'label' => $plan->label,
                'price' => number_format($plan->price),
                'originalPrice' => number_format($plan->price),
                'trialDays' => $plan->trial_days,
                'specs' => [
                    'storage' => $this->getStorageByPlan($plan->name),
                    'traffic' => $this->getTrafficByPlan($plan->name),
                    'domains' => $this->getDomainsByPlan($plan->name),
                    'features' => $plan->features->pluck('name')->toArray()
                ]
            ];
        });

        return Inertia::render('Server/Create', [
            'plans' => $plans
        ]);
    }

    // 서버 생성 폼 제출 시 결제 더미 페이지로 이동
    public function paymentDummy(Request $request)
    {
        return Inertia::render('Server/PaymentDummy', [
            'form' => $request->all()
        ]);
    }

    /**
     * 플랜별 저장공간 반환
     */
    private function getStorageByPlan($planName)
    {
        $storageMap = [
            'free' => '1GB',
            'starter' => '5GB',
            'business' => '20GB',
            'enterprise' => '100GB'
        ];
        return $storageMap[$planName] ?? '1GB';
    }

    /**
     * 플랜별 트래픽 반환
     */
    private function getTrafficByPlan($planName)
    {
        $trafficMap = [
            'free' => '10GB/월',
            'starter' => '150GB/월',
            'business' => '600GB/월',
            'enterprise' => '무제한'
        ];
        return $trafficMap[$planName] ?? '10GB/월';
    }

    /**
     * 플랜별 도메인 수 반환
     */
    private function getDomainsByPlan($planName)
    {
        $domainsMap = [
            'free' => '서브도메인',
            'starter' => '1개',
            'business' => '5개',
            'enterprise' => '무제한'
        ];
        return $domainsMap[$planName] ?? '서브도메인';
    }

    /**
     * 서버 생성 처리
     */
    public function store(Request $request)
    {
        // 실제 결제/서버생성은 추후 구현
        // 여기서 servers 테이블에 더미로 저장
        \DB::table('servers')->insert([
            'user_id' => \Auth::id(),
            'site_name' => $request->site_name,
            'domain' => $request->domain,
            'region' => $request->region,
            'platform' => $request->platform,
            'plan' => $request->plan,
            'months' => $request->months,
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return Inertia::render('Server/Loading');
    }

    /**
     * 서버 선택 페이지
     */
    public function select()
    {
        $servers = \DB::table('servers')
            ->where('user_id', \Auth::id())
            ->orderByDesc('created_at')
            ->get()
            ->map(function($server) {
                // 만료일 계산 (생성일 + 개월 수)
                $createdAt = \Carbon\Carbon::parse($server->created_at);
                $expiresAt = $createdAt->copy()->addMonths($server->months);
                
                return [
                    'id' => $server->id,
                    'site_name' => $server->site_name,
                    'domain' => $server->domain,
                    'region' => $server->region,
                    'platform' => $server->platform,
                    'plan' => $server->plan,
                    'months' => $server->months,
                    'status' => $server->status,
                    'created_at' => $server->created_at,
                    'expires_at' => $expiresAt->format('Y-m-d'),
                    'days_remaining' => now()->diffInDays($expiresAt, false),
                ];
            });

        return Inertia::render('Server/Select', [
            'servers' => $servers
        ]);
    }

    /**
     * 대시보드
     */
    public function dashboard()
    {
        $serverCount = \DB::table('servers')->where('user_id', \Auth::id())->count();
        if ($serverCount > 0) {
            return redirect()->route('server.select');
        }
        // 서버가 없을 때 기존 대시보드 렌더링 (또는 안내)
        return Inertia::render('Dashboard');
    }

    /**
     * 환불 금액 계산 (새로운 정책)
     */
    public function calculateRefund($serverId)
    {
        $server = Server::find($serverId);
        
        if (!$server) {
            return response()->json(['error' => '서버를 찾을 수 없습니다.'], 404);
        }
        
        $usedDays = now()->diffInDays($server->created_at);
        $monthlyPrice = $server->original_price;
        $paidPrice = $server->paid_price;
        $discountAmount = $server->discount_amount;
        $months = $server->months;
        
        // 무료 체험 기간 중
        if ($server->plan === 'free') {
            return response()->json([
                'refund_amount' => 0,
                'message' => '무료 체험 기간 중에는 환불이 불가능합니다.'
            ]);
        }
        
        // 1개월 결제
        if ($months == 1) {
            if ($usedDays <= 14) {
                // 14일 이내: 일할 계산
                $usedAmount = ($monthlyPrice / 30) * $usedDays;
                $refundAmount = $paidPrice - $usedAmount;
            } else {
                // 15일 이후: 환불 불가
                $refundAmount = 0;
            }
        } else {
            // 3/6/12개월 결제
            if ($usedDays <= 14) {
                // 14일 이내: 1개월치 일할 계산 + 나머지 개월 전액 환불
                $usedAmount = ($monthlyPrice / 30) * $usedDays;
                $remainingMonths = $months - 1;
                $refundAmount = ($monthlyPrice * $remainingMonths) + ($paidPrice - $usedAmount);
            } else {
                // 15일 이후: 1개월 사용으로 간주 + 나머지 개월 전액 환불
                $remainingMonths = $months - 1;
                $refundAmount = $monthlyPrice * $remainingMonths;
            }
        }
        
        // 할인 위약금 차감
        $refundAmount -= $discountAmount;
        
        // 최소 0원 보장
        $refundAmount = max(0, $refundAmount);
        
        return response()->json([
            'refund_amount' => $refundAmount,
            'used_days' => $usedDays,
            'calculation_details' => [
                'monthly_price' => $monthlyPrice,
                'paid_price' => $paidPrice,
                'discount_amount' => $discountAmount,
                'months' => $months,
                'used_amount' => $usedDays <= 14 ? ($monthlyPrice / 30) * $usedDays : $monthlyPrice,
                'remaining_months' => $months > 1 ? $months - 1 : 0
            ]
        ]);
    }
    
    /**
     * 환불 처리 (토스페이먼츠 연동)
     */
    public function processRefund(Request $request, $serverId)
    {
        $server = Server::find($serverId);
        
        if (!$server) {
            return response()->json(['error' => '서버를 찾을 수 없습니다.'], 404);
        }
        
        // 환불 가능 여부 확인
        if (!$server->isRefundable()) {
            return response()->json(['error' => '환불 가능한 주문이 없습니다.'], 400);
        }
        
        $tossService = new TossPaymentService();
        $result = $tossService->refundServer($serverId, $request->input('reason', '사용자 요청'));
        
        if ($result['success']) {
            return response()->json([
                'success' => true,
                'total_refund_amount' => $result['total_refund_amount'],
                'refund_results' => $result['refund_results'],
                'message' => '환불이 성공적으로 처리되었습니다.'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'error' => $result['error'] ?? '환불 처리 중 오류가 발생했습니다.'
            ], 500);
        }
    }

    /**
     * 환불 금액 계산 (주문별 상세)
     */
    public function calculateRefundDetails($serverId)
    {
        $server = Server::find($serverId);
        
        if (!$server) {
            return response()->json(['error' => '서버를 찾을 수 없습니다.'], 404);
        }
        
        $refundDetails = [];
        $totalRefundAmount = 0;
        
        foreach ($server->activeOrders() as $order) {
            $refundAmount = $order->calculateRefundAmount();
            $isRefundable = $order->isRefundable();
            
            $refundDetails[] = [
                'order_id' => $order->id,
                'order_number' => $order->order_number,
                'order_type' => $order->order_type,
                'amount' => $order->amount,
                'months' => $order->months,
                'created_at' => $order->created_at->format('Y-m-d'),
                'expires_at' => $order->expires_at->format('Y-m-d'),
                'used_days' => now()->diffInDays($order->created_at),
                'is_refundable' => $isRefundable,
                'refund_amount' => $refundAmount,
                'refund_reason' => $this->getRefundReason($order)
            ];
            
            $totalRefundAmount += $refundAmount;
        }
        
        return response()->json([
            'server_id' => $server->id,
            'server_name' => $server->site_name,
            'total_refund_amount' => $totalRefundAmount,
            'is_refundable' => $totalRefundAmount > 0,
            'refund_details' => $refundDetails
        ]);
    }

    /**
     * 환불 사유 설명
     */
    private function getRefundReason($order)
    {
        if ($order->order_type === 'extension' && $order->expires_at > now()) {
            return '연장 주문 - 아직 사용하지 않음 (100% 환불)';
        }
        
        $usedDays = now()->diffInDays($order->created_at);
        
        if ($usedDays <= 14) {
            return '14일 이내 - 일할 계산 환불';
        } else {
            return '14일 이후 - 환불 불가';
        }
    }

    public function show($id)
    {
        $server = \DB::table('servers')
            ->where('id', $id)
            ->where('user_id', \Auth::id())
            ->first();

        if (!$server) {
            abort(404);
        }

        // 사용자의 모든 서버 목록 가져오기
        $allServers = \DB::table('servers')
            ->where('user_id', \Auth::id())
            ->orderByDesc('created_at')
            ->get()
            ->map(function($s) {
                $createdAt = \Carbon\Carbon::parse($s->created_at);
                $expiresAt = $createdAt->copy()->addMonths($s->months);
                
                return [
                    'id' => $s->id,
                    'site_name' => $s->site_name,
                    'domain' => $s->domain,
                    'platform' => $s->platform,
                    'plan' => $s->plan,
                    'status' => $s->status,
                    'expires_at' => $expiresAt->format('Y-m-d'),
                    'days_remaining' => now()->diffInDays($expiresAt, false),
                ];
            });

        // 만료일 계산
        $createdAt = \Carbon\Carbon::parse($server->created_at);
        $expiresAt = $createdAt->copy()->addMonths($server->months);
        $daysRemaining = now()->diffInDays($expiresAt, false);

        $serverData = [
            'id' => $server->id,
            'site_name' => $server->site_name,
            'domain' => $server->domain,
            'region' => $server->region,
            'platform' => $server->platform,
            'plan' => $server->plan,
            'months' => $server->months,
            'status' => $server->status,
            'created_at' => $server->created_at,
            'expires_at' => $expiresAt->format('Y-m-d'),
            'days_remaining' => $daysRemaining,
        ];

        // 플랫폼별 사이드바 메뉴 정의
        $sidebarMenus = $this->getSidebarMenusByPlatform($server->platform);

        return Inertia::render('Server/Show', [
            'server' => $serverData,
            'allServers' => $allServers,
            'sidebarMenus' => $sidebarMenus
        ]);
    }

    public function renderWithServerProps($id, $vuePage)
    {
        $server = \DB::table('servers')
            ->where('id', $id)
            ->where('user_id', \Auth::id())
            ->first();

        if (!$server) {
            abort(404);
        }

        $allServers = \DB::table('servers')
            ->where('user_id', \Auth::id())
            ->orderByDesc('created_at')
            ->get()
            ->map(function($s) {
                $createdAt = \Carbon\Carbon::parse($s->created_at);
                $expiresAt = $createdAt->copy()->addMonths($s->months);
                return [
                    'id' => $s->id,
                    'site_name' => $s->site_name,
                    'domain' => $s->domain,
                    'platform' => $s->platform,
                    'plan' => $s->plan,
                    'status' => $s->status,
                    'expires_at' => $expiresAt->format('Y-m-d'),
                    'days_remaining' => now()->diffInDays($expiresAt, false),
                ];
            });

        $createdAt = \Carbon\Carbon::parse($server->created_at);
        $expiresAt = $createdAt->copy()->addMonths($server->months);
        $daysRemaining = now()->diffInDays($expiresAt, false);

        $serverData = [
            'id' => $server->id,
            'site_name' => $server->site_name,
            'domain' => $server->domain,
            'region' => $server->region,
            'platform' => $server->platform,
            'plan' => $server->plan,
            'months' => $server->months,
            'status' => $server->status,
            'created_at' => $server->created_at,
            'expires_at' => $expiresAt->format('Y-m-d'),
            'days_remaining' => $daysRemaining,
        ];

        $sidebarMenus = $this->getSidebarMenusByPlatform($server->platform);

        return Inertia::render($vuePage, [
            'server' => $serverData,
            'allServers' => $allServers,
            'sidebarMenus' => $sidebarMenus
        ]);
    }

    private function getSidebarMenusByPlatform($platform)
    {
        switch ($platform) {
            case 'cms':
                return [
                    [
                        'title' => '기본설정',
                        'icon' => 'settings',
                        'route' => 'server.settings.basic',
                    ],
                    [
                        'title' => 'SEO',
                        'icon' => 'chart-bar',
                        'route' => 'server.settings.seo',
                    ],
                    [
                        'title' => '소셜',
                        'icon' => 'users',
                        'route' => 'server.settings.social',
                    ],
                    [
                        'title' => '추가기능',
                        'icon' => 'puzzle',
                        'route' => 'server.settings.extra',
                    ],
                    [
                        'title' => '회원 관리',
                        'icon' => 'users',
                        'children' => [
                            ['title' => '회원 리스트', 'route' => 'server.members.list'],
                            ['title' => '회원가입 템플릿', 'route' => 'server.members.template'],
                            ['title' => '설정', 'route' => 'server.members.settings'],
                            ['title' => '회원 포인트', 'route' => 'server.members.points'],
                        ]
                    ],
                    [
                        'title' => '기능',
                        'icon' => 'puzzle',
                        'children' => [
                            [
                                'title' => '게시판 관리',
                                'route' => 'server.board.manage',
                            ],
                            [
                                'title' => 'FORM 리스트',
                                'route' => 'server.forms.manage',
                            ],
                            [
                                'title' => '달력 리스트',
                                'route' => 'server.calendar.manage',
                            ]
                        ]
                    ],
                    [
                        'title' => '통계',
                        'icon' => 'chart-bar',
                        'children' => [
                            ['title' => '방문기록', 'route' => 'server.stats.visits'],
                            ['title' => '접속 통계', 'route' => 'server.stats.access'],
                        ]
                    ],
                    [
                        'title' => '서버관리',
                        'icon' => 'server',
                        'children' => [
                            [
                                'title' => '설정',
                                'route' => 'server.admin.settings',
                            ],
                            ['title' => '백업', 'route' => 'server.admin.backup'],
                            ['title' => 'SSL', 'route' => 'server.admin.ssl'],
                            ['title' => '웹 데이터베이스 바로가기', 'route' => 'server.admin.phpmyadmin'],
                            ['title' => '파일관리자 바로가기', 'route' => 'server.admin.filemanager'],
                        ]
                    ]
                ];

            case 'wordpress':
                return [
                    ['title' => '도메인 등록/가이드', 'route' => 'server.settings.domain-guide'],
                    [
                        'title' => '서버관리',
                        'icon' => 'server',
                        'children' => [
                            ['title' => 'PHP 버전설정', 'route' => 'server.admin.php-version'],
                            ['title' => 'MySQL 관리', 'route' => 'server.admin.mysql'],
                            ['title' => 'SSL', 'route' => 'server.admin.ssl'],
                        ]
                    ],
                    ['title' => '테마설치', 'route' => 'server.wordpress.themes'],
                    ['title' => '웹 데이터베이스 바로가기', 'route' => 'server.admin.phpmyadmin'],
                    ['title' => '파일관리자 바로가기', 'route' => 'server.admin.filemanager'],
                ];

            case 'custom':
                return [
                    ['title' => '도메인 등록/가이드', 'route' => 'server.settings.domain-guide'],
                    [
                        'title' => '서버관리',
                        'icon' => 'server',
                        'children' => [
                            ['title' => 'PHP 버전설정', 'route' => 'server.admin.php-version'],
                            ['title' => 'MySQL 관리', 'route' => 'server.admin.mysql'],
                            ['title' => 'SSL', 'route' => 'server.admin.ssl'],
                        ]
                    ],
                    ['title' => '웹 데이터베이스 바로가기', 'route' => 'server.admin.phpmyadmin'],
                    ['title' => '파일관리자 바로가기', 'route' => 'server.admin.filemanager'],
                ];

            default:
                return [];
        }
    }
} 