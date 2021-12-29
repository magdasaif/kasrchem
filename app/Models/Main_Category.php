<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Main_Category extends Model
{
    use HasFactory;

    protected $table = 'main_categories';
    public $fillable=['id','subname_ar','subname_en','image','section_id','status'];
    public $timestamps = true;

    public function Sections()
    {
        return $this->belongsTo('App\Models\Sitesection', 'section_id');
    }
}
