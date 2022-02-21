<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\sub_categoriesResource;
class main_categoryResource extends JsonResource
{
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
        if($lang=='ar')
         {
             $x->map(function($i) { $i->lang = 'ar'; });
         }
        else
         {
             $x->map(function($i) { $i->lang = 'en'; });
          }

          $path=storage_path().'/app/public/categories/first/';

          return 
          [
               'id'=>$this->id,
               'name'=>$subname,
              // 'image'=>$path.$this->image,
               'image'=>asset('storage/categories/first/' . $this->image),
               'sub_categories'=>   $x,
          ] ;
        }
}
