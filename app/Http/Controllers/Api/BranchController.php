<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branche;
use Illuminate\Support\Facades\Validator;
class BranchController  extends Controller
{
    public function getbranches($lang)
    {
      if($lang=='ar')
      {
        
        $Branche = Branche::select('id','name_ar AS title','address_ar AS address','phone','fax','email','latitude','longitude')->get();
        
      }
      else
      { 
        $Branche = Branche::select('id','name_en AS title','address_en AS address','phone','fax','email','latitude','longitude')->get();
      }
      
     
        return response($Branche,200,['OK']);
    }

  



}
