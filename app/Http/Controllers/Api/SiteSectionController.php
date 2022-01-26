<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\sectionResource;
use App\Http\Resources\main_categoryResource;

use App\Models\Sitesection;
use App\Models\Main_Category;

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
//--------------------------------------------------------------//
public function get_section_category($lang,$section_id)
{
  
 $main_category=main_categoryResource::collection(Main_Category::where('section_id',$section_id)->get());
        //----------to pass lang to resource---------
        if($lang=='ar'){
            $main_category->map(function($i) { $i->lang = 'ar'; });
        }else{
        $main_category->map(function($i) { $i->lang = 'en'; });
        }
        //-----------------------------------------------
 return response($main_category,200,['OK']);
}
//--------------------------------------------------------------//




















//--------------------------------------------------------------//
    // public function get_one_section($section_id)
    // {
    //     // return $section_id;
    //     $Sitesections = Sitesection::where('id','=',$section_id)->get();
    //      return response($Sitesections,200,['OK']);
    //  }
//--------------------------------------------------------------//


}
