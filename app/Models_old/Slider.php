<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Slider extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $guarded=[];
    
   // public $fillable = ['priority','image','status'];
    protected $table = 'sliders';
    
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
