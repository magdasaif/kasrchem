<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AboutResource extends JsonResource
{

    public function toArray($request)
    {
      //  $type = $this->when( property_exists($this,'type'), function() { return $this->type; } );

        if(isset($this->image)){
            //$path=storage_path().'/app/public/about_us/';
            
            return [
                'title'=>$this->title,
                'mission' =>$this->mission,
                'vision' =>$this->vision,
                'goal' =>$this->goal,
<<<<<<< HEAD
                'image' => $path.$this->image,

            ];
        }
        else{
            $path =  public_path().'/images/';

=======
                'image' =>asset('storage/app/public/about_us/' . $this->image),
                
            ];
        }
        else{
           // $path=public_path().'/images/';
>>>>>>> api
            return [
                'site_name'=>$this->site_name,
                'site_description' =>$this->site_description,
                'site_email' =>$this->site_mail,
                'site_phone' =>$this->site_phone,
                'site_fax' =>$this->site_fax,
                'site_whatsapp' =>$this->site_whatsapp,
                'site_logo' => asset('public/images/' . $this->site_logo),
<<<<<<< HEAD

=======
                
>>>>>>> api
            ];
        }
    }

}
