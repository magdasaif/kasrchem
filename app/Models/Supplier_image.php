<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier_image extends Model
{
    use HasFactory;
    public $fillable = ['supplier_id','image'];
    public function relation_with_supplier()
    {
        return $this->belongsTo('App\Models\Supplier', 'supplier_id');
    }
}
