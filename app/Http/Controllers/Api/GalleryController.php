<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Photo_Gallery;

use App\Models\Section_All_Page;
use App\Http\Controllers\Controller;
use App\Http\Resources\GalleryResource;

class GalleryController extends Controller
{
    /**
     * @OA\Get(
     *      path="/photos_galleries",
     *      operationId="Get list of Photos Galleries",
     *      tags={"Multimedia"},
     *      summary="Get list of Photos Galleries",
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
    //select galleries in selected categories 
         $main_cate_id=$request->category_id;

         //use header to read parameter passed in header 
        $lang=$request->header('locale');
        
         if($request->perpage){$perpage=$request->perpage;}else{$perpage=10;}
       
         $media_ids=Section_All_Page::where('sitesection_id',$main_cate_id)->where('type','photos')->pluck('type_id');

         if($lang=='ar'){
             $selected="name_ar as title";
         }else{
              $selected="name_en as title";
         }
         $gallery=GalleryResource::collection(Photo_Gallery::select('id',$selected)->whereIn('id',$media_ids)->withoutTrashed()->where('status','1')->orderby('sort','asc')->paginate($perpage));
         $gallery->map(function($t) { $t->type = 'first_fun'; });
         return response($gallery,200,['OK']);
    }

    /**
     * @OA\Get (
     *      path="/photos_galleries/{id}",
     *      operationId="show_gallery",
     *      tags={"Multimedia"},
     *      summary="Show Gallery Data",
     *     @OA\Parameter(
     *         description="Gallery ID",
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
        }else{
            $selected="name_en as title";
        }

        $all_posts = Photo_Gallery::select('id',$selected,'image')->where('id','=',$id)->get();

        $all_posts = GalleryResource::collection($all_posts);

        $all_posts->map(function($t) { $t->type = 'second'; });

        return response($all_posts,200,['OK']);
    }


}
