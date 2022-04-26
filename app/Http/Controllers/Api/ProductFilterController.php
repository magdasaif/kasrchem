<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;

use App\Models\Section_All_Page;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;

class ProductFilterController extends Controller
{
    
     /**
     * @OA\Get(
     *      path="/products",
     *      operationId="Get list of Products",
     *      tags={"Products"},
     *      summary="Get list of Products",
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
     *          name="section_id",
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
         $section_id=$request->section_id;
         
        //use header to read parameter passed in header 
        $lang=$request->header('locale');

         if($request->perpage){$perpage=$request->perpage;}else{$perpage=10;}
         
         $products_ids=Section_All_Page::where('sitesection_id',$section_id)->where('type','products')->pluck('type_id');
         
         //return response($products_ids,200,['OK']); 

         if($lang=='ar'){
            $selected="name_ar as name";
            $selected2="description_ar as desc";
        }else{
             $selected="name_en as name";
             $selected2="description_en as desc";
        }

         $products = ProductResource::collection(
                Product::select('id','video_link','link',$selected,$selected2)
                ->withoutTrashed()
                ->whereIn('id',$products_ids)
                ->where('status','1')
                ->orderBy('sort','asc')
                ->paginate($perpage)
        );

         $products->map(function($i) { $i->type = 'first_fun'; });
         return response($products,200,['OK']);
    }

   /**
     * @OA\Get (
     *      path="/products/{id}",
     *      operationId="show_products",
     *      tags={"Products"},
     *      summary="Show product Data",
     *     @OA\Parameter(
     *         description="product ID",
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
            $selected="name_ar as name";
            $selected2="description_ar as desc";
        }else{
             $selected="name_en as name";
             $selected2="description_en as desc";
        }


        // $all_product = Product::select('*',$selected,$selected2)->where('id','=',$id)->get();

        $all_product = Product::select('id','video_link','link',$selected,$selected2)->withoutTrashed()->where('id','=',$id)->get();
        $product = ProductResource::collection($all_product);

        if($lang=='ar'){
             $product->map(function($i) { $i->lang = 'ar'; });
        }else{
            $product->map(function($i) { $i->lang = 'en'; });
        }
        return response($product,200,['OK']);
    }

}
