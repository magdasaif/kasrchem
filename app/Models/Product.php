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

}
