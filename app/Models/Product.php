<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product_attachment;

class Product extends Model
{
    use HasFactory;


    protected $table = 'products';
    public $fillable=['id','main_cate_id','sub1_id','sub2_id','sub3_id','name_ar','name_en','code','desc_ar','desc_en','image','status','video_link',];
    protected $guarded=[];
    public $timestamps = true;

    //relation with main_category table
   /* public function ProductMainCategory()
    {
        return $this->belongsTo('App\Models\Main_category', 'main_cate_id');
    }*/

    public function relation_with_main_category()
    {
        return $this->belongsTo('App\Models\Main_Category', 'main_cate_id');
    }


    public function relation_with_sub2_category()
    {
        return $this->belongsTo('App\Models\Sub_Category2', 'sub1_id');
    }


    public function relation_with_sub3_category()
    {
        return $this->belongsTo('App\Models\sub_Category3', 'sub2_id');
    }

    
    public function relation_with_sub4_category()
    {
        return $this->belongsTo('App\Models\Sub_Category4', 'sub3_id');
    }

   /* public function images()
    {
        return $this->hasMany(Product_attachment::class,'product_id')->where('type', 'image');
    }

    public function attachments()
    {
        return $this->hasMany(Product_attachment::class,'product_id')->where('type', 'file');
    }

    public function features()
    {
        return $this->hasMany(Product_Feature::class,'product_id');
    }*/

}
