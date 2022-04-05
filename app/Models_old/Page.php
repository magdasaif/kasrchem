<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $guarded=[];
    //public $fillable = ['title_ar','title_en','description_ar','description_en','content_ar','content_en','status'];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
