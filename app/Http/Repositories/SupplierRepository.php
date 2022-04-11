<?php

namespace App\Http\Repositories;

use App\Models\Image;
use App\Models\Supplier;
use App\Traits\ImageTrait;
use App\Models\Sitesection;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Traits\TableAutoIncreamentTrait;
use App\Http\Interfaces\SupplierInterface;

class SupplierRepository implements SupplierInterface
{
    use TableAutoIncreamentTrait;
    use ImageTrait;
     //******************************get all suppliers data*****************************/
    public function index(){
        $data['title']='الموردين';
        $data['suppliers']=Supplier::withoutTrashed()->orderBy('sort','asc')->paginate(10);
        return view('pages.supplier.Show',$data);
    } 
    //******************************show supplier add form*****************************/
    public function create(){
        $data['title']       ='اضافه مورد';
        $data['sections']    = Sitesection::whereNull('parent_id')->where('visible', '!=' , 0)->get();
        $data['suppliers']   = Supplier::withoutTrashed()->whereNull('parent_id')->get();
        // $data['suppliers']   = Supplier::where('parent_id', '=', 0)->get();
       return view('pages.supplier.add',$data);
    }
     //******************************store supplier in DB *****************************/
    public function store($request){
        DB::beginTransaction();
       
        try{
           //call trait to handel aut-increament
           $this->refreshTable('suppliers');

              $Supplier = new Supplier
             ([
              'name_ar' =>  $request->name_ar,
              'name_en' =>  $request->name_en,
              'description_ar' =>  $request->description_ar,
              'description_en' =>  $request->description_en,
              'parent_id'=>  ($request->supplier_or_sub!='0')?$request->supplier_or_sub :'',
              'sort'=>  $request->sort,
              'status'=>  $request->status,
             ]);
            $Supplier->save();
            $Supplier->sup_sections()->attach($request->section_id);

            if($request->image){
                //get last id of supplier to create folder named with this id +1
                //$this->getTableLastId('Supplier')
             
                // handel image array to pass image data to trait function
                 $imageData=[
                     'image_name'    => $request->image,
                     'folder_name'   => 'supplier_no_'. $Supplier->id,
                     'disk_name'     => 'supplier',
                 ];
                 
                //call to storeImage fun to save image in disk and return back with photo name
                $photo_name=$this->storeImage($imageData);

                //optimize image
                $Supplier->addMedia($request->image)->toMediaCollection('supplier');
                 
            }else{
                $photo_name='';
            }
            
             //start morph image for product main image
             $image =new Image();
             $image->imageable_type='App\Models\Supplier';
             $image->imageable_id=$Supplier->id;
             $image->image_or_file='1';//image
             $image->main_or_sub='1'; //main image
             $image->filename=$photo_name;
             $image->save();

             
          if(!empty($request->photos)){
           foreach($request->photos as $photo){

                // handel image array to pass image data to trait function
                $imageData=[
                    'image_name'    => $photo,
                    'folder_name'   => 'product_no_'. $Supplier->id,
                    'disk_name'     => 'products',
                ];
                
                //call to storeImage fun to save image in disk and return back with photo name
                $photo_name2=$this->storeImage($imageData);
        
                //start morph image for product sub images
                Image::create([
                    'imageable_type'=>'App\Models\Supplier',
                    'imageable_id'=>$Supplier->id,
                    'image_or_file'=>'1',//image
                    'main_or_sub'=>'2', //sub image
                    'filename'=>$photo_name2
                ]);
           }
       }

       DB::commit();
          if ($request->supplier_model==1)
          {
             //return redirect()->route('video.create')->with(['success'=>'تمت اضافة التصنيف الفرعى بنجاح']);
             return redirect()->back()->with(
                 [
                    'success'=>'تمت اضافة المورد بنجاح',
                    'supplier_id'  => $Supplier->id,
                 ]
             );
            
          }else{
            toastr()->success('تمت الاضافه بنجاح');
            return redirect()->route('supplier.index')->with(['success'=>'تمت الاضافه بنجاح']);
          }
       }
       catch(\Exception $e){
           DB::rollback();
           toastr()->error('حدث خطا اثناء الاضافه');
           return redirect()->back()->withErrors(['error'=>'حدث خطا اثناء الاضافه']);
       }
    }

    //******************************show edit form *****************************/
    public function edit($id){
        
        $real_id=decrypt($id);

        $data['title']           ='تعديل مورد';
        $data['Supplier']       = Supplier::findOrfail($real_id);  //data of edited supplier
        $data['all_suppliers']  = Supplier::withoutTrashed()->whereNull('parent_id')->where('id','!=',$real_id)->get();
        $data['all_sections']   = Sitesection::whereNull('parent_id')->where('visible', '!=' , 0)->get();

        return view('pages.supplier.edit',$data);
    }
    public function update($request){

    }
    public function destroy($id){

    }
    public function bulkDelete($request){

    }

    public function yajra_data($request){

    }
}
?>
