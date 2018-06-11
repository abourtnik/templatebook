<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model {

    protected $table = 'medias';

    public static $rules = [

        'file' => 'required|mimes:jpeg,png,jpg,gif,svg|size:2048', // 2 Mo
        'type' => 'required|in:image,youtube'

    ];

    protected $fillable = ['file', 'type'];

    public function template() {

        return $this->belongsTo('App\Template', 'template_id');
        
    }

}