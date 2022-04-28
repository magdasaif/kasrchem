<?php

namespace App\Http\Resources;

use App\Models\PageImage;
use App\Http\Resources\PagesImagesResource;
use App\Models\Page;
use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource
{
   
    public function toArray($request)
    {
        $type = $this->when( property_exists($this,'type'), function() { return $this->type; } );

        // $x= PagesImagesResource::collection (PageImage::where('page_id',$this->id)->get());
        $x= PagesImagesResource::collection (Page::find($this->id)->getMedia('sub_pages'));

        if($type=='single'){
            return [
                'id'=>$this->id,
                'name'=>$this->title,
                'slug' =>str_replace(' ', '_',$this->title),
                'images'=> $x,
                'sample' =>preg_replace("/\r\n|\r|\n/", '<br/>', $this->sample),
                'content'=>preg_replace("/\r\n|\r|\n/", '<br/>', $this->content),
                'comment'=>preg_replace("/\r\n|\r|\n/", '<br/>', $this->comment),
            ]; 
        }else{
            return [
                'id'=>$this->id,
                'name'=>$this->title,
                'slug' =>str_replace(' ', '_',$this->title),
                'images'=> $x,
                'sample' =>preg_replace("/\r\n|\r|\n/", '<br/>', $this->sample),
            ];
        }
    }
}
