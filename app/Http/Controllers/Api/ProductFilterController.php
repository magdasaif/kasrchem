<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductFilterController extends Controller
{
    
    public function index(Request $request)
    {
    //select products in selected categories 
         $main_cate_id=$request->category_id;
         $sub2_id=$request->sub_category_id;
         $sub3_id=$request->type_id;
         $lang=$request->local;

         if($request->perpage){$perpage=$request->perpage;}else{$perpage=10;}
         
         if($lang=='ar'){
             $selected="name_ar as name";
         }else{
              $selected="name_en as name";
         }
         //stock=amunt
         //min=min_amount
         //max=max_amount
         //security_clearance
         $products = Product::select('id',$selected,'price','offer_price','min_amount as min','max_amount as max','amount as stock','image','security_permit as security_clearance')->where('main_cate_id',$main_cate_id)->where('sub2_id',$sub2_id)->where('sub3_id',$sub3_id)->where('status','1')->orderBy('sort','asc')->paginate($perpage);
       //  $products = ProductResource::collection(Product::select('id',$selected,'price','offer_price','min_amount as min','max_amount as max','amount as stock','image','security_permit as security_clearance')->where('main_cate_id',$main_cate_id)->where('sub2_id',$sub2_id)->where('sub3_id',$sub3_id)->where('status','1')->get());
         return response($products,200,['OK']);
    }

    public function getProduct($id,$lang){

        if($lang=='ar'){
            $selected="name_ar as name";
            $selected2="desc_ar as desc";
        }else{
             $selected="name_en as name";
             $selected2="desc_en as desc";
        }

        $all_product = Product::select('*',$selected,$selected2)->where('id','=',$id)->get();
        $product = ProductResource::collection($all_product);

        if($lang=='ar'){
             $product->map(function($i) { $i->lang = 'ar'; });
        }else{
            $product->map(function($i) { $i->lang = 'en'; });
        }
        return response($product,200,['OK']);
    }

    public function store(Request $request)
    {
        //
    }

   
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
