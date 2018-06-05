<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'confirmation_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function templates () {
        return $this->hasMany('App\Template');
    }

    public function orders () {
        return $this->hasMany('App\Order');
    }

    public function comments () {
        return $this->hasMany('App\Comment');
    }

    public function votes () {
        return $this->hasMany('App\Vote');
    }
}