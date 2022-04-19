<?php

namespace App\Http\Repositories;
use App\Models\Partner;
use App\Traits\ImageTrait;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Traits\TableAutoIncreamentTrait;
use App\Http\Interfaces\PartnerInterface;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Traits\MediaTrait;
class PartnerRepository implements PartnerInterface{

    use TableAutoIncreamentTrait,ImageTrait,MediaTrait;
    
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
                //optimize image
                $partner->addMedia($request->image)->toMediaCollection('partner');

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
            return redirect()->route('partner.index')->with(['success'=>'تم التعديل بنجاح']);
        }catch(\Exception $e){
            DB::rollback();
            toastr()->error('حدث خطا اثناء التعديل');
            return redirect()->back()->withErrors(['error'=>'حدث خطا اثناء التعديل']);
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
