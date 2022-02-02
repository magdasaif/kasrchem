<?php

namespace App\Http\Controllers\Cities;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CityRequest;
use App\Models\City;
class CityController extends Controller
{
   
    public function index()
    {
         $cities=City::all();
         return view('pages.City.Show',compact('cities'));
    }
 //---------------------------------------//
    public function edit($id)
    {
        $City = City::findOrfail($id);
        if(!$City) return redirect()->back();
         return view('pages.City.edit',compact('City'));
    }

  
    public function update(CityRequest $request, $id)
    {
        try 
        {

            $validated = $request->validated();
            $City = City::findOrFail($request->id);
            $City-> title_ar= $request->title_ar;
            $City->title_en = $request->title_en;
            $City-> charge_spend= $request->charge_spend;
            $City-> status=$request->status;
            $City->save();
           return redirect()->route('city.index')->with(['success'=>'تم التعديل بنجاح']);
        }
        catch
        (\Exception $e) 
        {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

}
