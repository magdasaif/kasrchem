<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\Gallery_Photo_Image;

class GalleryResource extends JsonResource
{
   
    public function toArray($request)
    {
        //$path_main=storage_path().'/app/public/photo_gallery/';
        //$path=storage_path().'/app/public/photo_gallery/gallery_photo_images_no_'.$this->id.'/';

       // $type = $this->when( property_exists($this,'type'), function() { return $this->type; } );
   
        $images = Gallery_Photo_Image::where('gallery_id',$this->id)->get();
        $new_images=array();
        foreach($images as $ii){
            $selected=[
                'id'=>$ii->id,
               // 'image'=>$path.$ii->image,
                'image'=>asset('storage/photo_gallery/gallery_photo_images_no_'.$this->id.'/' . $ii->image),
            ];
        array_push($new_images,$selected);
        }

        return [

            'id' =>$this->id,
            'title' =>$this->title,
            //'image' => $path_main.$this->image,
            'image' => asset('storage/photo_gallery/' . $this->image),
            'images' => $new_images,
        ];
      //  return parent::toArray($request);
    }
}