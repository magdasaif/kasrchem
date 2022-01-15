<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;


    protected $table = 'products';
//    public $fillable=['id','name_ar','name_en','code','desc_ar','desc_en','image','main_cate_id','status','video_link',];
    protected $guarded=[];
    public $timestamps = true;

    //relation with main_category table
    public function ProductMainCategory()
    {
        return $this->belongsTo('App\Models\Main_category', 'main_cate_id');
    }
}
