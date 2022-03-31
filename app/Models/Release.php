<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Release extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $guarded=[];
    
  //  public $fillable = ['site_id','main_cate_id','sub1_id','sub2_id','sub3_id','title_ar','title_en','image','file','status'];
  protected $table = 'releases';


    public function rel_section(){
        return $this->belongsToMany('App\Models\Sitesection','releases_sections');
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
