<?php

namespace App\Http\Livewire;
use Livewire\Component;

use Livewire\WithFileUploads;

use App\Models\Main_Category;
use App\Models\Product;
use App\Models\Product_attachment;
use App\Models\Product_Feature;

use App\Models\Sub_Category2;
use App\Models\Sub_Category3;
use App\Models\Sub_Category4;


class Productlivewire extends Component
{
    use WithFileUploads;

    public $message,$main_cate_id,$sub2,$sub3,$sub4,
            $code,$name_ar,$name_en,
            $desc_ar,$desc_en,$price,$tax=0,$offer_price=0,
            $amount=1,$min_amount=1,$max_amount=1,$image,
            $video_link,$sell_through=1,$shipped_weight=0,
            $sort=0,$status=1,$availabe_or_no=1,$photos,$files,
            $weight_ar,$weight_en,$value_ar,$value_en,$List_Classes;


    public $inputs = [];
    public $i = 1;

    //public $output;

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName,[

            'main_cate_id' => 'required',
            'sub2' => 'required',
            'sub3' => 'required',
            'sub4' => 'required',
            'code'=>'required|unique:products',
            'name_ar'=>'required|unique:products',
            'name_en'=>'required|unique:products',
            'price'=>'required',
            'desc_ar'=>'required',
            'desc_en'=>'required',
            'amount'=>'required|integer',
            'min_amount'=>'required|integer',
            'max_amount'=>'required|integer',
            'sort'=>'integer',
            'image'=>'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'shipped_weight'=>'required',

            'weight_ar.0' => 'required',
            'value_ar.0' => 'required',
            'weight_en.0' => 'required',
            'value_en.0' => 'required',

            'weight_ar.*' => 'required',
            'value_ar.*' => 'required',
            'weight_en.*' => 'required',
            'value_en.*' => 'required',

        ]);
    }

    protected $rules = [
        //exists:main_categories,id
        'main_cate_id' => 'required',
        'sub2' => 'required',
        'sub3' => 'required',
        'sub4' => 'required',
        'code'=>'required|unique:products',
        'name_ar'=>'required|unique:products',
        'name_en'=>'required|unique:products',
        'price'=>'required',
        'desc_ar'=>'required',
        'desc_en'=>'required',
        'amount'=>'required',
        'amount'=>'required|integer',
        'min_amount'=>'required|integer',
        'max_amount'=>'required|integer',
        'sort'=>'integer',
        'image'=>'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        'shipped_weight'=>'required',

        'weight_ar.0' => 'required',
        'value_ar.0' => 'required',
        'weight_en.0' => 'required',
        'value_en.0' => 'required',

        'weight_ar.*' => 'required',
        'value_ar.*' => 'required',
        'weight_en.*' => 'required',
        'value_en.*' => 'required',
    ];



    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->inputs ,$i);
    }

    public function remove($i)
    {
        unset($this->inputs[$i]);
    }

    private function resetInputFields(){
        $this->weight_ar = '';
        $this->weight_en = '';
        $this->value_ar = '';
        $this->value_en = '';
    }
  
    public function render()
    {
        //get first cate_id to make it as default value for select category in blade
        $first_main_id = Main_Category::orderBy('id', 'desc')->first();
        if($first_main_id){
            $this->main_cate_id =$first_main_id->id;
        }else{
            $this->main_cate_id=1;
        }
        //dd(Main_Category::withcount('sub_cate2')->get());
        return view('livewire.productlivewire',[
            'categories' =>Main_Category::withcount('sub_cate2')->get(),
        ]);
    }

    public function store_product()
    {

        if($this->main_cate_id==null){dd('يُرجى اختيار تصنيف !');}
      //  dd($this->main_cate_id,$this->status,$this->availabe_or_no,$this->sell_through);

       // $this->output= $this->name_ar;
       //  return view('livewire.show');
         try{
            //vaildation
            $this->validate();

           if($this->image){

                $last_id = Product::orderBy('id', 'desc')->first();
                if($last_id){
                    $new_id = $last_id->id + 1;
                }else{
                    $new_id=1;
                }
                $folder_name='product_no_'. $new_id;
                // dd($last_id->id,$folder_name);

                $photo_name= ($this->image)->getClientOriginalName();
                ($this->image)->storeAs($folder_name,$photo_name,$disk="products");
           }else{
               $photo_name='';
           }

            $product =new Product();

            $product->main_cate_id=$this->main_cate_id;

            $product->code=$this->code;

            $product->name_ar=$this->name_ar;
            $product->name_en=$this->name_en;

            $product->desc_ar=$this->desc_ar;
            $product->desc_en=$this->desc_en;

            $product->price= $this->price;
            $product->tax= $this->tax;
            $product->offer_price= $this->offer_price;

            $product->amount= $this->amount;
            $product->min_amount= $this->min_amount;
            $product->max_amount= $this->max_amount;

            $product->sell_through= $this->sell_through;
            $product->shipped_weight= $this->shipped_weight;
            $product->sort= $this->sort;

            $product->video_link= $this->video_link;

            $product->availabe_or_no= $this->availabe_or_no;
            $product->status= $this->status;

            $product->image= $photo_name;

            $product->save();

            if(!empty($this->photos)){
                foreach($this->photos as $photo){

                    $folder_name0='product_no_'. $new_id;
                    // dd($last_id->id,$folder_name);
                     $photo_name0= ($photo)->getClientOriginalName();
                    ($photo)->storeAs($folder_name0,$photo_name0,$disk="products");

                    Product_attachment::create([
                        'path'=>$photo_name0,
                        'type'=>'image',
                        'product_id'=>Product::latest()->first()->id
                    ]);
                }
            }

            if(!empty($this->files)){
                foreach($this->files as $file){

                    $folder_name0='product_no_'. $new_id;
                    // dd($last_id->id,$folder_name);
                     $file_name0= ($file)->getClientOriginalName();
                    ($file)->storeAs($folder_name0,$file_name0,$disk="products");

                    Product_attachment::create([
                        'path'=>$file_name0,
                        'type'=>'file',
                        'product_id'=>Product::latest()->first()->id
                    ]);
                }
            }

          //  dd($this->weight_ar);
            foreach ($this->weight_ar as $key => $value) {
                Product_Feature::create([
                    'weight_ar' => $this->weight_ar[$key],
                    'weight_en' => $this->weight_en[$key],
                    'value_ar' => $this->value_ar[$key],
                    'value_en' => $this->value_en[$key],
                    'product_id'=>Product::latest()->first()->id
                ]);
            }

            $this->inputs = [];

            $this->resetInputFields();


            //toastr()->success('تمت الاضافه بنجاح');

            return redirect()->route('products.index')->with(['success'=>'تمت الاضافه بنجاح']);
        }catch(\Exception $e){
            return redirect()->back()->with(['error'=>$e->getMessage()]);
        }


    }
}
