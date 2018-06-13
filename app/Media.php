<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model {

    protected $table = 'medias';

    public static $rules = [

        'file.*' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048', // 2 Mo
        'type.*' => 'nullable|in:image,youtube',
        'youtube.*' => 'nullable|url'
    ];

    protected $fillable = ['file', 'type'];

    public function template() {

        return $this->belongsTo('App\Template', 'template_id');
        
    }

}