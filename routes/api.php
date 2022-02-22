<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\SiteSectionController;
use App\Http\Controllers\Api\sliderController;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\PartnerController;
use App\Http\Controllers\Api\BranchController;
use App\Http\Controllers\Api\social_linksController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductFilterController;
use App\Http\Controllers\Api\LatestProductController;
use App\Http\Controllers\Api\PostsController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\LatestMultiMediaController;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\Api\RelatedProductController;
use App\Http\Controllers\Api\AboutUsController;
use App\Http\Controllers\Api\SearchController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
//---------------------test------------------------
Route::get('/test', function () {
    return 'test';
});

///-------------------------------sections-----------------
Route::get('/sections',[SiteSectionController::class,'index']);

///-------------------------------section_category----------
Route::get('/sections/{id}',[SiteSectionController::class,'get_section_category']);

///-------------------------------category_sub_category--------
Route::get('/categories/{id}/subs',[SiteSectionController::class,'get_category_sub_category']);

///-------------------------------sub_category_types--------------
Route::get('/sub_categories/{id}/types',[SiteSectionController::class,'get_sub_category_types']);

///-------------------------------sub_types_types----------------
Route::get('/types/{id}/sub_types',[SiteSectionController::class,'get_types_sub_types']);

///------------------------slider-------------------------------
Route::get('/sliders',[sliderController::class,'index']);

//-------------------------Pages---------------------------------
Route::get('/pages',[PageController::class,'getpages']);

//--------------------------Partners----------------------------
Route::get('/partners',[PartnerController::class,'getpartners']);

//---------------------------Branch-----------------------------
Route::get('/branches',[BranchController::class,'getbranches']);

//----------------------------social_links---------------------
Route::get('/social_links',[social_linksController::class,'getsocial_links']);

//---------------------products------------------------
Route::apiResource('/products', 'ProductFilterController', array("as" => "api"));

//---------------------latest products------------------------
Route::get('/latest_products',[LatestProductController::class,'latest_products']);

//---------------------posts/article------------------------
Route::apiResource('/posts', 'PostsController', array("as" => "api"));

//---------------------latest posts------------------------
Route::get('/latest_posts',[LatestMultiMediaController::class,'latest_posts']);

//---------------------videos------------------------
Route::apiResource('/videos', 'VideoController', array("as" => "api"));

//---------------------latest videos------------------------
Route::get('/latest_videos',[LatestMultiMediaController::class,'latest_videos']);

//---------------------photos_galleries------------------------
Route::apiResource('/photos_galleries', 'GalleryController', array("as" => "api"));

//---------------------latest galleries------------------------
Route::get('/latest_galleries',[LatestMultiMediaController::class,'latest_galleries']);

//---------------------releases------------------------
Route::apiResource('/releases', 'ReleaseController', array("as" => "api"));

//---------------------latest releases------------------------
Route::get('/latest_releases',[LatestMultiMediaController::class,'latest_releases']);

///------------------------------Supplier-------------------------------------
Route::get('/suppliers',[SupplierController::class,'index']);

///------------------------------Supplier details -------------------------------------
Route::get('/supplier/{id}',[SupplierController::class,'getSupplier']);

//---------------------related products with supplier ------------------------
 Route::get('/related_products/{id}',[RelatedProductController::class,'show']);

 ///------------------------------about us------------------------------------
 Route::get('/about_us',[AboutUsController::class,'about_us']);
 
 Route::get('/setting',[AboutUsController::class,'setting']);

 Route::Post('/contact',[AboutUsController::class,'contact']);
 Route::post('/sendemail/send', [AboutUsController::class,'send']);

 
 Route::get('/search',[SearchController::class,'search']);
