<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model {

    protected $table = 'templates';

    public static $created_rules = [

        'name' => 'required|max:255',
        'description' => 'max:2000',
        'file' => 'required|mimes:zip,tar|max:4048',
        'price' => 'required|regex:/^\d*(\.\d{1,2})?$/',
        'category' => 'nullable|exists:categories,id'

    ];

    public static $updated_rules = [

        'name' => 'required|max:255',
        'description' => 'max:2000',
        'file' => 'nullable|mimes:zip,tar|max:4048',
        'price' => 'required|regex:/^\d*(\.\d{1,2})?$/',
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
        return $this->hasMany('App\Comment');
    }

    public function votes () {
        return $this->hasMany('App\Vote');
    }


}