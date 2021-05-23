<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'surname',
        'name',
        'lastname',
        'gender',
        'login',
        'password',
        'id_roles',
        'id_group_electrical',
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
//
//    /**
//     * The attributes that should be cast to native types.
//     *
//     * @var array
//     */
//    protected $casts = [
//        'email_verified_at' => 'datetime',
//    ];
//
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Проверка на роль пользователя
    public function isAdmin()
    {
        return $this->id_roles == 1;
    }

    public function isModerator()
    {
//        dd($this->id_roles);
        return $this->id_roles == 2;
    }
}
