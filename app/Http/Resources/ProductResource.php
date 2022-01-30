<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\Main_Category;
use App\Models\Sub_Category2;
use App\Models\Sub_Category3;
use App\Models\Sub_Category4;

use App\Models\Product_Feature;
use App\Models\Product_attachment;

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
        if($type=='first_fun'){
            return [
                'id' =>$this->id,
                'name' =>$this->name,
                'price' =>$this->price,
                'offer_price' =>$this->offer_price,
                'min' =>$this->min_amount,
                'max' =>$this->max_amount,
                'stock' =>$this->amount,
                'security_clearance' =>$this->security_permit,
                'image' => $path.$this->image,
            ];
        }else{
        
            if($this->sell_through==1){$x='both';}
            elseif($this->sell_through==2){$x='online';}
            elseif($this->sell_through==3){$x='branches';}


        // $lang= $this->lang;
            $lang = $this->when( property_exists($this,'lang'), function() { return $this->lang; } );
            if($lang=='ar'){
                $selected="subname_ar as name";
                $selected2="subname2_ar as name";
                $selected3="subname_ar as name";

                $selected4="weight_ar as key";
                $selected5="value_ar as value";

            }else{
                $selected="subname_en as name";
                $selected2="subname2_en as name";
                $selected3="subname_en as name";

                $selected4="weight_en as key";
                $selected5="value_en as value";
            }
            
            $main_cate_id = Main_Category::select('id', $selected)->findOrfail($this->main_cate_id);
            $sub2_id = Sub_Category2::select('id', $selected2)->findOrfail($this->sub2_id);
            $sub3_id = Sub_Category3::select('id', $selected3)->findOrfail($this->sub3_id);
            $sub4_id = Sub_Category4::select('id', $selected3)->findOrfail($this->sub4_id);

            $ff = Product_Feature::select('id', $selected4,$selected5)->where('product_id',$this->id)->get();
            $new=array();
            foreach($ff as $f){
                $selected=[
                    'id'=>$f->id,
                    'key'=>$f->key,
                    'value'=>$f->value,
                ];
            array_push($new,$selected);
            }

            $images = Product_attachment::where('product_id',$this->id)->where('type','image')->get();
            $new_images=array();
            foreach($images as $ii){
                $selected=[
                    'id'=>$ii->id,
                    'image'=>$path.$ii->path,
                ];
            array_push($new_images,$selected);
            }

            $files = Product_attachment::where('product_id',$this->id)->where('type','file')->get();
            $new_files=array();
            foreach($files as $fi){
                $selected=[
                    'id'=>$fi->id,
                    'file'=>$path.$fi->path,
                ];
            array_push($new_files,$selected);
            }


            return [

                'lang' => $this->when( property_exists($this,'lang'), function() { return $this->lang; } ),
    //'lang'=>$this->lang,
                'id' =>$this->id,
                'name' =>$this->name,
                'price' =>$this->price,
                'offer_price' =>$this->offer_price,
                'min' =>$this->min_amount,
                'max' =>$this->max_amount,
                'stock' =>$this->amount,
                'security_clearance' =>$this->security_permit,

            //   "image": "https://backend.eradco.murabba.dev/storage/products/product1/product1636788975.png",

                'image' => $path.$this->image,

                'description' => $this->desc,
                
                'video_link' => $this->video_link,

                'selling_at'=> $x,

                'category' => [
                    'id'=>$main_cate_id->id,
                    'name'=>$main_cate_id->name,
                ],

                'subCategory' => [
                    'id'=>$sub2_id->id,
                    'name'=> $sub2_id->name,
                ],
                'type' => [
                    'id'=>$sub3_id->id,
                    'name'=> $sub3_id->name,
                ],
                'subType' => [
                    'id'=>$sub4_id->id,
                    'name'=> $sub4_id->name,
                ],

                //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!foreach
            // 'properties'=>$ff,
                'properties'=>$new,

                'gallery'=>$new_images,
                'product_attachments'=>$new_files,

            ];
        //  return parent::toArray($request);
        }
    }
}