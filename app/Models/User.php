<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    const ROLE_ADMIN = 13;
    const ROLE_USER = 7;
    const INFO_TABLE = 'users_info';
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'id',
        'role'
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

    /**
     * Перевіряє користувача чи є він адміном
     * @return bool
     */
    public function isAdmin():bool
    {
        return (int)$this->role === self::ROLE_ADMIN;
    }


    /**
     * Получить запись с номером телефона пользователя.
     */
    public function userContact()
    {
        return $this->hasOne('App\Models\UserContact', 'user_id');
    }

    public function cart(){
        return $this->hasOne('App\Models\Cart');
    }

    function npInfo()
    {
        return $this->hasOne('App\Models\NPInfo');
    }

    function order(){
        return $this->hasOne('App\Models\FullOrders');
    }

}
