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
      //---------------------conversion for dashboard -------------------------------------
         $this->addMediaConversion('index')
            ->format('webp')
            ->width(90)
            ->height(90);

         $this->addMediaConversion('edit')
            ->format('webp')
            ->width(300)
            ->height(200);

           //الأبعاد [يجب أن يكون العرض بين (850 و 1200) ، ويجب أن يكون الارتفاع بين (315 و 600)]
           $this->addMediaConversion('sub_img')
                ->format('webp')
                ->width(900)
                ->height(400);
                
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
}
