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
        if($this->parent_id=='0'){
            $is_root=true;
            $is_child=false;
            $is_leave=false;
        }else{
            if(count($this->childs)){//child
                $is_root=false;
                $is_child=true;
                $is_leave=false;
            }else{//leave
                $is_root=false;
                $is_child=false;
                $is_leave=true;
            }
        }
       $x= Supplier_imagesResource::collection (Supplier_image::where('supplier_id',$this->id)->get());
        $path=storage_path().'/app/public/supplier/';
        return [
            'id'=>$this->id,
            'name' =>$supplier_name,
            'parent_id' =>$this->parent_id,
            'is_root'=>$is_root,
            'is_child'=>$is_child,
            'is_leave'=>$is_leave,
           // 'logo' => $path.$this->logo,
            'logo' => asset('storage/supplier/' . $this->logo),
            'images'=> $x,
            'description'=>$supplier_description,
        ];
    }
}
