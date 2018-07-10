<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model {

    protected $table = 'templates';

    public static $created_rules = [

        'name' => 'required|min:1|max:255',
        'description' => 'max:1000',
        'source' => 'required|mimes:zip,tar|max:5120', // 5 Mo
        'price' => 'required|numeric|min:0|max:999',
        'category' => 'nullable|exists:categories,id'
    ];

    public static $updated_rules = [

        'name' => 'required|min:1|max:255',
        'description' => 'max:1000',
        'source' => 'nullable|mimes:zip,tar|max:5120', // 5 Mo
        'price' => 'required|numeric|min:0|max:999',
        'category' => 'nullable|exists:categories,id'
    ];

    protected $fillable = ['name', 'description' , 'file' , 'price' , 'downloads' , 'views' , 'category_id'];

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function medias () {
        return $this->hasMany('App\Media');
    }

    public function category () {
        return $this->belongsTo('App\Category', 'category_id');
    }

    public function orders () {
        return $this->belongsToMany('App\Order' , 'order_template')->withPivot('quantity');
    }

    public function comments () {
        return $this->hasMany('App\Comment')->orderBy('created_at' , 'desc');
    }

    public function votes () {
        return $this->hasMany('App\Vote');
    }

    public function positiveVotes () {
        return $this->hasMany('App\Vote')->where('status','=', 1);
    }

    public function negativeVotes () {
        return $this->hasMany('App\Vote')->where('status','=', 0);
    }


}