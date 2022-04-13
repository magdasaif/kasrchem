<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
class Page extends Model implements HasMedia
{
    use HasFactory,SoftDeletes,InteractsWithMedia;
    
    protected $dates = ['deleted_at'];
    protected $guarded=[];
    //public $fillable = ['title_ar','title_en','description_ar','description_en','content_ar','content_en','status'];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

      //this for image optimization package 
      public function registerMediaConversions(Media $media = null): void
      {
          $this->addMediaConversion('thumb')
                  ->width(200)
                  ->height(120);
  
          $this->addMediaConversion('logo')
                  ->width(90)
                  ->height(90);
      }
}
