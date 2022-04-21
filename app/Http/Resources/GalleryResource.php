<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\Gallery_Photo_Image;
use App\Models\Photo_Gallery;

class GalleryResource extends JsonResource
{
   
    public function toArray($request)
    {
     
       // $type = $this->when( property_exists($this,'type'), function() { return $this->type; } );
        $images = Photo_Gallery::find($this->id)->getMedia('sub_gallery');
            $new_images=array();
            foreach($images as $ii){
                $selected=[
                   'id'=>$ii->id,
                   'image'=> $ii->getUrl('edit')
                ];
            array_push($new_images,$selected);
            }

        return [

            'id' =>$this->id,
            'title' =>$this->title,
            //'image' => $path_main.$this->image,
            'image' => $this->getFirstMediaUrl('gallery','edit'),
            'images' => $new_images,
        ];
      //  return parent::toArray($request);
    }
}