<?php
use Spatie\MediaLibrary\MediaCollections\Models\Media;

if (! function_exists('registerMediaConversions')) {
   //this for image optimization package 
  function registerMediaConversions(Media $media = null): void
   {
       $this->addMediaConversion('thumb')
               ->width(200)
               ->height(120);

       $this->addMediaConversion('logo')
               ->width(90)
               ->height(90);
   }
}
