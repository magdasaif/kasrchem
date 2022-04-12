<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Release extends Model implements HasMedia
{
    use HasFactory;
    use SoftDeletes;
    use InteractsWithMedia;
    protected $dates = ['deleted_at'];
    protected $guarded=[];
    
  //  public $fillable = ['site_id','main_cate_id','sub1_id','sub2_id','sub3_id','title_ar','title_en','image','file','status'];
  protected $table = 'releases';
//-----------------------------------------------
    // public function rel_section(){
    //     return $this->belongsToMany('App\Models\Sitesection','releases_sections');
    // }
//------function to pivot table------------------
public function rel_section(){
    return $this->belongsToMany('App\Models\Sitesection','section_all_pages','type_id','sitesection_id')->withTimestamps();
  
}
//-------------------morph table for images----------------
public function image_file()
{
  return $this->morphMany(Image::class, 'imageable');
  
}

//-------------------------------------------------------------------
public function scopeMainImage()
{
    return $this->image_file->where('image_or_file','1')->where('main_or_sub','1');
}
//-----------------------morph table for files------------------------------
 public function scopeMainFile()
 {
     return $this->image_file->where('image_or_file','2')->where('main_or_sub','1');
 }
 //-------------------------------------------
        //==============resize image===================
    public function registerMediaConversions(Media $media = null): void
    {
        //---------release method looks like with 3 size conversions-----------
        $this->addMediaConversion('index')
              ->width(90)
              ->height(90);

        $this->addMediaConversion('logo')
              ->width(190)
              ->height(190);

        $this->addMediaConversion('adding')
        ->width(200)
        ->height(120);
        //-------------------------------------------------------------
    }
}
