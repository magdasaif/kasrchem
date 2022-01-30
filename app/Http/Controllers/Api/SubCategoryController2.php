<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sub_Category2;

class SubCategoryController2 extends Controller
{
    public function index(){
        $sub2 = Sub_Category2::get();
        return response($sub2,200,['OK']);
    }

    public function getCategories($sub1){
       $sub2 = Sub_Category2::where('cate_id','=',$sub1)->get();
        return response($sub2,200,['OK']);
    }
}
