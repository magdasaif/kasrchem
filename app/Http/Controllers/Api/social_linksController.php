<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Social;
use Illuminate\Support\Facades\Validator;
class social_linksController  extends Controller
{
    /**
     * @OA\Get(
     *      path="/social_links",
     *      operationId="Get Social Links",
     *      tags={"Social Links"},
     *      summary="Get Social Links",
     *      description="Returns  Social Links",
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
    
    public function getsocial_links()
    {
      
        $Social = Social::select('id','name','icon','link')->where('status','1')->get();
         return response($Social,200,['OK']);
    }

  



}
