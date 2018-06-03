<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model {

    protected $table = 'templates';

    public static $rules = [

        'name' => 'required|unique:templates|max:255',
        'description' => 'max:2000',
        'file' => 'required|mimes:zip|max:4048',
        'price' => 'required|regex:/^\d*(\.\d{1,2})?$/'

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
        return $this->belongsToMany('App\Order' , 'order_template' , 'order_id' , 'template_id');
    }
    
}