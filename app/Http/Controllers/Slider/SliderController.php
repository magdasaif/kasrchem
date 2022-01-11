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
        $Slider=Slider::all();
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
            $request->validate(['image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',]);
           if($request->image)
           {
              $folder_name='';
              $photo_name= ($request->image)->getClientOriginalName();
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
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
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
            $request->validate(['image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',]);
            $folder_name='';
            $photo_name= ($request->image)->getClientOriginalName();
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
  public function destroy($id)
    {
       // dd($id);
         try 
         {
         $Slider=Slider::find($id);  
         $Slider->delete(); 
         return redirect()->route('slider.index')->with(['success'=>'تم الحذف بنجاح']);
        }
        catch
        (\Exception $e)
        {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
