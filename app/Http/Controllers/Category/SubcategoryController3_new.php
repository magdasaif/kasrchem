<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Sitesection;
use App\Models\Main_Category;
use App\Models\Sub_Category2;
use App\Models\Sub_Category3; 

use App\Http\Requests\SubCatergory3Request;




class SubcategoryController3_new extends Controller
{
  
    //----------------------------------------------
    public function index()
    {
        $from_side_or_no='yes';
        //dd( sub_Category3::where('sub2_id',$sub2_id)->get());
        $sub_Category3 = Sub_Category3::withcount('relation_sub3_with_sub4')->get();
        return view('categories.sub3.show',compact('sub_Category3','from_side_or_no'));
    }
    //----------------------------------------------

    public function create()
    {
        $from_side_or_no='yes';
        $sections = Sitesection::get();
        $sub1_categories = Main_Category::get();
        $Sub_Category2 = Sub_Category2::get();

        return view('categories.sub3.add',compact('sections','sub1_categories','Sub_Category2','from_side_or_no'));
    }
//----------------------------------------------
  
  
}
