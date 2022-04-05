<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier_section extends Model
{
    use HasFactory;
    protected $table = 'supplier_sections';
    protected $guarded=[];
    public $timestamps = false;

}
