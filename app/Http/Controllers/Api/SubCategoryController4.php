<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sub_Category4;

class SubCategoryController4 extends Controller
{
    public function index(){
        $sub4 = Sub_Category4::get();
        return response($sub4,200,['OK']);
    }

    public function getCategories($sub3){
       // return $section_id;
       $sub4 = Sub_Category4::where('sub3_id','=',$sub3)->get();
        return response($sub4,200,['OK']);
    }
}
