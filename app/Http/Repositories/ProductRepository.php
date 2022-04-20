<?php

namespace App\Http\Repositories;

use toastr;
use App\Models\Image;
use App\Models\Product;

use App\Models\Supplier;

use App\Traits\ImageTrait;

use App\Models\Sitesection;

use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Traits\TableAutoIncreamentTrait;
use App\Http\Interfaces\ProductInterface;


class ProductRepository implements ProductInterface{

    use TableAutoIncreamentTrait;
    use ImageTrait;

    //******************************get all products data*****************************/
    public function index(){
        $data['title']      ='المنتجات';
        // $data['products']   = Product::withoutTrashed()->orderBy('sort','asc')->get();
        $data['products']   = Product::withoutTrashed()->orderBy('sort','asc')->paginate(1);
       return view('pages.products.show',$data);
    }
   //*********************************************************************************/
function search($request)
{
   // dd($request->all());
    $title='المنتجات';
    $search_text = $request->query_text;
   //  $search_text = $_GET['query_text'];
    //dd($search_text);
     $searching_result=Product::withoutTrashed()->where('name_ar','LIKE','%'.$search_text.'%')->paginate(1);
    return view('pages.products.show',compact('searching_result','title'));

}
   //******************************show product add form*****************************/
    public function create(){
        $data['title']       ='اضافه منتج';
        $data['suppliers']   = Supplier::withoutTrashed()->whereNull('parent_id')->get();
        $data['sections']   = Sitesection::where('visible', '!=' , 0)->whereNull('parent_id')->get();
        //-++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//
       return view('pages.products.add',$data);
    }

