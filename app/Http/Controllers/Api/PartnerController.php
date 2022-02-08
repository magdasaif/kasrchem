<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Partner;
use App\Http\Resources\PartnerResource;
use Illuminate\Support\Facades\Validator;
class PartnerController extends Controller
{

  /**
     * @OA\Get(
     *      path="/partners",
     *      operationId="Get list of Partners",
     *      tags={"Partners"},
     *      summary="Get list of Partners",
     *      description="Returns list of Partners",
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
    public function getpartners(Request $request)
    {
      $lang=$request->header('locale');
      $Partner=PartnerResource::collection(Partner::where('status','1')->get());
      if($lang=='ar'){
          $Partner->map(function($i) { $i->lang = 'ar'; });
      }else{
      $Partner->map(function($i) { $i->lang = 'en'; });
      }
       return response($Partner,200,['OK']);
    }

  



}
