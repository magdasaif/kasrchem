<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class sub_typesResource extends JsonResource
{
    
    public function toArray($request)
    {
         // return parent::toArray($request);
         $lang = $this->when( property_exists($this,'lang'), function() { return $this->lang; } );
        if($lang=='ar')
        {
            $subname= $this->subname_ar;
        }
        else
        {
            $subname= $this->subname_en;
        }
        return 
        [
             'id'=>$this->id,
             'name'=>$subname,
        ] ;
        
    }
}
