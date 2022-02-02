<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Main_Category;

class SubCategoryController1 extends Controller
{
    public function index(){
        $categories = Main_Category::get();
        return response($categories,200,['OK']);
    }

    public function getCategories($section_id){
       // return $section_id;
       $categories = Main_Category::where('section_id','=',$section_id)->get();
        return response($categories,200,['OK']);
    }
}
