<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sub_Category2;

class Main_Category extends Model
{
    use HasFactory;

    protected $table = 'main_categorys';
    public $fillable=['id','subname_ar','subname_en','image','section_id','status'];
    public $timestamps = true;

    public function relation_with_section()
    {
        return $this->belongsTo('App\Models\Sitesection', 'section_id');
    }

    public function sub_cate2()
    {
        return $this->hasMany(Sub_Category2::class,'cate_id');
    }
}
