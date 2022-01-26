<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\SiteSectionController;
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

///---------------site sections/categories--------------
Route::get('/Sitesections',[SiteSectionController::class,'index']);
Route::get('/Sitesections/{section_id}',[SiteSectionController::class,'get_one_section']);

//---------------------sub1_category------------------------
Route::get('/sub_category1',[SubCategoryController1::class,'index']);
Route::get('/sub_category1/{section_id}',[SubCategoryController1::class,'getCategories']);

//---------------------sub2_category------------------------
Route::get('/sub_category2',[SubCategoryController2::class,'index']);
Route::get('/sub_category2/{sub1}',[SubCategoryController2::class,'getCategories']);

//---------------------sub3_category------------------------
Route::get('/sub_category3',[SubCategoryController3::class,'index']);
Route::get('/sub_category3/{sub2}',[SubCategoryController3::class,'getCategories']);

//---------------------sub4_category------------------------
Route::get('/sub_category4',[SubCategoryController4::class,'index']);
Route::get('/sub_category4/{sub3}',[SubCategoryController4::class,'getCategories']);

//---------------------products------------------------
// Route::get('/all_products/{lang}',[ProductController::class,'get_all_product']);
//Route::get('/products/category_id={sub1}&sub_category_id={sub2}&type_id={sub3}&local={lang}',[ProductController::class,'filter_product']);


Route::get('/products/{id}/{lang}',[ProductFilterController::class,'getProduct']);
Route::get('/latest_products/{lang}',[LatestProductController::class,'latest_products']);

Route::apiResource('/products', 'ProductFilterController', array("as" => "api"));

///-------------------------------------
