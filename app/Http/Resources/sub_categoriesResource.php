<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\typesResource;
class sub_categoriesResource extends JsonResource
{
    
    public function toArray($request)
    {
       // return parent::toArray($request);
       $lang = $this->when( property_exists($this,'lang'), function() { return $this->lang; } );
       if($lang=='ar')
        {
             $subname= $this->subname2_ar;
        }
       else
        {
            $subname= $this->subname2_en;
        }
       return 
       [
           'id'=>$this->id,
           //'name'=>$this->subname2_ar,
           'name'=>$subname,
           'image'=>$this->image2,
           //'types'=>$this->sub_cate3,
           'types'=> typesResource::collection ($this->sub_cate3),
       
       ] ;
      
    }
}
