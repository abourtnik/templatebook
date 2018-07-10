<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {

    protected $table = 'comments';

    public static $rules = [

        'content' => 'required|max:1000',
        'template_id' => 'required|exists:templates,id'
    
    ];

    protected $fillable = ['content' , 'template_id'];

    public function user() {

        return $this->belongsTo('App\User', 'user_id');

    }

    public function template () {

        return $this->belongsTo('App\Template', 'template_id');
        
    }
}