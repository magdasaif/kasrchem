<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Facades\Validator;
class PageController extends Controller
{
    public function getpages($lang)
    {
      if($lang=='ar')
      {
        
        $Page = Page::select('id','title_ar AS name','title_en AS slug','description_ar AS sample','content_ar AS content')->where('status','1')->get();
    
      }
      else
      { 
        $Page = Page::select('id','title_en AS name','title_en AS slug','description_en AS sample','content_en AS content')->where('status','1')->get();
      }
     
        return response($Page,200,['OK']);
    }

  



}
