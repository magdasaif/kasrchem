<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;
class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $path=storage_path().'/app/public/products/product_no_'.$this->id.'/';

        $type = $this->when( property_exists($this,'type'), function() { return $this->type; } );
        if($type=='first_fun'){ //all products
            return [
                'id' =>$this->id,
                // 'name' =>$this->name,
                'name' =>preg_replace("/\r\n|\r|\n/", '<br/>', $this->name),
                'description' => $this->desc,
                'link' => $this->link,
                'image' => $this->getFirstMediaUrl('product'),
            ];
        }else{
        
       
            
            $images = Product::find($this->id)->getMedia('sub_product');
            $new_images=array();
            foreach($images as $ii){
                $selected=[
                   'id'=>$ii->id,
                   'image'=> $ii->getUrl()
                ];
            array_push($new_images,$selected);
            }

            $files = Product::find($this->id)->subFiles();
            $new_files=array();
            foreach($files as $fi){
                $selected=[
                    'id'=>$fi->id,
                   // 'file'=>$path.$fi->path,
                   'file'=> asset('storage/products/product_no_'.$this->id.'/' . $fi->filename),
                ];
            array_push($new_files,$selected);
            }


            return [

                'id' =>$this->id,
                'name' =>preg_replace("/\r\n|\r|\n/", '<br/>', $this->name),
                'image' => $this->getFirstMediaUrl('product'),
                'description' => $this->desc,
                'video_link' => $this->video_link,
                'link' => $this->link,

                'gallery'=>$new_images,
                'product_attachments'=>$new_files,

            ];
        //  return parent::toArray($request);
        }
    }
}