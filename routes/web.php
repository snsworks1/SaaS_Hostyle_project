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
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    \App\Http\Middleware\HandleInertiaRequests::class,
])->get('/user/profile', function () {
    return Inertia::render('Profile/Show');
})->name('profile.show');

