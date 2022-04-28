<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Spatie\MediaLibrary\MediaCollections\Models\Media;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Photo_Gallery extends Model implements HasMedia
{
    use HasFactory,SoftDeletes,InteractsWithMedia;
    protected $dates = ['deleted_at'];
    protected $guarded=[];
    // public $fillable = ['main_cate_id','sub1_id','sub2_id','sub3_id','title_ar','title_en','image','status'];
    protected $table = 'photo_gallerys';


    public function rel_section(){
        return $this->belongsToMany('App\Models\Sitesection','section_all_pages','type_id','sitesection_id')->withTimestamps();
      
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function scopeMainImages()
    {
        return $this->images->where('image_or_file','1')->where('main_or_sub','1');
    }
    
    public function scopeSubImages()
    {
        return $this->images->where('image_or_file','1')->where('main_or_sub','2');
    }
    
    //this for image optimization package 
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

    }
    
}
