<?php

namespace App\Http\Controllers\Release;
// /use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ReleaseRequest;
use App\Models\Release;

use App\Models\Sitesection;
use App\Models\Main_Category;
use App\Models\Release_Section;
use App\Models\Sub_Category2;
use App\Models\Sub_Category3;
use App\Models\Sub_Category4;



use App\Traits\TableAutoIncreamentTrait;

class ReleaseController extends Controller
{
    use TableAutoIncreamentTrait;
    public function index()
    {
        $Rel=Release::orderBy('id','desc')->get();
         return view('pages.Release.Show',compact('Rel'));
    }
//--------------------------------------------
 public function create()
    {
        //$Main_Cat = Main_Category::withCount('sub_cate2')->get();
        // $sub_Category4      = Sub_Category4::get(); 
        // $sub_Category3      = Sub_Category3::get(); 
        // $Sub_Category2      = Sub_Category2::get();
        // $Main_Cat	        = Main_Category::get();
        // $sections           = Sitesection::get();
   //+++++++++++++++++++++++++new for unrequired +++++++++++++++++++++++++//
            $sections =Sitesection::where('parent_id', '=', Null)->where('visible', '!=' , 0)->get();
            $Main_Cat = Main_Category::where('visible', '!=' , 0)->get();
            $sub_Category4 = Sub_Category4::where('visible', '!=' , 0)->get();
            $sub_Category3 = Sub_Category3::where('visible', '!=' , 0)->get();
            $Sub_Category2 = Sub_Category2::where('visible', '!=' , 0)->get();
    //+++++++++++++++++++++++++++++++++++++++++++++//
        return view('pages.Release.add',compact('Main_Cat','sub_Category4','sub_Category3','Sub_Category2','sections'));
    }
    //--------------------------------------------
    public function store(ReleaseRequest $request)
    {
         //call trait to handel aut-increament
        $this->refreshTable('releases');

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
              $photo_name= str_replace(' ', '_',($request->image)->getClientOriginalName());
               ($request->image)->storeAs($folder_name,$photo_name,$disk="release");

           }
          if($request->file)
           {
             $folder_name='release_'. $last_id;
              $file_name= str_replace(' ', '_',($request->file)->getClientOriginalName());
               ($request->file)->storeAs($folder_name,$file_name,$disk="release");

           }

           /* $release = new Release
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
           ]);*/
           $release = new Release();
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//            
            //---"!$request"=> علشان لو ظاهر جزء اضف تصنيف يحفظ بالقيمة 1 كانه مختارش حاجة++++++++++//
              
             
                //--------------------------------    
            if(!$request->section_id)
            {
                $release->site_id= 1;
            }
            else
            {
                $release->site_id= $request->section_id; 
            }

           if(!$request->main_category)
            {
                $release->main_cate_id=1;
            }
            else
            {
                $release->main_cate_id= $request->main_category; 
            }
            /* if(!$request->main_cate_id && !$request->main_category)
            {
                $release->main_cate_id=1;
                
            }
            else
            {
                if($request->main_cate_id){
                   // read from edit form
                    $release->main_cate_id=$request->main_cate_id;
                }else{
                   // read from add form
                    $release->main_cate_id=$request->main_category;
                }               
           }*/

            if(!$request->sub2)
            {
                $release->sub1_id= 1;

            }
            else
            {
                $release->sub1_id= $request->sub2; 
            }

            if(!$request->sub3)
            {
                $release->sub2_id=1;
            }
            else
            {
                $release->sub2_id=$request->sub3; 
            }
            if(!$request->sub4)
            {
                $release->sub3_id=1;
            }
            else
            {
                $release->sub3_id= $request->sub4; 
            }
          
            $release->title_ar=$request->title_ar;
            $release->title_en=$request->title_en;
            $release->status=$request->status;
            $release->image=$photo_name;
            $release->file=$file_name;
        //++++++++++++++++++++++++++++++++++++++++++//
        $release->save();
  
          //attach sections with release  to insert in releases_sections
         // dd($request->site_id);

         $release->rel_section()->attach($request->site_id);
    
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
        
       /*  $sections     = Sitesection::get();
         $Main_Cat = Main_Category::get();
         $Sub_Category4      = Sub_Category4::get();
         $Sub_Category3      = Sub_Category3::get();
         $Sub_Category2      = Sub_Category2::get();

        //to retrive value of section
        $main_categories = Main_Category::findOrfail($release->main_cate_id);
        $s = Sitesection::findOrfail($main_categories->section_id);    
        return view('pages.Release.edit',compact('s','sections','release','Main_Cat','Sub_Category2','Sub_Category3','Sub_Category4'));

        */
        //+++++++++++++++++++++++++ new for unrequired +++++++++++++++++++++++++//
        $sections = Sitesection::where('parent_id', '=', Null)->where('visible', '!=' , 0)->get();     
       $Main_Cat = Main_Category::where('visible', '!=' , 0)->get();
        $Sub_Category4 = Sub_Category4::where('visible', '!=' , 0)->get();
        $Sub_Category3 = Sub_Category3::where('visible', '!=' , 0)->get();
        $Sub_Category2 = Sub_Category2::where('visible', '!=' , 0)->get();
        return view('pages.Release.edit',compact('sections','release','Main_Cat','Sub_Category2','Sub_Category3','Sub_Category4'));

//+++++++++++++++++++++++++++++++++++++++++++++//
    }
