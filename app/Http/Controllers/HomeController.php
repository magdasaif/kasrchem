<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Sitesection;
use App\Models\Main_Category;
use App\Models\Slider;
use App\Models\Article;
use App\Models\Photo_Gallery;
use App\Models\Video;
use App\Models\Partner;
use App\Models\Social;
use App\Models\Product;
use App\Models\Branche;
use App\Models\Supplier;

class HomeController extends Controller
{

    //------------------------------------------------------
     public function dashboard()
     {
       $title='الرئيسيه';
       
       $sections = Sitesection::get()->count();
       $sub1 = Main_Category::get()->count();
       $slider = Slider::get()->count();
       $article = Article::get()->count();
       $gallery = Photo_Gallery::get()->count();
       $video = Video::get()->count();
       $partner = Partner::get()->count();
       $social = Social::get()->count(); 
       $product = Product::get()->count(); 
       $branches = Branche::get()->count(); 
       $supplier = Supplier::get()->count(); 
       
     //dd($slider);
       return view('pages.home_page',compact('sections','sub1','slider','article','gallery','video','partner','social','product','branches','title'));
     }

}
