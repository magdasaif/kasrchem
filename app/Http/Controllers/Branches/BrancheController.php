<?php

namespace App\Http\Controllers\Branches;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branche;
use App\Http\Requests\BranchRequest;

class BrancheController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title='قائمه الفروع';
        $branches=Branche::all();
        return view('pages.branches.show',compact('branches','title'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title='اضافه الفروع';
        return view('pages.branches.add',compact('title'));
    }

    public function store(BranchRequest $request)
    {
       // dd($request->map_lat);
        try{
            //vaildation
           $validated = $request->validated();
           
            $branche =new Branche();

            $branche->name_ar=$request->name_ar;
            $branche->name_en=$request->name_en;
            $branche->address_ar=$request->address_ar;
            $branche->address_en=$request->address_en;
            $branche->status= $request->status;
            $branche->email= $request->email;
            $branche->phone= $request->phone;
            $branche->fax= $request->fax;
            $branche->latitude= $request->map_lat;
            $branche->longitude= $request->map_long;

            $branche->save();


            //toastr()->success('تمت الاضافه بنجاح');

            return redirect()->route('branches.index')->with(['success'=>'تمت الاضافه بنجاح']);
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
       $branch = Branche::findOrfail($id);
       $title=' تعديل فرع';
       return view('pages.branches.edit',compact('title','branch'));
    }

    
    public function update(BranchRequest $request)
    {
        try{
            //vaildation
           $validated = $request->validated();
           
            $branche =Branche::findOrfail($request->id);

            $branche->name_ar=$request->name_ar;
            $branche->name_en=$request->name_en;
            $branche->address_ar=$request->address_ar;
            $branche->address_en=$request->address_en;
            $branche->status= $request->status;
            $branche->email= $request->email;
            $branche->phone= $request->phone;
            $branche->fax= $request->fax;
            $branche->latitude= $request->map_lat;
            $branche->longitude= $request->map_long;

            $branche->save();


            //toastr()->success('تمت الاضافه بنجاح');

            return redirect()->route('branches.index')->with(['success'=>'تم التعديل بنجاح']);
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        Branche::findOrfail($id)->delete();
        return redirect()->route('branches.index')->with(['success'=>'تم الحذف بنجاح']);

    }
}
