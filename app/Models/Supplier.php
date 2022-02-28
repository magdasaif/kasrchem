<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    public $fillable = ['name_ar','name_en','logo','description_ar','description_en','parent_id','type'];

    public function products(){
        return $this->belongsToMany('App\Models\Product','products_suppliers');
    }

    public function childs() {
        return $this->hasMany('App\Models\Supplier','parent_id','id') ;
    }
}
