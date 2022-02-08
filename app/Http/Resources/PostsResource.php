<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostsResource extends JsonResource
{

    public function toArray($request)
    {
        $path=storage_path().'/app/public/article/'.$this->image;
        $type = $this->when( property_exists($this,'type'), function() { return $this->type; } );
    if($type=='second'){

        return [

            'id' =>$this->id,
            'title' =>$this->title,
            'image' =>$path,
            // 'description' => strip_tags($this->description),
             'description' => $this->description,
            'date' =>$this->date,
        ];

    }else{
        return [

            'id' =>$this->id,
            'title' =>$this->title,
            'image' =>$path,
        ];
    }
      //  return parent::toArray($request);
    }
}
