<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Supplier_imagesResource extends JsonResource
{
    public function toArray($request)
    {
         $path=storage_path().'/app/public/supplier/supplier_images_no'.$this->id.'/';
           return 
           [
                'id'=>$this->id,
                //'image'=>$path.$this->image,
                'image'=>asset('storage/app/public/supplier/supplier_images_no'.$this->id.'/' . $this->image),
                
           ] ;
    }
}
