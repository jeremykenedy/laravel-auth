<?php

namespace App\Providers;

use App\Listeners\AuditSecurityEvent;
use App\Listeners\NotifyAdminOfNewUser;
use App\Listeners\SendWelcomeNotification;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Spatie\Health\Checks\Checks\CacheCheck;
use Spatie\Health\Checks\Checks\DatabaseCheck;
use Spatie\Health\Checks\Checks\DebugModeCheck;
use Spatie\Health\Checks\Checks\EnvironmentCheck;
use Spatie\Health\Checks\Checks\HorizonCheck;
use Spatie\Health\Checks\Checks\OptimizedAppCheck;
use Spatie\Health\Checks\Checks\RedisCheck;
use Spatie\Health\Checks\Checks\ScheduleCheck;
use Spatie\Health\Checks\Checks\UsedDiskSpaceCheck;
use Spatie\Health\Facades\Health;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Event listeners
        Event::listen(Registered::class, SendWelcomeNotification::class);
        Event::listen(Registered::class, NotifyAdminOfNewUser::class);

        // Security audit events
        Event::listen(Login::class, [AuditSecurityEvent::class, 'handleLogin']);
        Event::listen(Logout::class, [AuditSecurityEvent::class, 'handleLogout']);
        Event::listen(PasswordReset::class, [AuditSecurityEvent::class, 'handlePasswordReset']);

        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        if (env('MAIL_MOCK')) {
            Mail::alwaysTo(env('MAIL_MOCK_TO'));
        }

        Paginator::useBootstrap();
        Schema::defaultStringLength(191);

        // Register HTML macros (icon_link, image_link, icon_btn, show_username)
        require base_path('app/Logic/Macros/HtmlMacros.php');

        // Register Spatie Health checks
        Health::checks([
            UsedDiskSpaceCheck::new()
                ->warnWhenUsedSpaceIsAbovePercentage(70)
                ->failWhenUsedSpaceIsAbovePercentage(90),
            DatabaseCheck::new(),
            CacheCheck::new(),
            ScheduleCheck::new()
                ->heartbeatMaxAgeInMinutes(2),
            DebugModeCheck::new(),
            EnvironmentCheck::new(),
            RedisCheck::new(),
            HorizonCheck::new(),
            OptimizedAppCheck::new(),
        ]);
    }
}
