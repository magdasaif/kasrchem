<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\sub_categoriesResource;
class main_categoryResource extends JsonResource
{
    // private $lang;
    // public function __construct($JsonResource, $lang)
    // {
    //     // Ensure you call the parent constructor
    //     parent::__construct($JsonResource);
    //     $this->JsonResource = $JsonResource;
        
    //     $this->lang = $lang;
    // }
    //-------------------------------------------------------//
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
        $x= sub_categoriesResource::collection ($this->sub_cate2);
        if($lang=='ar'){
             $x->map(function($i) { $i->lang = 'ar'; });
         }else{
             $x->map(function($i) { $i->lang = 'en'; });
         }
       return 
       [
           'id'=>$this->id,
            'name'=>$subname,
           'image'=>$this->image,
           //'sub_categories'=> response($x,200,['OK']),
            'sub_categories'=>   $x,
            //'types'=>$this->sub_cate3,
         
       
       ] ;
      
      
    }
}
