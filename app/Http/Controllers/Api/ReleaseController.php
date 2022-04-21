<?php

namespace App\Http\Controllers\Api;

use App\Models\Release;
use App\Models\Sitesection;

use Illuminate\Http\Request;

use App\Models\Release_Section;
use App\Models\Section_All_Page;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReleaseResource;
use App\Http\Resources\ReleaseSectionResource;

class ReleaseController extends Controller
{
    /**
     * @OA\Get(
     *      path="/releases",
     *      operationId="Get list of Releases",
     *      tags={"Multimedia"},
     *      summary="Get list of Releases",
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
    //select Release in selected categories 
         $main_cate_id=$request->category_id;
     //     $sub2_id=$request->sub_category_id;
     //     $sub3_id=$request->type_id;
         
          //use header to read parameter passed in header 
        $lang=$request->header('locale');

         if($request->perpage){$perpage=$request->perpage;}else{$perpage=10;}
         
         if($lang=='ar'){
             $selected="name_ar as title";
         }else{
              $selected="name_en as title";
         }
        
         $media_ids=Section_All_Page::where('sitesection_id',$main_cate_id)->where('type','releases')->pluck('type_id');
         $relases=ReleaseResource::collection(Release::select('id',$selected)->whereIn('id',$media_ids)->withoutTrashed()->where('status','1')->orderby('sort','asc')->paginate($perpage));
          return response($relases,200,['OK']);
    }


          /**
     * @OA\Get(
     *      path="/release_section",
     *      operationId="getReleasList",
     *      tags={"Multimedia"},
     *      summary="Get list of sections with release",
     *      description="Returns list of sections with release",
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
    public function sectionsAndRelease(Request $request)
    {
      $lang=$request->header('locale');

      if($request->perpage){$perpage=$request->perpage;}else{$perpage=10;}
      
      if($lang=='ar'){
          $selected="name_ar as title";
      }else{
           $selected="name_en as title";
      }

      $media_ids=Section_All_Page::where('type','releases')->pluck('type_id');
      $relases=ReleaseResource::collection(Release::select('id',$selected)->whereIn('id',$media_ids)->withoutTrashed()->where('status','1')->orderby('sort','asc')->paginate($perpage));
      
      
      return response($relases,200,['OK']);
    }
    
}
