<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    public $fillable = ['main_cate_id','sub1_id','sub2_id','sub3_id','title_ar','title_en','link','status'];
    protected $table = 'videos';


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
        return $this->belongsTo('App\Models\Sub_Category3', 'sub2_id');
    }


    public function relation_with_sub4_category()
    {
        return $this->belongsTo('App\Models\Sub_Category4', 'sub3_id');
    }
    
    public function relation_with_site()
    {
        return $this->belongsTo('App\Models\Sitesection', 'site_id');
    }
}
