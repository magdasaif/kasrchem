<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;

class LatestProductController extends Controller
{
    
   
    public function latest_products($lang)
    {
    //select lastedt 15 products 
   
         if($lang=='ar'){
             $selected="name_ar as name";
         }else{
              $selected="name_en as name";
         }
   
         $products = Product::select('id',$selected,'price','offer_price','min_amount as min','max_amount as max','amount as stock','image','security_permit as security_clearance')->where('status','1')->orderBy('created_at','desc')->limit(15)->get();
         return response($products,200,['OK']);
    }

    

}
