<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sub_Category2 extends Model
{
    use HasFactory;

    protected $table = 'sub2_categories';
    public $fillable=['id','subname2_ar','subname2_en','image2','cate_id','status'];
    public $timestamps = true;

    public function relation_sub2_with_main()
    {
        return $this->belongsTo('App\Models\Main_Category', 'cate_id');
    }
}
