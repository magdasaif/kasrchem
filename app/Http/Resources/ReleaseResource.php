<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReleaseResource extends JsonResource
{
   
    public function toArray($request)
    {
        $path=storage_path().'/app/public/release/release_'.$this->id.'/';

        $type = $this->when( property_exists($this,'type'), function() { return $this->type; } );

        if($type=='release_section'){
          
        }
        
        return [

            'id' =>$this->id,
            'title' =>$this->title,
         //   'image' =>$path.$this->image,
            'image' =>  asset('storage/release/release_'.$this->id.'/' . $this->image),
          //  'attachment' => $path.$this->file,
            'attachment' =>  asset('storage/release/release_'.$this->id.'/' . $this->file),
           
        ];
      //  return parent::toArray($request);
    }
}