    //******************************store product data in db*****************************/
    public function store($request){
       //to handel multiple insertion
        DB::beginTransaction();
        try{
            //vaildation
           //$validated = $request->validated();

            //call trait to handel aut-increament
            $this->refreshTable('products');
    
            $product =new Product();

            $product->name_ar=$request->name_ar;
            $product->name_en=$request->name_en;
            $product->description_ar=$request->description_ar;
            $product->description_en=$request->description_en;
            $product->sort= $request->sort;
            $product->status= $request->status;
            (isset($request->video_link))? $product->video_link= $request->video_link:$product->video_link='' ;
            (isset($request->link))? $product->link= $request->link:$product->link='' ;
            $product->save();
            
            $product->rel_section()->attach($request->site_id,['type' => 'products']);

            //attach products with supplier
            // $product->suppliers()->attach($request->supplier_id);

            if($request->image){
                //get last id of product to create folder named with this id +1
                //$this->getTableLastId('Product')
             
                // handel image array to pass image data to trait function
                 $imageData=[
                     'image_name'    => $request->image,
                     'folder_name'   => 'product_no_'. $product->id,
                     'disk_name'     => 'products',
                     'model'         =>$product,
                 ];
                 
                //call to storeImage fun to save image in disk and return back with photo name
                $photo_name=$this->storeImage($imageData);

                 //start morph image for product main image
                $image =new Image();
                $image->imageable_type='App\Models\Product';
                $image->imageable_id=$product->id;
                $image->image_or_file='1';//image
                $image->main_or_sub='1'; //main image
                $image->filename=$photo_name;
                $image->save();
             
                //optimize image
                $product->addMedia($request->image)->toMediaCollection('product');
                 
            }
            
            

             
            if(!empty($request->photos)){
                foreach($request->photos as $photo){
                    // handel image array to pass image data to trait function
                    $imageData=[
                        'image_name'    => $photo,
                        'folder_name'   => 'product_no_'. $product->id,
                        'disk_name'     => 'products',
                        'model'         =>$product,
                    ];
                    
                    //call to storeImage fun to save image in disk and return back with photo name
                    $photo_name2=$this->storeImage($imageData);
                    $product->addMedia($photo)->toMediaCollection('sub_product');

                     //start morph image for product sub images
                    Image::create([
                        'imageable_type'=>'App\Models\Product',
                        'imageable_id'=>$product->id,
                        'image_or_file'=>'1',//image
                        'main_or_sub'=>'2', //sub image
                        'filename'=>$photo_name2
                    ]);
                }
            }

            if(!empty($request->product_files)){
                foreach($request->product_files as $file){

                     // handel image array to pass image data to trait function
                     $imageData=[
                        'file_name'    => $file,
                        'folder_name'   => 'product_no_'. $product->id,
                        'disk_name'     => 'products',
                    ];
                    //call to storeImage fun to save image in disk and return back with photo name
                    $file_name=$this->storeFile($imageData);
                                
                    //start morph image for product sub images
                    Image::create([
                    'imageable_type'=>'App\Models\Product',
                    'imageable_id'=>$product->id,
                    'image_or_file'=>'2',//file
                    'main_or_sub'=>'2', //sub image
                    'filename'=>$file_name
                    ]);

                    
                }
            }

            DB::commit();
             toastr()->success('تمت الاضافه بنجاح');
             return redirect()->route('products.index')->with(['success'=>'تمت الاضافه بنجاح']);
            //  return redirect()->route('products.index')->with(['success'=>'تمت الاضافه بنجاح']);

        }catch(\Exception $e){

            DB::rollback();
            toastr()->error('حدث خطا اثناء الاضافه');
            return redirect()->back()->withErrors(['error'=>'حدث خطا اثناء الاضافه']);
        }
    }
//******************************start product images  ******************************/
    //------------------------show images--------------------------------------//
    public function products_images($product_id)
    {
       //decrypt product_id which is encryptrd
        $real_id=decrypt($product_id);

        //retreive all products images &files(main&sub)
        //  Product::find($product_id)->images();

        $data['title']='صور المنتجات';
        $data['product_id']=$real_id;
        
        //subImages() is a scope function in product model
       // $data['Product_images'] = Product::find($real_id)->subImages();
        
      $data['Product_images']= Product::find($real_id)->getMedia('sub_product');//'sub_product','thumb'
     

        return view('pages.products.images',$data);
    }
    //------------------------add images-----------------------------------------//
    public function add_product_images($request,$product_id){
         //dd($request->all());
        try{
                //decrypt product_id which is encryptrd
                $real_id=decrypt($product_id);
                $product=Product::findOrfail($real_id);
              //  dd($real_id);
                if(!empty($request->photos)){
                    foreach($request->photos as $photo){
                        // handel image array to pass image data to trait function
                        $imageData=[
                            'image_name'    => $photo,
                            'folder_name'   => 'product_no_'. $real_id,
                            'disk_name'     => 'products',
                        ];
                        
                        //call to storeImage fun to save image in disk and return back with photo name
                        $photo_name=$this->storeImage($imageData);

                        //start morph image for product sub images
                        Image::create([
                            'imageable_type'=>'App\Models\Product',
                            'imageable_id'=>$real_id,
                            'image_or_file'=>'1',//image
                            'main_or_sub'=>'2', //sub image
                            'filename'=>$photo_name
                        ]);

                        //optimize image
                        $product->addMedia($request->image)->toMediaCollection('sub_product');
                        //$product->copy($product, 'new-collection', 'products');
                    }
                }

                toastr()->success('تمت الاضافه بنجاح');
                return redirect()->back()->with(['success'=>'تمت الاضافه بنجاح']);
               //  return redirect()->route('products.index')->with(['success'=>'تمت الاضافه بنجاح']);
   
           }catch(\Exception $e){
            // dd('eee');
               toastr()->error('حدث خطا اثناء الاضافه');
               return redirect()->back()->with(['error'=>'حدث خطا اثناء الاضافه']);
   
            //   return redirect()->back()->with(['error'=>$e->getMessage()]);
           }
    }
    //------------------------delete images--------------------------------------//
    public function delete_product_images($request){

        try{
            // handel image array to pass image path to trait function
            $imageData=[
                'path'=>storage_path().'/app/public/products/product_no_'.$request->product_id.'/'.$request->image_name,
            ];

            //call to unLinkImage fun to delete image from disk 
            $this->unLinkImage($imageData);
            Image::findOrfail($request->image_id)->delete();

            //call trait to handel aut-increament
            $this->refreshTable('images');
            
            toastr()->success('تم الحذف بنجاح');
            return redirect()->back()->with(['success'=>'تم الحذف']);
        }catch(\Exception $e){
            toastr()->error('حدث خطا اثناء الحذف');
            return redirect()->back()->with(['error'=>'حدث خطا اثناء الحذف']);
        }
    }
//******************************end product images  ******************************/

//******************************start product files  *****************************/

