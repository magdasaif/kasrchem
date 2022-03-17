<?php

namespace App\Http\Resources;

use App\Models\PageImage;
use App\Http\Resources\PagesImagesResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource
{
   
    public function toArray($request)
    {
        $type = $this->when( property_exists($this,'type'), function() { return $this->type; } );

        $x= PagesImagesResource::collection (PageImage::where('page_id',$this->id)->get());

        if($type=='single'){
            return [
                'id'=>$this->id,
                'name'=>$this->title,
                'slug' =>str_replace(' ', '_',$this->title),
                'images'=> $x,
                'sample'=>$this->sample,
                'content'=>$this->content,
            ]; 
        }else{
            return [
                'id'=>$this->id,
                'name'=>$this->title,
                'slug' =>str_replace(' ', '_',$this->title),
                'images'=> $x,
                'sample'=>$this->sample,
            ];
        }
    }
}
