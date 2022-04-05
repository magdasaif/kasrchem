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

  /**
     * @OA\Get(
     *      path="/suppliers",
     *      operationId="getsuppliersList",
     *      tags={"suppliers"},
     *      summary="Get list of suppliers",
     *      description="Returns list of suppliers",
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

      /**
     * @OA\Get(
     *      path="/suppliers_section",
     *      operationId="getsuppliersList",
     *      tags={"suppliers"},
     *      summary="Get list of sections with suppliers",
     *      description="Returns list of sections with suppliers",
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
    public function sectionsAndSupplier(Request $request)
    {
      $lang=$request->header('locale');
      $all=Sitesection::select('site_sections.id as section_id','site_name_ar','site_name_en')
      ->join('supplier_sections', 'supplier_sections.sitesection_id', '=', 'site_sections.id')
      ->groupBy('section_id')
      ->get();
      //return response($all,200,['OK']);
        
      $Supplier=SupplierSectionResource::collection($all);

      if($lang=='ar'){
        $Supplier->map(function($i) { $i->lang = 'ar'; });
     }else{
        $Supplier->map(function($i) { $i->lang = 'en'; });
     }
      return response($Supplier,200,['OK']);
    }


     /**
     * @OA\Get(
     *      path="/supplier/{id}",
     *      operationId="getsuppliersdata",
     *      tags={"suppliers"},
     *      summary="Get supplier data",
     *      description="Returns supplier data",
     *      @OA\Parameter(
	   *          in="path",
     *          name= "id",
     *          description= "supplier ID",
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
