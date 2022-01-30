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
        $x= typesResource::collection ($this->sub_cate3);
        if($lang=='ar'){
             $x->map(function($i) { $i->lang = 'ar'; });
         }else{
             $x->map(function($i) { $i->lang = 'en'; });
         }
       return 
       [
           'id'=>$this->id,
           'name'=>$subname,
           'image'=>$this->image2,
           'types'=> $x,
           //'types'=> typesResource::collection ($this->sub_cate3),
       
       ] ;
      
    }
}
