<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Media extends Model {
    protected $table = 'medias';
    
    public static $rules = [
        'file' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'type' => 'required|in:image,video,image_url,video_url'
    ];

    protected $fillable = ['file', 'type'];
    
    public function template() {
        return $this->belongsTo('App\Template', 'template_id');
    }
}