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
use App\Models\Main_Category;
use App\Models\Sitesection;
use App\Models\Sub_Category2;
use App\Models\Sub_Category3;
use App\Models\Supplier;
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
                $results =  Search::add(Article::select('id','title_en as name','image'), [ 'title_en', 'content_en'])
                    ->add(Product::select('id','name_en as name','image'), ['name_en','desc_en'])
                    ->add(Release::select('id','title_en as name','image'), ['title_en'])
                    ->add(Main_Category::select('id','subname_en as name','image'), ['subname_en'])
                    ->add(Partner::select('id','name_en as name','image'), ['name_en'])
                    ->add(Sitesection::select('id','site_name_en as name','image'), ['site_name_en'])
                    ->add(Sub_Category2::select('id','subname2_en as name','image2'), ['subname2_en'])
                    ->add(Sub_Category3::select('id','subname_en as name','image'), ['subname_en'])
                    ->add(Supplier::select('id','name_en as name','logo'), ['name_en','description_en'])
                    ->add(Video::select('id','title_en as name','link'), ['title_en'])
                    ->add(Photo_Gallery::select('id','title_en as name','image'), ['title_en'])
                    ->beginWithWildcard()
                    ->paginate()
                    ->get($s);
            } else {
                $results =  Search::add(Article::select('id','title_ar as name','image'), ['title_ar', 'content_ar'])
                    ->add(Product::select('id','name_ar as name','image'), ['name_ar','desc_ar'])
                    ->add(Release::select('id','title_ar as name','image'), ['title_ar'])
                    ->add(Main_Category::select('id','subname_ar as name','image'), ['subname_ar'])
                    ->add(Partner::select('id','name_ar as name','image'), ['name_ar'])
                    ->add(Sitesection::select('id','site_name_ar as name','image'), ['site_name_ar'])
                    ->add(Sub_Category2::select('id','subname2_ar as name','image2'), ['subname2_ar'])
                    ->add(Sub_Category3::select('id','subname_ar as name','image'), ['subname_ar'])
                    ->add(Supplier::select('id','name_ar as name','logo'), ['name_ar','description_ar'])
                    ->add(Video::select('id','title_ar as name','link'), ['title_ar'])
                    ->add(Photo_Gallery::select('id','title_en as name','image'), ['title_en'])
                    ->beginWithWildcard()
                    ->paginate()
                    ->get($s);
            }
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
