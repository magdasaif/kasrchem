<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SubCategoryController1;
use App\Http\Controllers\Api\SiteSectionController;
use App\Http\Controllers\Api\sliderController;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\PartnerController;
use App\Http\Controllers\Api\BranchController;
use App\Http\Controllers\Api\social_linksController;

 

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
    return 'hhh';
});
//---------------------main_category------------------------
Route::get('/main_category',[SubCategoryController1::class,'index']);
Route::get('/main_category/{section_id}',[SubCategoryController1::class,'getCategories']);

///-------------------------------sections----------------------------------------------
// Route::get('/Sitesections',[SiteSectionController::class,'index']);
//Route::get('/Sitesections/{section_id}',[SiteSectionController::class,'get_one_section']);
       //#######################################//
Route::get('/sections/{lang}',[SiteSectionController::class,'index']);
Route::get('/sections/{lang}/{section_id}',[SiteSectionController::class,'get_section_category']);
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
