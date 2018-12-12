<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'ragione_sociale', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function locazioni()
    {
        return $this->hasMany(Locazioni::class, 'user_id');
    }

    public function ups()
    {
        return $this->hasManyThrough(Ups::class, Locazioni::class);
    }

    public static function laratablesCustomAction($cliente)
    {
        return view('clienti.index_action', compact('cliente'))->render();
    }

}
