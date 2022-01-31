<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\PostsResource;
use App\Models\Article;

class PostsController extends Controller
{

    public function index(Request $request)
    {
        //return  $request->locale;
    //select products in selected categories
         $main_cate_id=$request->category_id;
         $sub2_id=$request->sub_category_id;
         $sub3_id=$request->type_id;
         $lang=$request->header('locale');

         if($request->perpage){$perpage=$request->perpage;}else{$perpage=10;}

         if($lang=='ar'){
             $selected="title_ar as title";
         }else{
              $selected="title_en as title";
         }
         //stock=amunt
         //min=min_amount
         //max=max_amount
         //security_clearance
         $posts =  PostsResource::collection(Article::select('id',$selected,'image')->where('main_cate_id',$main_cate_id)->where('sub2_id',$sub2_id)->where('sub3_id',$sub3_id)->where('status','1')->paginate($perpage));
         return response($posts,200,['OK']);
    }

    public function getPost($id){
    
        $lang=$request->header('locale');
        if($lang=='ar'){
            $selected="title_ar as title";
            $selected2="content_ar as description";
        }else{
            $selected="title_en as title";
            $selected2="content_en as description";
        }

        $all_posts = Article::select('id',$selected,'image',$selected2,'created_at as date')->where('id','=',$id)->get();

        $all_posts = PostsResource::collection($all_posts);

        $all_posts->map(function($t) { $t->type = 'second'; });

        if($lang=='ar'){
             $all_posts->map(function($i) { $i->lang = 'ar'; });
        }else{
            $all_posts->map(function($i) { $i->lang = 'en'; });
        }
        return response($all_posts,200,['OK']);
    }

}
