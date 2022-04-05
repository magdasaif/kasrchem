<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Partner extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $guarded=[];
   // public $fillable=['id','name_ar','name_en','image','external_link','status'];
    public $timestamps = true;

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
