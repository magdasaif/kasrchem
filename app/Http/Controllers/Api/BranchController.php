<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branche;
class BranchController  extends Controller
{
   /**
     * @OA\Get(
     *      path="/branches",
     *      operationId="Get list of Branches",
     *      tags={"Branches"},
     *      summary="Get list of Branches",
     *      description="Returns  list of Branches",
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
    public function getbranches(Request $request)
    {
      $lang=$request->header('locale');
      if($lang=='ar')
      {
        $title='name_ar AS title';
        $address='address_ar AS address';
       }
      else
      { $title='name_en AS title';
        $address='address_en AS address';
      }
      $Branche = Branche::select('id',$title,$address,'phone','fax','email','latitude','longitude')->withoutTrashed()->where('status','1')->orderBy('sort','asc')->get();

        return response($Branche,200,['OK']);
    }

  



}
