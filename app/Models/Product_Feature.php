<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Feature extends Model
{
    use HasFactory;

    protected $table = 'product_features';
    protected $guarded=[];
    public $timestamps = true;
}