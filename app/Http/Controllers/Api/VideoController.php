<?php

namespace App\Http\Controllers\Api;

use App\Models\Video;
use Illuminate\Http\Request;

use App\Models\Section_All_Page;
use App\Http\Controllers\Controller;

class VideoController extends Controller
{
    /**
     * @OA\Get(
     *      path="/videos",
     *      operationId="getVideosList",
     *      tags={"Multimedia"},
     *      summary="Get list of videos",
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
    //select products in selected categories 
         $section_id=$request->category_id;
         
          //use header to read parameter passed in header 
          $lang=$request->header('locale');
         
          $videos_ids=Section_All_Page::where('sitesection_id',$section_id)->where('type','videos')->pluck('type_id');

         
         if($lang=='ar'){
             $selected="name_ar as title";
         }else{
              $selected="name_en as title";
         }
        // if($request->perpage){$perpage=$request->perpage;}else{$perpage=10;}
        //  $posts =  Video::select('id',$selected,'link')->where('main_cate_id',$main_cate_id)->where('sub2_id',$sub2_id)->where('sub3_id',$sub3_id)->where('status','1')->paginate($perpage);
         $videos =  Video::select('id',$selected,'link')->whereIn('id',$videos_ids)->withoutTrashed()->where('status','1')->orderBy('sort','asc')->get();
         return response($videos,200,['OK']);
    }
}
