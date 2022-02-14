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

        $sub_Category4      = Sub_Category4::get(); 
        $sub_Category3      = Sub_Category3::get(); 
        $Sub_Category2      = Sub_Category2::get();
        $Main_Cat	    = Main_Category::get();
        $sections           = Sitesection::get();
        return view('pages.Video.add',compact('Main_Cat','sub_Category4','sub_Category3','Sub_Category2','sections'));
    }
   //--------------------------------------------
    public function store(VideoRequest $request)
    {
       //dd($request->all());
       try{
         $validated = $request->validated();
             $video= new Video
           ([
            'main_cate_id' =>  $request->main_category,
            'sub1_id' =>  $request->sub2,
            'sub2_id' =>  $request->sub3,
            'sub3_id' =>  $request->sub4,
            'title_ar' =>  $request->title_ar,
            'title_en' =>  $request->title_en,
            'link' =>  $request->link,
            'status' =>  $request->status,
           ]);
        $video->save();

            return redirect()->route('video.index')->with(['success'=>'تمت الاضافه بنجاح']);
        }
        catch(\Exception $e){
            return redirect()->back()->with(['error'=>$e->getMessage()]);
        }
    }


//--------------------------------------------
public function edit($id)
{
    $video = Video::findOrfail($id);
    if(!$video) return redirect()->back();
   $Main_Cat = Main_Category::withCount('sub_cate2')->get();
   $Sub_Category4 = Sub_Category4::get();
   $Sub_Category3=Sub_Category3:: whereIn('id',  $Sub_Category4)->get();
   $Sub_Category2= Sub_Category2::  whereIn('id',  $Sub_Category3)->get();
    return view('pages.Video.edit',compact('video','Main_Cat','Sub_Category2','Sub_Category3','Sub_Category4'));
}

//--------------------------------------------
    public function update(VideoRequest $request)
    {
         //dd( $request->all());
         try {

            $validated = $request->validated();
            $Video = Video::findOrFail($request->id);
              $Video->main_cate_id = $request->main_category;
             $Video->sub1_id =  $request->sub2;
            $Video->sub2_id = $request->sub3;
            $Video->sub3_id=  $request->sub4;
            $Video-> title_ar= $request->title_ar;
            $Video->title_en = $request->title_en;
            $Video-> link = $request->link;
            $Video-> status=$request->status;

       $Video->save();
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

}
