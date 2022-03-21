<?php

namespace App\Http\Controllers\Api;

use App\Models\Release;
use App\Models\Sitesection;

use Illuminate\Http\Request;

use App\Models\Release_Section;
use App\Models\Supplier_section;
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
             $selected="title_ar as title";
         }else{
              $selected="title_en as title";
         }
        
         // $relases =  ReleaseResource::collection(Release::select('id',$selected,'image','file')->where('main_cate_id',$main_cate_id)->where('sub2_id',$sub2_id)->where('sub3_id',$sub3_id)->where('status','1')->paginate($perpage));

          $releases_ids=Release_Section::where('sitesection_id',$main_cate_id)->pluck('release_id');
          
          $rr=Release::select('id',$selected,'image','file')->whereIn('id',$releases_ids)->where('status','1')->paginate($perpage);
          $relases =  ReleaseResource::collection($rr);

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
      
      $all=Sitesection::select('site_sections.id as section_id','site_name_ar','site_name_en')
      ->join('releases_sections', 'releases_sections.sitesection_id', '=', 'site_sections.id')
      ->groupBy('section_id')
      ->get();
      
      $section=ReleaseSectionResource::collection($all);
      $section->map(function($i) { $i->type = 'all'; });
      if($lang=='ar'){
        $section->map(function($i) { $i->lang = 'ar'; });
     }else{
        $section->map(function($i) { $i->lang = 'en'; });
     }
      return response($section,200,['OK']);
    }
    
}