    public function products_files($product_id)
    {
        //decrypt product_id which is encryptrd
        $real_id=decrypt($product_id);

        $data['title']='ملفات المنتجات';
        $data['product_id']=$real_id;
        
        //subFiles() is a scope function in product model that returen all sub files for this product
        $data['Product_files'] = Product::find($real_id)->subFiles();

        return view('pages.products.files',$data);
    }
      //------------------------add images-----------------------------------------//
      public function add_products_files($request,$product_id){
        //dd($request->all());
       try{
               //decrypt product_id which is encryptrd
               $real_id=decrypt($product_id);

             //  dd($real_id);
             if(!empty($request->product_files)){
                foreach($request->product_files as $file){
                       // handel image array to pass image data to trait function
                       $imageData=[
                           'file_name'    => $file,
                           'folder_name'   => 'product_no_'. $real_id,
                           'disk_name'     => 'products',
                       ];
                       
                       //call to storeFile fun to save file in disk and return back with file name
                       $file_name=$this->storeFile($imageData);

                       //start morph image for product sub images
                       Image::create([
                           'imageable_type'=>'App\Models\Product',
                           'imageable_id'=>$real_id,
                           'image_or_file'=>'2',//file
                           'main_or_sub'=>'2', //sub file
                           'filename'=>$file_name
                       ]);
                   }
               }

               toastr()->success('تمت الاضافه بنجاح');
               return redirect()->back()->with(['success'=>'تمت الاضافه بنجاح']);
              //  return redirect()->route('products.index')->with(['success'=>'تمت الاضافه بنجاح']);
  
          }catch(\Exception $e){
           // dd('eee');
              toastr()->error('حدث خطا اثناء الاضافه');
              return redirect()->back()->with(['error'=>'حدث خطا اثناء الاضافه']);
  
           //   return redirect()->back()->with(['error'=>$e->getMessage()]);
          }
   }
   //------------------------delete images--------------------------------------//
   public function delete_products_files($request){

       try{
           // handel image array to pass file path to trait function
           $imageData=[
               'path'=>storage_path().'/app/public/products/product_no_'.$request->product_id.'/'.$request->file_name,
           ];

           //call to unLinkImage fun to delete image from disk 
           $this->unLinkImage($imageData);
           Image::findOrfail($request->file_id)->delete();

           //call trait to handel aut-increament
           $this->refreshTable('images');
           
           toastr()->success('تم الحذف بنجاح');
           return redirect()->back()->with(['success'=>'تم الحذف']);
       }catch(\Exception $e){
           toastr()->error('حدث خطا اثناء الحذف');
           return redirect()->back()->with(['error'=>'حدث خطا اثناء الحذف']);
       }
   }

//******************************end product files  *****************************/

    //******************************show product edit form *****************************/
    public function edit($id){
        $real_id=decrypt($id);
        $data['title']      ='تعديل منتج';
        $data['product']    = Product::findOrfail($real_id);
        $data['suppliers']  = Supplier::withoutTrashed()->whereNull('parent_id')->get();
        $data['sections']   = Sitesection::where('visible', '!=' , 0)->whereNull('parent_id')->get();

        //-----------------------------------//
        return view('pages.products.edit',$data);
    }
    
    //******************************update product data in db*****************************/
    public function update($request) {
        
        //dd($request->all());
           if(($request->add_as_new)=='on'){
               return $this->store($request);
           }else{

                //to handel multiple insertion
                DB::beginTransaction();
        
               try{
                
                $real_id=decrypt($request->id);
                $product =Product::findOrfail($real_id);
                $product->name_ar=$request->name_ar;
                $product->name_en=$request->name_en;

                $product->description_ar=$request->description_ar;
                $product->description_en=$request->description_en;
                $product->sort= $request->sort;

                (isset($request->video_link))? $product->video_link= $request->video_link:'';
                (isset($request->link))? $product->link= $request->link:'' ;

                $product->status= $request->status;

                $product->save();
                   
                if($request->image){
                    if($request->deleted_image){
                      //  dd('1');
                        // handel image array to pass image path to trait function
                        $imageData=[
                            'path'=>storage_path().'/app/public/products/product_no_'.$real_id.'/'.$request->deleted_image,
                        ];
                        //call to unLinkImage fun to delete old image from disk 
                        $this->unLinkImage($imageData);
                    }
                    // handel image array to pass image data to trait function
                    $imageData=[
                        'image_name'    => $request->image,
                        'folder_name'   => 'product_no_'. $real_id,
                        'disk_name'     => 'products',
                        'model'         =>  $product,
                    ];
                    //call to storeImage fun to save image in disk and return back with photo name
                    $photo_name=$this->storeImage($imageData);

                    //optimize image
                    $product->addMedia($request->image)->toMediaCollection('product');
                        
                    //start morph image for product sub images
                    $img=Image::find($request->image_id);

                    if($img){

                        $img->filename=$photo_name;
                        $img->save();

                   }else{
                            //start morph image for product main image
                        $image =new Image();
                        $image->imageable_type='App\Models\Product';
                        $image->imageable_id=$product->id;
                        $image->image_or_file='1';//image
                        $image->main_or_sub='1'; //main image
                        $image->filename=$photo_name;
                        $image->save();
                         
                     }
                  
                    // dd('2');

                     //optimize image
                      //  $product->addMedia($request->image)->toMediaCollection('media');
                
                    //$product->mainImages()->filename=$photo_name;////////هنا عايزاه يعدل ع الصوره الاساسيه بس 
                    
                }
            
                   
   
                   //attach products with supplier
                //    if(isset($request->supplier_id)){
                //          $product->suppliers()->sync($request->supplier_id);
                //    }else{
                //        $product->suppliers()->sync();
                //    }
                
                   if(isset($request->site_id)){
                         $product->rel_section()->sync($request->site_id);
                   }else{
                       $product->rel_section()->sync();
                   }

                    DB::commit();
                    toastr()->success('تمت التعديل بنجاح');
                    return redirect()->route('products.index')->with(['success'=>'تمت التعديل بنجاح']);
               }catch(\Exception $e){
                  DB::rollBack();
                  // dd($e->getMessage());
                  toastr()->error(' حدث خطااثناء التعديل');
                  return redirect()->back()->withErrors(['error' => ' حدث خطااثناء التعديل']);
   
               }
           }
       }

