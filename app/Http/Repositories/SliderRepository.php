<?php

namespace App\Http\Repositories;

use App\Models\Image;
use App\Models\Slider;
use App\Traits\ImageTrait;
use App\Traits\MediaTrait;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Interfaces\SliderInterface;
use App\Traits\TableAutoIncreamentTrait;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class SliderRepository implements SliderInterface{

    use TableAutoIncreamentTrait,ImageTrait,MediaTrait;

    //-----------------------------------------------------------------------------------
    public function index(){
        $data['title']  ='الصور المتحركه';
        $data['Slider']=Slider::withoutTrashed()->orderBy('sort','asc')->paginate(10);
        return view('pages.slider.show',$data);
    }
    //-----------------------------------------------------------------------------------
    public function create(){
        $data['title']='اضافه صفحه';
        return view('pages.slider.add',$data);
    }
    //-----------------------------------------------------------------------------------
    public function store($request){
        DB::beginTransaction();
        try{           
            //call trait to handel aut-increament
             $this->refreshTable('sliders');

             $slider = new Slider();
             $slider->sort= $request->sort;
             $slider->status= $request->status;
             $slider->save();
             
           if($request->image){
                //optimize image
                $slider->addMedia($request->image)->toMediaCollection('slider');
            }

             DB::commit();
            toastr()->success('تمت الاضافه بنجاح');
            return redirect()->route('slider.index')->with(['success'=>'تمت الاضافه بنجاح']);
        }catch(\Exception $e){
            DB::rollback();
            toastr()->error('حدث خطا اثناء الاضافه');
            return redirect()->back()->withErrors(['error'=>'حدث خطا اثناء الاضافه']);
           // return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }
            
    }

    //-----------------------------------------------------------------------------------

    public function edit($id){
        $real_id=decrypt($id);
        $data['Slider']=Slider::findOrfail($real_id);
        $data['title']='تعديل الصور المتحركة';
         return view('pages.slider.edit',$data);
    }
        //-----------------------------------------------------------------------------------

    public function update($request){
        DB::beginTransaction();
        try{
           // dd();
            $real_id=decrypt($request->id);

            $Slider = Slider::findOrFail($real_id);
            $Slider->sort = $request->sort;
            $Slider->status = $request->status;
            $Slider->save();
            
            if($request->image)
            {
               //optimize image
               $Slider->addMedia($request->image)->toMediaCollection('slider');

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
            return redirect()->route('slider.index')->with(['success'=>'تم التعديل بنجاح']);
        }catch(\Exception $e){
            DB::rollback();
            //return redirect()->back()->with(['error' => $e->getMessage()]);
            toastr()->error('حدث خطا اثناء التعديل');
            return redirect()->back()->withErrors(['error'=>'حدث خطا اثناء التعديل']);
        }
    }
    //-------------------------------------------------------
    public function destroy($id){
        $real_id=decrypt($id);
        Slider::findOrfail($real_id)->delete();
        //call trait to handel aut-increament
        $this->refreshTable('sliders');
        toastr()->error('تم الحذف');
        return redirect()->route('slider.index')->with(['success'=>'تم الحذف ']);

    }
    public function bulkDelete($request){

        $all_ids = explode(',',$request->delete_all_id);
        // dd($all_ids);
        Slider::whereIn('id',$all_ids)->delete();
     
         //call trait to handel aut-increament
         $this->refreshTable('sliders');
         
         toastr()->error('تم الحذف');
         return redirect()->route('slider.index')->with(['success'=>'تم الحذف ']);
     }

    public function yajra_data($request){
    }
}
?>
