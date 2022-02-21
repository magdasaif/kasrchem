<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_supplier extends Model
{
    use HasFactory;

    protected $table = 'products_suppliers';
    protected $guarded=[];
    public $timestamps = true;
}
