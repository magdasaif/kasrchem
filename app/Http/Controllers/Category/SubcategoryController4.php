<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sub_Category4; 
use App\Models\sub_Category3;
use App\Http\Requests\SubCategory4Request;

class SubcategoryController4 extends Controller
{
    public function index()
    {
        //
    }
     //-----------------------index---------------------------
     public function show($sub3_id)
     {
         $sub_category4=Sub_Category4::where('sub3_id',$sub3_id)->get();
         return view('categories.sub4.show',compact('sub_category4','sub3_id'));
     }
//-----------------show add form------------------------------------
     public function create($sub3_id)
    {
       // return $sub3_id;
        $sub_Category3 = sub_Category3::find($sub3_id);
        return view('categories.sub4.add',compact('sub_Category3','sub3_id'));
    }
//-----------------------store to db-----------------------------------------------
    public function store(SubCategory4Request $request)
    {
        if(  Sub_Category4::where('subname_ar',$request->subname_ar)
        ->orWhere('subname_en',$request->subname_en)
        ->exists()
        )
        {
            return redirect()->back()->with(['error'=>'هذا النوع مُضاف بالفعل من قبل ']);
        }

        try{
            //vaildation
           $validated = $request->validated();
           $Sub_Category4 =new Sub_Category4();
            $Sub_Category4->sub3_id=$request->sub3_id;
            $Sub_Category4->subname_ar=$request->subname_ar;
            $Sub_Category4->subname_en=$request->subname_en;
            $Sub_Category4->status= $request->status;
            $Sub_Category4->save();

        return redirect()->route('categories4.show',$request->sub3_id)->with(['success'=>'تمت الاضافه بنجاح']);
        }catch(\Exception $e){
            return redirect()->back()->with(['error'=>$e->getMessage()]);
        }
    }

  
//----------------------------
    public function edit($sub4_id)
    {
       // return $sub4_id;
        $sub4 = sub_Category4::findOrfail($sub4_id);
       return view('categories.sub4.edit',compact('sub4'));
    }

    //----------------------------
    public function update(SubCategory4Request $request, $id)
    {
        try{
                     $validated = $request->validated();
                     $Sub_Category4 = Sub_Category4::findOrfail($request->id);
                     $Sub_Category4->sub3_id=$request->sub3_id;
                     $Sub_Category4->subname_ar=$request->subname_ar;
                     $Sub_Category4->subname_en=$request->subname_en;
                     $Sub_Category4->status= $request->status;
                     $Sub_Category4->save();
        
                  $Sub_Category4->save();
        
                    return redirect()->route('categories4.show',$request->sub3_id)->with(['success'=>'تم التعديل بنجاح']);
                }
            catch(\Exception $e){
                    return redirect()->back()->with(['error'=>$e->getMessage()]);
               }
    }

    //----------------------------
    public function destroy($id)
    {
        //
    }
}
