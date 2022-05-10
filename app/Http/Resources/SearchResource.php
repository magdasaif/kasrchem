<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SearchResource extends JsonResource
{

    public function toArray($request)
    {
        if($this->type=='Product'){
           $path= $this->getFirstMediaUrl('product','desktop');
        }
        elseif($this->type=='Article'){
            $path= $this->getFirstMediaUrl('article','desktop');
        }
        elseif($this->type=='Release'){
            $path= $this->getFirstMediaUrl('releases','desktop');
        }
        elseif($this->type=='Partner'){
            $path= $this->getFirstMediaUrl('partner','desktop');
        }
        elseif($this->type=='Sitesection'){
            $path= $this->getFirstMediaUrl('sections','desktop');
        }
        elseif($this->type=='Photo_Gallery'){
            $path= $this->getFirstMediaUrl('gallery','desktop');
        }
        elseif($this->type=='Video'){
            $path=  $this->link;
        }
            return [
                'id'=>$this->id,
                'name' =>$this->name,
                'source' =>$path,
                'type' =>$this->type,
            ];
       
    }

}
