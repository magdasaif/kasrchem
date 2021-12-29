<?php

use Illuminate\Support\Facades\Route;
use App\Http\Requests\SiteSectionRequest;

use App\Http\Controllers\Category\SiteSectionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('empty');
});
//------------------site_section------------------------------------------------------
Route::group(['namespace'=>'Category'],function(){
    Route::resource('site_section', 'SiteSectionController');
});

//Route::resource('site_section', 'App\Http\Controllers\Category\SiteSectionController');
//------------------------------------------------------------------------------------------
Route::group(['namespace'=>'Category'],function(){
    Route::resource('categories', 'SubcategoryController1');
});