<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

    protected $table = 'orders';

    protected $fillable = ['user_id', 'ammount' , 'paypal_id' , 'date'];

    public $timestamps = false;

    public function templates () {

        return $this->belongsToMany('App\Template' , 'order_template' , 'order_id' , 'template_id')->withPivot('quantity');
    }

    public function user () {

        return $this->belongsTo('App\User', 'user_id');
    }



}