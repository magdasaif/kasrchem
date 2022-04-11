<?php

namespace App\Http\Repositories;
use App\Models\SiteInfo;
use App\Http\Interfaces\SiteInfoInterface;
use App\Traits\ImageTrait;

class SiteInfoRepository implements SiteInfoInterface{

    use ImageTrait;
    
    public function edit(){
        $data['title']  ='اعدادت الموقع';
        $data['info']   =SiteInfo::first();      
       return view('pages.setting',$data);
    }
    
    public function update($request){
        //dd($request->all());
        try
        {
 
           $info = SiteInfo::first();
 
            $info-> site_name_ar= $request->site_name_ar;
            $info-> site_name_en= $request->site_name_en;
            $info-> site_desc_ar= $request->site_desc_ar;
            $info-> site_desc_en= $request->site_desc_en;
 
            $info-> site_mail= ($request->site_mail)?$request->site_mail:'';
            $info-> site_phone= ($request->site_phone)?$request->site_phone:'';
            $info-> site_fax= ($request->site_fax)?$request->site_fax:'';
            $info-> site_whatsapp= ($request->site_whatsapp)?$request->site_whatsapp:'';
            
            $info-> ios_link= ($request->ios_link)?$request->ios_link:'';
            $info-> android_link= ($request->android_link)?$request->android_link:'';
           
 
            if($request->site_logo)
            {
             if($request->deleted_image!=null)
             {
                // handel image array to pass image path to trait function
                  $imageData=[
                    'path'=>storage_path().'/app/public/setting/'.$request->deleted_image,
                ];
                //call to unLinkImage fun to delete old image from disk 
                $this->unLinkImage($imageData);
                
              }
             //----------------- //----------------- //-----------------
                // handel image array to pass image data to trait function
                 $imageData=[
                    'image_name'    => $request->site_logo,
                    'folder_name'   => '',
                    'disk_name'     => 'setting',
                ];
                
                //call to storeImage fun to save image in disk and return back with photo name
                $photo_name=$this->storeImage($imageData);

                $info->site_logo = $photo_name;
              }
 
              $info->save();

              toastr()->success('تمت التعديل بنجاح');
             return redirect()->back()->with(['success'=>'تم التعديل بنجاح']);
        }
        catch
        (\Exception $e)
        {
            toastr()->error(' حدث خطااثناء التعديل');
            return redirect()->back()->withErrors(['error' => ' حدث خطااثناء التعديل']);
            // return redirect()->route('settings/edit')->withErrors(['error' => $e->getMessage()]);
        }
    }
  
}
?>
