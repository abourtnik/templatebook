<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Category extends Model {

    protected $table = 'categories';

    public static $rules = [

    ];


    public function template() {

        return $this->hasMany('App\Template');
    }
}