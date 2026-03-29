<?php

namespace App\Models;

use App\Notifications\ResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Jeremykenedy\LaravelAvatar\Traits\HasAvatar;
use Jeremykenedy\LaravelChat\Traits\HasChat;
use Jeremykenedy\LaravelFaceAuth\Traits\HasFaceAuth;
use Jeremykenedy\LaravelIpCapture\Traits\CapturesIp;
use Jeremykenedy\LaravelProfiles\Traits\HasProfile;
use jeremykenedy\LaravelRoles\Traits\HasRoleAndPermission;
use Jeremykenedy\LaravelSocialiteKit\Traits\HasSocialAccounts;
use Jeremykenedy\LaravelThemes\Traits\HasTheme;
use Jeremykenedy\LaravelToast\Traits\HasToasts;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use CapturesIp;
    use HasApiTokens;
    use HasAvatar;
    use HasChat;
    use HasFaceAuth;
    use HasFactory;
    use HasProfile {
        HasAvatar::getAvatarUrl insteadof HasProfile;
        HasAvatar::getGravatarUrl insteadof HasProfile;
    }
    use HasRoleAndPermission;
    use HasSocialAccounts;
    use HasTheme;
    use HasToasts;
    use Notifiable;
    use SoftDeletes;

    protected $table = 'users';

    public $timestamps = true;

    protected $guarded = ['id'];

    protected $hidden = [
        'password',
        'remember_token',
        'activated',
        'token',
    ];

    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'email',
        'password',
        'activated',
        'chat_enabled',
        'token',
        'signup_ip_address',
        'signup_confirmation_ip_address',
        'signup_sm_ip_address',
        'admin_ip_address',
        'updated_ip_address',
        'deleted_ip_address',
    ];

    protected $casts = [
        'id' => 'integer',
        'first_name' => 'string',
        'last_name' => 'string',
        'email' => 'string',
        'email_verified_at' => 'datetime',
        'activated' => 'boolean',
        'chat_enabled' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function isOnline(): bool
    {
        if (config('session.driver') !== 'database') {
            return false;
        }

        return DB::table(config('session.table', 'sessions'))
            ->where('user_id', $this->id)
            ->where('last_activity', '>=', now()->subMinutes(5)->timestamp)
            ->exists();
    }

    public function lastActivity(): ?string
    {
        if (config('session.driver') !== 'database') {
            return null;
        }

        $session = DB::table(config('session.table', 'sessions'))
            ->where('user_id', $this->id)
            ->orderBy('last_activity', 'desc')
            ->first();

        return $session
            ? Carbon::createFromTimestamp($session->last_activity)->diffForHumans()
            : null;
    }

    public function profileCompleteness(): array
    {
        $steps = [
            'name' => ['label' => 'Username', 'done' => filled($this->name)],
            'email' => ['label' => 'Email address', 'done' => filled($this->email)],
            'email_verified' => ['label' => 'Email verified', 'done' => $this->email_verified_at !== null],
            'first_name' => ['label' => 'First name', 'done' => filled($this->first_name)],
            'last_name' => ['label' => 'Last name', 'done' => filled($this->last_name)],
            'avatar' => ['label' => 'Profile photo', 'done' => $this->profile?->usesUpload() ?? false],
            'theme' => ['label' => 'Theme selected', 'done' => $this->profile?->theme_id !== null],
            'two_factor' => ['label' => 'Two-factor auth', 'done' => filled($this->two_factor_secret)],
        ];

        $completed = collect($steps)->where('done', true)->count();
        $total = count($steps);
        $percent = $total > 0 ? (int) round(($completed / $total) * 100) : 0;

        return [
            'steps' => $steps,
            'completed' => $completed,
            'total' => $total,
            'percent' => $percent,
        ];
    }
}
