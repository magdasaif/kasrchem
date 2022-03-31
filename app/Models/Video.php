<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Video extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $guarded=[];
    //public $fillable = ['main_cate_id','sub1_id','sub2_id','sub3_id','title_ar','title_en','link','status'];
    protected $table = 'videos';


    public function rel_section(){
        return $this->belongsToMany('App\Models\Sitesection','section_all_pages','type_id','sitesection_id')->withTimestamps();
      
    }
}
