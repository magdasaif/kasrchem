<?php

namespace App\Http\Resources;

use App\Models\Release;

use App\Models\Photo_Gallery;
use Illuminate\Http\Resources\Json\JsonResource;

class LatestMultiMediaResource extends JsonResource
{
   
    public function toArray($request)
    {
        $type = $this->when( property_exists($this,'type'), function() { return $this->type; } );

        if($type=='latest_galleries'){
            $images = Photo_Gallery::find($this->id)->getMedia('sub_gallery');
            $new_images=array();
            foreach($images as $ii){
                $selected=[
                   'id'=>$ii->id,
                   'image'=> $ii->getUrl()
                ];
            array_push($new_images,$selected);
            }

            return [

                'id' =>$this->id,
                'title' =>$this->title,
                'image' => $this->getFirstMediaUrl('gallery'),
                'images' => $new_images,
            ];
        //  return parent::toArray($request);
        }elseif($type=='latest_releases'){
           
            $files=Release::find($this->id)->mainFile();
            $new_files='';
            foreach($files as $fi){
                $new_files=asset('storage/releases/release_no_'.$this->id.'/' . $fi->filename);
            }
            return [

                'id' =>$this->id,
                'title' =>$this->title,
                'image' =>  $this->getFirstMediaUrl('releases'),
                'attachment' =>  $new_files,
               
            ];

        }elseif($type=='latest_posts'){
            return [

                'id' =>$this->id,
                'title' =>$this->title,
                'image' =>$this->getFirstMediaUrl('article'),
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