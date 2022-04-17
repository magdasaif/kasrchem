<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Spatie\MediaLibrary\MediaCollections\Models\Media;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Article extends Model implements HasMedia
{
    use HasFactory,SoftDeletes,InteractsWithMedia;
    protected $dates = ['deleted_at'];
    
    protected $guarded=[];
    protected $table = 'articles';

    //relation with media pivot table section_all_pages
    public function rel_section()
    {
        return $this->belongsToMany('App\Models\Sitesection','section_all_pages','type_id','sitesection_id')->withTimestamps(); 
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
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
