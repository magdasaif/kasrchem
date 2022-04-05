<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    //public $fillable = ['id','parent_id','type','name_ar','name_en','logo','description_ar','description_en'];
    protected $guarded=[];
    
    public function sup_sections(){
        return $this->belongsToMany('App\Models\Sitesection','supplier_sections');
    }
    
    public function products(){
        return $this->belongsToMany('App\Models\Product','products_suppliers');
    }

    public function childs() {
        return $this->hasMany('App\Models\Supplier','parent_id','id') ;
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
