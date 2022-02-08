<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Facades\Validator;
class PageController extends Controller
{
  /**
     * @OA\Get(
     *      path="/pages",
     *      operationId="Get list of Pages",
     *      tags={"pages"},
     *      summary="Get list of Pages",
     *      description="Returns list of Pages",
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
    public function getpages(Request $request)
    {
      $lang=$request->header('locale');
      if($lang=='ar')
      {
         $Page = Page::select('id','title_ar AS name','title_en AS slug','description_ar AS sample','content_ar AS content')->where('status','1')->get();
      }
      else
      { 
        $Page = Page::select('id','title_en AS name','title_en AS slug','description_en AS sample','content_en AS content')->where('status','1')->get();
      }
      return response($Page,200,['OK']);
    }

  



}
