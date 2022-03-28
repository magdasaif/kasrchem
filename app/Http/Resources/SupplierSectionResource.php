<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Supplier;
class SupplierSectionResource extends JsonResource
{
   
    public function toArray($request)
    {
        $lang = $this->when( property_exists($this,'lang'), function() { return $this->lang; } );
       // $type = $this->when( property_exists($this,'type'), function() { return $this->type; } );
        if($lang=='ar')
        {
             $name= $this->site_name_ar;
        }
       else
        {
            $name= $this->site_name_en;
        }
        
            $all=Supplier::select('*','suppliers.id as id')
                            ->join('supplier_sections', 'supplier_sections.supplier_id', '=', 'suppliers.id')
                            ->where('supplier_sections.sitesection_id',$this->section_id)
                            ->where('suppliers.parent_id',0)
                            ->get();

             $supplier=SupplierResource2::collection($all);
             if($lang=='ar'){
                $supplier->map(function($ii) { $ii->lang = 'ar'; });
             }else{
                $supplier->map(function($ii) { $ii->lang = 'en'; });
             }
       
        return [
            'id'=>$this->section_id,
            // 'name' =>$name,
            'name' =>preg_replace("/\r\n|\r|\n/", '<br/>', $name),
            'supplier' =>$supplier,
        ];
    }
}
