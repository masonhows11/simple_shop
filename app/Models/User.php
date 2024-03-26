<?php

namespace App\Models;

use App\Mail\ResetPasswordEmail;
use App\Mail\VerificationEmail;
use App\Services\Discount\Coupon\Traits\Couponable;
use App\Services\Permission\Traits\HasRoles;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Services\Permission\Traits\HasPermission;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasPermission, HasRoles, Couponable;

    protected $guard = 'web';
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'auth_type',
        'name',
        'role',
        'first_name',
        'last_name',
        'password',
        'subscribe_news',
        'national_code',
        'email',
        'mobile',
        'email_verified_at',
        'mobile_verified_at',
        'provider',
        'provider_id',
        'avatar',
        'token',
        'token_guid',
    ];
    //    protected $fillable = [
    //        'name',
    //        'email',
    //        'password',
    //    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function sendEmailVerificationNotification()
    {

        Mail::to($this)->send(new VerificationEmail($this));
    }


    public function sendPasswordResetNotification($token)
    {
        Mail::to($this)->send(new ResetPasswordEmail($this, $token));
    }

    public function addresses()
    {

        return $this->hasMany(Address::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }
}
