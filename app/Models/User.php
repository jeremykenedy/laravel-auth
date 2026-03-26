<?php

namespace App\Models;

use App\Notifications\ResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
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
    use HasChat;
    use HasFaceAuth;
    use HasFactory;
    use HasProfile;
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
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
