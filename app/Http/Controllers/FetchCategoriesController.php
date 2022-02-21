<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Main_Category;
use App\Models\Sub_Category2;
use App\Models\Sub_Category3;
use App\Models\Sub_Category4;

class FetchCategoriesController extends Controller
{
    //--------------------------------------------
    public function findsub1($id)
    {
        if($id==0){
            $data= Main_Category::pluck("subname_ar", "id");
        }else{
            $data= Main_Category::where('section_id',$id)->pluck("subname_ar", "id");
        }
         //dd($data);
        return response()->json($data); //then sent this data to ajax success
        return $data;
    }
    //--------------------------------------------
    public function findsub2($id)
    {

    // $sub_Category3= sub_Category3::where('sub2_id',$id)->pluck("id");
     //$sub_Category3= sub_Category3::select("id")->get();
     //---------------------RELATED CATEGORY------------------------
    // $sub_Category3= sub_Category3::pluck("sub2_id"); 
       // $data= Sub_Category2::where('cate_id',$id)->whereIn('id',  $sub_Category3)-> pluck("subname2_ar", "id");

    ///---------------------------------------------------------------//
    $data= Sub_Category2::where('cate_id',$id)->pluck("subname2_ar", "id");
     return response()->json($data); //then sent this data to ajax success
    return $data;

    }

//--------------------------------------------
    public function findsub3($id)
    {
   //  $sub_Category4= sub_Category4::where('sub3_id',$id)->pluck("id");
    //  $sub_Category4= sub_Category4::pluck("sub3_id");
    //  $data= Sub_Category3::where('sub2_id',$id)->whereIn('id',  $sub_Category4)-> pluck("subname_ar", "id");
    $data= Sub_Category3::where('sub2_id',$id)-> pluck("subname_ar", "id");
     ///-------------------------------
     return response()->json($data); //then sent this data to ajax success
     return $data;
    }
    //---------------------------------------------//
    public function findsub4($id)
    {
        $data= Sub_Category4::where('sub3_id',$id)->pluck("subname_ar", "id");
        return response()->json($data); //then sent this data to ajax success
        //return $data;
    }
  
}
