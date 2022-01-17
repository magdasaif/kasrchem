<?php

namespace App\Http\Controllers\Products;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Main_Category;
use App\Models\Product_attachment;

use App\Http\Requests\ProductRequest;

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
        //this is uncomplete old page before using livewire package
         $title='المنتجات';
       // $categories = Main_Category::get();
       $categories= Main_Category::withcount('sub_cate2')->get();
        return view('pages.products.add',compact('categories','title'));
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
            dd($request->photos);
            if(!empty($request->photos)){
                foreach($request->photos as $photo){
                  //  dd($photo);
                    $folder_name0='product_no_'. $request->product_id;
                    // dd($last_id->id,$folder_name);
                    $photo_name0= ($photo)->getClientOriginalName();
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

    public function delete_product_images($image_id){
        Product_attachment::findOrfail($image_id)->delete();
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
                       $file_name= ($ff)->getClientOriginalName();
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
   
       public function delete_products_files($image_id){
           Product_attachment::findOrfail($image_id)->delete();
           return redirect()->back()->with(['success'=>'تم الحذف']);
       }
       // --------------end products files funcrion -----------------------
   
    
    public function store(ProductRequest $request)
    {
        try{
            //vaildation
           $validated = $request->validated();
            
           if($request->image){
                $folder_name='';
                $photo_name= ($request->image)->getClientOriginalName();
                ($request->image)->storeAs($folder_name,$photo_name,$disk="products");
           }else{
               $photo_name='';
           }

            $product =new Product();

            $product->main_cate_id=$request->main_cate_id;

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

            $product->shipped_weight= $request->shipped_weight;
            $product->sort= $request->sort;

            $product->video_link= $request->video_link;

            $product->availabe_or_no= $request->availabe_or_no;
            $product->status= $request->status;

            $product->image= $photo_name;

            $product->save();


            //toastr()->success('تمت الاضافه بنجاح');

            return redirect()->route('products.index')->with(['success'=>'تمت الاضافه بنجاح']);
        }catch(\Exception $e){
            return redirect()->back()->with(['error'=>$e->getMessage()]);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
