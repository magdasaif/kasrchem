<?php

namespace App\Http\Controllers\About_us;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\About_us_Request;
use App\Models\AboutUs;
class About_us_Controller extends Controller
{

    // public function index()
    // {
    //     //$AboutUs=AboutUs::all();
    //     $About=AboutUs:: orderBy('id')->take(1)->get();
    //     return view('pages.AboutUs.Show',compact('About'));
    // }


    //  public function show()
    //  {

    //  //$AboutUs=AboutUs::all();
    //  $About=AboutUs:: orderBy('id')->take(1)->get();
    //  return view('pages.AboutUs.Show',compact('About'));
    //  }

    //------------------------------------------------------
     public function edit($id)
     {
       $title='بيانات الموقع';
       $AboutUs=AboutUs::select('*')->first();

       return view('pages.AboutUs.Show',compact('AboutUs','title'));
     }
//------------------------------------------------------//
//About_us_Request
    public function show(Request $request,$id)
    {
        dd($request->all());
       try
       {
          // $validated = $request->validated();

           $AboutUs = AboutUs::findOrFail($id);
          //  $AboutUs = AboutUs::first();

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
            $photo_name= str_replace(' ', '_',($request->image)->getClientOriginalName());
            ($request->image)->storeAs($folder_name,$photo_name,$disk="about_us");
             $AboutUs->image = $photo_name;
           }
           $AboutUs->save();

            return redirect()->back()->with(['success'=>'تم التعديل بنجاح']);
       }
       catch
       (\Exception $e)
       {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
       }
    }
}
