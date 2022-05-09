<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Models\Sitesection;

class sectionResource extends JsonResource
{
    public function toArray($request)
    {
       // return $this->all();
        
        $lang = $this->when( property_exists($this,'lang'), function() { return $this->lang; } );

        $type = $this->when( property_exists($this,'type'), function() { return $this->type; } );
        
        if($lang=='ar'){
             $section_name= $this->name_ar;
             $section_desc=$this->description_ar;
        }
        else{
            $section_name= $this->name_en;
            $section_desc=$this->description_en;
        }


        if($type=='show_imgs'){

            $images = Sitesection::find($this->id)->getMedia('sub_section');
            $new_images=array();
            foreach($images as $ii){
                $selected=[
                   'id'=>$ii->id,
                   'image'=> $ii->getUrl('desktop')
                ];
            array_push($new_images,$selected);
            }

            return [
                'id'=>$this->id,
                // 'name' =>$section_name,
                'description' =>$section_desc,
                'images' => $new_images,
                 
            ];
        }else{
            return [
                'id'=>$this->id,
                // 'name' =>$section_name,
                'name' =>preg_replace("/\r\n|\r|\n/", '<br/>', $section_name),
                'image' => $this->getFirstMediaUrl('sections','desktop'),
                 
            ];
        }
    }

}
