<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Branche extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    
    //public $fillable=['id','name_ar','name_en','address_ar','address_en','email','phone','fax','latitude','longitude','status'];
    protected $guarded=[];
    public $timestamps = true;
}
