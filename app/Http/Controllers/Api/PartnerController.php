<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Partner;
use Illuminate\Support\Facades\Validator;
class PartnerController extends Controller
{
    public function getpartners($lang)
    {
      if($lang=='ar')
      {
        
        $Partner = Partner::select('id','name_ar AS name','image','external_link AS link')->where('status','1')->get();
        
      }
      else
      { 
        $Partner = Partner::select('id','name_en AS name','image','external_link AS link')->where('status','1')->get();
      }
      
     
        return response($Partner,200,['OK']);
    }

  



}
