<?php

namespace App\Http\Resources;

use App\Models\Release;
use Illuminate\Http\Resources\Json\JsonResource;

class ReleaseSectionResource extends JsonResource
{
   
    public function toArray($request)
    {
        $lang = $this->when( property_exists($this,'lang'), function() { return $this->lang; } );
        $type = $this->when( property_exists($this,'type'), function() { return $this->type; } );
        if($lang=='ar')
        {
             $name= $this->site_name_ar;
             $title="title_ar as title";
        }
       else
        {
            $name= $this->site_name_en;
            $title="title_en as title";
        }

        if($type=='all'){
            $all=Release::select('*','releases.id as id',$title)
                            ->join('releases_sections', 'releases_sections.release_id', '=', 'releases.id')
                            ->where('releases_sections.sitesection_id',$this->section_id)
                            ->get();
        }elseif($type=='latest'){                
            $all=Release::select('*','releases.id as id',$title)
                            ->join('releases_sections', 'releases_sections.release_id', '=', 'releases.id')
                            ->where('releases_sections.sitesection_id',$this->section_id)
                            ->where('status','1')->orderBy('releases.created_at','desc')->limit(15)
                            ->get();
        }
        
             $release=ReleaseResource::collection($all);
            
       
        return [
            'id'=>$this->section_id,
            'name' =>$name,
            'releases' =>$release,
        ];
    }
}
