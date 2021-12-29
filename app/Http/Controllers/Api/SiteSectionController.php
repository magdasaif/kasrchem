<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\sectionResource;
use App\Models\Sitesection;
use Illuminate\Support\Facades\Validator;
class SiteSectionController extends Controller
{
    use ApiResponseTrait;
    public function index()
    {
        $Sitesections = Sitesection::get();
        return response($Sitesections,200,['OK']);
    }

    public function get_one_section($section_id)
    {
        // return $section_id;
        $Sitesections = Sitesection::where('id','=',$section_id)->get();
         return response($Sitesections,200,['OK']);
     }


    
}