<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\sub_Category3; 
use App\Models\Sub_Category2;
use App\Http\Requests\CategoryRequest;




class SubcategoryController3 extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
        
    //     $sub_Category3 = sub_Category3::all();
    //     return view('categories.sub_category3.show',compact('sub_Category3'));
    // }
    //----------------------------------------------
    public function show($sub2_id)
    {
        //$sub_Category3 = sub_Category3::withcount('sub_cate3')->where('sub2_id',$sub2_id)->get();
        $sub_Category3 = sub_Category3::where('sub2_id',$sub2_id)->get();
        return view('categories.sub3.show',compact('sub_Category3','sub2_id'));
    }
    //----------------------------------------------

    public function create($sub2_id)
    {
        $Sub_Category2 = Sub_Category2::where('id',$sub2_id)->get();

        return view('categories.sub3.add',compact('Sub_Category2'));
    }
//----------------------------------------------
  
    public function store(CategoryRequest $request)
    {
      
        //dd($request->all());
        //this for check if this name stored before in sub_Category3 table or no 
       if(  sub_Category3::where('subname_ar',$request->subname_ar)
        ->orWhere('subname_en',$request->subname_en)
        ->exists()
        ){
            return redirect()->back()->with(['error'=>'هذا النوع مُضاف بالفعل من قبل ']);
        }

        try{
            //vaildation
           $validated = $request->validated();
            
           if($request->image){
                $folder_name='thired';
                $photo_name= ($request->image)->getClientOriginalName();
                ($request->image)->storeAs($folder_name,$photo_name,$disk="categories");
           }else{
               $photo_name='';
           }

            $sub_Category3 =new sub_Category3();
            $sub_Category3->sub2_id=$request->sub2_id;
            $sub_Category3->subname_ar=$request->subname_ar;
            $sub_Category3->subname_en=$request->subname_en;
            $sub_Category3->status= $request->status;
            $sub_Category3->image= $photo_name;
            //$sub_Category3->image='';
           $sub_Category3->save();

        return redirect()->route('categories3.show',$request->sub2_id)->with(['success'=>'تمت الاضافه بنجاح']);
        }catch(\Exception $e){
            return redirect()->back()->with(['error'=>$e->getMessage()]);
        }
    }
//----------------------------------------------
   
   /*  public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        $categories = Main_Category::findOrfail($id);
      //  return $categories;
        
        if(!$categories)
             return redirect()->back();

        $sections = Sitesection::all();

        return view('categories.edit',compact('sections','categories'));
    }

   
    public function update(CategoryRequest $request)
    {
        try{
            //vaildation
           $validated = $request->validated();

        //    $folder_name='first';
        //    $photo_name= ($request->image)->getClientOriginalName();
        //    ($request->image)->storeAs($folder_name,$photo_name,$disk="categories");


            $category = Main_Category::findOrfail($request->id);

            $category->section_id=$request->section_id;
            $category->subname_ar=$request->subname_ar;
            $category->subname_en=$request->subname_en;
            $category->status= $request->status;


            if($request->image){
                $folder_name='first';
                $photo_name= ($request->image)->getClientOriginalName();
                ($request->image)->storeAs($folder_name,$photo_name,$disk="categories");
                $category->image= $photo_name;
           }

           // $category->image= $photo_name;

            $category->save();



            //toastr()->success('تمت الاضافه بنجاح');

            return redirect()->route('categories.index')->with(['success'=>'تمت التعديل بنجاح']);
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }
    }

    
    public function destroy($id)
    {
        //
    } */
}
