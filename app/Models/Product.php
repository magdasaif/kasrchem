<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Image;
class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = 'products';
    //public $fillable=['id','main_cate_id','sub2_id','sub3_id','sub4_id','name_ar','name_en','code','desc_ar','desc_en','image','status','video_link',];
    protected $guarded=[];
    public $timestamps = true;

    public function suppliers(){
        return $this->belongsToMany('App\Models\Supplier','products_suppliers');
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

    // public function scopeAllFiles($query,$main_or_sub)
    // {
    //     return $query->where('image_or_file','2')->where('main_or_sub',$main_or_sub);
    // }
}
