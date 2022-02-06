<?php

namespace App\Http\Controllers\Products;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Main_Category;
use App\Models\Product_attachment;
use App\Models\Product_Feature;

use App\Http\Requests\ProductRequest;

use Illuminate\Support\Facades\Storage;

//to using beginTransaction
use Illuminate\Support\Facades\DB;

//use Illuminate\Support\Facades\Schema;

class ProductController extends Controller
{
    public function index()
    {
         $title='المنتجات';
        $products = Product::all();
        return view('pages.products.show',compact('products','title'));
    }

    public function create()
    {
        // $categories = Main_Category::get();
         $title='اضافه منتج';
         $categories= Main_Category::withcount('sub_cate2')->get();
        // return $categories;
        return view('pages.products.add',compact('categories','title'));
    }


    public function store(ProductRequest $request)
    {
        //to handel multiple insertion
        DB::beginTransaction();
        
       // dd('add');
        try{
            //vaildation
           $validated = $request->validated();

           $request->validate(['image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',]);
           if($request->image){
                $last_id = Product::orderBy('id', 'desc')->first();
                if($last_id){
                    $new_id = $last_id->id + 1;
                }else{
                    $new_id=1;
                }
                $folder_name='product_no_'. $new_id;
                // dd($last_id->id,$folder_name);
                $photo_name= str_replace(' ', '_',($request->image)->getClientOriginalName());
                ($request->image)->storeAs($folder_name,$photo_name,$disk="products");
           }else{
               $photo_name='';
           }
            $product =new Product();

            $product->main_cate_id=$request->main_cate_id;
            $product->sub2_id=$request->sub2;
            $product->sub3_id=$request->sub3;
            $product->sub4_id=$request->sub4;

            $product->code=$request->code;

            $product->name_ar=$request->name_ar;
            $product->name_en=$request->name_en;

            $product->desc_ar=$request->desc_ar;
            $product->desc_en=$request->desc_en;

            $product->price= $request->price;
            $product->tax= $request->tax;
            $product->offer_price= $request->offer_price;

            $product->amount= $request->amount;
            $product->min_amount= $request->min_amount;
            $product->max_amount= $request->max_amount;

            $product->sell_through= $request->sell_through;
            $product->shipped_weight= $request->shipped_weight;
            $product->sort= $request->sort;

            $product->video_link= $request->video_link;

            $product->availabe_or_no= $request->availabe_or_no;
            $product->status= $request->status;

            $product->image= $photo_name;

            if($request->security_permit=='on'){
                $product->security_permit=1;
            }else{
                $product->security_permit=0;
            }
            
            $product->save();

            if(!empty($request->photos)){
                foreach($request->photos as $photo){

                    $folder_name0='product_no_'. $new_id;
                    // dd($last_id->id,$folder_name);
                     $photo_name0= str_replace(' ', '_',($photo)->getClientOriginalName());
                    ($photo)->storeAs($folder_name0,$photo_name0,$disk="products");

                    Product_attachment::create([
                        'path'=>$photo_name0,
                        'type'=>'image',
                        'product_id'=>Product::latest()->first()->id
                    ]);
                }
            }

            if(!empty($request->product_files)){
                foreach($request->product_files as $file){

                    $folder_name0='product_no_'. $new_id;
                    // dd($last_id->id,$folder_name);
                     $file_name0= str_replace(' ', '_',($file)->getClientOriginalName());
                    ($file)->storeAs($folder_name0,$file_name0,$disk="products");

                    Product_attachment::create([
                        'path'=>$file_name0,
                        'type'=>'file',
                        'product_id'=>Product::latest()->first()->id
                    ]);
                }
            }
            $List_Classes=$request->List_Classes;
            foreach ($List_Classes as $list) {
                Product_Feature::create([
                    'weight_ar' => $list['weight_ar'],
                    'weight_en' => $list['weight_en'],
                    'value_ar' => $list['value_ar'],
                    'value_en' => $list['value_en'],
                    'product_id'=>Product::latest()->first()->id
                ]);
            }

            DB::commit();
            //toastr()->success('تمت الاضافه بنجاح');

            return redirect()->route('products.index')->with(['success'=>'تمت الاضافه بنجاح']);
        }catch(\Exception $e){
            
            DB::rollback();
         //   dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

         //   return redirect()->back()->with(['error'=>$e->getMessage()]);
        }
    }
    // --------------start products images funcrion -----------------------
    public function products_images($product_id)
    {
       // return 'pppp '.$product_id;
          $title='صور المنتجات';

          //where('product_id',$product_id)->

         //$Product_images = \DB::table('products_attachments')->where('product_id', '=', $product_id)->where('type', '=', 'image')->get();

         //$Product_images = Product_attachment::where('product_id', '=', $product_id)->where('type', '=', 'image')->get();

         $Product_images = Product_attachment::where([
            ['product_id', '=', $product_id],
            ['type', '=', 'image'],
        ])->get();

      //  dd($Product_images);
         return view('pages.products.images',compact('Product_images','product_id','title'));
    }
    public function add_product_images(Request $request,$product_id){
        try{
           // dd($request->photos);
            if(!empty($request->photos)){
                foreach($request->photos as $photo){
                  //  dd($photo);
                    $folder_name0='product_no_'. $request->product_id;
                    // dd($last_id->id,$folder_name);
                    $photo_name0= str_replace(' ', '_',($photo)->getClientOriginalName());
                    ($photo)->storeAs($folder_name0,$photo_name0,$disk="products");

                    Product_attachment::create([
                        'path'=>$photo_name0,
                        'type'=>'image',
                        'product_id'=>$request->product_id
                    ]);
                }
            }

            return redirect()->back()->with(['success'=>'تمت الاضافه بنجاح']);
        }catch(\Exception $e){
            return redirect()->back()->with(['error'=>$e->getMessage()]);
        }
    }
    //public function delete_product_images($image_id){
    public function delete_product_images(Request $request){

        $image_path=storage_path().'/app/public/products/product_no_'.$request->product_id.'/'.$request->image_name;
        unlink($image_path);
      //  Storage::disk('products')->delete('products/product_no_'.$request->product_id.'/'.$request->image_name);
        Product_attachment::findOrfail($request->image_id)->delete();
        return redirect()->back()->with(['success'=>'تم الحذف']);
    }
    // --------------end products images funcrion -----------------------


