<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sub_Category3 extends Model
{
    use HasFactory;
    protected $table = 'sub_categorys3';
    public $fillable=['id','sub2_id','subname_ar','subname_en','image','status'];
    public $timestamps = true;

  //  public function Sub_Category3()
 public function vv()

    {
        return $this->belongsTo('App\Models\Sub_Category2', 'sub2_id');
    }


    public function relation_sub3_with_sub4()
     {
         return $this->hasMany('App\Models\Sub_Category4', 'sub3_id');
     }
}



