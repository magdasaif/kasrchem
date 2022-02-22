<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Video;
use App\Models\Article;
use App\Models\Product;
use App\Models\Release;

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
        $search='nn';
        if ($request->filled('search')||$search) {
          //  $s = $request->get('search');
            $s = $search;
            if (app('request')->header('locale') === 'en') {
                $results =  Search::add(Article::class, [ 'title_en', 'description_en'])
                    ->add(Product::class, ['name_en'])
                    ->add(Release::class, ['title_en'])
                    ->beginWithWildcard()
                    ->paginate()
                    ->get($s);
            } else {
                $results =  Search::add(Article::class, ['title_ar', 'description_ar'])
                    ->add(Product::class, ['name_ar'])
                    ->add(Release::class, ['title_ar'])
                    ->beginWithWildcard()
                    ->orderByRelevance()
                    ->paginate()
                    ->get($s);
            }
            $results->map(function ($item) {
                $item['class_type'] =   class_basename($item);
            });
            return $results;
           // return SearchResource::collection($results);
        } else {
            return response()->json(['data' => 'no data'], 200);
        }
    }

}
