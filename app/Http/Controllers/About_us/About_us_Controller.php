<?php

namespace App\Http\Controllers\About_us;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\About_us_Request;
use App\Models\AboutUs;
class About_us_Controller extends Controller
{

    public function edit()
    {
        $title='بيانات الموقع';
        $AboutUs=AboutUs::first();
        //return $info;
        
      return view('pages.AboutUs.Show',compact('AboutUs','title'));
    }

//------------------------------------------------------//
//About_us_Request
    public function update(Request $request)
    {
        //dd($request->all());
       try
       {
          // $validated = $request->validated();

          $AboutUs = AboutUs::first();

           $AboutUs-> title_ar= $request->title_ar;
           $AboutUs->title_en = $request->title_en;
           $AboutUs-> mission_ar= $request->mission_ar;
           $AboutUs-> mission_en= $request->mission_en;
           $AboutUs-> vision_ar= $request->vision_ar;
           $AboutUs-> vision_en= $request->vision_en;
           $AboutUs-> goal_ar= $request->goal_ar;
           $AboutUs-> goal_en= $request->goal_en;

           if($request->image)
           {
                //-----------------لو مفيش صورة يحذفها اصلا-------------------//
            if($request->deleted_image!=null)
            {
              $image_path=storage_path().'/app/public/about_us/'.$request->deleted_image;
              unlink($image_path);

             }
            //----------------- //----------------- //-----------------
            $folder_name='';
           // $photo_name= str_replace(' ', '_',($request->image)->getClientOriginalName());
            $photo_name='about_us.jpg';
            ($request->image)->storeAs($folder_name,$photo_name,$disk="about_us");
             $AboutUs->image = $photo_name;
           }
           $AboutUs->save();

            return redirect()->route('about/edit')->with(['success'=>'تم التعديل بنجاح']);
       }
       catch
       (\Exception $e)
       {
            return redirect()->route('about/edit')->withErrors(['error' => $e->getMessage()]);
       }
    }
}
