<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\sectionResource;
use App\Http\Resources\main_categoryResource;
use App\Http\Resources\sub_categoriesResource;
use App\Http\Resources\typesResource;
use App\Http\Resources\sub_typesResource;
use App\Models\Sitesection;
use App\Models\Main_Category;
use App\Models\Sub_Category2;
use App\Models\Sub_Category3;
use App\Models\Sub_Category4;
use Illuminate\Support\Facades\Validator;
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
        $section=sectionResource::collection(Sitesection::where('statues','1')->orderBy('priority','asc')->get());
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
     *      operationId="getsectioncategory",
     *      tags={"Sections"},
     *      summary="Get Section Category",
     *      description="Returns Section Category",
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
    $main_category=main_categoryResource::collection(Main_Category::where('section_id',$section_id)->where('status','1')->get());
    if($lang=='ar'){
        $main_category->map(function($i) { $i->lang = 'ar'; });
    }else{
    $main_category->map(function($i) { $i->lang = 'en'; });
    }
    return response($main_category,200,['OK']);
}
//----------------------------------------------------------------------//
/**
     * @OA\Get(
     *      path="/categories/{id}/subs",
     *      operationId="Get Category Sub Categories",
     *      tags={"Sections"},
     *      summary="Get Category Sub Categories",
     *      description="Returns Category Sub Categories",
     *     @OA\Parameter(
	 *         in="path",
     *          name= "id",
     *          description= "Category ID",
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
public function get_category_sub_category(Request $request,$category_id)
{
    $lang=$request->header('locale');
    $Sub_Category2=sub_categoriesResource::collection(Sub_Category2::where('cate_id',$category_id)->where('status','1')->get());
        if($lang=='ar'){
            $Sub_Category2->map(function($i) { $i->lang = 'ar'; });
        }else{
        $Sub_Category2->map(function($i) { $i->lang = 'en'; });
        }
    return response($Sub_Category2,200,['OK']);
}
//-------------------------------------------------------------//
/**
     * @OA\Get(
     *      path="/sub_categories/{id}/types",
     *      operationId="Get Sub Category Types",
     *      tags={"Sections"},
     *      summary="Get Sub Category Types",
     *      description="Returns Sub Category Types",
     *     @OA\Parameter(
	 *         in="path",
     *          name= "id",
     *          description= "Sub Category ID",
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
public function get_sub_category_types(Request $request,$sub_category_id)
{
    $lang=$request->header('locale');
     $Sub_Category3=typesResource::collection(Sub_Category3::where('sub2_id',$sub_category_id)->where('status','1')->get());
        if($lang=='ar'){
            $Sub_Category3->map(function($i) { $i->lang = 'ar'; });
        }else{
        $Sub_Category3->map(function($i) { $i->lang = 'en'; });
        }
     return response($Sub_Category3,200,['OK']);
}
//-----------------------------------------------------//
/**
     * @OA\Get(
     *      path="/types/{id}/sub_types",
     *      operationId="Get Type Sub Types",
     *      tags={"Sections"},
     *      summary="Get Type Sub Types",
     *      description="Returns  Type Sub Types",
     *     @OA\Parameter(
	 *         in="path",
     *          name= "id",
     *          description= "Type ID",
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
public function get_types_sub_types(Request $request,$type_id)
{
    $lang=$request->header('locale');
   $Sub_Category4=sub_typesResource::collection(Sub_Category4::where('sub3_id',$type_id)->where('status','1')->get());
     if($lang=='ar'){
            $Sub_Category4->map(function($i) { $i->lang = 'ar'; });
        }else{
        $Sub_Category4->map(function($i) { $i->lang = 'en'; });
        }
   return response($Sub_Category4,200,['OK']);
}
//--------------------------------------------------------------//


}
