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
       $data['title']='الرئيسيه';
      
       $data['sections'] = Sitesection::get()->count();
       $data['sub1'] = Main_Category::get()->count();
       $data['slider'] = Slider::get()->count();
       $data['article'] = Article::get()->count();
       $data['gallery'] = Photo_Gallery::get()->count();
       $data['video'] = Video::get()->count();
       $data['partner'] = Partner::get()->count();
       $data['social'] = Social::get()->count(); 
       $data['product'] = Product::get()->count(); 
       $data['branches'] = Branche::get()->count(); 
       $data['supplier'] = Supplier::get()->count(); 
       
       return view('pages.home_page',$data);
     }

}
