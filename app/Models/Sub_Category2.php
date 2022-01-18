<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\sub_Category3;


class Sub_Category2 extends Model
{
    use HasFactory;

    protected $table = 'sub_categorys2';
    public $fillable=['id','subname2_ar','subname2_en','image2','cate_id','status'];
    public $timestamps = true;

    public function relation_sub2_with_main()
    {
        return $this->belongsTo('App\Models\Main_Category', 'cate_id');
    }

    public function sub_cate3()
    {
        return $this->hasMany(sub_Category3::class,'sub2_id');
    }
}