//--------------------------------------------
    public function update(ReleaseRequest $request, $id)
    {
  //dd( $request->all());
   //dd($request->sub2);
        try {

             $validated = $request->validated();
            // $rel = Release::findOrFail($request->id);
            $rel = Release::findOrFail($id);
          
             //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//            
            //---"!$request"=> علشان لو ظاهر جزء اضف تصنيف يحفظ بالقيمة 1 كانه مختارش حاجة++++++++++//
                    
            if(!$request->section_id)
            {
                $rel->site_id= 1;
            }
            else
            {
                $rel->site_id= $request->section_id; 
            }

            if(!$request->main_cate_id)
            {
                $rel->main_cate_id=1;
             //   $ff='1';
            }
            else
            {
                $rel->main_cate_id= $request->main_cate_id;
           //     $ff='2';
            }

         //   dd('ddd '.$rel->main_cate_id.$ff);
            
            if(!$request->sub2)
            {
                
                $rel->sub1_id= 1;

            }
            else
            {
                $rel->sub1_id= $request->sub2; 
            }

            if(!$request->sub3)
            {
                $rel->sub2_id=1;
            }
            else
            {
                $rel->sub2_id=$request->sub3; 
            }

            if(!$request->sub4)
            {
                $rel->sub3_id=1;
            }
            else
            {
                $rel->sub3_id= $request->sub4; 
            }
          
            $rel->title_ar=$request->title_ar;
            $rel->title_en=$request->title_en;
            $rel->status=$request->status;
        //++++++++++++++++++++++++++++++++++++++++++//

             if($request->image)
             {
            //   $validator = $request->validate(['image' => 'required|image|mimes:jpg,png,PNG,jpeg,gif,svg|max:2048',]);
            //   if ($validator->fails()) {
            //        return redirect()->back()->with($validator->errorrs());
            //     }


           $folder_name='release_'.$id;
             $photo_name= str_replace(' ', '_',($request->image)->getClientOriginalName());
             ($request->image)->storeAs($folder_name,$photo_name,$disk="release");

             $rel->image = $photo_name;
             }


             if($request->filee)
             {

            //     $validator=$request->validate(['file' => 'required|max:10000|mimes:application/pdf,application/vnd.ms-excel',]);
            //  if ($validator->fails()) {
            //     return redirect()->back()->with($validator->errorrs());
            // }
             $folder_name='release_'.$id;
             $file_name= str_replace(' ', '_',($request->filee)->getClientOriginalName());
             ($request->filee)->storeAs($folder_name,$file_name,$disk="release");

             $rel->file = $file_name;
             }

        $rel->save();
        //attach sections with supplier
        if(isset($request->site_id)){
            $rel->rel_section()->sync($request->site_id);
        }else{
            $rel->rel_section()->sync();
        }
       return redirect()->route('release.index')->with(['success'=>'تم التعديل بنجاح']);
     }
     catch
     (\Exception $e)
     {
         return redirect()->back()->with(['error' => $e->getMessage()]);
     }
    }

   //--------------------------------------------
    public function destroy(Request $request ,$id)
    {
        // dd($id);
        if(file_exists(storage_path().'/app/public/release/release_'.$id.'/'.$request->deleted_image)){
            unlink(storage_path().'/app/public/release/release_'.$id.'/'.$request->deleted_image);
        }

        if(file_exists(storage_path().'/app/public/release/release_'.$id.'/'.$request->deleted_file)){
            unlink(storage_path().'/app/public/release/release_'.$id.'/'.$request->deleted_file);
        }
        
        
        try
        {
        // $Release=Release::find($id);
        // $Release->delete();

        Release_Section::where('release_id',$id)->delete();
        Release::find($id)->delete();

        //call trait to handel aut-increament
        $this->refreshTable('releases');
                
        return redirect()->route('release.index')->with(['success'=>'تم الحذف بنجاح']);
       }
       catch
       (\Exception $e)
       {
           return redirect()->back()->with(['error' => $e->getMessage()]);
       }
    }
    //--------------------------------------------
    public function deleteAll(Request $request)
    {
    $all_ids = explode(',',$request->delete_all_id);
    // dd($all_ids);
    foreach($all_ids as $ids){
        if($ids=='on'){}else{
        Release_Section::where('release_id',$ids)->delete();
        Release::find($ids)->delete();
        }
    }

       //call trait to handel aut-increament
       $this->refreshTable('releases');
    
    //Release::whereIn('id',$all_ids)->delete();
    return redirect()->route('release.index')->with(['success'=>'تم الحذف بنجاح']);
    }

}
