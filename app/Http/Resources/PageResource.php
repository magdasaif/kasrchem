<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Page;
class PageResource extends JsonResource
{
   
    public function toArray($request)
    {
        $type = $this->when( property_exists($this,'type'), function() { return $this->type; } );
        if($type=='single'){
            return [
                'id'=>$this->id,
                'name'=>$this->title,
                'slug' =>str_replace(' ', '_',$this->title),
                'sample'=>$this->sample,
                'content'=>$this->content,
            ]; 
        }else{
            return [
                'id'=>$this->id,
                'name'=>$this->title,
                'slug' =>str_replace(' ', '_',$this->title),
                'sample'=>$this->sample,
            ];
        }
    }
}
