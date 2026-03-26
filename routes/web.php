<?php

use App\Http\Controllers\AdminDetailsController;
use App\Http\Controllers\AppSettingsController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\ImpersonationController;
use App\Http\Controllers\TermsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsersManagementController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Thin shell routes. Package-registered routes handle profiles, themes,
| social auth, chat, notifications, face auth, health, roles, logger,
| blocker, 2step, phpinfo, and users management.
|
*/

// Homepage Routes
Route::group(['middleware' => ['web', 'checkblocked']], function () {
    Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');
    Route::get('/terms', [TermsController::class, 'terms'])->name('terms');
});

// Guest Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
});

// Authenticated Auth Routes
Route::middleware('auth')->group(function () {
    // Email Verification
    Route::get('verify-email', EmailVerificationPromptController::class)->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    // Password
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

// Authenticated User Routes
Route::group(['middleware' => ['auth', 'verified', 'activity', 'twostep', 'checkblocked']], function () {
    Route::get('/home', [UserController::class, 'index'])->name('home');
});

// Impersonation Routes
Route::group(['middleware' => ['auth', 'verified', 'activity', 'twostep', 'checkblocked']], function () {
    Route::post('/impersonate/{user}', [ImpersonationController::class, 'start'])->name('impersonate.start');
    Route::post('/impersonate-stop', [ImpersonationController::class, 'stop'])->name('impersonate.stop');
});

// Admin Routes
Route::group(['middleware' => ['auth', 'verified', 'level:5', 'activity', 'twostep', 'checkblocked']], function () {
    // Admin route listing
    Route::get('/routes', [AdminDetailsController::class, 'listRoutes'])->name('admin.routes');

    // App settings
    Route::get('/settings', [AppSettingsController::class, 'index'])->name('admin.settings');
    Route::put('/settings', [AppSettingsController::class, 'update'])->name('admin.settings.update');

    // Soft-deleted users management (must be before resource route)
    Route::get('users/deleted', [UsersManagementController::class, 'deletedIndex'])->name('deleted.index');
    Route::get('users/deleted/{id}', [UsersManagementController::class, 'deletedShow'])->name('deleted.show');
    Route::put('users/deleted/{id}', [UsersManagementController::class, 'restore'])->name('deleted.restore');
    Route::delete('users/deleted/{id}', [UsersManagementController::class, 'forceDestroy'])->name('deleted.destroy');

    Route::resource('users', UsersManagementController::class, [
        'names' => [
            'index' => 'users',
            'destroy' => 'user.destroy',
        ],
    ])->where(['user' => '[0-9]+']);
    Route::post('search-users', [UsersManagementController::class, 'search'])->name('search-users');
});

Route::redirect('/php', '/phpinfo', 301);
