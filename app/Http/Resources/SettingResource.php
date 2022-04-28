<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{

    public function toArray($request)
    {
      //  $type = $this->when( property_exists($this,'type'), function() { return $this->type; } );

       

            if($this->getFirstMediaUrl('site_logo')){
                $path=$this->getFirstMediaUrl('site_logo');
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
