<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Spatie\MediaLibrary\MediaCollections\Models\Media;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Partner extends Model implements HasMedia
{
    use HasFactory,SoftDeletes,InteractsWithMedia;
    
    protected $dates = ['deleted_at'];
    protected $guarded=[];
   // public $fillable=['id','name_ar','name_en','image','external_link','status'];
    public $timestamps = true;

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
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
