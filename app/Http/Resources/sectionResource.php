<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class sectionResource extends JsonResource
{
   
    public function toArray($request)
    {
        return [
          
            'site_name_ar' =>$this->site_name_ar,
            'site_name_en' =>$this->site_name_en,
            'statues' => $this->statues,
              'image' => $this->image,
        ];
    }
}
