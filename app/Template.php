<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Template extends Model {

    protected $table = 'templates';

    public static $rules = [

        'name' => 'required|unique:templates|max:255',
        'description' => 'max:2000',
        'file' => 'required|file',
        'price' => ''
    ];

    public function user() {

        return $this->belongsTo('App\User', 'user_id');
    }
}