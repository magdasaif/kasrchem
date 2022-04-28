<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


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
                'link' =>$this->link,
                'image' => $this->getFirstMediaUrl('product'),
            ];
       
        //  return parent::toArray($request);
       
    }
}