<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\MyOwnResetPassword as ResetPasswordNotification;


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

    // Peoples who follow me
    public function followers() {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }

    // Peoples what I follow
    public function followings () {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
    }

    public function suggestions () {
        return $this->hasMany('App\Suggestion');
    }

    // Scope

    public function scopeConfirmed ($query) {
        return $query->where('confirmation_token' , null);
    }

    // Reset password

    public function sendPasswordResetNotification($token) {
        $this->notify(new ResetPasswordNotification($token));
    }
}