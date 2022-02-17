<?php

namespace App\Http\Controllers\Category;


use Illuminate\Http\Request;
use App\Models\Main_Category;
use App\Models\Sub_Category2;
use App\Models\Sub_Category3;
use App\Models\Sub_Category4;
use App\Models\Video;
use App\Models\Product;
use App\Models\Article;
use App\Models\Release;
use App\Models\Photo_Gallery;

use App\Http\Controllers\Controller;


class deleteCategoriesController extends Controller
{
    //--------------------------------------------
    public function findsub1($cate_id)
    {
       
        // $sub_Category2= sub_Category2::pluck("cate_id");  //main_category_in_sub2 
        // $Video= Video::pluck("main_cate_id");  //main_category_in_Video 
        // $Product= Product::pluck("main_cate_id");  //main_category_in_Product
        // $Article= Article::pluck("main_cate_id");  //main_category_in_Article
        // $Release= Release::pluck("main_cate_id");  //main_category_in_Release
        // $Photo_Gallery= Photo_Gallery::pluck("main_cate_id");  //main_category_in_Photo_Gallery
        
        //---------------------------------------//
        $sub_Category2= sub_Category2::where("cate_id",$cate_id)->pluck("cate_id"); 
        $Video= Video::where("main_cate_id",$cate_id)->pluck("main_cate_id");
        $Product= Product::where("main_cate_id",$cate_id)->pluck("main_cate_id");  //main_category_in_Product
        $Article= Article::where("main_cate_id",$cate_id)->pluck("main_cate_id");  //main_category_in_Article
        $Release= Release::where("main_cate_id",$cate_id)->pluck("main_cate_id");  //main_category_in_Release
        $Photo_Gallery= Photo_Gallery::where("main_cate_id",$cate_id)->pluck("main_cate_id");  //main_category_in_Photo_Gallery
        
        //-----------------------------------------------//
        
        $data= Main_Category::where('id',$cate_id)
        ->whereIn('id',  $sub_Category2)
        ->orWhereIn('id',  $Video)
        ->orWhereIn('id',  $Product)
        ->orWhereIn('id',  $Article)
        ->orWhereIn('id',  $Release)
        ->orWhereIn('id',  $Photo_Gallery)
        // ->pluck("id")
        ->get();
        ;


      

         //dd($data);
        return response()->json($data); //then sent this data to ajax success
        //return $data;
    }
    //--------------------------------------------
    public function findsub2($id)
    {

   

    }

//--------------------------------------------
    public function findsub3($id)
    {
  
    }
    //---------------------------------------------//
    public function findsub4($id)
    {
     
    }
  
}
