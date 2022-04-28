<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PagesImagesResource extends JsonResource
{
    public function toArray($request)
    {
//$path=storage_path().'/app/public/pages/page_no_'.$this->page_id.'/';
           return 
           [
                'id'=>$this->id,
                'image'=>$this->getUrl(),
           ] ;
    }
}