       // --------------start products files funcrion -----------------------
       public function products_files($product_id)
       {
         //  return 'pppp '.$product_id;
             $title='ملفات المنتجات';


         //$Product_files = \DB::table('products_attachments')->where('product_id', '=', $product_id)->where('type', '=', 'file')->get();

         //$Product_files = Product_attachment::where('product_id', '=', $product_id)->where('type', '=', 'file')->get();


            $Product_files = Product_attachment::where([
               ['product_id', '=', $product_id],
               ['type', '=', 'file'],
           ])->get();

          // dd($Product_files);
            return view('pages.products.files',compact('Product_files','product_id','title'));
       }
       public function add_products_files(Request $request,$product_id){
           try{
            // dd($request->ffff);
               if(!empty($request->ffff)){
                   foreach($request->ffff as $ff){
                     //  dd($ff,($ff)->getClientOriginalName());

                       $folder_name='product_no_'. $request->product_id;
                       $file_name= str_replace(' ', '_',($ff)->getClientOriginalName());
                       ($ff)->storeAs($folder_name,$file_name,$disk="products");

                    //    Storage::putFileAs(
                    //     'avatars', $request->file('avatar'), $request->user()->id
                  //  );

                      // dd($file_name,$request->product_id);
                       Product_attachment::create([
                           'path'=>$file_name,
                           'type'=>'file',
                           'product_id'=>$request->product_id
                       ]);

                   }
               }

               return redirect()->back()->with(['success'=>'تمت الاضافه بنجاح']);
           }catch(\Exception $e){
               return redirect()->back()->with(['error'=>$e->getMessage()]);
           }

       }
      // public function delete_products_files($image_id){
       public function delete_products_files(Request $request){

        $image_path=storage_path().'/app/public/products/product_no_'.$request->product_id.'/'.$request->file_name;
        unlink($image_path);
           Product_attachment::findOrfail($request->file_id)->delete();
           return redirect()->back()->with(['success'=>'تم الحذف']);
       }
       // --------------end products files funcrion -----------------------
       
    public function edit($id)
    {
         $title='تعديل المنتج';

         $product = Product::findOrfail($id);
         $categories= Main_Category::withcount('sub_cate2')->get();
         $features = Product_Feature::where('product_id','=',$id)->get();

         $feature_count = Product_Feature::where('product_id','=',$id)->count();
         //dd($product);
        return view('pages.products.edit',compact('product','categories','title','features','feature_count'));
    }

    //ProductRequest
    public function update(ProductRequest $request)
    {
      //  dd($request->all);
        if(($request->add_as_new)=='on'){
            return $this->store($request);
        }else{
           // dd('edit');
            try{
                //vaildation
            $validated = $request->validated();

            $product =Product::findOrfail($request->id);

            if($request->image){
                $request->validate(['image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',]);

                    $folder_name='product_no_'. $request->id;
                    $photo_name= str_replace(' ', '_',($request->image)->getClientOriginalName());
                    ($request->image)->storeAs($folder_name,$photo_name,$disk="products");
                    $product->image= $photo_name;
            }


                $product->main_cate_id=$request->main_cate_id;
                $product->sub2_id=$request->sub2;
                $product->sub3_id=$request->sub3;
                $product->sub4_id=$request->sub4;

                $product->code=$request->code;

                $product->name_ar=$request->name_ar;
                $product->name_en=$request->name_en;

                $product->desc_ar=$request->desc_ar;
                $product->desc_en=$request->desc_en;

                $product->price= $request->price;
                $product->tax= $request->tax;
                $product->offer_price= $request->offer_price;

                $product->amount= $request->amount;
                $product->min_amount= $request->min_amount;
                $product->max_amount= $request->max_amount;

                $product->sell_through= $request->sell_through;
                $product->shipped_weight= $request->shipped_weight;
                $product->sort= $request->sort;

                $product->video_link= $request->video_link;

                $product->availabe_or_no= $request->availabe_or_no;
                $product->status= $request->status;

                if($request->security_permit=='on'){
                    $product->security_permit=1;
                }else{
                    $product->security_permit=0;
                }

                $product->save();

                $List_Classes=$request->List_Classes;
                if(isset($List_Classes)){
                    Product_Feature::where('product_id',$request->id) ->delete();
                    foreach ($List_Classes as $list) {
                        Product_Feature::create([
                            'weight_ar' => $list['weight_ar'],
                            'weight_en' => $list['weight_en'],
                            'value_ar' => $list['value_ar'],
                            'value_en' => $list['value_en'],
                            'product_id'=>$request->id
                        ]);
                    }
                }
               // toastr()->success('تمت التعديل بنجاح');
                 return redirect()->route('products.index')->with(['success'=>'تمت التعديل بنجاح']);
            }catch(\Exception $e){
               // dd($e->getMessage());
               //toastr()->danger('حدث خطا');
               return redirect()->back()->withErrors(['error' => $e->getMessage()]);

            //    return redirect()->back()->with(['error'=>$e->getMessage()]);
            }
        }
    }

    public function destroy($id)
    {
        //
    }
}
