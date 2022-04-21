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
        if($lang=='ar')
        {
             $section_name= $this->name_ar;
        }
       else
        {
            $section_name= $this->name_en;
        }

        
        return [
            'id'=>$this->id,
            // 'name' =>$section_name,
            'name' =>preg_replace("/\r\n|\r|\n/", '<br/>', $section_name),
            'image' => $this->getFirstMediaUrl('sections','edit'),
             
        ];
    }

}
