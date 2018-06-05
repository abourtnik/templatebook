<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {

    protected $table = 'comments';

    public static $rules = [

        'content' => 'required|max:2000',
    ];

    protected $fillable = ['content'];

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function template () {
        return $this->belongsTo('App\Template', 'template_id');
    }

}