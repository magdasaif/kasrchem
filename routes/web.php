<?php

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

use App\Models\User;
use Yajra\DataTables\DataTables;
// use App\Http\Controllers\Products\ProductNewController; 



use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// Route::get('try', function () {
//             $data = User::latest()->get();
//             dd($data);
//             return DataTables::of($data)
//                 ->addIndexColumn()
//                 ->addColumn('action', function($row){
//                     $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
//                     return $actionBtn;
//                 })
//                 ->rawColumns(['action'])
//                 ->make(true);
    
// })->name('try'); 


// Route::get('data_try', function () {
//     return view('pages.product_new.try');
    
// });

Route::get('/', function () {
    return view('welcome');
    
});

Auth::routes(['verify' => true]);

Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('home', function () {
        return redirect('/dashboard');
    });

    // Route::POST('check_action', function () {
    //     return view('pages.Pages.ServerFileToExecute');
    // });
    
    // Route::get('/{vue_capture?}', function () {
    //     return view('home');
    // })->where('vue_capture', '[\/\w\.-]*')->middleware('auth');

    //---------from old project-----------------------------------
    //------------------Category------------------------------------------------------
    Route::group(['namespace'=>'Category'],function(){

        Route::resource('categories', 'SubcategoryController1');

        Route::resource('categories2', 'SubcategoryController2');
        Route::GET('categories2/add/{id}', 'SubcategoryController2@show_add_form');
        
        Route::resource('categories2_new', 'SubcategoryController2_new');

        Route::resource('categories3', 'SubcategoryController3');
        Route::get('categories3_add/{id}', 'SubcategoryController3@create');

        Route::resource('categories3_new', 'SubcategoryController3_new');

        Route::resource('categories4', 'SubcategoryController4');
        Route::get('categories4_add/{id}', 'SubcategoryController4@create');

        Route::resource('categories4_new', 'SubcategoryController4_new');
        //==================check if categories related with thing or not=========================//
        Route::GET('/found_for_delete_sub1/{main_category_id}','deleteCategoriesController@findsub1');
        Route::GET('/found_for_delete_sub2/{sub2_id}','deletedCategoriesController@findsub2');
        Route::GET('/found_for_delete_sub3/{sub3_id}','deleteCategoriesController@findsub3');
        Route::GET('/found_for_delete_sub4/{sub4_id}','deleteCategoriesController@findsub4');
        //========================================================================================//

    });
    //------------------site_section------------------------------------------------------
    Route::group(['namespace'=>'SiteSection'],function(){
    Route::resource('site_section', 'SiteSectionController');
      //=======check if section related with release or supplier=========//
  Route::GET('/check_section/{section_id}','CheckSectionController@check_section');
  //================================================================//

    });
    //-----------------------slider-------------------------------------------------------
    Route::group(['namespace'=>'Slider'],function(){
        Route::resource('slider', 'SliderController');
        Route::post('delete_all_slider', 'SliderController@deleteAll')->name('delete_all_slider');

    });
    //--------------------------------article---------------------------------------------
    Route::group(['namespace'=>'Article'],function(){
        Route::resource('article', 'ArticleController');
        
        Route::post('delete_all_article', 'ArticleController@deleteAll')->name('delete_all_article');

        Route::GET('/sub2_article/{main_category_id}','ArticleController@findsub2');
        Route::GET('/sub3_article/{sub2_id}','ArticleController@findsub3');
        Route::GET('/sub4_article/{sub3_id}','ArticleController@findsub4');
    });

    //-------------------------Products----------------------------------------------------
    Route::group(['namespace'=>'Products'],function(){
        Route::resource('products', 'ProductController');       
        Route::post('delete_all_product', 'ProductController@deleteAll')->name('delete_all_product');

        Route::get('product_datatable', 'ProductNewController@yajra_data')->name('product_datatable');

        Route::get('Product2/list','ProductNewController@getdata')->name('Product2_list');
        Route::delete('/Product2/bulk_delete/{ids}', [ProductNewController::class,'bulkDelete'])->name('product2.bulk_delete');
       
   /********************************* Product Routes ************************************/
         Route::resource('Product2', ProductNewController::class)->except(['show']);
        Route::delete('/Product2/bulk_delete/{ids}', [ProductNewController::class,'bulkDelete'])->name('product2.bulk_delete');
    /********************************* End Product Routes ************************************/
    // Route::resource('Product2', 'ProductNewController')->except(['show']);
    // Route::get('/Product2/data','ProductNewController@data');
    // Route::delete('/Product2/bulk_delete/{ids}', 'ProductNewController@bulkDelete');



    });
    //----------------------------add product with livewire---------------------------------
    // Route::get('product_datatable', 'ProductNewController@yajra_data')->name('product_datatable');

    //form repeat routes
    Route::get('add/{id}','Products\ProductController@add');
    Route::get('remove/{id}','Products\ProductController@remove');

    //add product with livewire
    Route::view('add_product','livewire.show');

    //-------------------get sub2,sub3,sub4 when change on any select-------------------
    Route::GET('/fetch_sub1/{section_id}','FetchCategoriesController@findsub1');
    Route::GET('/fetch_sub2/{main_category_id}','FetchCategoriesController@findsub2');
    Route::GET('/fetch_sub3/{sub2_id}','FetchCategoriesController@findsub3');
    Route::GET('/fetch_sub4/{sub3_id}','FetchCategoriesController@findsub4');

    //-------------------product images routes (show/add/delete)-------------------
    Route::get('img/{id}','Products\ProductController@products_images');
    Route::post('add_product_images/{id}','Products\ProductController@add_product_images')/*->middleware('imageOptimize')*/;
    Route::get('delete_product_images/{id}','Products\ProductController@delete_product_images');

    //------------------- product files routes (show/add/delete)-------------------
    Route::get('products_files/{id}','Products\ProductController@products_files');
    Route::post('add_products_files/{id}','Products\ProductController@add_products_files');
    Route::get('delete_products_files/{id}','Products\ProductController@delete_products_files');

    //-----------soft delete && restore -------------------------------------------
    Route::get('delete_product/{id}','Products\ProductController@delete_product')->name('product_delete');
    // Route::get('restore_product/{id}','Products\ProductController@restore_product')->name('product_restore');
    //--------------------------------vedio---------------------------------------------
    Route::group(['namespace'=>'Video'],function(){
        Route::resource('video', 'VideoController');
        Route::post('delete_all_video', 'VideoController@deleteAll')->name('delete_all_video');
    });
    //--------------------------------partners---------------------------------------------
    Route::group(['namespace'=>'Partners'],function(){
        Route::resource('partner', 'PartnerController');
        Route::post('delete_all_partner', 'PartnerController@deleteAll')->name('delete_all_partner');

        Route::get('partner_datatable', 'PartnerController@yajra_data')->name('partner_datatable');

    });
    //----------------------------release-------------------------------------------------
    //----------------------------release-------------------------------------------------
    Route::group(['namespace'=>'Release'],function(){
        Route::resource('release', 'ReleaseController')->except(['show']);
        Route::post('delete_all_release', 'ReleaseController@deleteAll')->name('delete_all_release');
        Route::get('release/list','ReleaseController@getdata')->name('release_datatable');

    });
    //----------------------------release-------------------------------------------------
    Route::group(['namespace'=>'Branches'],function(){
        Route::resource('branches', 'BrancheController');
        Route::post('delete_all_branche', 'BrancheController@deleteAll')->name('delete_all_branche');
    });
    //------------------------photo_gallery-------------------------------------------------------
    Route::group(['namespace'=>'Photo_Gallery'],function(){
        Route::resource('photo_gallery', 'Photo_GalleryController');
        Route::post('delete_all_gallery', 'Photo_GalleryController@deleteAll')->name('delete_all_gallery');

    });
    //############photo_gallery images############-
    Route::get('show_gallery_images/{id}','Photo_Gallery\Photo_GalleryController@show_gallery');
    Route::post('add_gallery_images/{id}','Photo_Gallery\Photo_GalleryController@add_gallery_images');
    Route::get('delete_gallery_images/{id}','Photo_Gallery\Photo_GalleryController@delete_gallery_images');

    //---------------------------pages-------------------------------------------------//
    Route::group(['namespace'=>'Pages'],function(){
        Route::resource('page', 'PageController');
        Route::post('delete_all_page', 'PageController@deleteAll')->name('delete_all_page');
   
     //-------------------pages images routes (show/add/delete)-------------------
     Route::get('page_img/{id}','PageController@pages_images');
     Route::post('add_page_images/{id}','PageController@add_page_images');
     Route::get('delete_page_images/{id}','PageController@delete_page_images');
    });

    //----------------------------------------cities------------------------------------//
    Route::group(['namespace'=>'Cities'],function(){
        Route::resource('city', 'CityController');
    });
    //----------------------------Social links-----------------------------------------------//
    Route::group(['namespace'=>'SocialLinks'],function(){
        Route::resource('social', 'SocialController');
        Route::post('delete_all_social', 'SocialController@deleteAll')->name('delete_all_social');
    });

    //----------------------------Users-------------------------------------------------
    Route::group(['namespace'=>'User'],function(){
        Route::resource('user_type', 'UserTypeController');

    });
    //----------------------------------About_us--------------------------------------------//

    Route::group(['namespace'=>'About_us'],function(){
        // Route::resource('about_us', 'About_us_Controller');
        // Route::POST('update_about_us', 'About_us_Controller@update_about_us')->name('update_about_us');

        Route::GET('about/edit', 'About_us_Controller@edit')->name('about/edit');
        Route::POST('about/update', 'About_us_Controller@update')->name('about/update');
    });
    //------------------------------- ------------------------------------------------//
    Route::group(['namespace'=>'Supplier'],function(){
        Route::resource('supplier', 'SupplierController');
        Route::post('delete_all_supplier', 'SupplierController@deleteAll')->name('delete_all_supplier');
    });
    //===========show_supplier_image=========//
    Route::get('show_supplier_images/{id}','Supplier\SupplierController@show_supplier_image');
    Route::post('add_supplier_images/{id}','Supplier\SupplierController@add_supplier_images');
    Route::get('delete_supplier_images/{id}','Supplier\SupplierController@delete_supplier_images');
    //-------------------------------------------------------------------------------//

    Route::GET('dashboard','HomeController@dashboard')->name('dashboard');

    Route::GET('settings/edit', 'SettingController@edit')->name('settings/edit');
    Route::POST('settings/update', 'SettingController@update')->name('settings/update');

    Route::resource('contact','ContactController');
    Route::post('delete_all_contact', 'ContactController@deleteAll')->name('delete_all_contact');

});
//---------------------------------------ChangePassword-----------------------------------------------//
Route::group(['namespace'=>'Change_password'],function(){
    Route::get('change-password', 'ChangePasswordController@index')->name('show_password');
    Route::post('change-password', 'ChangePasswordController@store')->name('change.password');
});
//--------------------------------------------------------------------------------------//
Route::get('/docs', function () {
    return view('swagger.index');
});
//------------------------------------------------------------------------------//

Route::get('datatables.data', 'DatatablesController@anyData')->name('datatables.data');
Route::get('datatables.index', 'DatatablesController@getIndex')->name('datatables.index');

Route::controller('datatables', 'DatatablesController', [
    'anyData'  => 'datatables.data',
    'getIndex' => 'datatables',
]);
