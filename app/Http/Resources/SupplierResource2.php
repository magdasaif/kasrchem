<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Supplier_imagesResource;
use App\Models\Supplier;
use App\Models\Supplier_image;
class SupplierResource2 extends JsonResource
{
   
    public function toArray($request)
    {
        $lang = $this->when( property_exists($this,'lang'), function() { return $this->lang; } );
       // $type = $this->when( property_exists($this,'type'), function() { return $this->type; } );
        if($lang=='ar')
        {
             $supplier_name= $this->name_ar;
             $supplier_description=$this->description_ar;
        }
       else
        {
            $supplier_name= $this->name_en;
            $supplier_description=$this->description_en;
        }
      
            
         $description=$supplier_description;
       

        
       $x= Supplier_imagesResource::collection (Supplier_image::where('supplier_id',$this->id)->get());
        $path=storage_path().'/app/public/supplier/';
        return [
            // 'lang'=>$lang,
            'id'=>$this->id,
            'name' =>$supplier_name,
            'logo' => asset('storage/supplier/supplier_no_'.$this->id.'/'. $this->logo),
            'images'=> $x,
            'description'=>$description,
        ];
    }
}
