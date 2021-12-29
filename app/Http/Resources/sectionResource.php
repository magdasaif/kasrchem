<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class sectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
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
