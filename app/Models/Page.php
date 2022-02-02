<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    public $fillable = ['title_ar','title_en','description_ar','description_en','content_ar','content_en','status'];
   
}
