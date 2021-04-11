<?php

namespace App\Models;

use App\Models\User\UserAddress;
use App\Models\User\UserSim;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'email_verified_at',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    const USER_ROLE_ADMIN = 1; // Роль админ
    const USER_ROLE_USER = 2; // Роль пользователь
    const USER_ROLE_DEALER = 3; // Роль диллер

    public function address()
    {
        return $this->hasOne(UserAddress::class, 'user_id');
    }

    public function sims()
    {
        return $this->hasOne(UserSim::class, 'user_id');
    }
}
