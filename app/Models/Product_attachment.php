<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_attachment extends Model
{
    use HasFactory;

    protected $table = 'products_attachments';
    protected $guarded=[];
    public $timestamps = true;
}
