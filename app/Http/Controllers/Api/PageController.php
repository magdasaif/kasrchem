<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\PageResource;

class PageController extends Controller
{
  /**
     * @OA\Get(
     *      path="/pages",
     *      operationId="Get list of Pages",
     *      tags={"pages"},
     *      summary="Get list of Pages",
     *      description="Returns list of Pages",
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
    public function getpages(Request $request)
    {
      $lang=$request->header('locale');
      if($lang=='ar'){
          $selected="description_ar as sample";
          $selected2="content_ar as content";
          $selected3="title_ar as title";
      }else{
           $selected="description_en as sample";
           $selected2="content_en as content";
           $selected3="title_en as title";
      }
      $Page = Page::select('id',$selected3,$selected,$selected2)->where('status','1')->get();

      $Page = PageResource::collection($Page);
      $Page->map(function($i) { $i->type = 'all'; });
      return response($Page,200,['OK']);
    }


     /**
     * @OA\Get(
     *      path="/page/{id}",
     *      operationId="getPagedata",
     *      tags={"pages"},
     *      summary="Get page data",
     *      description="Returns page data",
     *      @OA\Parameter(
	   *          in="path",
     *          name= "id",
     *          description= "Page ID",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="locale",
     *          description="App Locale",
     *          required=true,
     *          in="header",
     *          @OA\Schema(
     *             type="string",
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
  
    public function page_detail($id,Request $request){

      $lang=$request->header('locale');
      if($lang=='ar'){
        $selected="description_ar as sample";
        $selected2="content_ar as content";
        $selected3="title_ar as title";
       // $search='title_ar';
    }else{
         $selected="description_en as sample";
         $selected2="content_en as content";
         $selected3="title_en as title";
        // $search='title_en';
    }
     $Page = Page::select('id',$selected3,$selected,$selected2)->where('status','1')->where('id',$id)->get();

     //revert slug without underscore_
      // $new_word=str_replace('_', ' ',$id);
      // $Page = Page::select('id',$selected3,$selected,$selected2)->where('status','1')->where($search, 'like', '%' . $new_word . '%')->get();

      $Page = PageResource::collection($Page);
      $Page->map(function($i) { $i->type = 'single'; });
      
      return response($Page,200,['OK']);
  }



}
