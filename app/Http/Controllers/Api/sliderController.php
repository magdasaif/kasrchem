<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Http\Resources\SliderResource;
use Illuminate\Support\Facades\Validator;
class sliderController extends Controller
{
  /**
     * @OA\Get(
     *      path="/sliders",
     *      operationId="getslidersList",
     *      tags={"sliders"},
     *      summary="Get list of sliders",
     *      description="Returns list of sliders",
     *  
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
    use ApiResponseTrait;
    public function index()
    {
      $Slider=SliderResource::collection(Slider::where('status','1')->orderBy('priority','asc')->get());
      return response($Slider,200,['OK']);
    }

  



}
