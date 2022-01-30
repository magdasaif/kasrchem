<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\SiteSectionController;
use App\Http\Controllers\Api\sliderController;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\PartnerController;
use App\Http\Controllers\Api\BranchController;
use App\Http\Controllers\Api\social_linksController;
use App\Http\Controllers\Api\SubCategoryController1;
use App\Http\Controllers\Api\SubCategoryController2;
use App\Http\Controllers\Api\SubCategoryController3;
use App\Http\Controllers\Api\SubCategoryController4;

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductFilterController;
use App\Http\Controllers\Api\LatestProductController;



 

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

///-------------------------------sections----------------------------------------------
Route::get('/sections/{lang}',[SiteSectionController::class,'index']);
///-------------------------------section_category----------------------------------------------
Route::get('/sections/{lang}/{section_id}',[SiteSectionController::class,'get_section_category']);
///-------------------------------category_sub_category----------------------------------------------
Route::get('/sub_category/{lang}/{category_id}/subs',[SiteSectionController::class,'get_category_sub_category']);
///-------------------------------sub_category_types----------------------------------------------
Route::get('/sub_categories/{lang}/{sub_category_id}/types',[SiteSectionController::class,'get_sub_category_types']);
///-------------------------------sub_types_types----------------------------------------------
Route::get('/types/{lang}/{type_id}/sub_types',[SiteSectionController::class,'get_types_sub_types']);
///------------------------slider---------------------------------------------------------
Route::get('/sliders',[sliderController::class,'index']);
//-------------------------Pages----------------------------------------------------------
Route::get('/Pages/{lang}',[PageController::class,'getpages']);
//--------------------------Partners------------------------------------------------------
Route::get('/partners/{lang}',[PartnerController::class,'getpartners']);
//---------------------------Branch-------------------------------------------------------
Route::get('/branches/{lang}',[BranchController::class,'getbranches']);
//----------------------------social_links--------------------------------------------------
Route::get('/social_links',[social_linksController::class,'getsocial_links']);

//---------------------products------------------------
// Route::get('/all_products/{lang}',[ProductController::class,'get_all_product']);
//Route::get('/products/category_id={sub1}&sub_category_id={sub2}&type_id={sub3}&local={lang}',[ProductController::class,'filter_product']);


Route::get('/products/{id}/{lang}',[ProductFilterController::class,'getProduct']);
Route::get('/latest_products/{lang}',[LatestProductController::class,'latest_products']);

Route::apiResource('/products', 'ProductFilterController', array("as" => "api"));

///-------------------------------------
