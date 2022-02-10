<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sub_Category3; 
use App\Models\Sub_Category2;
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
       
        //dd( sub_Category3::where('sub2_id',$sub2_id)->get());
        $sub_Category3 = Sub_Category3::withcount('relation_sub3_with_sub4')->where('sub2_id',$sub2_id)->get();
        return view('categories.sub3.show',compact('sub_Category3','sub2_id'));
    }
    //----------------------------------------------

    public function create($sub2_id)
    {
        $Sub_Category2 = Sub_Category2::where('id',$sub2_id)->get();

        return view('categories.sub3.add',compact('Sub_Category2','sub2_id'));
    }
//----------------------------------------------
  
    public function store(SubCatergory3Request $request)
    {
      
      // dd($request->all());
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

        return redirect()->route('categories3.show',$request->sub2_id)->with(['success'=>'تمت الاضافه بنجاح']);
        }catch(\Exception $e){
            return redirect()->back()->with(['error'=>$e->getMessage()]);
        }
    }
//----------------------------------------------
public function edit($sub3_id)
{
    $sub3 = sub_Category3::findOrfail($sub3_id);;
    return view('categories.sub3.edit',compact('sub3'));

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


            if($request->image){
                 $folder_name='third';
                 $photo_name= str_replace(' ', '_',($request->image)->getClientOriginalName());
                 ($request->image)->storeAs($folder_name,$photo_name,$disk="categories");
              $sub3->image= $photo_name;
          }

     

          $sub3->save();

            return redirect()->route('categories3.show',$request->sub_id2)->with(['success'=>'تم التعديل بنجاح']);
        }
    catch(\Exception $e){
            return redirect()->back()->with(['error'=>$e->getMessage()]);
       }
    
}
}
