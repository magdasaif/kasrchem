<?php

use Illuminate\Support\Facades\Route;

use App\Http\Requests\SiteSectionRequest;

use App\Http\Controllers\SiteSection\SiteSectionController;


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
//------------------Category------------------------------------------------------
Route::group(['namespace'=>'Category'],function(){
    
    Route::resource('categories', 'SubcategoryController1');
    
    Route::resource('categories2', 'SubcategoryController2');
    Route::GET('categories2/add/{id}', 'SubcategoryController2@show_add_form');

    Route::resource('categories3', 'SubcategoryController3');
    Route::get('categories3_add/{id}', 'SubcategoryController3@create');
   
    Route::resource('categories4', 'SubcategoryController4');
    Route::get('categories4_add/{id}', 'SubcategoryController4@create');

});
//------------------site_section------------------------------------------------------
Route::group(['namespace'=>'SiteSection'],function(){
   Route::resource('site_section', 'SiteSectionController');
});
//-----------------------slider-------------------------------------------------------
Route::group(['namespace'=>'slider'],function(){
    Route::resource('slider', 'SliderController');
});
//--------------------------------------------------------------------------------------