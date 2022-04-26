<?php

namespace App\Http\Repositories;


use App\Models\Supplier;
use App\Traits\ImageTrait;
use Illuminate\Support\Facades\DB;
use App\Traits\TableAutoIncreamentTrait;
use App\Http\Interfaces\SupplierInterface;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Traits\MediaTrait;
class SupplierRepository implements SupplierInterface
{
    use TableAutoIncreamentTrait,ImageTrait,MediaTrait;  
    //----------------------------------------------------------
    public function index()
    {
        $data['title']  ='الموردين ';
        $data['suppliers']=Supplier::withoutTrashed()->orderBy('sort','asc')->paginate(10);
         return view('pages.new_supplier.show',$data);
    }
 //-----------------------------------------------------------------------------//
 function search($request)
     {
        if($request->ajax())
        {
            $data['title']  ='الموردين';
            $search_text = $request->get('query');
            $data['searching']="search";
            $data['suppliers']=Supplier::withoutTrashed()
            ->where('name_ar','LIKE','%'.$search_text.'%')
            ->orWhere('name_en', 'like', '%'.$search_text.'%')
            ->orWhere('description_ar', 'like', '%'.$search_text.'%')
            ->orWhere('description_en', 'like', '%'.$search_text.'%')
            ->paginate(10);
           return view('pages.new_supplier.paginate_new_supplier',$data)->render();   
        }
     }
     //-----------------------------------------------
    public function create()
    {
        $data['title']='اضافه مورد';
        return view('pages.new_supplier.add',$data);
    }
    //-----------------------------------------------
    public function store($request)
    {
        DB::beginTransaction();
        try{           
            //call trait to handel aut-increament
             $this->refreshTable('suppliers');
    
             $supplier =new Supplier();

             $supplier->name_ar=$request->name_ar;
             $supplier->name_en=$request->name_en;
             $supplier->sort= $request->sort;
             $supplier->status= $request->status;
             $supplier->description_ar= $request->description_ar;
             $supplier->description_en= $request->description_en;
             $supplier->save();
             
           if($request->image){
               //optimize image
               $supplier->addMedia($request->image)->toMediaCollection('supplier');
            }

            DB::commit();
            toastr()->success('تمت الاضافه بنجاح');
            return redirect()->route('new_supplier.index')->with(['success'=>'تمت الاضافه بنجاح']);
        }catch(\Exception $e){
            DB::rollback();
            toastr()->error('حدث خطا اثناء الاضافه');
            return redirect()->back()->withErrors(['error'=>'حدث خطا اثناء الاضافه']);
           // return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }
    }
    //-----------------------------------------------
    public function edit($id){
        $real_id=decrypt($id);
        //dd($real_id);
        $data['supplier']=Supplier::findOrfail($real_id);
        $data['title']='تعديل المورد';
         return view('pages.new_supplier.edit',$data);
    }
    //-----------------------------------------------
    public function update($request){
        DB::beginTransaction();
        try{
            $real_id=decrypt($request->id);
            
            $supplier=Supplier::findOrfail($real_id);
            $supplier->name_ar=$request->name_ar;
            $supplier->name_en=$request->name_en;
            $supplier->sort= $request->sort;
            $supplier->status= $request->status;
            $supplier->description_ar= $request->description_ar;
             $supplier->description_en= $request->description_en;
            $supplier->save();


            if($request->image){
                //optimize image
                $supplier->addMedia($request->image)->toMediaCollection('supplier');

                if(isset($request->media_url)){
                    //remove  folder from disk //remove old media
                    Media::find($this->get_media_id($request->media_url))->delete(); // this will also remove folder from disk
                    // rmdir(storage_path().'/app/public/media/'.$request->media_id);

                    //call trait to handel aut-increament
                    $this->refreshTable('media');
                }
             }

            //toastr()->success('تمت الاضافه بنجاح');
            DB::commit();
            toastr()->success('تم التعديل بنجاح');
            return redirect()->route('new_supplier.index')->with(['success'=>'تم التعديل بنجاح']);
        }catch(\Exception $e){
            DB::rollback();
            toastr()->error('حدث خطا اثناء التعديل');
            return redirect()->back()->withErrors(['error'=>'حدث خطا اثناء التعديل']);
        }
    }
    //-------------------------------------------------------
    public function destroy($id){
        $real_id=decrypt($id);
        Supplier::findOrfail($real_id)->delete();
        //call trait to handel aut-increament
        $this->refreshTable('suppliers');
        toastr()->error('تم الحذف');
        return redirect()->route('new_supplier.index')->with(['success'=>'تم الحذف ']);

    }
    //-----------------------------------------------
    public function bulkDelete($request){

        $all_ids = explode(',',$request->delete_all_id);
        // dd($all_ids);
        Supplier::whereIn('id',$all_ids)->delete();
     
         //call trait to handel aut-increament
         $this->refreshTable('suppliers');
         
         toastr()->error('تم الحذف');
         return redirect()->route('new_supplier.index')->with(['success'=>'تم الحذف ']);
     }
//-----------------------------------------------
    public function yajra_data($request)
    {

     }
}
?>

