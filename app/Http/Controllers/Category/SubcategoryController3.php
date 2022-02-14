<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sitesection; 
use App\Models\Main_Category;
use App\Models\Sub_Category2;
use App\Models\Sub_Category3; 

use App\Http\Requests\SubCatergory3Request;




class SubcategoryController3 extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //----------------------------------------------
    // public function index()
    // {
        
    //     $sub_Category3 = sub_Category3::all();
    //     return view('categories.sub_category3.show',compact('sub_Category3'));
    // }
    //----------------------------------------------
    public function show($sub2_id)
    {
        $from_side_or_no='no';
        $sections = Sitesection::orderBy('id','desc')->get();
        //dd( sub_Category3::where('sub2_id',$sub2_id)->get());
        $sub_Category3 = Sub_Category3::withcount('relation_sub3_with_sub4')->where('sub2_id',$sub2_id)->get();
        return view('categories.sub3.show',compact('sub_Category3','sub2_id','sections','from_side_or_no'));
    }
    //----------------------------------------------

    public function create($sub2_id)
    {
        $from_side_or_no='no';
              
        $Sub_Category2 = Sub_Category2::find($sub2_id);
        $sub1_categories = Main_Category::where('id',$Sub_Category2->cate_id)->first();
        $sections = Sitesection::where('id',$sub1_categories->section_id)->first();

        //dd($Sub_Category2);
        return view('categories.sub3.add',compact('Sub_Category2','sub2_id','sections','sub1_categories','from_side_or_no'));
    }
//----------------------------------------------
  
    public function store(SubCatergory3Request $request)
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
               
                $folder_name='third';
                $photo_name= str_replace(' ', '_',($request->image)->getClientOriginalName());
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
            $sub_Category3->save();
            if ($request->model2==1)
            {
                return redirect()->back()->with(['success'=>'تمت اضافة النوع الرئيسى بنجاح']);

              
            }
            if($request->model2_edit==1) 
            {
               
               return redirect()->back()->with(['success'=>'تمت اضافة النوع الرئيسى بنجاح']);
             
            }
            else
            {
                if($request->change_redirect=='yes'){
                    return redirect()->route('categories3_new.index',$request->sub2_id)->with(['success'=>'تمت الاضافه بنجاح']);
                }else{
                    return redirect()->route('categories3.show',$request->sub2_id)->with(['success'=>'تمت الاضافه بنجاح']);
                }       
            }
        }catch(\Exception $e){
            return redirect()->back()->with(['error'=>$e->getMessage()]);
        }
    }
//----------------------------------------------
public function edit($sub3_id)
{
    $sub3 = sub_Category3::findOrfail($sub3_id);;

    $sub_categories = Sub_Category2::findOrfail($sub3->sub2_id);
    $main_categories = Main_Category::findOrfail($sub_categories->cate_id);
    $sections = Sitesection::findOrfail($main_categories->section_id);
    
    return view('categories.sub3.edit',compact('sub_categories','sections','main_categories','sub3'));

}
  //---------------------------------------------- 
   
 public function update(SubCatergory3Request $request)
    {
     // dd($request->all());
         try{
    //        //vaildation
           $validated = $request->validated();
           
            $sub3 = sub_Category3::findOrfail($request->id);
            $sub3->sub2_id=$request->sub_id2;
            $sub3->subname_ar=$request->subname_ar;
            $sub3->subname_en=$request->subname_en;
           $sub3->status= $request->status;

        //    $request->validate(
        //        ['image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048','image requires'],
        //        ['image.required' => 'You have to choose the file!']
        //     );

            // $rules = [
            //     'image' => 'required'
            // ];
        
            // $customMessages = [
            //     'image.required' => 'You have to choose the file!.'
            // ];
        
            // $this->validate($request, $rules, $customMessages);
            
            if($request->image){
                 $folder_name='third';
                 $photo_name= str_replace(' ', '_',($request->image)->getClientOriginalName());
                 ($request->image)->storeAs($folder_name,$photo_name,$disk="categories");
              $sub3->image= $photo_name;
          }

     

          $sub3->save();

             return redirect()->route('categories3_new.index',$request->sub_id2)->with(['success'=>'تم التعديل بنجاح']);
            // return redirect()->route('categories3.show',$request->sub_id2)->with(['success'=>'تم التعديل بنجاح']);
        }
    catch(\Exception $e){
            return redirect()->back()->with(['error'=>$e->getMessage()]);
       }
    
}
}
