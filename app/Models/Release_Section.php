<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Release_Section extends Model
{
    use HasFactory;

    protected $table = 'release_sections';
    protected $guarded=[];
    public $timestamps = true;
}
