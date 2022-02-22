<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Sitesection;
use App\Models\Main_Category;
use App\Models\Sub_Category2; 

use App\Http\Requests\subCategory2Request;



class SubcategoryController2_new extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $from_side_or_no='yes';
        $categories = Sub_Category2::where('visible', '!=' , 0)->withcount('sub_cate3')->orderBy('id','desc')->get();
      // $categories = Sub_Category2 ::withCount('cate_id')->get();
        
        return view('categories.sub2.category',compact('categories','from_side_or_no'));
    }

    public function create()
    {
        $from_side_or_no='yes';
        $sections = Sitesection::where('visible', '!=' , 0)->get();
        $sub1_categories = Main_Category::where('visible', '!=' , 0)->get();
        //return $sub1_categories;
        return view('categories.sub2.add',compact('sections','sub1_categories','from_side_or_no'));
    }

}
