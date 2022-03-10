<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AboutResource extends JsonResource
{

    public function toArray($request)
    {
      //  $type = $this->when( property_exists($this,'type'), function() { return $this->type; } );

        //about us details
        if(isset($this->image)){
            //$path=storage_path().'/app/public/about_us/';
            
            return [
                'title'=>$this->title,
                'mission' =>$this->mission,
                'vision' =>$this->vision,
                'goal' =>$this->goal,
                'image' =>asset('storage/about_us/' . $this->image),
                
            ];
        }
        else{//setting details

            if(file_exists(storage_path().'/app/public/setting/'.$this->site_logo)){
                $path=asset('storage/setting/'.$this->site_logo);
            }else{
                 $path= asset('public/images/logo.png');
                 //public_path().'/images/logo.png';
            }
           
            return [
                'site_name'=>$this->site_name,
                'site_description' =>$this->site_description,
                'site_email' =>$this->site_mail,
                'site_phone' =>$this->site_phone,
                'site_fax' =>$this->site_fax,
                'site_whatsapp' =>$this->site_whatsapp,
                'site_logo' => $path,
                'ios_link' =>$this->ios_link,
                'android_link' =>$this->android_link,
            ];
        }
    }

}
