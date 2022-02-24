<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SearchResource extends JsonResource
{

    public function toArray($request)
    {
        if($this->type=='Product'){
           $path= asset('storage/products/product_no_'.$this->id.'/' . $this->image);
        }
        elseif($this->type=='Article'){
            $path= asset('storage/article/'. $this->image);
        }
        elseif($this->type=='Release'){
            $path= asset('storage/release/release_'.$this->id.'/'. $this->image);
        }
        elseif($this->type=='Main_Category'){
            $path= asset('storage/categories/first/'. $this->image);
        }
        elseif($this->type=='Partner'){
            $path= asset('storage/partners/'. $this->image);
        }
        elseif($this->type=='Sitesection'){
            $path= asset('storage/site_sections/site_section_image/'. $this->image);
        }
        elseif($this->type=='Sub_Category2'){
            $path= asset('storage/categories/first/'. $this->image);
        }
        elseif($this->type=='Sub_Category3'){
            $path= asset('storage/categories/second/'. $this->image);
        }
        elseif($this->type=='Supplier'){
            $path= asset('storage/supplier/'. $this->logo);
        }
        elseif($this->type=='Photo_Gallery'){
            $path= asset('storage/photo_gallery/gallery_photo_images_no_'.$this->id.'/'. $this->image);
        }
        elseif($this->type=='Video'){
            $path=  $this->link;
        }
            return [
                'id'=>$this->id,
                'name' =>$this->name,
                'source' =>$path,
                'type' =>$this->type,
            ];
       
    }

}
