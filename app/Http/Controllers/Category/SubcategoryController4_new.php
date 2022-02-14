<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Sitesection;
use App\Models\Main_Category;
use App\Models\Sub_Category2;
use App\Models\Sub_Category3;
use App\Models\Sub_Category4; 

use App\Http\Requests\SubCategory4Request;

class SubcategoryController4_new extends Controller
{
    public function index()
    {
        $from_side_or_no='yes';
        $sub_category4=Sub_Category4::orderBy('id','desc')->get();

        return view('categories.sub4.show',compact('sub_category4','from_side_or_no'));
    }
   
//-----------------show add form------------------------------------
     public function create()
    {
      
        $from_side_or_no='yes';
        $sub_Category3      = Sub_Category3::get(); 
        $Sub_Category2      = Sub_Category2::get();
        $sub1_categories    = Main_Category::get();
        $sections           = Sitesection::get();
        return view('categories.sub4.add',compact('sub_Category3','Sub_Category2','sections','sub1_categories','from_side_or_no'));
   
    }
}
