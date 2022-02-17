<?php

namespace App\Http\Controllers\Supplier;
use App\Http\Controllers\Controller;
use App\Models\Supplier;
use App\Models\Supplier_image;
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
        return view('pages.supplier.add');
    }
// //-------------------------------------------------------------//
    public function store(Supplier_Request $request)
    {
         //dd($request->all());
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
               $Supplier = new Supplier
              ([
               'name_ar' =>  $request->name_ar,
               'name_en' =>  $request->name_en,
               'description_ar' =>  $request->description_ar,
               'description_en' =>  $request->description_en,
               
               'logo' =>$photo_name,
              ]);
           $Supplier->save();

           if ($request->supplier_model==1)
           {
              //return redirect()->route('video.create')->with(['success'=>'تمت اضافة التصنيف الفرعى بنجاح']);
              return redirect()->back()->with(
                  [
                     'success'=>'تمت اضافة التصنيف الفرعى بنجاح',
                     'section_id'   =>$request->section_id,
                     'cate_id'      =>$request->cate_id,
                     'sub2_id'      => $request->sub2_id,
                     'sub3_id'      => $request->sub3_id,
                     'sub4_id'      => $request->id,
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
       
        return view('pages.supplier.edit',compact('Supplier'));
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

         $image_path=storage_path().'/app/public/supplier/'.$request->deleted_image;
        // dd($id); 
         unlink($image_path);
         try 
         {
         $Supplier=Supplier::find($id);  
         $Supplier->delete(); 
         return redirect()->route('supplier.index')->with(['success'=>'تم الحذف بنجاح']);
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
   
}
