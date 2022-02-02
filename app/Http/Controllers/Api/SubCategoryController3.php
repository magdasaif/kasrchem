<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sub_Category3;

class SubCategoryController3 extends Controller
{
    public function index(){
        $sub3 = Sub_Category3::get();
        return response($sub3,200,['OK']);
    }

    public function getCategories($sub2){
       $sub3 = Sub_Category3::where('sub2_id','=',$sub2)->get();
        return response($sub3,200,['OK']);
    }
}
