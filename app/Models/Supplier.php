<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Supplier extends Model implements HasMedia
{
    use HasFactory;
    use SoftDeletes;
    use InteractsWithMedia;
    
    protected $dates = ['deleted_at'];
    //public $fillable = ['id','parent_id','type','name_ar','name_en','logo','description_ar','description_en'];
    protected $guarded=[];
    
    public function sup_sections(){
        return $this->belongsToMany('App\Models\Sitesection','supplier_sections');
    }
    
    public function products(){
        return $this->belongsToMany('App\Models\Product','products_suppliers');
    }

    public function childs() {
        return $this->hasMany('App\Models\Supplier','parent_id','id') ;
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
        $this->addMediaConversion('thumb')
              ->width(200)
              ->height(120);

        $this->addMediaConversion('logo')
              ->width(90)
              ->height(90);
    }
}
