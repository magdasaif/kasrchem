<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Supplier_imagesResource;
use App\Models\Supplier;
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
      /*  if($this->parent_id=='0'){
            $is_root=true;
            
            if(count($this->childs)){//child
                $is_leaf=false;
            }else{//leave
                $is_leaf=true;
            }
            
            $description=$supplier_description;
        }else{
            if(count($this->childs)){//child
                $is_root=false;
                $is_leaf=false;
            }else{//leave
                $is_root=false;
                $is_leaf=true;
            }
            $description='';
        }


        if(count($this->childs)){//child
            $lang=$request->header('locale');
             $child_supplier=SupplierResource::collection(Supplier::where('parent_id',$this->id)->get());
             if($lang=='ar'){
                $child_supplier->map(function($ii) { $ii->lang = 'ar'; });
             }else{
                $child_supplier->map(function($ii) { $ii->lang = 'en'; });
             }
        }else{
            $child_supplier='[]';
        }
        */

       //$x= Supplier_imagesResource::collection (Supplier_image::where('supplier_id',$this->id)->get());
       // $path=storage_path().'/app/public/supplier/';
        return [
            // 'lang'=>$lang,
            'id'=>$this->id,
            'name' =>$supplier_name,
           // 'parent_id' =>$this->parent_id,
          //  'is_root'=>$is_root,
           // 'is_leaf'=>$is_leaf,
            'logo' => $this->getFirstMediaUrl('supplier','desktop'),
           // 'images'=> $x,
            'description'=>$supplier_description,
           // 'child' =>$child_supplier,
        ];
    }
}
