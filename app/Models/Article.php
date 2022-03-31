<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    
    //public $fillable = ['main_cate_id','sub1_id','sub2_id','sub3_id','title_ar','title_en','content_ar','content_en','image','status'];
    protected $guarded=[];
    protected $table = 'articles';

    //relation with media pivot table section_all_pages
    public function rel_section()
    {
        return $this->belongsToMany('App\Models\Sitesection','section_all_pages','type_id','sitesection_id')->withTimestamps(); 
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
    
}
