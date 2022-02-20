<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\Gallery_Photo_Image;

class GalleryResource extends JsonResource
{
   
    public function toArray($request)
    {
        $type = $this->when( property_exists($this,'type'), function() { return $this->type; } );

        if($type=='latest_galleries'){
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
        }elseif($type=='latest_releases'){
            return [

                'id' =>$this->id,
                'title' =>$this->title,
             //   'image' =>$path.$this->image,
                'image' =>  asset('storage/release/release_'.$this->id.'/' . $this->image),
              //  'attachment' => $path.$this->file,
                'attachment' =>  asset('storage/release/release_'.$this->id.'/' . $this->file),
               
            ];

        }elseif($type=='latest_posts'){
            return [

                'id' =>$this->id,
                'title' =>$this->title,
                'image' =>asset('storage/article/' . $this->image),
            ];

        }elseif($type=='latest_videos'){
            return [

                'id' =>$this->id,
                'title' =>$this->title,
                'link' => $this->link,
            ];

        }
    }
}