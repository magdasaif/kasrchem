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
use App\Http\Controllers\Api\SupplierController;







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

//---------------------videos------------------------
Route::apiResource('/videos', 'VideoController', array("as" => "api"));

//---------------------photos_galleries------------------------
Route::apiResource('/photos_galleries', 'GalleryController', array("as" => "api"));

//---------------------photos_galleries------------------------
Route::apiResource('/releases', 'ReleaseController', array("as" => "api"));

///------------------------------Supplier-------------------------------------
Route::get('/suppliers',[SupplierController::class,'index']);

//---------------------related products with suplier ------------------------

?>