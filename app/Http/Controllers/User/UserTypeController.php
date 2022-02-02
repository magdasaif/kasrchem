<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


use App\Models\UserType;


class UserTypeController extends Controller
{
    
    public function index()
    {
       $title = 'انواع المستخدمين';
       $types = UserType::get();
       return view('pages.users.types_show',compact('types','title'));

    }

  
    public function create()
    {
        $title='اضافه نوع';
        return view('pages.users.types_add',compact('title'));
    }

    public function store(Request $request)
    {
        try{
            //vaildation
           $validated = $request->validate([
            'name_ar' => 'required|unique:user_types,name_ar',
            'name_en' => 'required|unique:user_types,name_en',
            'status' => 'required',
           ],[
            'name_ar.required' => 'تاكد مم ادخال النوع باللغه  العربيه',
            'name_en.required' => 'تاكد مم ادخال النوع باللغه  الانجليزيه',
           ]);

           /* $validator = Validator::make(
            $request,
                array(
                    'name_ar' => 'required',
                    'name_en' => 'required',
                    'status' => 'required',
                ),array(
                    'name_ar.required' => 'تاكد مم ادخال النوع باللغه  العربيه',
                    'name_en.required' => 'تاكد مم ادخال النوع باللغه  الانجليزيه',
                )
            );
            */
           
            $type =new UserType();

            $type->name_ar=$request->name_ar;
            $type->name_en=$request->name_en;
            $type->status= $request->status;

            $type->save();


            //toastr()->success('تمت الاضافه بنجاح');

            return redirect()->route('user_type.index')->with(['success'=>'تمت الاضافه بنجاح']);
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $title='اضافه نوع';
        $type=UserType::findOrfail($id);
        return view('pages.users.types_edit',compact('title','type'));
    }

  
    public function update(Request $request)
    {
        try{
            //vaildation
           $validated = $request->validate([
            'name_ar' => 'required|unique:user_types,name_ar,'.$request->id,
            'name_en' => 'required|unique:user_types,name_en,'.$request->id,
            'status' => 'required',
           ],[
            'name_ar.required' => 'تاكد مم ادخال النوع باللغه  العربيه',
            'name_en.required' => 'تاكد مم ادخال النوع باللغه  الانجليزيه',
           ]);


            $type =UserType::findOrfail($request->id);

            $type->name_ar=$request->name_ar;
            $type->name_en=$request->name_en;
            $type->status= $request->status;

            $type->save();


            //toastr()->success('تمت الاضافه بنجاح');

            return redirect()->route('user_type.index')->with(['success'=>'تم التعديل بنجاح']);
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

  
    public function destroy($id)
    {
        UserType::findOrFail($id)->delete();
        return redirect()->route('user_type.index')->with(['success'=>'تم الحذف ']);

    }
}
