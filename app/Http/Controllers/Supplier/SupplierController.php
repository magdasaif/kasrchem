<?php

namespace App\Http\Controllers\Supplier;
use App\Http\Controllers\Controller;
use App\Models\Supplier;
use App\Models\Supplier_image;
use App\Models\Product_supplier;
use App\Http\Requests\Supplier_Request;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    // public $fillable = ['name_ar','name_en','logo','description_ar','description_en'];
  
    public function index()
    {
        $Supplier=Supplier::orderBy('id','desc')->get();
        return view('pages.supplier.Show',compact('Supplier'));
    }
// //-------------------------------------------------------------//
    public function create()
    {
      //   $suppliers=Supplier::get();
      $suppliers= Supplier::where('parent_id', '=', 0)->get();
        return view('pages.supplier.add',compact('suppliers'));
    }
// //-------------------------------------------------------------//
    public function store(Supplier_Request $request)
    {
        // dd($request->all());
         try{
            $validated = $request->validated();
             $request->validate(['logo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',]);
              if($request->logo)
              {
                 $folder_name='';
                //  $photo_name= ($request->logo)->getClientOriginalName();
                $photo_name= str_replace(' ', '_',($request->logo)->getClientOriginalName());
                  ($request->logo)->storeAs($folder_name,$photo_name,$disk="supplier");
                  
              }
               

              //-----------------------------------//
              if($request->supplier_or_sub==0)
              {
                $ttype="supplier";
              }
              else
              {
                $ttype="sub_supplier";
              }
               $Supplier = new Supplier
              ([
               'name_ar' =>  $request->name_ar,
               'name_en' =>  $request->name_en,
               'description_ar' =>  $request->description_ar,
               'description_en' =>  $request->description_en,
               'parent_id'=>  $request->supplier_or_sub ,
               'type'=> $ttype,
               'logo' => $photo_name,
              ]);
             // dd('done');

           $Supplier->save();
           if ($request->supplier_model==1)
           {
              //return redirect()->route('video.create')->with(['success'=>'تمت اضافة التصنيف الفرعى بنجاح']);
              return redirect()->back()->with(
                  [
                     'success'=>'تمت اضافة المورد بنجاح',
                     'section_id'   =>$request->section_id,
                     'cate_id'      =>$request->cate_id,
                     'sub2_id'      => $request->sub2_id,
                     'sub3_id'      => $request->sub3_id,
                     'sub4_id'      => $request->sub4_id,
                     'supplier_id'  => $Supplier->id,
                  ]
              );
             
           }else{
               return redirect()->route('supplier.index')->with(['success'=>'تمت الاضافه بنجاح']);
           }
        }
        catch(\Exception $e){
            return redirect()->back()->with(['error'=>$e->getMessage()]);
        }
    }
// //-------------------------------------------------------------//
    public function edit($id)
    {
       
        $Supplier = Supplier::findOrfail($id);
        if($Supplier->parent_id==0)
        {$first_select=0; $parent_of_supplier='';}
        else
        {$first_select=''; $parent_of_supplier = Supplier::findOrfail($Supplier->parent_id);}
       
        $all_suppliers =Supplier::where('parent_id', '=', 0)->get();
        //dd( $suppliers);
     //  dd($parent_of_supplier);
        if(!$parent_of_supplier){$first_select=0;}else{$first_select='';}
        //$parent_of_supplier=Supplier::where('id','=',$id)->get();
        // dd( $parent_of_supplier);
        return view('pages.supplier.edit',compact('Supplier','parent_of_supplier','first_select','all_suppliers'));
    }
// //-------------------------------------------------------------//
    public function update(Supplier_Request $request, $id)
    {
    //   dd( $request->all());
      try {

        $validated = $request->validated();
        $Supplier = Supplier::findOrFail($id);
          $Supplier->name_ar = $request->name_ar;
         $Supplier->name_en =  $request->name_en;
        $Supplier-> description_ar= $request->description_ar;
        $Supplier->description_en = $request->description_en;
      

        if($request->logo)
        {
        $request->validate(['logo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',]);
        $folder_name='';
        // $photo_name= ($request->logo)->getClientOriginalName();
        $photo_name= str_replace(' ', '_',($request->logo)->getClientOriginalName());
        ($request->logo)->storeAs($folder_name,$photo_name,$disk="supplier");
        
        $Supplier->logo = $photo_name;
        }
        $Supplier->save();
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
            $found_product= Product_supplier::where('supplier_id',$id)->count();
            if($found_product>0){
                return redirect()->route('supplier.index')->with(['error'=>'يوجد منتجات مرتبطه بهذا المورد .. من فضلك قم بنقلهم الى مورد اخر ثم اعد المحاوله ...']);
            }else{
                $image_path=storage_path().'/app/public/supplier/'.$request->deleted_image;
                // dd($id); 
                unlink($image_path);
            
                $Supplier=Supplier::find($id);  
                $Supplier->delete(); 
                return redirect()->route('supplier.index')->with(['success'=>'تم الحذف بنجاح']);
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
                 $folder_namee='supplier_images_no_'. $id;
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
      
        $image_path=storage_path().'/app/public/supplier/supplier_images_no_'.$request->supplier_id.'/'.$request->deleted_image;
        unlink($image_path);
        Supplier_image::findOrfail($id)->delete();
        return redirect()->back()->with(['success'=>'تم الحذف']);
    }
// //--------------------------------------------------------------------------
    public function deleteAll(Request $request)
    {
        $all_ids = explode(',',$request->delete_all_id);
        $new_ids=array();
        $found=0;

        foreach($all_ids as $id){
            $found_product= Product_supplier::where('supplier_id',$id)->count();
            if($found_product>0){//supplier related with product
                $found++;
            }else{
                array_push($new_ids,$id);//all supplier ids that don't related with products
            }
        }
        
                
        // dd($all_ids);
        Supplier::whereIn('id',$new_ids)->delete();
        return redirect()->route('supplier.index')->with(['success'=>'تم حذف الموردين الغير مرتبطين بمنتجات ']);
            
    }
}
