<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    use HasFactory;
    // public $fillable=['id','name','link','icon','status'];
    protected $guarded=[];
    public $timestamps = true;
}
