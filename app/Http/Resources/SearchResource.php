<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SearchResource extends JsonResource
{

    public function toArray($request)
    {
        if($this->type=='Product'){
           $path= $this->getFirstMediaUrl('product','edit');
        }
        elseif($this->type=='Article'){
            $path= $this->getFirstMediaUrl('article','edit');
        }
        elseif($this->type=='Release'){
            $path= $this->getFirstMediaUrl('releases','edit');
        }
        elseif($this->type=='Partner'){
            $path= $this->getFirstMediaUrl('partner','edit');
        }
        elseif($this->type=='Sitesection'){
            $path= $this->getFirstMediaUrl('sections','edit');
        }
        elseif($this->type=='Photo_Gallery'){
            $path= $this->getFirstMediaUrl('gallery','edit');
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
