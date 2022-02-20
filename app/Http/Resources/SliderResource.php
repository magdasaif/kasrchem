<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends JsonResource
{
   
    public function toArray($request)
    {
        
        $path=storage_path().'/app/public/slider/';
        return [
            'id'=>$this->id,
            'priority'=>$this->priority,
           // 'image' => $path.$this->image,
            'image' => asset('storage/app/public/slider/' . $this->image),
            
             
        ];
    }
}
