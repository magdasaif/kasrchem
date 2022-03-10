<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\LatestProductResource;
use App\Models\Product;

class LatestProductController extends Controller
{
    
    
     /**
     * @OA\Get(
     *      path="/latest_products",
     *      operationId="Get list of Latest Products",
     *      tags={"Web APIs"},
     *      summary="Get list of Latest Products",
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
    public function latest_products(Request $request)
    {
         //select lastedt 15 products 

        //use header to read parameter passed in header 
        $lang=$request->header('locale');

        if($lang=='ar'){
          $selected="name_ar as name";
          $selected2="desc_ar as desc";
      }else{
           $selected="name_en as name";
           $selected2="desc_en as desc";
      }
   
         $products = LatestProductResource::collection(Product::select('id',$selected,$selected2,'price','offer_price','min_amount as min','max_amount as max','amount as stock','image','security_permit as security_clearance','link')->where('status','1')->orderBy('created_at','desc')->limit(15)->get());
         return response($products,200,['ok']);
    }

    

}
