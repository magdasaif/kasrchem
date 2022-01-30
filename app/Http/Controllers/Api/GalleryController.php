<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\GalleryResource;
use App\Models\Photo_Gallery;

class GalleryController extends Controller
{
    
    public function index(Request $request)
    {
    //select galleries in selected categories 
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
        
         $posts =  GalleryResource::collection(Photo_Gallery::select('id',$selected,'image')->where('main_cate_id',$main_cate_id)->where('sub2_id',$sub2_id)->where('sub3_id',$sub3_id)->where('status','1')->paginate($perpage));
         $posts->map(function($t) { $t->type = 'first_fun'; });
         return response($posts,200,['OK']);
    }

    public function getPhotoDetail($id,$lang){

        if($lang=='ar'){
            $selected="title_ar as title";
        }else{
            $selected="title_en as title";
        }

        $all_posts = Photo_Gallery::select('id',$selected,'image')->where('id','=',$id)->get();

        $all_posts = GalleryResource::collection($all_posts);

        $all_posts->map(function($t) { $t->type = 'second'; });

        return response($all_posts,200,['OK']);
    }

}
