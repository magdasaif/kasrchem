<?php

namespace App\Http\Controllers\Slider;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Http\Requests\SliderRequest;
use Illuminate\Http\Request;

class SliderController extends Controller
{
     public function index()
    {
        $Slider=Slider::orderBy('priority','asc')->get();
        return view('pages.Slider.Show',compact('Slider'));
    }
//-----------------------------------------
  public function create()
    {
        return view('pages.Slider.add');
    }
//--------------------------------------------
    public function store(SliderRequest $request)
    {
      
    try{
            $validated = $request->validated();
            $request->validate(['image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|dimensions:max_width=1200,max_height=600,min_width=850,min_height=315','image requires']);
           if($request->image)
           {
              $folder_name='';
            //   $photo_name= ($request->image)->getClientOriginalName();
              $photo_name= str_replace(' ', '_',($request->image)->getClientOriginalName());
               ($request->image)->storeAs($folder_name,$photo_name,$disk="slider");
               
           }
          $Slider = new Slider
           ([
            
            'priority' => $request-> priority,
            'status' =>  $request->status,
            'image' =>$photo_name,
           ]);
        $Slider->save();

            return redirect()->route('slider.index')->with(['success'=>'تمت الاضافه بنجاح']);
        }catch(\Exception $e){
            return redirect()->back()->with(['error'=>$e->getMessage()]);
        }
    }

//--------------------------------------------
    public function edit($id)
    {
        $Slider = Slider::findOrfail($id);
        if(!$Slider)
             return redirect()->back();
            return view('pages.Slider.edit',compact('Slider'));
    }
//--------------------------------------------
  public function update(SliderRequest $request)
    {
       // dd( $request->all());
        try {

            $validated = $request->validated();
            $Slider = Slider::findOrFail($request->id);
            $Slider->priority = $request->priority;
            $Slider->status = $request->status;

            if($request->image)
            {
            $request->validate(['image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|dimensions:max_width=1200,max_height=600,min_width=850,min_height=315',]);
            $folder_name='';
            // $photo_name= ($request->image)->getClientOriginalName();
            $photo_name= str_replace(' ', '_',($request->image)->getClientOriginalName());
            ($request->image)->storeAs($folder_name,$photo_name,$disk="slider");
            
            $Slider->image = $photo_name;
            }
  
         ///------------------------------
          $Slider->save();
      return redirect()->route('slider.index')->with(['success'=>'تم التعديل بنجاح']);
    }
    catch
    (\Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  
    }

//--------------------------------------------
  public function destroy(Request $request ,$id)
    {
       // dd($id);
       $image_path=storage_path().'/app/public/slider/'.$request->deleted_image;
       unlink($image_path);
         try 
         {
         $Slider=Slider::find($id);  
         $Slider->delete(); 
         return redirect()->route('slider.index')->with(['success'=>'تم الحذف بنجاح']);
        }
        catch
        (\Exception $e)
        {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
    public function deleteAll(Request $request)
    {
      $all_ids = explode(',',$request->delete_all_id);
     // dd($all_ids);
     Slider::whereIn('id',$all_ids)->delete();
     return redirect()->route('slider.index')->with(['success'=>'تم الحذف بنجاح']);
    }
}