    //******************************softdelete single product*****************************/
    public function destroy($id){
        try{
            $real_id=decrypt($id);
            Product::where('id',$real_id)->delete(); //soft_delete
            //Product::where('id',$id)->forceDelete();//hard delete
            toastr()->success('تم الحذف بنجاح');
            return redirect()->route('products.index')->with(['success'=>'تم الحذف بنجاح']);
        }catch(\Exception $e){
            toastr()->error('حدث خطا اثناء الحذف');
            return redirect()->back();
        }
    }

    //******************************softdelete selected product*****************************/
    public function bulkDelete($request){
        try{
            $all_ids = explode(',',$request->delete_all_id);
            // dd($all_ids);
            Product::whereIn('id',$all_ids)->delete();
            toastr()->success('تم الحذف بنجاح');
            return redirect()->route('products.index')->with(['success'=>'تم الحذف بنجاح']);
        }catch(\Exception $e){
            toastr()->error('حدث خطا اثناء الحذف');
            return redirect()->back();
        }
    }

    public function yajra_data($request){
        // dd("ffff");
        //if ($request->ajax()) {
        //  $data  = Product::withoutTrashed()->orderBy('id','DESC')->get();

     /*   
         $data  = Product::orderBy('id','DESC')->get();
     
             return Datatables::of($data)
                 ->addColumn('record_select',function (Product $products) {
                     return view('pages.product_new.data_table.record_select', compact('products'));
                 })
     
     
                 ->editColumn('status', function (Product $products) {
                     if($products->status=='1'){
                         // return '<i class="fas fa-check green"></i>';
                         return 'مفعل';
                     }else{
                        // return '<i class="fas fa-times red"></i>';
                        return ' غير مفعل';
                     }
                 })
                 
                 ->addColumn('media',function (Product $products) {
                        return '-';
                    })
                 ->addColumn('actions',function (Product $products) {
                        return view('pages.product_new.data_table.actions', compact('products'));
                    })
                    ->rawColumns(['record_select','media','actions'])
                    ->toJson();
*/
                    
                 //"DT_RowIndex": 1
           //  }
             // }else
             // {
             //     dd("ssssssssss");
             // }
             
        
     
     }
     
    
    // public function yajra_data(){
                
    //     //get all Products data
    //     $products = Product::withoutTrashed()->orderBy('id','DESC')->get();
    //     //use datatables (yajra) to handel this data
    //     return DataTables::of($products)
    //         ->addColumn('record_select',function (Product $products) {
    //             return view('pages.product_new.data_table.record_select', compact('products'));
    //         })
    //         ->editColumn('status', function (Product $products) {
    //             if($products->status=='1'){
    //                 return '<i class="fas fa-check green"></i>';
    //             }else{
    //                 return '<i class="fas fa-times red"></i>';
    //             }
    //         })
    //         // ->addColumn('image', function (Product $products) {
    //         //     return view('dashboard.admin.products.data_table.image', compact('products'));
    //         // })
    //         ->addColumn('actions',function (Product $products) {
    //             return view('pages.product_new.data_table.actions', compact('products'));
    //         })
    //         ->rawColumns(['record_select','actions'])
    //         ->toJson();
    // }

    
}
?>
