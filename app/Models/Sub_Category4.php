<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sub_Category4 extends Model
{
    use HasFactory;
    protected $table = 'sub_categorys4';
    public $fillable=['id','sub3_id','subname_ar','subname_en','status'];
    public $timestamps = true;

    public function Sub_Category4()
    {
        return $this->belongsTo('App\Models\Sub_Category3', 'sub3_id');
    }
}
