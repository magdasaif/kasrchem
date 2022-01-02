<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sitesection extends Model
{
    use HasFactory;
    public $fillable = ['site_name_ar','site_name_en','priority','statues','image'];
    protected $table = 'site_sections';
}
