<?php

namespace App\Http\Controllers\Release;
// /use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ReleaseRequest;
use App\Models\Release;
use App\Models\Main_Category; 
use App\Models\Sub_Category2;
use App\Models\sub_Category3;
use App\Models\Sub_Category4;
class ReleaseController extends Controller
{
    public function index()
    {
        $Rel=Release::all();
         return view('pages.Release.Show',compact('Rel'));
    }
//--------------------------------------------
 public function create()
    {
        $Main_Cat = Main_Category::withCount('sub_cate2')->get();
        return view('pages.Release.add',compact('Main_Cat'));
    }
    //--------------------------------------------
    public function store(ReleaseRequest $request)
    {
        //--------get last id and if it the first make last_id=1---------//
        $last_id=Release::pluck("id")->last();
         if($last_id=='')
         {
            $last_id=1;
         }
         else
         {
            $last_id= $last_id+1;
         }
         //------------------------------------------------------------//
      // dd($request->all());
       try{
         $validated = $request->validated();
           if($request->image)
           {
               
            $folder_name='release_'. $last_id;
              $photo_name= ($request->image)->getClientOriginalName();
               ($request->image)->storeAs($folder_name,$photo_name,$disk="release");
               
           }
          if($request->file)
           {
             $folder_name='release_'. $last_id;
              $file_name= ($request->file)->getClientOriginalName();
               ($request->file)->storeAs($folder_name,$file_name,$disk="release");
               
           }
         
            $release = new Release
           ([
            'main_cate_id' =>  $request->main_category,
            'sub1_id' =>  $request->sub2,
            'sub2_id' =>  $request->sub3,
            'sub3_id' =>  $request->sub4,
            'title_ar' =>  $request->title_ar,
            'title_en' =>  $request->title_en,
             'status' =>  $request->status,
            'image' =>$photo_name,
            'file' =>$file_name,
           ]);
        $release->save();
       
            return redirect()->route('release.index')->with(['success'=>'تمت الاضافه بنجاح']);
        }
        catch(\Exception $e){
            return redirect()->back()->with(['error'=>$e->getMessage()]);
        }
    }
//--------------------------------------------
    public function edit($id)
    {
        $release = Release::findOrfail($id);
        if(!$release) return redirect()->back();
       $Main_Cat = Main_Category::withCount('sub_cate2')->get();
       $Sub_Category4 = Sub_Category4::get();
       $Sub_Category3=sub_Category3:: whereIn('id',  $Sub_Category4)->get();
       $Sub_Category2= Sub_Category2::  whereIn('id',  $Sub_Category3)->get();
        return view('pages.release.edit',compact('release','Main_Cat','Sub_Category2','Sub_Category3','Sub_Category4'));
    }
//--------------------------------------------
    public function update(ReleaseRequest $request, $id)
    {
    // dd($request->$release_id);
    
        try {
           
             $validated = $request->validated();
            // $rel = Release::findOrFail($request->id);
            $rel = Release::findOrFail($id);
             $rel->main_cate_id = $request->main_category;
             $rel->sub1_id =  $request->sub2;
             $rel->sub2_id = $request->sub3;
             $rel->sub3_id=  $request->sub4;
             $rel-> title_ar= $request->title_ar;
             $rel->title_en = $request->title_en;
             $rel-> status=$request->status;
 
             if($request->image)
             {
              $validator = $request->validate(['image' => 'required|image|mimes:jpg,png,PNG,jpeg,gif,svg|max:2048',]);
              if ($validator->fails()) { 
                   return redirect()->back()->with($validator->errorrs());
                }
  

           $folder_name='release_'.$id;
             $photo_name= ($request->image)->getClientOriginalName();
             ($request->image)->storeAs($folder_name,$photo_name,$disk="release");
             
             $rel->image = $photo_name;
             }
           
 
             if($request->filee)
             {
             
                $validator=$request->validate(['file' => 'required|max:10000|mimes:application/pdf,application/vnd.openxmlformats-officedocument.wordprocessingml.document',]);
             if ($validator->fails()) { 
                return redirect()->back()->with($validator->errorrs());
            }
             $folder_name='release_'.$id;
             $file_name= ($request->filee)->getClientOriginalName();
             ($request->filee)->storeAs($folder_name,$file_name,$disk="release");
             
             $rel->file = $file_name;
             }
          
        $rel->save();
       return redirect()->route('release.index')->with(['success'=>'تم التعديل بنجاح']);
     }
     catch
     (\Exception $e) 
     {
         return redirect()->back()->with(['error' => $e->getMessage()]);
     }
    }

   //--------------------------------------------
    public function destroy($id)
    {
        // dd($id);
        try 
        {
        $Release=Release::find($id);  
        $Release->delete(); 
        return redirect()->route('release.index')->with(['success'=>'تم الحذف بنجاح']);
       }
       catch
       (\Exception $e)
       {
           return redirect()->back()->with(['error' => $e->getMessage()]);
       }
    }
    //--------------------------------------------
    public function errorrs()
    {
     
    return   [
        'image.required' =>'الملف مطلوب',
        'image.max' =>'يجب ان يكون المرفق لا يتعدى ال 10000',
        'image.mimes' =>'jpg,png,PNG,jpeg,gif,svgامتداد الصوزة غير مناسب يجب ان يكون ',

        'file.required' =>'الصورة مطلوبة',
        'file.image' =>'يجب ان يكون المرفق المرفوع صورة',
        'file.mimes' =>'pdf,xml,wordامتداد الملف غير مناسب يجب ان يكون ',
    ];}
}
