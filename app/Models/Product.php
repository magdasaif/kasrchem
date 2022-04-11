<?php

namespace App\Models;

use App\Models\Image;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory;
    use SoftDeletes;

    use InteractsWithMedia;
    
    protected $dates = ['deleted_at'];

    protected $table = 'products';
    //public $fillable=['id','main_cate_id','sub2_id','sub3_id','sub4_id','name_ar','name_en','code','desc_ar','desc_en','image','status','video_link',];
    protected $guarded=[];
    public $timestamps = true;

    public function suppliers(){
        return $this->belongsToMany('App\Models\Supplier','products_suppliers');
    }

    //relation with media pivot table section_all_pages
     public function rel_section()
     {
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

    public function scopeMainFile()
    {
        return $this->images->where('image_or_file','2')->where('main_or_sub','1');
    }
    
    public function scopeSubFiles()
    {
        return $this->images->where('image_or_file','2')->where('main_or_sub','2');
    }

    //this for media library package
    // public static function last(){
    //    // return Media::all()->last();
    //      return Static::all()->last();
    // }
    
    // public function scopeAllMedia(){
    //    // return Media::all()->last();
    //    return $this->belongsToMany(Media::class,'media');
    // }

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
