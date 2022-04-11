<?php

namespace App\Http\Controllers\Supplier;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Sitesection;
use Illuminate\Http\Request;
use App\Models\Supplier_image;
use App\Models\Product_supplier;
use App\Models\Supplier_section;
use App\Http\Controllers\Controller;
use App\Http\Requests\Supplier_Request;

use App\Traits\TableAutoIncreamentTrait;
use App\Http\Interfaces\SupplierInterface;

class SupplierController extends Controller
{
    use TableAutoIncreamentTrait;
    
    protected $xx;
    public function __construct(SupplierInterface $y) {
        $this->xx = $y;
    }
    
    public function index(){
       return  $this->xx->index();
    }
    
// //-------------------------------------------------------------//
    public function create()
    {
        return  $this->xx->create();
    }
// //-------------------------------------------------------------//
    public function store(Supplier_Request $request)
    {
        return  $this->xx->store($request);
    }
// //-------------------------------------------------------------//
    public function edit($id)
    {
        return  $this->xx->edit($id);
    }
// //-------------------------------------------------------------//
    public function update(Supplier_Request $request, $id)
    {
     //dd( $request->all());
      try {
        if($request->supplier_or_sub==0)
        {
          $ttype="supplier";
        }
        else
        {
          $ttype="sub_supplier";
        }
        $validated = $request->validated();
        $Supplier = Supplier::findOrFail($id);
        $Supplier->name_ar = $request->name_ar;
        $Supplier->name_en =  $request->name_en;
        $Supplier-> description_ar= $request->description_ar;
        $Supplier->description_en = $request->description_en;
        $Supplier->parent_id=  $request->supplier_or_sub ;
        $Supplier->type=$ttype;
        $Supplier->sort= $request->sort;
      

        if($request->logo)
        {
        $request->validate(['logo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',]);

        if(file_exists(storage_path().'/app/public/supplier/supplier_no_'.$id.'/'.$request->deleted_image)){
            unlink(storage_path().'/app/public/supplier/supplier_no_'.$id.'/'.$request->deleted_image);
        }
        
        $folder_name='supplier_no_'. $id;
       // $folder_name='';
        // $photo_name= ($request->logo)->getClientOriginalName();
        $photo_name= str_replace(' ', '_',($request->logo)->getClientOriginalName());
        ($request->logo)->storeAs($folder_name,$photo_name,$disk="supplier");
        
        $Supplier->logo = $photo_name;
        }
        $Supplier->save();

          //attach sections with supplier
        if(isset($request->section_id)){
            $Supplier->sup_sections()->sync($request->section_id);
        }else{
            $Supplier->sup_sections()->sync();
        }
      
        return redirect()->route('supplier.index')->with(['success'=>'تم التعديل بنجاح']);
        }
        catch
        (\Exception $e) 
        {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
//-------------------------------------------------------------//
     public function destroy(Request $request ,$id)
    {
         // dd($id);
        
         
         try 
         {
             $check_found_sub=Supplier::where('parent_id',$id)->count();
             
             if($check_found_sub>0){
                $s=Supplier::where('parent_id',$id)->pluck('name_ar');
                return redirect()->route('supplier.index')->with([
                    'error'=>'يوجد موردين فرعيين من هذا المورد .. من فضلك قم بنقلهم الى مورد اخر ثم اعد المحاوله ...',
                    'data'=>$s,
                ]);
            }else{
                
                $undeleted_products_id =  Product::withoutTrashed()->pluck('id');
                $found_product= Product_supplier::where('supplier_id',$id)->whereIn('product_id',$undeleted_products_id)->count();
                
                if($found_product>0){
                    return redirect()->route('supplier.index')->with(['error'=>'يوجد منتجات مرتبطه بهذا المورد .. من فضلك قم بنقلهم الى مورد اخر ثم اعد المحاوله ...']);
                }else{

                    if(file_exists(storage_path().'/app/public/supplier/supplier_no_'.$request->supplier_id.'/'.$request->deleted_image)){
                        unlink(storage_path().'/app/public/supplier/supplier_no_'.$request->supplier_id.'/'.$request->deleted_image);
                    }
                    // $image_path=storage_path().'/app/public/supplier/'.$request->deleted_image;
                    // // dd($id); 
                    // unlink($image_path);

                    //to delete supplier with product in table product_supplier when delete supplier and product is soft deleted
                    $deleted_products_id =  Product::onlyTrashed()->pluck('id');
                    Product_supplier::whereIn('product_id',$deleted_products_id)->where('supplier_id',$id)->delete();
                    
                    Supplier_section::where('supplier_id',$id)->delete();
                    Supplier::find($id)->delete();

                    //call trait to handel aut-increament
                    $this->refreshTable('suppliers');
                    $this->refreshTable('supplier_images');
                    $this->refreshTable('supplier_sections');
          
                    
                    return redirect()->route('supplier.index')->with(['success'=>'تم الحذف بنجاح']);
                }
            }
        }
        catch
        (\Exception $e)
        {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
    //--------------------------------------------------------------------------
    public function show_supplier_image($id)
    {
        //dd($id);
     $Supplier_image= Supplier_image::where('supplier_id',$id)->get();
     return view('pages.supplier.show_supplier_image',compact('Supplier_image','id'));
    }
//     //--------------------------------------------------------------------------
    public function add_supplier_images(Request $request,$id)
    {
        try{
            // dd($request->image);
             if(!empty($request->image)){
                 foreach($request->image as $imagee){
                   //  dd($photo);
                 $folder_namee='supplier_no_'. $id;
                // $folder_namee=""
                     $photo_namee= ($imagee)->getClientOriginalName();
                    // $photo_namee= str_replace(' ', '_',($imagee)->getClientOriginalName());
                    // dd($photo_namee);
                     ($imagee)->storeAs($folder_namee,$photo_namee,$disk="supplier");
                     Supplier_image::create([
                         'supplier_id'=>$id,
                         'image'=>$photo_namee,
                         
                     ]);
                   
                   
                 }
             }
 
             return redirect()->back()->with(['success'=>'تمت الاضافه بنجاح']);
         }catch(\Exception $e){
             return redirect()->back()->with(['error'=>$e->getMessage()]);
         }
    }
//  //--------------------------------------------------------------------------
    public function delete_supplier_images(Request $request ,$id){

        if(file_exists(storage_path().'/app/public/supplier/supplier_no_'.$request->supplier_id.'/'.$request->deleted_image)){
            unlink(storage_path().'/app/public/supplier/supplier_no_'.$request->supplier_id.'/'.$request->deleted_image);
        }
       
        Supplier_image::findOrfail($id)->delete();
        
         //call trait to handel aut-increament
         $this->refreshTable('supplier_images');
         
        return redirect()->back()->with(['success'=>'تم الحذف']);
    }
// //--------------------------------------------------------------------------
    public function deleteAll(Request $request)
    {
        $all_ids = explode(',',$request->delete_all_id);
        $new_ids=array();
        $found=0;

       $undeleted_products_id =  Product::withoutTrashed()->pluck('id');
        foreach($all_ids as $id){

            $check_found_sub=Supplier::where('parent_id',$id)->count();
            if($check_found_sub>0){
                $s=Supplier::where('parent_id',$id)->pluck('name_ar');
                return redirect()->route('supplier.index')->with([
                    'error'=>'يوجد موردين فرعيين من هذا المورد .. من فضلك قم بنقلهم الى مورد اخر ثم اعد المحاوله ...',
                    'data'=>$s
                ]);
            }else{
                $found_product= Product_supplier::where('supplier_id',$id)->whereIn('product_id',$undeleted_products_id)->count();
                if($found_product>0){//supplier related with product
                    $found++;
                }else{
                    array_push($new_ids,$id);//all supplier ids that don't related with products
                }
            }
        }

         
                
        // dd($all_ids);
        foreach($all_ids as $ids){
            if($id=='on'){}else{
                //to delete supplier with product in table product_supplier when delete supplier and product is soft deleted
                $deleted_products_id =  Product::onlyTrashed()->pluck('id');
                Product_supplier::whereIn('product_id',$deleted_products_id)->where('supplier_id',$ids)->delete();
                
                Supplier_section::where('supplier_id',$ids)->delete();
                Supplier::find($ids)->delete();
            }
        }

        //call trait to handel aut-increament
        $this->refreshTable('suppliers');
        $this->refreshTable('supplier_images');
        $this->refreshTable('supplier_sections');
        
        //Supplier::whereIn('id',$all_ids)->delete();
        return redirect()->route('supplier.index')->with(['success'=>'تم حذف الموردين الغير مرتبطين بمنتجات ']);
            
    }
}
