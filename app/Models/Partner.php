<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;
    public $fillable=['id','name_ar','name_en','image','external_link','status'];
    public $timestamps = true;
}
