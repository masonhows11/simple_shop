<?php

namespace App\Models;

 use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Services\Permission\Traits\HasPermission;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable,HasPermission;

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
}
