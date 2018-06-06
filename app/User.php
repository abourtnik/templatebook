<?php

namespace App;

use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

    use Notifiable;

    public static $rules = [
        'avatar' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048' // 2 Mo
    ];

    protected $fillable = [
        'name', 'email', 'password', 'confirmation_token'
    ];

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