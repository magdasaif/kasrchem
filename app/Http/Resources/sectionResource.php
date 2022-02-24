<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class sectionResource extends JsonResource
{
   
    public function toArray($request)
    {
        
        $lang = $this->when( property_exists($this,'lang'), function() { return $this->lang; } );
        if($lang=='ar')
        {
             $section_name= $this->site_name_ar;
        }
       else
        {
            $section_name= $this->site_name_en;
        }
        $path=storage_path().'/app/public/site_sections/site_section_image/';
        return [
            'id'=>$this->id,
            'name' =>$section_name,
           // 'image' => $path.$this->image,
            'image' => asset('storage/site_sections/site_section_image/' . $this->image),
             
        ];
    }

}
