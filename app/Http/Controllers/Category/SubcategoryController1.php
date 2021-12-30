<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Sitesection; 
use App\Models\Main_Category; 
use App\Http\Requests\CategoryRequest;
use App\Traits\CategoryTrait;



class SubcategoryController1 extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $sections = Sitesection::all();
        $categories = Main_Category::all();

        return view('categories.category',compact('categories'));
    }

    public function create()
    {
        $sections = Sitesection::all();

        return view('categories.add',compact('sections'));
    }

  
    public function store(CategoryRequest $request)
    {

        //this for check if this name stored before in category table or no 
        if(  Main_Category::where('subname_ar',$request->subname_ar)
        ->orWhere('subname_en',$request->subname_en)
        ->exists()
        ){
            return redirect()->back()->withErrors('هذا التصنيف مُضاف بالفعل من قبل ');
        }

        try{
            //vaildation
           $validated = $request->validated();
            
           if($request->image){
                $folder_name='first';
                $photo_name= ($request->image)->getClientOriginalName();
                ($request->image)->storeAs($folder_name,$photo_name,$disk="categories");
           }else{
               $photo_name='';
           }

           //when using trait
           //$file_name = $this->saveImage($request->image, 'images/categories');

            $category =new Main_Category();

            $category->section_id=$request->section_id;
            $category->subname_ar=$request->subname_ar;
            $category->subname_en=$request->subname_en;
            $category->status= $request->status;
           // $category->image= $request->image;
            $category->image= $photo_name;

            $category->save();


            // Main_Category::create([
            //     'section_id' => $request->section_id,
            //     'subname_ar' => $request->subname_ar,
            //     'subname_en' => $request->subname_en,
            //     'status' => $request->status,
            //     'image' => $request->image,
            // ]);

            //toastr()->success('تمت الاضافه بنجاح');

            return redirect()->route('categories.index')->with(['success'=>'تمت الاضافه بنجاح']);
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }
    }

   
    public function show($id)
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
<<<<<<< HEAD

            if($request->image){
                $folder_name='first';
                $photo_name= ($request->image)->getClientOriginalName();
                ($request->image)->storeAs($folder_name,$photo_name,$disk="categories");
                $category->image= $photo_name;
           }
=======
>>>>>>> yasmeen
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
    }
}
