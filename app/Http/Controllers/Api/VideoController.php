<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Video;

class VideoController extends Controller
{
    
    public function index(Request $request)
    {
    //select products in selected categories 
         $main_cate_id=$request->category_id;
         $sub2_id=$request->sub_category_id;
         $sub3_id=$request->type_id;
         $lang=$request->locale;

         if($request->perpage){$perpage=$request->perpage;}else{$perpage=10;}
         
         if($lang=='ar'){
             $selected="title_ar as title";
         }else{
              $selected="title_en as title";
         }
        
         $posts =  Video::select('id',$selected,'link')->where('main_cate_id',$main_cate_id)->where('sub2_id',$sub2_id)->where('sub3_id',$sub3_id)->where('status','1')->paginate($perpage);
         return response($posts,200,['OK']);
    }
}
