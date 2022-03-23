<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\Main_Category;
use App\Models\Sub_Category2;
use App\Models\Sub_Category3;
use App\Models\Sub_Category4;

use App\Models\Product_Feature;
use App\Models\Product_attachment;

class LatestProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
       // $path=storage_path().'/app/public/products/product_no_'.$this->id.'/';

        $type = $this->when( property_exists($this,'type'), function() { return $this->type; } );
        
            return [
                'id' =>$this->id,
                'name' =>preg_replace("/\r\n|\r|\n/", '<br/>', $this->name),
                'description' => $this->desc,
                'price' =>$this->price,
                'offer_price' =>$this->offer_price,
                'min' =>$this->min_amount,
                'max' =>$this->max_amount,
                'stock' =>$this->amount,
                'security_clearance' =>$this->security_permit,
                'link' =>$this->link,
               // 'image' => $path.$this->image,
                'image' => asset('storage/products/product_no_'.$this->id.'/' . $this->image),
            ];
       
        //  return parent::toArray($request);
       
    }
}