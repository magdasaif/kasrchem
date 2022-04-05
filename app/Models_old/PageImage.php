<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageImage extends Model
{
    use HasFactory;

    public $fillable = ['page_id','image'];

    public function relation_with_supplier()
    {
        return $this->belongsTo('App\Models\Page', 'page_id');
    }
}
