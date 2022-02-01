<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Social;
use Illuminate\Support\Facades\Validator;
class social_linksController  extends Controller
{
    public function getsocial_links()
    {
      
        $Social = Social::select('id','name','icon','link')->where('status','1')->get();
    
        return response($Social,200,['OK']);
    }

  



}
