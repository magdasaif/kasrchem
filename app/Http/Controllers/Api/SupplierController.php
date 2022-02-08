<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Http\Resources\SupplierResource;
use Illuminate\Support\Facades\Validator;
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
      $Supplier=SupplierResource::collection(Supplier::get());
      if($lang=='ar'){
        $Supplier->map(function($i) { $i->lang = 'ar'; });
     }else{
        $Supplier->map(function($i) { $i->lang = 'en'; });
     }
      return response($Supplier,200,['OK']);
    }

  



}
