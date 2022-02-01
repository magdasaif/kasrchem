<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\PostsResource;
use App\Models\Article;

class PostsController extends Controller
{

    /**
     * @OA\Get(
     *      path="/posts",
     *      operationId="getPostsList",
     *      tags={"Multimedia"},
     *      summary="Get list of posts",
     *      @OA\Parameter(
     *          name="locale",
     *          description="App Locale",
     *          required=true,
     *          in="header",
     *          @OA\Schema(
     *              type="string",
     *              enum={"ar", "en"},
     *              default="ar"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="category_id",
     *          in="query",
     *          @OA\Schema(
     *              type="string",
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="sub_category_id",
     *          in="query",
     *          @OA\Schema(
     *              type="string",
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="type_id",
     *          in="query",
     *          @OA\Schema(
     *              type="string",
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="not found"
     *      ),
     *     )
     */

    public function index(Request $request)
    {
       // return  $request->all();
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
       //  return $posts;
         return response($posts,200,['OK']);
    }


    /**
     * @OA\Get (
     *      path="/posts/{id}",
     *      operationId="show_post",
     *      tags={"Multimedia"},
     *      summary="Show Post Data",
     *     @OA\Parameter(
     *         description="Post ID",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *      @OA\Parameter(
     *          name="locale",
     *          description="App Locale",
     *          required=true,
     *          in="header",
     *          @OA\Schema(
     *              type="string",
     *              enum={"ar", "en"},
     *              default="ar"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="not found"
     *      ),
     *     )
     */

    public function show($id,Request $request){

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
       // return $all_posts;
        return response($all_posts,200,['OK']);
    }

}
