<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\Validator;
class sliderController extends Controller
{
    use ApiResponseTrait;
    public function index()
    {
      //$Slider = Slider::get();
      $Slider = Slider::select('id','priority','image')->where('status','1')->orderBy('priority','asc')->get();
     
        return response($Slider,200,['OK']);
    }

  



}
