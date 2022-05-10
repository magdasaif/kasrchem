<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\SiteSectionController;
use App\Http\Controllers\Api\sliderController;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\PartnerController;
use App\Http\Controllers\Api\BranchController;
use App\Http\Controllers\Api\social_linksController;
use App\Http\Controllers\Api\ProductFilterController;
use App\Http\Controllers\Api\LatestProductController;
use App\Http\Controllers\Api\PostsController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\LatestMultiMediaController;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\Api\RelatedProductController;
use App\Http\Controllers\Api\CommonController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\ReleaseController;


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
Route::get('/sections/{id}',[SiteSectionController::class,'get_section_category']);
Route::get('/sections_imgs/{id}',[SiteSectionController::class,'section_imgs']);

///------------------------slider-------------------------------
Route::get('/sliders',[sliderController::class,'index']);

//-------------------------Pages---------------------------------
Route::get('/pages',[PageController::class,'getpages']);

///------------------------------page details -------------------------------------
Route::get('/page/{id}',[PageController::class,'page_detail']);

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

// ------------------------common api for all media----------------------------
Route::apiResource('/media', 'MediaController', array("as" => "api"));

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

//---------------------categories with releases ------------------------
Route::get('/release_section',[ReleaseController::class,'sectionsAndRelease']);

//---------------------latest releases------------------------
Route::get('/latest_releases',[LatestMultiMediaController::class,'latest_releases']);

///------------------------------Supplier-------------------------------------
Route::get('/suppliers',[SupplierController::class,'index']);

///------------------------------Supplier details -------------------------------------
Route::get('/supplier/{id}',[SupplierController::class,'getSupplier']);

//---------------------related products with supplier ------------------------
 Route::get('/related_products/{id}',[RelatedProductController::class,'show']);
 
//---------------------categories with supplier ------------------------
 //Route::get('/suppliers_section',[SupplierController::class,'sectionsAndSupplier']);
 
 ///------------------------------about us------------------------------------
 
 Route::get('/setting',[CommonController::class,'setting']);

 Route::Post('/contact',[CommonController::class,'contact']);
 
 Route::get('/search',[SearchController::class,'search']);
