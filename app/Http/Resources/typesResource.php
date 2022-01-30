<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\sub_typesResource;
class typesResource extends JsonResource
{
    
    public function toArray($request)
    {
        // return parent::toArray($request);
        $lang = $this->when( property_exists($this,'lang'), function() { return $this->lang; } );
        if($lang=='ar')
         {
              $subname= $this->subname_ar;
         }
        else
        {
            $subname= $this->subname_en;
        }
        
        $x= sub_typesResource::collection ($this->relation_sub3_with_sub4);
         if($lang=='ar')
        {
              $x->map(function($i) { $i->lang = 'ar'; });
        }
          else
        {
            $x->map(function($i) { $i->lang = 'en'; });
        }
       return 
       [
           'id'=>$this->id,
           'name'=>$subname,
           'image'=>$this->image,
           'sub_types'=>  $x,
       ] ;
      
    }
}
