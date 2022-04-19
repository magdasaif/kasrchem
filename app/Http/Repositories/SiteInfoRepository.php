<?php

namespace App\Http\Repositories;
use App\Models\SiteInfo;
use App\Traits\ImageTrait;
use App\Http\Interfaces\SiteInfoInterface;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Traits\MediaTrait;
use App\Traits\TableAutoIncreamentTrait;
class SiteInfoRepository implements SiteInfoInterface{

    use ImageTrait,TableAutoIncreamentTrait,MediaTrait;
    
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
                //optimize image
                $info->addMedia($request->site_logo)->toMediaCollection('site_logo');

               if(isset($request->media_url)){
                   //remove  folder from disk //remove old media
                   Media::find($this->get_media_id($request->media_url))->delete(); // this will also remove folder from disk
                   // rmdir(storage_path().'/app/public/media/'.$request->media_id);

                   //call trait to handel aut-increament
                   $this->refreshTable('media');
               }
                  
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
