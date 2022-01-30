<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductController extends Controller
{

    
    public function get_all_product($lang){
        if($lang=='ar'){
            $selected="name_ar as name";
            $selected2="desc_ar as desc";
        }else{
             $selected="name_en as name";
             $selected2="desc_en as desc";
        }
        $products = Product::select('id',$selected,'price','offer_price','min_amount as min','max_amount as max','amount as stock','image','security_permit as security_clearance')->get();
        return response($products,200,['OK']);
    }

    public function index(Request $request)
    //public function index($sub1,$sub2,$sub3,$local)
    {
        //   dd($sub1);
        //  $main_cate_id=$sub1;
        //  $sub2_id=$sub2;
        //  $sub3_id=$sub3;
        //  $lang=$local;

         $main_cate_id=$request->category_id;
         $sub2_id=$request->sub_category_id;
         $sub3_id=$request->type_id;
         $lang=$request->local;
    // public function filter_product($sub1,$sub2,$sub3,$local)
    // {
    //   //  dd($sub1);
    //     $main_cate_id=$sub1;
    //     $sub2_id=$sub2;
    //     $sub3_id=$sub3;
        
        $lang=$local;
        
        if($lang=='ar'){
            $selected="name_ar as name";
        }else{
             $selected="name_en as name";
        }
        //stock=amunt
        //min=min_amount
        //max=max_amount
        //security_clearance
        $products = Product::select('id',$selected,'price','offer_price','min_amount as min','max_amount as max','amount as stock','image','security_permit as security_clearance')->where('main_cate_id',$main_cate_id)->where('sub2_id',$sub2_id)->where('sub3_id',$sub3_id)->where('status','1')->get();
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
}
