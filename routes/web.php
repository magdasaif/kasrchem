<?php

use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
<<<<<<< HEAD
=======
use App\Http\Requests\SiteSectionRequest;

use App\Http\Controllers\SiteSection\SiteSectionController;
>>>>>>> yasmeen
=======
>>>>>>> magda

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
<<<<<<< HEAD
<<<<<<< HEAD

=======
>>>>>>> magda

Route::group(['namespace'=>'Category'],function(){
    Route::resource('categories', 'SubcategoryController1');
});
<<<<<<< HEAD
=======
>>>>>>> yasmeen
//------------------site_section------------------------------------------------------
Route::group(['namespace'=>'SiteSection'],function(){
    Route::resource('site_section', 'SiteSectionController');
});
<<<<<<< HEAD
=======

//Route::resource('site_section', 'App\Http\Controllers\Category\SiteSectionController');
//------------------------------------------------------------------------------------------
// Route::group(['namespace'=>'Category'],function(){
//     Route::resource('categories', 'SubcategoryController1');
// });
>>>>>>> yasmeen
=======
>>>>>>> magda
