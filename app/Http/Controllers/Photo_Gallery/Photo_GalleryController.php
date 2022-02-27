<?php

namespace App\Http\Controllers\Photo_Gallery;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Photo_Gallery_Request;
use App\Models\Photo_Gallery;

use App\Models\Sitesection;
use App\Models\Main_Category;
use App\Models\Sub_Category2;
use App\Models\Sub_Category3;
use App\Models\Sub_Category4;

use App\Models\Gallery_Photo_Image;
class Photo_GalleryController extends Controller
{
    
    public function index()
    {
        $Photo_Gal=Photo_Gallery::orderBy('id','desc')->get();
        return view('pages.Photo_Gallery.Show',compact('Photo_Gal'));
    }
//-------------------------------------------------------------//
    public function create()
    {
       // $Main_Cat = Main_Category::withCount('sub_cate2')->get();
       /*$sub_Category4      = Sub_Category4::get(); 
        $sub_Category3      = Sub_Category3::get(); 
        $Sub_Category2      = Sub_Category2::get();
        $sections           = Sitesection::get();
       $Main_Cat            = Main_Category::get();*/
        //+++++++++++++++++++++++++new for unrequired +++++++++++++++++++++++++//
        $sections = Sitesection::where('visible', '!=' , 0)->get();
        $Main_Cat = Main_Category::where('visible', '!=' , 0)->get();
        $sub_Category4 = Sub_Category4::where('visible', '!=' , 0)->get();
        $sub_Category3 = Sub_Category3::where('visible', '!=' , 0)->get();
        $Sub_Category2 = Sub_Category2::where('visible', '!=' , 0)->get();
          //+++++++++++++++++++++++++++++++++++++++++++++//
        return view('pages.Photo_Gallery.add',compact('Main_Cat','sub_Category4','sub_Category3','Sub_Category2','sections'));
    }
//-------------------------------------------------------------//
    public function store(Photo_Gallery_Request $request)
    {
         //dd($request->all());
         try{
            $validated = $request->validated();
             $request->validate(['image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',]);
              if($request->image)
              {
                 $folder_name='';
                //  $photo_name= ($request->image)->getClientOriginalName();
                $photo_name= str_replace(' ', '_',($request->image)->getClientOriginalName());
                  ($request->image)->storeAs($folder_name,$photo_name,$disk="photo_gallery");
                  
              }
              /* $photo_gallery = new Photo_Gallery
              ([
               'main_cate_id' =>  $request->main_category,
               'sub1_id' =>  $request->sub2,
               'sub2_id' =>  $request->sub3,
               'sub3_id' =>  $request->sub4,
               'title_ar' =>  $request->title_ar,
               'title_en' =>  $request->title_en,
               'status' =>  $request->status,
               'image' =>$photo_name,
              ]);*/
              //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//            
            //---"!$request"=> علشان لو ظاهر جزء اضف تصنيف يحفظ بالقيمة 1 كانه مختارش حاجة++++++++++//
            $photo_gallery = new Photo_Gallery();       
            if(!$request->section_id)
            {
                $photo_gallery->site_id= 1;
            }
            else
            {
                $photo_gallery->site_id= $request->section_id; 
            }

           if(!$request->main_category)
            {
                $photo_gallery->main_cate_id=1;
            }
            else
            {
                $photo_gallery->main_cate_id= $request->main_category; 
            }
          
          if(!$request->sub2)
            {
                $photo_gallery->sub1_id= 1;

            }
            else
            {
                $photo_gallery->sub1_id= $request->sub2; 
            }

            if(!$request->sub3)
            {
                $photo_gallery->sub2_id=1;
            }
            else
            {
                $photo_gallery->sub2_id=$request->sub3; 
            }
            if(!$request->sub4)
            {
                $photo_gallery->sub3_id=1;
            }
            else
            {
                $photo_gallery->sub3_id= $request->sub4; 
            }
            $photo_gallery->title_ar=$request->title_ar;
            $photo_gallery->title_en=$request->title_en;
            $photo_gallery->status=$request->status;
            $photo_gallery->image=$photo_name;
           
        //++++++++++++++++++++++++++++++++++++++++++//
           $photo_gallery->save();
   
               return redirect()->route('photo_gallery.index')->with(['success'=>'تمت الاضافه بنجاح']);
           }
           catch(\Exception $e){
               return redirect()->back()->with(['error'=>$e->getMessage()]);
           }
    }
//-------------------------------------------------------------//
    public function edit($id)
    {
       
        $photo_gallery = Photo_Gallery::findOrfail($id);
        if(!$photo_gallery) return redirect()->back();

         /*$sections     = Sitesection::get();
         $Main_Cat = Main_Category::get();
         $Sub_Category4      = Sub_Category4::get();
         $Sub_Category3      = Sub_Category3::get();
         $Sub_Category2      = Sub_Category2::get();

         
         //to retrive value of section
         $main_categories = Main_Category::findOrfail($photo_gallery->main_cate_id);
         $s = Sitesection::findOrfail($main_categories->section_id);
         
        return view('pages.Photo_Gallery.edit',compact('s','sections','photo_gallery','Main_Cat','Sub_Category2','Sub_Category3','Sub_Category4'));
    */
     //+++++++++++++++++++++++++new for unrequired +++++++++++++++++++++++++//
     $sections = Sitesection::where('visible', '!=' , 0)->get();
     $Main_Cat = Main_Category::where('visible', '!=' , 0)->get();
     $Sub_Category4 = Sub_Category4::where('visible', '!=' , 0)->get();
     $Sub_Category3 = Sub_Category3::where('visible', '!=' , 0)->get();
     $Sub_Category2 = Sub_Category2::where('visible', '!=' , 0)->get();
     return view('pages.Photo_Gallery.edit',compact('sections','photo_gallery','Main_Cat','Sub_Category2','Sub_Category3','Sub_Category4'));

    //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//

}
//-------------------------------------------------------------//
    public function update(Photo_Gallery_Request $request, $id)
    {
     // dd( $request->all());
      try {

        $validated = $request->validated();
        $Photo_Gallery = Photo_Gallery::findOrFail($id);
         // $Photo_Gallery->main_cate_id = $request->main_category;
         
         /* $Photo_Gallery->main_cate_id = $request->main_cate_id;
         $Photo_Gallery->sub1_id =  $request->sub2;
        $Photo_Gallery->sub2_id = $request->sub3;
        $Photo_Gallery->sub3_id=  $request->sub4;
        $Photo_Gallery-> title_ar= $request->title_ar;
        $Photo_Gallery->title_en = $request->title_en;
        $Photo_Gallery-> status=$request->status;*/
   //++++++++++++++++++++++++++++++++++++++++++//   //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//            
            //---"!$request"=> علشان لو ظاهر جزء اضف تصنيف يحفظ بالقيمة 1 كانه مختارش حاجة++++++++++//
                
            if(!$request->section_id)
            {
                $Photo_Gallery->site_id= 1;
            }
            else
            {
                $Photo_Gallery->site_id= $request->section_id; 
            }

           if(!$request->main_cate_id)
            {
                $Photo_Gallery->main_cate_id=1;
            }
            else
            {
                $Photo_Gallery->main_cate_id= $request->main_cate_id; 
            }
          
          if(!$request->sub2)
            {
                $Photo_Gallery->sub1_id= 1;

            }
            else
            {
                $Photo_Gallery->sub1_id= $request->sub2; 
            }

            if(!$request->sub3)
            {
                $Photo_Gallery->sub2_id=1;
            }
            else
            {
                $Photo_Gallery->sub2_id=$request->sub3; 
            }
            if(!$request->sub4)
            {
                $Photo_Gallery->sub3_id=1;
            }
            else
            {
                $Photo_Gallery->sub3_id= $request->sub4; 
            }
            $Photo_Gallery->title_ar=$request->title_ar;
            $Photo_Gallery->title_en=$request->title_en;
            $Photo_Gallery->status=$request->status;
         
           
        //++++++++++++++++++++++++++++++++++++++++++//
        if($request->image)
        {
       // $request->validate(['image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',]);
        $folder_name='';
        // $photo_name= ($request->image)->getClientOriginalName();
        $photo_name= str_replace(' ', '_',($request->image)->getClientOriginalName());
        ($request->image)->storeAs($folder_name,$photo_name,$disk="photo_gallery");
        
        $Photo_Gallery->image = $photo_name;
        }
      
        $Photo_Gallery->save();
        return redirect()->route('photo_gallery.index')->with(['success'=>'تم التعديل بنجاح']);
        }
        catch
        (\Exception $e) 
        {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
//-------------------------------------------------------------//
     public function destroy(Request $request ,$id)
    {
         // dd($id);
         $image_path=storage_path().'/app/public/photo_gallery/'.$request->deleted_image;
         unlink($image_path);
         try 
         {
         $Photo_Gallery=Photo_Gallery::find($id);  
         $Photo_Gallery->delete(); 
         return redirect()->route('photo_gallery.index')->with(['success'=>'تم الحذف بنجاح']);
        }
        catch
        (\Exception $e)
        {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
    //--------------------------------------------------------------------------
    public function show_gallery($id)
    {
        //dd($id);
     $Gallery_Photo= Gallery_Photo_Image::where('gallery_id',$id)->get();
     return view('pages.Photo_Gallery.show_gallery_image',compact('Gallery_Photo','id'));
    }
    //--------------------------------------------------------------------------
    public function add_gallery_images(Request $request,$id)
    {
        try{
            // dd($request->image);
             if(!empty($request->image)){
                 foreach($request->image as $imagee){
                   //  dd($photo);
                  $folder_namee='gallery_photo_images_no_'. $id;
                     //$photo_namee= ($imagee)->getClientOriginalName();
                     $photo_namee= str_replace(' ', '_',($imagee)->getClientOriginalName());
                    // dd($photo_namee);
                     ($imagee)->storeAs($folder_namee,$photo_namee,$disk="photo_gallery");
                        Gallery_Photo_Image::create([
                         'gallery_id'=>$id,
                         'image'=>$photo_namee,
                         
                     ]);
                   
                   
                 }
             }
 
             return redirect()->back()->with(['success'=>'تمت الاضافه بنجاح']);
         }catch(\Exception $e){
             return redirect()->back()->with(['error'=>$e->getMessage()]);
         }
    }
 //--------------------------------------------------------------------------
    public function delete_gallery_images(Request $request ,$id){
      
        $image_path=storage_path().'/app/public/photo_gallery/gallery_photo_images_no_'.$request->gallery_id.'/'.$request->deleted_image;
        unlink($image_path);
        Gallery_Photo_Image::findOrfail($id)->delete();
        return redirect()->back()->with(['success'=>'تم الحذف']);
    }
//--------------------------------------------------------------------------

    public function deleteAll(Request $request)
    {
    $all_ids = explode(',',$request->delete_all_id);
    // dd($all_ids);
    Photo_Gallery::whereIn('id',$all_ids)->delete();
    return redirect()->route('photo_gallery.index')->with(['success'=>'تم الحذف بنجاح']);
    }

}
