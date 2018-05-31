<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model {

    protected $table = 'medias';

    public static $rules = [
        'file' => 'required|file'
    ];

    protected $fillable = ['file', 'type'];
    
    public function template() {
        return $this->belongsTo('App\Template', 'template_id');
    }
}