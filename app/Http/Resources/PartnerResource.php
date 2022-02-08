<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PartnerResource extends JsonResource
{
    
    public function toArray($request)
    {
       $lang = $this->when( property_exists($this,'lang'), function() { return $this->lang; } );
        if($lang=='ar')
        {
             $partner_name= $this->name_ar;
        }
    else
        {
            $partner_name= $this->name_en;
        }
        $path=storage_path().'/app/public/partners/';
        return [
            'id'=>$this->id,
            'name' =>$partner_name,
            'image' => $path.$this->image,
            'link'=>$this->external_link,
             
        ];
    }
}
