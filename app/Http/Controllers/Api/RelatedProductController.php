<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\Product_supplier;

class RelatedProductController extends Controller
{
      /**
     * @OA\Get (
     *      path="/related_products/{id}",
     *      operationId="Get list of Related Products",
     *      tags={"Web APIs"},
     *      summary="Get list of Related Products",
     *     @OA\Parameter(
     *         description="Supplier ID",
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
       
        if($request->perpage){$perpage=$request->perpage;}else{$perpage=10;}
         
        if($lang=='ar'){
            $selected="name_ar as name";
        }else{
             $selected="name_en as name";
        }
        $products_ids= Product_supplier::select('product_id')->where('supplier_id','=',$id)->get();
        $products = ProductResource::collection(Product::select('*',$selected)->whereIn('id',$products_ids)->where('status','1')->orderBy('sort','asc')->paginate($perpage));
        $products->map(function($i) { $i->type = 'first_fun'; });
        return response($products,200,['OK']);
    }
   
}
