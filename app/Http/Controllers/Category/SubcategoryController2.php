<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Main_Category; 
use App\Models\Sub_Category2; 

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
        $categories = Sub_Category2::all();
        
        return view('categories.sub2.category',compact('categories'));
    }

    public function create()
    {
        $sub1_categories = Main_Category::all();

        return view('categories.sub2.add',compact('sub1_categories'));
    }

  
    public function store(subCategory2Request $request)
    {

        //this for check if this name stored before in sub category table or no 
        if(  Sub_Category2::where('subname2_ar',$request->subname2_ar)
        ->orWhere('subname2_en',$request->subname2_en)
        ->exists()
        ){
            return redirect()->back()->withErrors('هذا التصنيف مُضاف بالفعل من قبل ');
        }

        try{
            //vaildation
           $validated = $request->validated();
            
           if($request->image){
                $folder_name='second';
                $photo_name= ($request->image)->getClientOriginalName();
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

            return redirect()->route('categories2.index')->with(['success'=>'تمت الاضافه بنجاح']);
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }
    }

   
    public function show($id)
    {
        $categories = Sub_Category2::where('cate_id','=',$id)->get();
       // dd($categories);
        return view('categories.sub2.category',compact('categories'));
    }

   
    public function edit($id)
    {
        $sub_categories = Sub_Category2::findOrfail($id);
      //  return $categories;
        
        if(!$sub_categories)
             return redirect()->back();

        $main_categories = Main_Category::all();

        return view('categories.sub2.edit',compact('sub_categories','main_categories'));
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
                $photo_name= ($request->image)->getClientOriginalName();
                ($request->image)->storeAs($folder_name,$photo_name,$disk="categories");
                $category->image2= $photo_name;
           }

           // $category->image= $photo_name;

            $category->save();



            //toastr()->success('تمت الاضافه بنجاح');

            return redirect()->route('categories2.index')->with(['success'=>'تمت التعديل بنجاح']);
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }
    }

    
    public function destroy($id)
    {
        //
    }
}
