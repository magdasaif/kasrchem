<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends JsonResource
{
   
    public function toArray($request)
    {
        
        return [
            'id'=>$this->id,
            'priority'=>$this->sort,
            //'image' => $this->getFirstMediaUrl('slider','slider_img'),
            'image' => $this->getFirstMediaUrl('slider','phone'),
            
             
        ];
    }
}
