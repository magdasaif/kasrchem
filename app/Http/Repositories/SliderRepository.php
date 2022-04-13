<?php

namespace App\Http\Repositories;

use App\Models\Image;
use App\Models\Slider;
use App\Traits\ImageTrait;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Interfaces\SliderInterface;
use App\Traits\TableAutoIncreamentTrait;

class SliderRepository implements SliderInterface{

    use TableAutoIncreamentTrait,ImageTrait;

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
                // handel image array to pass image data to trait function
                $imageData=[
                    'image_name'    => $request->image,
                    'folder_name'   => '',
                    'disk_name'     => 'slider',
                ];
                
                //call to storeImage fun to save image in disk and return back with photo name
                $photo_name=$this->storeImage($imageData);

                 //start morph image for product main imagحe
                $image =new Image();
                $image->imageable_type='App\Models\Slider';
                $image->imageable_id=$slider->id;
                $image->image_or_file='1';//image
                $image->main_or_sub='1'; //main image
                $image->filename=$photo_name;
                $image->save();
             
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
            
           if($request->image){
                // handel image array to pass image data to trait function
                $imageData=[
                    'image_name'    => $request->image,
                    'folder_name'   => '',
                    'disk_name'     => 'slider',
                ];
                //call to storeImage fun to save image in disk and return back with photo name
                $photo_name=$this->storeImage($imageData);

                //optimize image
                $Slider->addMedia($request->image)->toMediaCollection('slider');
                    
                //start morph image for product sub images
                $img=Image::find($request->image_id);

                if($img){ // if there are image stored before-->update it

                    $img->filename=$photo_name;
                    $img->save();
                    
                }else{// if there are no image stored before-->add it
                    
                        //start morph image for product main image
                        $image =new Image();
                        $image->imageable_type='App\Models\Slider';
                        $image->imageable_id=$Slider->id;
                        $image->image_or_file='1';//image
                        $image->main_or_sub='1'; //main image
                        $image->filename=$photo_name;
                        $image->save();
                    
                }
                
                if($request->deleted_image){
                    //  dd('1');
                    // handel image array to pass image path to trait function
                    $imageData=[
                        'path'=>storage_path().'/app/public/slider/'.$request->deleted_image,
                    ];
                    //call to unLinkImage fun to delete old image from disk 
                    $this->unLinkImage($imageData);
                }
             }


            //toastr()->success('تمت الاضافه بنجاح');
            DB::commit();
            toastr()->success('تم التعديل بنجاح');
            return redirect()->route('slider.index')->with(['success'=>'تم التعديل بنجاح']);
        }catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->with(['error' => $e->getMessage()]);
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
