<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\SearchResource;

use App\Models\Video;
use App\Models\Article;
use App\Models\Product;
use App\Models\Release;
use App\Models\Partner;
use App\Models\Sitesection;
use App\Models\Photo_Gallery;

use ProtoneMedia\LaravelCrossEloquentSearch\Search;
// use ProtoneMedia\LaravelPaddle\Events\SubscriptionCreated;


class SearchController extends Controller
{

    /**
     * @OA\Get(
     *      path="/search",
     *      operationId="get_search_data",
     *      tags={"Search"},
     *      summary="Get Search Data",
     *      @OA\Parameter(
     *          name="search",
     *          description="Search Word",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
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
    public function search(Request $request)
    {
       
        if ($request->filled('search')) {

            $s = $request->get('search');
            
            if (app('request')->header('locale') === 'en') {
                    $select0='name_en as name';
                    $select1='name_en';
                    $select2='content_en';
                    $select3='description_en';
            }else{
                $select0='name_ar as name';
                $select1='name_ar';
                $select2='content_ar';
                $select3='description_ar';
            }
          
          
            $results =  Search::add(Article::select('id',$select0)->withoutTrashed(), [ $select1, $select2])
                ->add(Product::select('id',$select0)->withoutTrashed(), [$select1,$select3])
                ->add(Release::select('id',$select0)->withoutTrashed(), [$select1])
                ->add(Partner::select('id',$select0)->withoutTrashed(), [$select1])
                ->add(Sitesection::select('id',$select0)->where('visible',1), [$select1])
                ->add(Video::select('id',$select0,'link')->withoutTrashed(), [$select1])
                ->add(Photo_Gallery::select('id',$select0)->withoutTrashed(), [$select1])
                ->beginWithWildcard()
                ->paginate()
                ->get($s);
           

            $results->map(function ($item) {
                $item['type'] =   class_basename($item);
            });
           // return $results;
            return SearchResource::collection($results);
        } else {
            return response()->json(['data' => 'no data'], 200);
        }
    }

}
