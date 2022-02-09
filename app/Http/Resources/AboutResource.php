<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AboutResource extends JsonResource
{
   
    public function toArray($request)
    {
        $type = $this->when( property_exists($this,'type'), function() { return $this->type; } );
        if($type=='about_us'){
            $path=storage_path().'/app/public/about_us/';
            return [
                'title'=>$this->title,
                'mission' =>$this->mission,
                'vision' =>$this->vision,
                'goal' =>$this->goal,
                'image' => $path.$this->image,
                
            ];
        }else if($type=='setting'){
            $path=public_path().'/images/';
            return [
                'site_name'=>$this->site_name,
                'site_description' =>$this->site_description,
                'site_email' =>$this->site_mail,
                'site_phone' =>$this->site_phone,
                'site_fax' =>$this->site_fax,
                'site_whatsapp' =>$this->site_whatsapp,
                'site_logo' => $path.$this->image,
                
            ];
        }
    }

}
