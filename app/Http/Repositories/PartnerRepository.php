<?php

namespace App\Http\Repositories;

use App\Models\Image;
use App\Models\Partner;
use App\Traits\ImageTrait;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Traits\TableAutoIncreamentTrait;
use App\Http\Interfaces\PartnerInterface;

class PartnerRepository implements PartnerInterface{

    use TableAutoIncreamentTrait,ImageTrait;
    
    public function index(){
        $data['title']  ='الشركاء';
        $data['partners']=Partner::withoutTrashed()->orderBy('sort','asc')->paginate(10);
         return view('pages.partners.show',$data);
    }

    public function create(){
        $data['title']='اضافه شريك';
        return view('pages.partners.add',$data);
    }
    public function store($request){
        DB::beginTransaction();
        try{           
            //call trait to handel aut-increament
             $this->refreshTable('partners');
    
             $partner =new Partner();

             $partner->name_ar=$request->name_ar;
             $partner->name_en=$request->name_en;
             $partner->sort= $request->sort;
             $partner->status= $request->status;
             $partner->external_link= $request->external_link;
 
             $partner->save();
             
           if($request->image){
                // handel image array to pass image data to trait function
                $imageData=[
                    'image_name'    => $request->image,
                    'folder_name'   => '',
                    'disk_name'     => 'partners',
                ];
                
                //call to storeImage fun to save image in disk and return back with photo name
                $photo_name=$this->storeImage($imageData);

                 //start morph image for product main imagحe
                $image =new Image();
                $image->imageable_type='App\Models\Partner';
                $image->imageable_id=$partner->id;
                $image->image_or_file='1';//image
                $image->main_or_sub='1'; //main image
                $image->filename=$photo_name;
                $image->save();
             
                //optimize image
                $partner->addMedia($request->image)->toMediaCollection('partner');
            }

            

             DB::commit();
            toastr()->success('تمت الاضافه بنجاح');
            return redirect()->route('partner.index')->with(['success'=>'تمت الاضافه بنجاح']);
        }catch(\Exception $e){
            DB::rollback();
            toastr()->error('حدث خطا اثناء الاضافه');
            return redirect()->back()->withErrors(['error'=>'حدث خطا اثناء الاضافه']);
           // return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }
    }
    
    public function edit($id){
        $real_id=decrypt($id);
        $data['partner']=Partner::findOrfail($real_id);
        $data['title']='تعديل شريك';
         return view('pages.partners.edit',$data);
    }
    
    public function update($request){
        DB::beginTransaction();
        try{
            $real_id=decrypt($request->id);
            
            $partner=Partner::findOrfail($real_id);
            $partner->name_ar=$request->name_ar;
            $partner->name_en=$request->name_en;
            $partner->sort= $request->sort;
            $partner->status= $request->status;
            $partner->external_link= $request->external_link;
            $partner->save();
            
           if($request->image){
                // handel image array to pass image data to trait function
                $imageData=[
                    'image_name'    => $request->image,
                    'folder_name'   => '',
                    'disk_name'     => 'partners',
                ];
                //call to storeImage fun to save image in disk and return back with photo name
                $photo_name=$this->storeImage($imageData);

                //optimize image
                $partner->addMedia($request->image)->toMediaCollection('partner');
                    
                //start morph image for product sub images
                $img=Image::find($request->image_id);

                if($img){ // if there are image stored before-->update it

                    $img->filename=$photo_name;
                    $img->save();
                    
                }else{// if there are no image stored before-->add it
                    
                        //start morph image for product main image
                        $image =new Image();
                        $image->imageable_type='App\Models\Partner';
                        $image->imageable_id=$partner->id;
                        $image->image_or_file='1';//image
                        $image->main_or_sub='1'; //main image
                        $image->filename=$photo_name;
                        $image->save();
                    
                }
                
                if($request->deleted_image){
                    //  dd('1');
                    // handel image array to pass image path to trait function
                    $imageData=[
                        'path'=>storage_path().'/app/public/partners/'.$request->deleted_image,
                    ];
                    //call to unLinkImage fun to delete old image from disk 
                    $this->unLinkImage($imageData);
                }
             }


            //toastr()->success('تمت الاضافه بنجاح');
            DB::commit();
            toastr()->success('تم التعديل بنجاح');
            return redirect()->route('partner.index')->with(['success'=>'تم التعديل بنجاح']);
        }catch(\Exception $e){
            DB::rollback();
            toastr()->error('حدث خطا اثناء الاضافه');
            return redirect()->back()->withErrors(['error'=>'حدث خطا اثناء الاضافه']);
        }
    }
    //-------------------------------------------------------
    public function destroy($id){
        $real_id=decrypt($id);
        Partner::findOrfail($real_id)->delete();
        //call trait to handel aut-increament
        $this->refreshTable('partners');
        toastr()->error('تم الحذف');
        return redirect()->route('partner.index')->with(['success'=>'تم الحذف ']);

    }
    public function bulkDelete($request){

        $all_ids = explode(',',$request->delete_all_id);
        // dd($all_ids);
        Partner::whereIn('id',$all_ids)->delete();
     
         //call trait to handel aut-increament
         $this->refreshTable('partners');
         
         toastr()->error('تم الحذف');
         return redirect()->route('partner.index')->with(['success'=>'تم الحذف ']);
     }

    public function yajra_data($request){

        //if ($request->ajax()) {
         $data  = Partner::orderBy('id','DESC')->get();
        // dd($data);
        return Datatables::of($data)
            ->addColumn('record_select',function (Partner $partner) {
                return view('pages.partners.data_table.record_select', compact('partner'));
            })
            ->addColumn('actions',function (Partner $partner) {
                return view('pages.partners.data_table.actions', compact('partner'));
            })
            ->rawColumns(['record_select','actions'])
            ->make(true);
            // ->toJson();
       // }else{return'fffffffff';}
     }
}
?>
