<?php

namespace App\Models;

//use App\Mail\ResetPasswordEmail;
//use App\Mail\VerificationEmail;
//use App\Services\Discount\Coupon\Traits\Couponable;
//use App\Services\Permission\Traits\HasRoles;
//use Illuminate\Contracts\Auth\MustVerifyEmail;
//use App\Services\Permission\Traits\HasPermission;
//use Illuminate\Database\Eloquent\Model;
//use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    protected $guard = 'admin';
    protected $table = 'admins';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'password',
        'email',
        'mobile',
        'email_verified_at',
        'mobile_verified_at',
        'avatar',
        'token',
        'department'
    ];


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

    //// make relation key between admin tbl  & ticket tb;
    //// is department column
    public function tickets()
    {
        return $this->hasMany(ticket::class,'department','department');
    }
}
