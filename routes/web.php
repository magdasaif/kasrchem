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
Route::group(['namespace'=>'Slider'],function(){
    Route::resource('slider', 'SliderController');
});
//--------------------------------article---------------------------------------------
Route::group(['namespace'=>'Article'],function(){
    Route::resource('article', 'ArticleController');

    Route::GET('/sub2_article/{main_category_id}','ArticleController@findsub2');
    Route::GET('/sub3_article/{sub2_id}','ArticleController@findsub3');
    Route::GET('/sub4_article/{sub3_id}','ArticleController@findsub4');
});

//------------------Products------------------------------------------------------
Route::group(['namespace'=>'Products'],function(){
    Route::resource('products', 'ProductController');

});

//form repeat routes
Route::get('add/{id}','Products\ProductController@add');
Route::get('remove/{id}','Products\ProductController@remove');


//add product with livewire
Route::view('add_product','livewire.show');

// get sub2,sub3,sub4 when change on any select
Route::GET('/fetch_sub2/{main_category_id}','FetchCategoriesController@findsub2');
Route::GET('/fetch_sub3/{sub2_id}','FetchCategoriesController@findsub3');
Route::GET('/fetch_sub4/{sub3_id}','FetchCategoriesController@findsub4');

// product images routes (show/add/delete)
Route::get('img/{id}','Products\ProductController@products_images');
Route::post('add_product_images/{id}','Products\ProductController@add_product_images');
Route::get('delete_product_images/{id}','Products\ProductController@delete_product_images');

// product files routes (show/add/delete)
Route::get('products_files/{id}','Products\ProductController@products_files');
Route::post('add_products_files/{id}','Products\ProductController@add_products_files');
Route::get('delete_products_files/{id}','Products\ProductController@delete_products_files');

