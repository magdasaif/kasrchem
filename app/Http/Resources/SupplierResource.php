<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Supplier_imagesResource;
use App\Models\Supplier_image;
class SupplierResource extends JsonResource
{
   
    public function toArray($request)
    {
        $lang = $this->when( property_exists($this,'lang'), function() { return $this->lang; } );
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

       $x= Supplier_imagesResource::collection (Supplier_image::where('supplier_id',$this->id)->get());
        $path=storage_path().'/app/public/supplier/';
        return [
            'id'=>$this->id,
            'name' =>$supplier_name,
           // 'logo' => $path.$this->logo,
            'logo' => asset('storage/app/public/supplier/' . $this->logo),
            'images'=> $x,
            
            
             
        ];
    }
}
