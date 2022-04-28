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
        return [
            'id'=>$this->id,
            'name' =>$partner_name,
            'image'=>$this->getFirstMediaUrl('partner'),
            'link'=>$this->external_link,
             
        ];
    }
}
