<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branche extends Model
{
    use HasFactory;
    public $fillable=['id','name_ar','name_en','address_ar','address_en','email','phone','fax','latitude','longitude','status'];
    public $timestamps = true;
}
