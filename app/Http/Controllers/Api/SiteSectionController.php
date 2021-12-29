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
    public function index(){
        $Sitesections = Sitesection::get();
        return response($Sitesections,200,['OK']);
    }

    public function get_one_section($section_id){
        // return $section_id;
        $Sitesections = Sitesection::where('id','=',$section_id)->get();
         return response($Sitesections,200,['OK']);
     }


     public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'site_name_ar' => 'required',
            'site_name_en' => 'required',
            'statues' => 'required',
              'image' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(null,$validator->errors(),400);
        }

        $Sitesection = Sitesection::create($request->all());

        if($Sitesection){
            return $this->apiResponse(new sectionResource($Sitesection),'The Sitesection Save',201);
        }

        return $this->apiResponse(null,'The Sitesection Not Save',400);
    }

    public function update(Request $request ,$id){

        $validator = Validator::make($request->all(), [
            'site_name_ar' => 'required',
            'site_name_en' => 'required',
            'statues' => 'required',
              'image' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(null,$validator->errors(),400);
        }

        $Sitesection=Sitesection::find($id);

        if(!$Sitesection){
            return $this->apiResponse(null,'The Sitesection Not Found',404);
        }

        $Sitesection->update($request->all());

        if($Sitesection){
            return $this->apiResponse(new sectionResource($Sitesection),'The Sitesection update',201);
        }

    }
}