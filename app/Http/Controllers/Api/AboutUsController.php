<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\AboutResource;
use App\Models\AboutUs;
use App\Models\SiteInfo;

class AboutUsController extends Controller
{

    /**
     * @OA\Get (
     *      path="/about_us",
     *      operationId="Get about us information",
     *      tags={"Setting"},
     *      summary="Get about us information",
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

    public function about_us(Request $request){
        //use header to read parameter passed in header 
        $lang=$request->header('locale');
      
        if($lang=='ar'){
            $selected ="title_ar as title";
            $selected2="mission_ar as mission";
            $selected3="vision_ar as vision";
            $selected4="goal_ar as goal";
        }else{
             $selected="title_en as title";
             $selected2="mission_en as mission";
             $selected3="vision_en as vision";
             $selected4="goal_en as goal";
        }
        $about= new AboutResource(AboutUs::select('image',$selected,$selected2,$selected3,$selected4)->first());
      //  $about->map(function($i) { $i->type = 'about_us'; });
        return response($about,200,['OK']);
    }
    

    /**
     * @OA\Get (
     *      path="/setting",
     *      operationId="Get site setting information",
     *      tags={"Setting"},
     *      summary="Get site setting information",
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

    public function setting(Request $request){
        //use header to read parameter passed in header 
        $lang=$request->header('locale');
      
        if($lang=='ar'){
            $selected ="site_name_ar as site_name";
            $selected2="site_desc_ar as site_description";
        }else{
             $selected="site_name_en as site_name";
             $selected2="site_desc_en as site_description";
        }
        $setting=new AboutResource(SiteInfo::select('*',$selected,$selected2)->first());
       // $setting->map(function($i) { $i->type = 'setting'; });
        return response($setting,200,['OK']);
    }
   
}
