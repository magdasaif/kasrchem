<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Main_Category; 
use App\Models\Sub_Category2; 
use App\Models\Sitesection; 

use App\Http\Requests\subCategory2Request;



class SubcategoryController2 extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Sub_Category2::orderBy('id','desc')->get();
      // $categories = Sub_Category2 ::withCount('cate_id')->get();
        
        return view('categories.sub2.category',compact('categories'));
    }

    public function show_add_form($cate_id)
    {
        $from_side_or_no='no';
        $sub1_categories = Main_Category::find($cate_id);
        $sections = Sitesection::where('id',$sub1_categories->section_id)->first();

        //dd($sections);

        return view('categories.sub2.add',compact('sub1_categories','from_side_or_no','sections'));
    }

    public function create()
    {
        $from_side_or_no='no';
        $sections = Sitesection::get();
        $sub1_categories = Main_Category::get();
        //return $sub1_categories;
        return view('categories.sub2.add',compact('sub1_categories','from_side_or_no','sections'));
    }

  
    public function store(subCategory2Request $request)
    {

        //this for check if this name stored before in sub category table or no 
        if(Sub_Category2::where('subname2_ar',$request->subname2_ar)
        ->orWhere('subname2_en',$request->subname2_en)
        ->exists()
        ){
            return redirect()->back()->with(['error'=>'هذا التصنيف مُضاف بالفعل من قبل ']);
        }

        try{
            //vaildation
           $validated = $request->validated();
            
           if($request->image){
                $folder_name='second';
                $photo_name= str_replace(' ', '_',($request->image)->getClientOriginalName());
                ($request->image)->storeAs($folder_name,$photo_name,$disk="categories");
           }else{
               $photo_name='';
           }

           //when using trait
           //$file_name = $this->saveImage($request->image, 'images/categories');

            $category =new Sub_Category2();

            $category->cate_id=$request->cate_id;
            $category->subname2_ar=$request->subname2_ar;
            $category->subname2_en=$request->subname2_en;
            $category->status= $request->status;
           // $category->image= $request->image;
            $category->image2= $photo_name;

            $category->save();


            //toastr()->success('تمت الاضافه بنجاح');
             if ($request->model1==1)
             {
                //return redirect()->route('video.create')->with(['success'=>'تمت اضافة التصنيف الفرعى بنجاح']);
                return redirect()->back()->with(
                    [
                        'success'=>'تمت اضافة التصنيف الفرعى بنجاح',
                        'section_id'=>$request->section_id,
                       'cate_id'=>$request->cate_id,
                       'sub2_id' => $category->id,
                    ]
                );
               
             }
             else
             {
                if($request->change_redirect=='yes'){
                    return redirect()->route('categories2_new.index',$category ->cate_id)->with(['success'=>'تمت الاضافه بنجاح']);
    
                }else{
                    return redirect()->route('categories2.show',$category ->cate_id)->with(['success'=>'تمت الاضافه بنجاح']);
    
                }
             }
        }catch(\Exception $e){
            return redirect()->back()->with(['error'=>$e->getMessage()]);
        }
    }

   
    public function show($id)
    {
        $from_side_or_no='no';
        $categories = Sub_Category2::withcount('sub_cate3')->where('cate_id','=',$id)->get();
       // dd($categories);
        return view('categories.sub2.category',compact('categories','id','from_side_or_no'));
    }

   
    public function edit($id)
    {
        $sub_categories = Sub_Category2::findOrfail($id);
        $main_categories = Main_Category::findOrfail($sub_categories->cate_id);
        $sections = Sitesection::findOrfail($main_categories->section_id);
       // dd($sections);

        
        if(!$sub_categories)
             return redirect()->back();


        return view('categories.sub2.edit',compact('sub_categories','sections'));
    }

   
    public function update(subCategory2Request $request)
    {
        try{
            //vaildation
           $validated = $request->validated();

            $category = Sub_Category2::findOrfail($request->id);

            $category->cate_id=$request->cate_id;
            $category->subname2_ar=$request->subname2_ar;
            $category->subname2_en=$request->subname2_en;
            $category->status= $request->status;


            if($request->image){
                $folder_name='second';
                $photo_name= str_replace(' ', '_',($request->image)->getClientOriginalName());
                ($request->image)->storeAs($folder_name,$photo_name,$disk="categories");
                $category->image2= $photo_name;
           }

           // $category->image= $photo_name;

            $category->save();



            //toastr()->success('تمت الاضافه بنجاح');
            
            // if($request->change_redirect=='yes'){
                return redirect()->route('categories2_new.index',$category ->cate_id)->with(['success'=>'تمت التعديل بنجاح']);

            // }else{
            //     return redirect()->route('categories2.show',$category ->cate_id)->with(['success'=>'تمت التعديل بنجاح']);

            // }
        }catch(\Exception $e){
            return redirect()->back()->with(['error'=>$e->getMessage()]);
        }
    }

    
    public function destroy($id)
    {
        //
    }
}
