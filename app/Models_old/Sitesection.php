<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Main_Category;
class Sitesection extends Model
{
    use HasFactory;
   // public $fillable = ['id','parent_id','site_name_ar','site_name_en','priority','statues','image'];
    protected $table = 'site_sections';
    protected $guarded=[];
    
    public function childs() {
        return $this->hasMany('App\Models\Sitesection','parent_id','id')->where('visible', '!=',0);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
    
}
