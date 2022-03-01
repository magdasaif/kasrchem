<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteInfo;

class SettingController extends Controller
{
    
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }


    public function edit()
    {
        $title='اعدادت الموقع';
        $info=SiteInfo::first();
        //return $info;
         
       return view('pages.setting',compact('info','title'));
    }

  
    public function update(Request $request)
    {
       // dd($request->all());
           //dd($request->all());
       try
       {
          // $validated = $request->validated();

          $info = SiteInfo::first();

           $info-> site_name_ar= $request->site_name_ar;
           $info-> site_name_en= $request->site_name_en;
           $info-> site_desc_ar= $request->site_desc_ar;
           $info-> site_desc_en= $request->site_desc_en;

           $info-> site_mail= $request->site_mail;
           $info-> site_phone= $request->site_phone;
           $info-> site_fax= $request->site_fax;
           $info-> site_whatsapp= $request->site_whatsapp;
           
           $info-> ios_link= $request->ios_link;
           $info-> android_link= $request->android_link;
          

           if($request->site_logo)
           {
                //-----------------لو مفيش صورة يحذفها اصلا-------------------//
            if($request->deleted_image!=null)
            {
              $image_path=public_path().'/images/'.$request->deleted_image;
              unlink($image_path);
             }
            //----------------- //----------------- //-----------------
            $folder_name='';
            // $photo_name= str_replace(' ', '_',($request->site_logo)->getClientOriginalName());
            $photo_name='logo.jpg';
            ($request->site_logo)->storeAs($folder_name,$photo_name,$disk="site_logo");

          // ($request->site_logo)->move($disk="site_logo", $photo_name);
                $info->site_logo = $photo_name;
             }

             $info->save();

            //return redirect()->route('settings/edit')->with(['success'=>'تم التعديل بنجاح']);
            return redirect()->back()->with(['success'=>'تم التعديل بنجاح']);
       }
       catch
       (\Exception $e)
       {
            return redirect()->route('settings/edit')->withErrors(['error' => $e->getMessage()]);
       }
    }

}
