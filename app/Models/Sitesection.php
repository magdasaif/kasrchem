<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Sitesection extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    
    protected $table = 'site_sections';
    protected $guarded=[];
    
    public function childs() {
        return $this->hasMany('App\Models\Sitesection','parent_id','id')->where('visible', '!=',0);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
 //==============resize image===================
 public function registerMediaConversions(Media $media = null): void
 {
         //---------------------conversion for dashboard -------------------------------------
         $this->addMediaConversion('index')
           ->format('webp')
           ->width(90)
           ->height(90);

           $this->addMediaConversion('edit')
           ->format('webp')
           ->width(300)
           ->height(200);

           //---------------------conversion for front -------------------------------------
           $this->addMediaConversion('phone')
           ->format('webp')
           ->width(320);

           $this->addMediaConversion('tablet')
           ->format('webp')
           ->width(786);

           $this->addMediaConversion('desktop')
           ->format('webp')
           ->width(1024);

           $this->addMediaConversion('largeDesktop')
           ->format('webp')
           ->width(1440);
        
     //-------------------------------------------------------------
 }

//mobile -->
//templet
//desktop
//largedesktop

    
}
