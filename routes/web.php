<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\ServerController;
use App\Http\Middleware\HandleInertiaRequests;
use Illuminate\Http\Request;

// inertia 미들웨어 그룹 (GET 라우트만)
Route::middleware([HandleInertiaRequests::class])->group(function () {
    // 메인 페이지
    Route::get('/', function () {
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    });

    // 로그인 페이지
    Route::get('/login', function () {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
        ]);
    })->name('login');

    // 비밀번호 찾기(이메일 입력 폼)
    Route::get('/password/reset', function () {
        return Inertia::render('Auth/ForgotPassword');
    })->name('password.request');

    // 비밀번호 재설정 폼
    Route::get('/password/reset/{token}', function (string $token) {
        return Inertia::render('Auth/ResetPassword', [
            'token' => $token,
            'email' => request()->query('email'),
        ]);
    })->name('password.reset');

    // 회원가입 폼
    Route::get('/register', function () {
        return Inertia::render('Auth/Register');
    })->name('register');

    // 이메일 인증 안내
    Route::get('/email/verify', function () {
        return Inertia::render('Auth/VerifyEmail');
    })->name('verification.notice');

    // 정책 및 약관 라우트
    Route::get('/policy', function () {
        return Inertia::render('Policy');
    })->name('policy.show');

    Route::get('/terms', function () {
        return Inertia::render('Terms');
    })->name('terms.show');

    // 이메일 인증 메일 재발송 라우트 (POST, 인증 필요)
    Route::post('/email/verification-notification', function (Request $request) {
        if ($request->user()) {
            $request->user()->sendEmailVerificationNotification();
        }
        return back()->with('success', '인증 메일을 다시 발송했습니다.');
    })->middleware(['auth:sanctum', config('jetstream.auth_session')])->name('verification.send');
});

// 비밀번호 찾기(이메일 전송) - inertia 미들웨어 그룹 밖에서 처리
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware(['guest'])
    ->name('password.email');

// 비밀번호 재설정 처리 - inertia 미들웨어 그룹 밖에서 처리
Route::post('/reset-password', [ResetPasswordController::class, 'store'])->name('password.update');

