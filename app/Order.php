<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

    protected $table = 'orders';

    protected $fillable = ['user_id', 'ammount' , 'paypal_id'];

    public function templates () {

        return $this->belongsToMany('App\Template');
 
    }
}