<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\sectionResource;
use App\Models\Sitesection;


class SiteSectionController extends Controller
{
  /**
     * @OA\Get(
     *      path="/sections",
     *      operationId="getSectionsList",
     *      tags={"Sections"},
     *      summary="Get list of sections",
     *      description="Returns list of sections",
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
    
    // public function index($lang)
    public function index(Request $request)
    { 
        $lang=$request->header('locale');
        $section=sectionResource::collection(Sitesection::where('status','1')->where('visible','1')->whereNULL('parent_id')->orderBy('sort','asc')->get());
        if($lang=='ar'){
           $section->map(function($i) { $i->lang = 'ar'; });
        }else{
           $section->map(function($i) { $i->lang = 'en'; });
        }
        return response($section,200,['OK']);
        
    }
//----------------------------------------------------------------------//    
/**
     * @OA\Get(
     *      path="/sections/{id}",
     *      operationId="getsubsection",
     *      tags={"Sections"},
     *      summary="Get Section childs",
     *      description="Returns Section childs",
     *     @OA\Parameter(
	 *         in="path",
     *          name= "id",
     *          description= "section ID",
     *          required=true,
     *        @OA\Schema(
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
     *          ) ),
     * 
    
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *         )
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
public function get_section_category(Request $request,$section_id)
{
    $lang=$request->header('locale');
    $main_category=sectionResource::collection(Sitesection::where('parent_id',$section_id)->where('status','1')->get());
    if($lang=='ar'){
        $main_category->map(function($i) { $i->lang = 'ar'; });
    }else{
    $main_category->map(function($i) { $i->lang = 'en'; });
    }
    return response($main_category,200,['OK']);
}
//----------------------------------------------------------------------//


}
