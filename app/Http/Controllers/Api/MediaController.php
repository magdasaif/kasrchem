<?php

namespace App\Http\Controllers\Api;
use App\Models\Video;
use App\Models\Article;

use App\Models\Release;
use Illuminate\Http\Request;
use App\Models\Photo_Gallery;
use App\Models\Release_Section;
use App\Models\Section_All_Page;

use App\Http\Controllers\Controller;

use App\Http\Resources\MediaResource;
use App\Http\Resources\PostsResource;
use App\Http\Resources\GalleryResource;
use App\Http\Resources\ReleaseResource;

class MediaController extends Controller
{

    /**
     * @OA\Get(
     *      path="/media",
     *      operationId="getMediaList",
     *      tags={"Multimedia"},
     *      summary="Get list of Media",
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
     *      @OA\Parameter(
     *          name="category_id",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string",
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="type",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string",
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
        //read category_id & type of media to be selected 
         $main_cate_id=$request->category_id;
         $mediatype=$request->type;
         
          //use header to read parameter passed in header 
         $lang=$request->header('locale');

         if($request->perpage){$perpage=$request->perpage;}else{$perpage=10;}

         if($lang=='ar'){
             $selected="title_ar as title";
         }else{
              $selected="title_en as title";
         }


        $media_ids=Section_All_Page::where('sitesection_id',$main_cate_id)->where('type',$mediatype)->pluck('type_id');

        if($mediatype=='videos'){

            $fetch=Video::select('id',$selected,'link')->whereIn('id',$media_ids)->where('status','1')->paginate($perpage);
            return response($fetch,200,['OK']);
        }elseif($mediatype=='photos'){

            $fetch=GalleryResource::collection(Photo_Gallery::select('id',$selected,'image')->whereIn('id',$media_ids)->where('status','1')->paginate($perpage));
             $fetch->map(function($t) { $t->type = 'first_fun'; });
             return response($fetch,200,['OK']);

        }elseif($mediatype=='articles'){

            $fetch=PostsResource::collection(Article::select('id',$selected,'image')->whereIn('id',$media_ids)->where('status','1')->paginate($perpage));
            return response($fetch,200,['OK']);
        }elseif($mediatype=='releases'){

            $releases_ids=Release_Section::where('sitesection_id',$main_cate_id)->pluck('release_id');
            $fetch=ReleaseResource::collection(Release::select('id',$selected,'image','file')->whereIn('id',$releases_ids)->where('status','1')->paginate($perpage));
            return response($fetch,200,['OK']);
        }

        // $result =  MediaResource::collection($fetch);
        // return response($result,200,['OK']);
    }
}