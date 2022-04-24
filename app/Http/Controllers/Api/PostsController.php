<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use Illuminate\Http\Request;

use App\Models\Section_All_Page;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostsResource;

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
        //select posts in selected categories
        
         $section_id=$request->category_id;

         //use header to read parameter passed in header 
         $lang=$request->header('locale');

         if($request->perpage){$perpage=$request->perpage;}else{$perpage=10;}
       
         $articles_ids=Section_All_Page::where('sitesection_id',$section_id)->where('type','articles')->pluck('type_id');

         if($lang=='ar'){
             $selected="name_ar as title";
         }else{
              $selected="name_en as title";
         }
         
         $posts =  PostsResource::collection(Article::select('id',$selected)->whereIn('id',$articles_ids)->withoutTrashed()->where('status','1')->orderBy('sort','asc')->paginate($perpage));
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

        //use header to read parameter passed in header 
        $lang=$request->header('locale');
        if($lang=='ar'){
            $selected="name_ar as title";
            $selected2="content_ar as description";
        }else{
            $selected="name_en as title";
            $selected2="content_en as description";
        }

        $all_posts = Article::select('id',$selected,$selected2,'created_at as date')->where('id',$id)->get();

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
