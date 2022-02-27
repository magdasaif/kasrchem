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
           // $path=public_path().'/images/';
            return [
                'site_name'=>$this->site_name,
                'site_description' =>$this->site_description,
                'site_email' =>$this->site_mail,
                'site_phone' =>$this->site_phone,
                'site_fax' =>$this->site_fax,
                'site_whatsapp' =>$this->site_whatsapp,
                'site_logo' => asset('public/images/' . $this->site_logo),
                'ios_link' =>$this->ios_link,
                'android_link' =>$this->android_link,
            ];
        }
    }

}
