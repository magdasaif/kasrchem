<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Sitesection; 
use App\Models\Main_Category; 
use App\Models\Sub_Category2; 
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

      //  $categories = Main_Category::all();

        $categories = Main_Category::where('visible', '!=' , 0)->withCount('sub_cate2')->orderBy('id','desc')->get();

       //dd($categories);
      
        //  $count = Sub_Category2::where('cate_id', $categories->id)->count();
        // $count = Sub_Category2::where('cate_id', 1)->count();

         return view('categories.sub1.category',compact('categories'));
    }

    public function create()
    {
        $sections = Sitesection::where('visible', '!=' , 0)->get();

        return view('categories.sub1.add',compact('sections'));
    }

  
    public function store(CategoryRequest $request)
    {

        //this for check if this name stored before in category table or no 
        if(  Main_Category::where('subname_ar',$request->subname_ar)
        ->orWhere('subname_en',$request->subname_en)
        ->exists()
        ){
            return redirect()->back()->with(['error'=>'هذا التصنيف مُضاف بالفعل من قبل ']);
        }

        try{
            //vaildation
           $validated = $request->validated();
            
           if($request->image){
                $folder_name='first';
                $photo_name= str_replace(' ', '_',($request->image)->getClientOriginalName());
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
            if ($request->model0==1)
            {
                
               //return redirect()->route('video.create')->with(['success'=>'تمت اضافة التصنيف الفرعى بنجاح']);
               return redirect()->back()->with(
                    [
                       'success'=>'تمت اضافة التصنيف الرئيسى بنجاح',
                       'section_id'=>$request->section_id,
                       'cate_id' => $category->id,
                    ]
                );
              
            }else{
                 return redirect()->route('categories.index')->with(['success'=>'تمت الاضافه بنجاح']);
            }
        }catch(\Exception $e){
            return redirect()->back()->with(['error'=>$e->getMessage()]);
        }
    }

   
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        $categories = Main_Category::findOrfail($id);
        //return $categories;
        
        if(!$categories)
             return redirect()->back();

        $sectionss = Sitesection::where('visible', '!=' , 0)->get();

        return view('categories.sub1.edit',compact('sectionss','categories'));
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
                $photo_name= str_replace(' ', '_',($request->image)->getClientOriginalName());
                ($request->image)->storeAs($folder_name,$photo_name,$disk="categories");
                $category->image= $photo_name;
           }

           // $category->image= $photo_name;

            $category->save();



            //toastr()->success('تمت الاضافه بنجاح');

            return redirect()->route('categories.index')->with(['success'=>'تمت التعديل بنجاح']);
        }catch(\Exception $e){
            return redirect()->back()->with(['error'=>$e->getMessage()]);
        }
    }

    
    public function destroy($id)
    {
        // dd($id);
        try
        {
        $Main_Category=Main_Category::find($id);
        $Main_Category->delete();
        return redirect()->route('categories.index')->with(['success'=>'تم الحذف بنجاح']);
       }
       catch
       (\Exception $e)
       {
           return redirect()->back()->with(['error' => $e->getMessage()]);
       }
    }
}