// 인증 필요(verified) 라우트
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    HandleInertiaRequests::class,
])->group(function () {
    // 서버 선택 페이지 (서버가 있을 때)
    Route::get('/select-server', [ServerController::class, 'select'])->name('server.select');

    // 서버 상세보기 페이지
    Route::get('/server/{id}', [ServerController::class, 'show'])->name('server.show');

    // 서버 생성/구매 페이지
    Route::get('/create-server', [ServerController::class, 'create'])->name('server.create');

    // 서버 생성 폼 제출 시 결제 더미 페이지로 이동
    Route::post('/create-server/payment-dummy', [ServerController::class, 'paymentDummy'])->name('server.payment.dummy');

    // 서버 생성 처리
    Route::post('/create-server', [ServerController::class, 'store'])->name('server.store');

    // 환불 관련
    Route::get('/server/{server}/refund/calculate', [ServerController::class, 'calculateRefundDetails'])->name('server.refund.calculate');
    Route::post('/server/{server}/refund', [ServerController::class, 'processRefund'])->name('server.refund.process');

    // 대시보드
    Route::get('/dashboard', [ServerController::class, 'dashboard'])->name('dashboard');

    // 설정/관리 페이지 라우트 추가
    Route::get('/server/{id}/settings/basic', function ($id) {
        $controller = app(\App\Http\Controllers\ServerController::class);
        return $controller->renderWithServerProps($id, 'Server/Settings/Basic');
    })->name('server.settings.basic');
    Route::get('/server/{id}/settings/seo', function ($id) {
        $controller = app(\App\Http\Controllers\ServerController::class);
        return $controller->renderWithServerProps($id, 'Server/Settings/Seo');
    })->name('server.settings.seo');
    Route::get('/server/{id}/settings/social', function ($id) {
        $controller = app(\App\Http\Controllers\ServerController::class);
        return $controller->renderWithServerProps($id, 'Server/Settings/Social');
    })->name('server.settings.social');
    Route::get('/server/{id}/settings/extra', function ($id) {
        $controller = app(\App\Http\Controllers\ServerController::class);
        return $controller->renderWithServerProps($id, 'Server/Settings/Extra');
    })->name('server.settings.extra');
    Route::get('/server/{id}/settings/domain-guide', function ($id) {
        $controller = app(\App\Http\Controllers\ServerController::class);
        return $controller->renderWithServerProps($id, 'Server/Settings/DomainGuide');
    })->name('server.settings.domain-guide');

    // 회원관리
    Route::get('/server/{id}/members/list', function ($id) {
        $controller = app(\App\Http\Controllers\ServerController::class);
        return $controller->renderWithServerProps($id, 'Server/Members/List');
    })->name('server.members.list');
    Route::get('/server/{id}/members/template', function ($id) {
        $controller = app(\App\Http\Controllers\ServerController::class);
        return $controller->renderWithServerProps($id, 'Server/Members/Template');
    })->name('server.members.template');
    Route::get('/server/{id}/members/settings', function ($id) {
        $controller = app(\App\Http\Controllers\ServerController::class);
        return $controller->renderWithServerProps($id, 'Server/Members/Settings');
    })->name('server.members.settings');
    Route::get('/server/{id}/members/points', function ($id) {
        $controller = app(\App\Http\Controllers\ServerController::class);
        return $controller->renderWithServerProps($id, 'Server/Members/Points');
    })->name('server.members.points');

    // 기능
    Route::get('/server/{id}/board/manage', fn($id) => Inertia::render('Server/Board/Manage'))->name('server.board.manage');
    Route::get('/server/{id}/forms/manage', fn($id) => Inertia::render('Server/Forms/Manage'))->name('server.forms.manage');
    Route::get('/server/{id}/calendar/manage', fn($id) => Inertia::render('Server/Calendar/Manage'))->name('server.calendar.manage');

    // 통계
    Route::get('/server/{id}/stats/visits', function ($id) {
        $controller = app(\App\Http\Controllers\ServerController::class);
        return $controller->renderWithServerProps($id, 'Server/Stats/Visits');
    })->name('server.stats.visits');
    Route::get('/server/{id}/stats/access', function ($id) {
        $controller = app(\App\Http\Controllers\ServerController::class);
        return $controller->renderWithServerProps($id, 'Server/Stats/Access');
    })->name('server.stats.access');

    // 서버관리
    Route::get('/server/{id}/admin/php-version', fn($id) => Inertia::render('Server/Admin/PhpVersion'))->name('server.admin.php-version');
    Route::get('/server/{id}/admin/mysql-password', fn($id) => Inertia::render('Server/Admin/MysqlPassword'))->name('server.admin.mysql-password');
    Route::get('/server/{id}/admin/mysql-users', fn($id) => Inertia::render('Server/Admin/MysqlUsers'))->name('server.admin.mysql-users');
    Route::get('/server/{id}/admin/backup', function ($id) {
        $controller = app(\App\Http\Controllers\ServerController::class);
        return $controller->renderWithServerProps($id, 'Server/Admin/Backup');
    })->name('server.admin.backup');
    Route::get('/server/{id}/admin/ssl', function ($id) {
        $controller = app(\App\Http\Controllers\ServerController::class);
        return $controller->renderWithServerProps($id, 'Server/Admin/Ssl');
    })->name('server.admin.ssl');
    Route::get('/server/{id}/admin/phpmyadmin', fn($id) => Inertia::render('Server/Admin/Phpmyadmin'))->name('server.admin.phpmyadmin');
    Route::get('/server/{id}/admin/filemanager', fn($id) => Inertia::render('Server/Admin/Filemanager'))->name('server.admin.filemanager');
    Route::get('/server/{id}/admin/mysql', fn($id) => Inertia::render('Server/Admin/Mysql'))->name('server.admin.mysql');
    Route::get('/server/{id}/wordpress/themes', fn($id) => Inertia::render('Server/Wordpress/Themes'))->name('server.wordpress.themes');
    Route::get('/server/{id}/admin/settings', function ($id) {
        $controller = app(\App\Http\Controllers\ServerController::class);
        return $controller->renderWithServerProps($id, 'Server/Admin/Settings');
    })->name('server.admin.settings');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    \App\Http\Middleware\HandleInertiaRequests::class,
])->get('/user/profile', function () {
    return Inertia::render('Profile/Show');
})->name('profile.show');

