<?php

namespace App\Http\Controllers\Api;

use App\Models\Video;
use App\Models\Article;
use App\Models\Release;
use App\Models\Sitesection;
use Illuminate\Http\Request;
use App\Models\Photo_Gallery;
use App\Models\Section_All_Page;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReleaseResource;
use App\Http\Resources\ReleaseSectionResource;
use App\Http\Resources\LatestMultiMediaResource;

class LatestMultiMediaController extends Controller
{
    
    
   /**
     * @OA\Get(
     *      path="/latest_galleries",
     *      operationId="Get list of Latest gallery limit 15",
     *      tags={"Multimedia"},
     *      summary="Get list of Latest gallery limit 15",
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
    public function latest_galleries(Request $request)
    {
         //select lastest 15 gallery 

        //use header to read parameter passed in header 
        $lang=$request->header('locale');

          if($lang=='ar'){
               $selected="name_ar as title";
          }else{
               $selected="name_en as title";
          }
         
         $posts = LatestMultiMediaResource::collection(Photo_Gallery::select('id',$selected)->withoutTrashed()->where('status','1')->orderBy('sort','asc')->limit(15)->get());
         $posts->map(function($t) { $t->type = 'latest_galleries'; });
         return response($posts,200,['OK']);
    }
    
   /**
     * @OA\Get(
     *      path="/latest_releases",
     *      operationId="Get list of Latest releases limit 15",
     *      tags={"Multimedia"},
     *      summary="Get list of Latest releases limit 15",
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
    public function latest_releases(Request $request)
    {
         //select lastest 15 releases 

        //use header to read parameter passed in header 
        $lang=$request->header('locale');

          if($lang=='ar'){
               $selected="name_ar as title";
          }else{
               $selected="name_en as title";
          }
          
          $r=Release::select('id',$selected)->withoutTrashed()->where('status','1')->orderby('sort','asc')->limit(15)->get();

          $relases=ReleaseResource::collection($r);
          
          return response($relases,200,['OK']);

    }
    
   /**
     * @OA\Get(
     *      path="/latest_posts",
     *      operationId="Get list of Latest posts limit 15",
     *      tags={"Multimedia"},
     *      summary="Get list of Latest posts limit 15",
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
    public function latest_posts(Request $request)
    {
         //select lastest 15 posts 

        //use header to read parameter passed in header 
        $lang=$request->header('locale');

          if($lang=='ar'){
               $selected="name_ar as title";
          }else{
               $selected="name_en as title";
          }
         
         $posts = LatestMultiMediaResource::collection(Article::select('id',$selected)->withoutTrashed()->where('status','1')->orderBy('sort','asc')->limit(15)->get());
         $posts->map(function($t) { $t->type = 'latest_posts'; });
         return response($posts,200,['OK']);
    }
   /**
     * @OA\Get(
     *      path="/latest_videos",
     *      operationId="Get list of Latest videos limit 15",
     *      tags={"Multimedia"},
     *      summary="Get list of Latest videos limit 15",
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
    public function latest_videos(Request $request)
    {
         //select lastest 15 videos 

        //use header to read parameter passed in header 
        $lang=$request->header('locale');

          if($lang=='ar'){
               $selected="name_ar as title";
          }else{
               $selected="name_en as title";
          }
         
         $posts = LatestMultiMediaResource::collection(Video::select('id',$selected,'link')->withoutTrashed()->where('status','1')->orderBy('sort','asc')->limit(15)->get());
         $posts->map(function($t) { $t->type = 'latest_videos'; });
         return response($posts,200,['OK']);
    }

    

}
