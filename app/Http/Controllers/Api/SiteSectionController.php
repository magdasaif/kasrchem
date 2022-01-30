<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\sectionResource;
use App\Http\Resources\main_categoryResource;
use App\Http\Resources\sub_categoriesResource;
use App\Http\Resources\typesResource;
use App\Http\Resources\sub_typesResource;
use App\Models\Sitesection;
use App\Models\Main_Category;
use App\Models\Sub_Category2;
use App\Models\Sub_Category3;
use App\Models\Sub_Category4;
use Illuminate\Support\Facades\Validator;
class SiteSectionController extends Controller
{
    
    public function index($lang)
    {
       // $Sitesections = Sitesection::get();
        if($lang=='ar')
        {
           $Sitesections = Sitesection::select('id','site_name_ar AS name','image')->get();
        }
        else
        { 
          $Sitesections = Sitesection::select('id','site_name_en AS name','image')->get();
        }

        return response($Sitesections,200,['OK']);
    }

//------------------------------------------------------------------//
public function get_section_category($lang,$section_id)
{
    $main_category=main_categoryResource::collection(Main_Category::where('section_id',$section_id)->get());
    if($lang=='ar'){
        $main_category->map(function($i) { $i->lang = 'ar'; });
    }else{
    $main_category->map(function($i) { $i->lang = 'en'; });
    }
    return response($main_category,200,['OK']);
}
//----------------------------------------------------------------------//
public function get_category_sub_category($lang,$category_id)
{
    $Sub_Category2=sub_categoriesResource::collection(Sub_Category2::where('cate_id',$category_id)->get());
        if($lang=='ar'){
            $Sub_Category2->map(function($i) { $i->lang = 'ar'; });
        }else{
        $Sub_Category2->map(function($i) { $i->lang = 'en'; });
        }
    return response($Sub_Category2,200,['OK']);
}
//-------------------------------------------------------------//
public function get_sub_category_types($lang,$sub_category_id)
{
     $Sub_Category3=typesResource::collection(Sub_Category3::where('sub2_id',$sub_category_id)->get());
        if($lang=='ar'){
            $Sub_Category3->map(function($i) { $i->lang = 'ar'; });
        }else{
        $Sub_Category3->map(function($i) { $i->lang = 'en'; });
        }
     return response($Sub_Category3,200,['OK']);
}
//-----------------------------------------------------//
public function get_types_sub_types($lang,$type_id)
{
   $Sub_Category4=sub_typesResource::collection(Sub_Category4::where('sub3_id',$type_id)->get());
     if($lang=='ar'){
            $Sub_Category4->map(function($i) { $i->lang = 'ar'; });
        }else{
        $Sub_Category4->map(function($i) { $i->lang = 'en'; });
        }
   return response($Sub_Category4,200,['OK']);
}
//--------------------------------------------------------------//
    // public function get_one_section($section_id)
    // {
    //     // return $section_id;
    //     $Sitesections = Sitesection::where('id','=',$section_id)->get();
    //      return response($Sitesections,200,['OK']);
    //  }
//--------------------------------------------------------------//


}
