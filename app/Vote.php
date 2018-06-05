<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model {

    protected $table = 'votes';

    public static $rules = [

        'status' => 'required',
    ];

    protected $fillable = ['status'];

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function template () {
        return $this->belongsTo('App\Template', 'template_id');
    }

}