<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
class SiteInfo extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;

    protected $table = 'site_infos';
    protected $guarded=[];
    public $timestamps = true;

     //this for image optimization package 
     public function registerMediaConversions(Media $media = null): void
     {
        $this->addMediaConversion('nav')
        ->width(40)
        ->height(40);
 
         //الأبعاد [يجب أن يكون العرض بين (850 و 1200) ، ويجب أن يكون الارتفاع بين (315 و 600)]
         $this->addMediaConversion('logo')
         ->width(300)
         ->height(300);
                 
     }
}
