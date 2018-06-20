<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model {

    protected $table = 'suggestions';

    public static $rules = [
        'content' => 'required|max:2000',
    ];

    protected $fillable = ['content'];

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function likes() {
        return $this->hasMany('App\Like');
    }

}