<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


use Spatie\MediaLibrary\MediaCollections\Models\Media;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
class Slider extends Model implements HasMedia
{
    use HasFactory,SoftDeletes,InteractsWithMedia;
    
    protected $dates = ['deleted_at'];
    protected $guarded=[];
    
   // public $fillable = ['priority','image','status'];
    protected $table = 'sliders';
    
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

     //this for image optimization package 
     public function registerMediaConversions(Media $media = null): void
     {
        $this->addMediaConversion('edit')
        ->width(300)
        ->height(200);
 
         //الأبعاد [يجب أن يكون العرض بين (850 و 1200) ، ويجب أن يكون الارتفاع بين (315 و 600)]
         $this->addMediaConversion('slider_img')
         ->width(900)
         ->height(400);
                 
        $this->addMediaConversion('index')
        ->width(90)
        ->height(90);
     }
}
