<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery_Photo_Image extends Model
{
    use HasFactory;
    public $fillable = ['gallery_id','image'];
    protected $table = 'gallery_photo_images';
    public function relation_with_photo_gallery()
    {
        return $this->belongsTo('App\Models\Photo_Gallery', 'gallery_id');
    }


}
