<?php
<<<<<<< HEAD

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SubCategoryController1;
use App\Http\Controllers\Api\SiteSectionController;
=======
use App\Http\Controllers\Api\SiteSectionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
>>>>>>> yasmeen

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

<<<<<<< HEAD
Route::get('/sub_category1',[SubCategoryController1::class,'index']);

Route::get('/sections_category/{section_id}',[SubCategoryController1::class,'getCategories']);

Route::get('/test', function () {
    return 'hhh';
});
=======
>>>>>>> yasmeen

///---------------sections--------------
Route::get('/Sitesections',[SiteSectionController::class,'index']);
Route::get('/Sitesections/{section_id}',[SiteSectionController::class,'get_one_section']);

<<<<<<< HEAD
=======

///------------------------------------------------
Route::get('/sub_category1',[SubCategoryController1::class,'index']);
Route::get('/sections_category/{section_id}',[SubCategoryController1::class,'getCategories']);
>>>>>>> yasmeen
