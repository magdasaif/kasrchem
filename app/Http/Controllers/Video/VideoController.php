<?php

namespace App\Http\Controllers\Video;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\VideoRequest;
use App\Models\Video;

use App\Models\Sitesection;
use App\Models\Main_Category;
use App\Models\Sub_Category2;
use App\Models\Sub_Category3;
use App\Models\Sub_Category4;

class VideoController extends Controller
{

    public function index()
    {
        $Vid=Video::orderBy('id','desc')->get();

         return view('pages.Video.Show',compact('Vid'));
    }
//--------------------------------------------
 public function create()
    {
      //  $Main_Cat = Main_Category::withCount('sub_cate2')->get();
         //++++++++++++++++++++new for unrequired++++++++++++++++++++//
         //visible', '!=' , 0 هيعرضلى على التصنيفات والاقسام اللى ال 
        $sub_Category4   = Sub_Category4::where('visible', '!=' , 0)->get(); 
        $sub_Category3   = Sub_Category3::where('visible', '!=' ,0)->get(); 
        $Sub_Category2 = Sub_Category2::where('visible', '!=' , 0)->get();
        $Main_Cat	= Main_Category::where('visible', '!=' , 0)->get();
        $sections  = Sitesection::where('visible', '!=' , 0)->where('parent_id', '=', Null)->get();
        //-++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//
        return view('pages.Video.add',compact('Main_Cat','sub_Category4','sub_Category3','Sub_Category2','sections'));
    }
   //--------------------------------------------
    public function store(VideoRequest $request)
    {
      //dd($request->all());
       try{
         $validated = $request->validated();
             $video= new Video();
            
//---"!$request"=> علشان لو ظاهر جزء اضف تصنيف يحفظ بالقيمة 1 كانه مختارش حاجة++++++++++//
          
            if(!$request->section_id)
            {
                $video->site_id= 1;
            }
            else
            {
                $video->site_id= $request->section_id; 
            }

            if(!$request->main_category)
            {
                $video->main_cate_id=1;
            }
            else
            {
                $video->main_cate_id= $request->main_category; 
            }

            if(!$request->sub2)
            {
                $video->sub1_id= 1;
           
            }
            else
            {
                $video->sub1_id= $request->sub2; 
            }

            if(!$request->sub3)
            {
                $video->sub2_id=1;
            }
            else
            {
                $video->sub2_id=$request->sub3; 
            }
            if(!$request->sub4)
            {
                $video->sub3_id=1;
            }
            else
            {
                $video->sub3_id= $request->sub4; 
            }
            $video->title_ar=$request->title_ar;
            $video->title_en=$request->title_en;
            $video->link=$request->link;
            $video->status=$request->status;
           
          
//++++++++++++++++++++++++++++++++++++++++++//
           /* ([
          'main_cate_id' =>  $request->main_category,
            'sub1_id' =>  $request->sub2,
            'sub2_id' =>  $request->sub3,
            'sub3_id' =>  $request->sub4,
            'title_ar' =>  $request->title_ar,
            'title_en' =>  $request->title_en,
            'link' =>  $request->link,
            'status' =>  $request->status,
           ]);*/
        $video->save();
        $video->rel_section()->attach($request->site_id,['type' => 'videos']);
            return redirect()->route('video.index')->with(['success'=>'تمت الاضافه بنجاح']);
        }
        catch(\Exception $e){
            return redirect()->back()->with(['error'=>$e->getMessage()]);
        }
    }


//--------------------------------------------
public function edit($id)
{
   // dd(Video::findOrfail($id));
    $video = Video::findOrfail($id);
    if(!$video) return redirect()->back();
 //+++++++++++++++++++++++++new for unrequired+++++++++++++++++++++++++//
    $sections = Sitesection::where('visible', '!=' , 0)->where('parent_id', '=', Null)->where('id','!=',$id)->get();
    $Main_Cat = Main_Category::where('visible', '!=' , 0)->get();
    $Sub_Category4 = Sub_Category4::where('visible', '!=' , 0)->get();
    $Sub_Category3 = Sub_Category3::where('visible', '!=' , 0)->get();
    $Sub_Category2 = Sub_Category2::where('visible', '!=' , 0)->get();
   // dd($video->main_cate_id);
  //  dd(Main_Category::findOrfail(4));
  
  //--------------------لغيناه علشان مش هنجيب القسم من  التصنيف الرئيسى ضفتله كولوم فى الداتا بيز<--sالمتغير--------------//
 /* if($video->main_cate_id==1 )
  {
   // dd(Main_Category::findOrfail($video->main_cate_id));
    $main_categories_0 = Main_Category::findOrfail($video->main_cate_id);
   // dd($main_categories_0);
    if($main_categories_0->visible==0)
    {
         //to retrive value of section-->اختر
        $main_categories = Main_Category::first(); 
        // $main_categories = Main_Category::where('visible','=',0)->get();
        // $s = Sitesection::where('visible','=',0)->get(); 
         $s = Sitesection::first(); 
         return view('pages.Video.edit',compact('s','sections','video','Main_Cat','Sub_Category2','Sub_Category3','Sub_Category4'));
     
    }
    else
    {
         //to retrive value of section
        $main_categories = Main_Category::findOrfail($video->main_cate_id);
       $s = Sitesection::findOrfail($main_categories->section_id);
      return view('pages.Video.edit',compact('s','sections','video','Main_Cat','Sub_Category2','Sub_Category3','Sub_Category4')); 
    }
  
  }
  else
  {
       //to retrive value of section
    $main_categories = Main_Category::findOrfail($video->main_cate_id);
    $s = Sitesection::findOrfail($main_categories->section_id);
    return view('pages.Video.edit',compact('s','sections','video','Main_Cat','Sub_Category2','Sub_Category3','Sub_Category4'));

  }*/
    //---+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++--// 
    return view('pages.Video.edit',compact('sections','video','Main_Cat','Sub_Category2','Sub_Category3','Sub_Category4'));

}

//--------------------------------------------
    public function update(VideoRequest $request)
    {
        //dd( $request->all());
         try {

            $validated = $request->validated();
            $Video = Video::findOrFail($request->id);
             // $Video->main_cate_id = $request->main_category;
              //+++++++++++++++++++ علشان لو ظاهر جزء اضف تصنيف يخلى الحاجة ظى قيمتها بصفر ++++++++++++++++++++++//
            if(!$request->section_id)
            {
                $Video->site_id=1;
            }
            else
            {
                $Video->site_id=$request->section_id; 
            }
            if(!$request->main_cate_id)
            {
                $Video->main_cate_id=1;
                
            }
            else
            {
                $Video->main_cate_id=$request->main_cate_id;
            }

            if(!$request->sub2)
            {
                $Video->sub1_id=1;
            }
            else
            {
                $Video->sub1_id=$request->sub2; 
            }
            if(!$request->sub3)
            {
                $Video->sub2_id=1;
            }
            else
            {
                $Video->sub2_id=$request->sub3; 
            }
            if(!$request->sub4)
            {
                $Video->sub3_id=1;
            }
            else
            {
                $Video->sub3_id=$request->sub4; 
            }

            //++++++++++++++++++++++++++++++++++++++++++//
              /*$Video->main_cate_id = $request->main_cate_id;
             $Video->sub1_id =  $request->sub2;
            $Video->sub2_id = $request->sub3;
            $Video->sub3_id=  $request->sub4;*/
            $Video-> title_ar= $request->title_ar;
            $Video->title_en = $request->title_en;
            $Video-> link = $request->link;
            $Video-> status=$request->status;

       $Video->save();
       if(isset($request->site_id)){
        $Video->rel_section()->sync($request->site_id,['type' => 'videos']);
    }else{
        $Video->rel_section()->sync();
    }
      return redirect()->route('video.index')->with(['success'=>'تم التعديل بنجاح']);
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
            $Video=Video::find($id);
            $Video->delete();
            return redirect()->route('video.index')->with(['success'=>'تم الحذف بنجاح']);
        }
        catch
        (\Exception $e)
        {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function deleteAll(Request $request)
    {
      $all_ids = explode(',',$request->delete_all_id);
     // dd($all_ids);
     Video::whereIn('id',$all_ids)->delete();
     return redirect()->route('video.index')->with(['success'=>'تم الحذف بنجاح']);
    }

}
