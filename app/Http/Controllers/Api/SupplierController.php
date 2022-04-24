<?php

namespace App\Http\Controllers\Api;
use App\Models\Supplier;
use App\Models\Sitesection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SupplierResource;
use App\Http\Resources\SupplierSectionResource;

class SupplierController extends Controller
{

    public function index(Request $request)
    {
      $lang=$request->header('locale');
      $Supplier=SupplierResource::collection(Supplier::where('parent_id','0')->orderBy('sort','asc')->get());
      if($lang=='ar'){
        $Supplier->map(function($i) { $i->lang = 'ar'; });
     }else{
        $Supplier->map(function($i) { $i->lang = 'en'; });
     }
     $Supplier->map(function($i) { $i->type = 'all'; });
      return response($Supplier,200,['OK']);
    }


    public function getSupplier($id,Request $request){

      $lang=$request->header('locale');
      if($lang=='ar'){
          $selected="name_ar as name";
          $selected2="description_ar as desc";
      }else{
           $selected="name_en as name";
           $selected2="description_ar as desc";
      }

      $supplier_data = Supplier::select('*',$selected,$selected2)->where('id','=',$id)->get();
      $supplier = SupplierResource::collection($supplier_data);
      $supplier->map(function($i) { $i->type = 'single'; });
      if($lang=='ar'){
           $supplier->map(function($i) { $i->lang = 'ar'; });
      }else{
          $supplier->map(function($i) { $i->lang = 'en'; });
      }
      return response($supplier,200,['OK']);
  }



}
