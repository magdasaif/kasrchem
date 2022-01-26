<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    use HasFactory;
    public $fillable = ['title_ar','title_en','mission_ar','mission_en','vision_ar','vision_en','goal_ar','goal_en','image'];
     public $timestamps = true;
}
