<?php

namespace App\Http\Repositories;
use App\Http\Interfaces\VideoInterface;
use App\Models\Video;
use App\Models\Sitesection;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Traits\TableAutoIncreamentTrait;
use toastr;
class VideoRepository implements VideoInterface{
    use TableAutoIncreamentTrait;
    //--------------------------------------------------------//
    public function index()
    {
         $data['title']='الفيديوهـات';
         $data['videos']=Video::withoutTrashed()->orderBy('sort','asc')->paginate(10);
        return view('pages.Video.Show',$data);

    }
    //-----------------------------------------------------------------------------//
    function search($request)
    {
    // dd($request->all());
        $data['title']  ='الفيديوهات';
        $search_text = $request->query_text;
        //dd($search_text);
        $data['videos']=Video::where('name_ar','LIKE','%'.$search_text.'%')->where('visible', '!=' , 0)->orderBy('sort','asc')->paginate(1);
        $searching_result=Video::where('name_ar','LIKE','%'.$search_text.'%')->where('visible', '!=' , 0)->get();
        $searching_count=$data['searching_count']=count($searching_result);
        // dd($searching_count);
        // return view('pages.products.show',compact('searching_result','title'));
        return view('pages.Sitesection.Sitesection',$data);

    }
    //--------------------------------------------------------//
    public function yajra_data($request)
    { 
    }
     
//--------------------------------------------------------//
    public function create(){
        $data['title']=' اضافه فيديو';
        $data['sections'] = Sitesection::where('parent_id', '=', Null)->where('visible', '!=' , 0)->get(); //get all parent section that not visible
        return view('pages.Video.add',$data);
    }
    //--------------------------------------------------------//
    public function store($request)
    {
        DB::beginTransaction(); //to handel multiple insertion
        try
        {
             //call trait to handel aut-increament
            $this->refreshTable('videos');
            //---------------store in videos table --------------------
            $video= new Video();
            $video->name_ar=$request->name_ar;
            $video->name_en=$request->name_en;
            $video->link=$request->link;
            $video->sort=$request->sort;
            $video->status= $request->status;
            $video->save();
            //---------------store in section all pages table -----------
            $video->rel_section()->attach($request->site_id,['type' => 'videos']);
            //-----------------------------------------------------------
            DB::commit();
            toastr()->success('تمت الاضافه بنجاح');
            return redirect()->route('video.index');
        }
        catch(\Exception $e)
        {
            DB::rollback();
            toastr()->error('حدث خطا اثناء الاضافه');
            return redirect()->back();   
        }
    }
    //--------------------------------------------------------//
    public function edit($id)
    {
        $real_id=decrypt($id);
        $data['title']=' تعديل فيديو';
        $data['video']= Video::findOrfail($real_id);
        $data['sections'] = Sitesection::where('parent_id', '=', Null)->where('visible', '!=' , 0)->get(); //get all parent section that not visible
        return view('pages.Video.edit',$data);
    }
    //--------------------------------------------------------//
    public function update($request)
    {
        DB::beginTransaction(); //to handel multiple insertion
     try {
            $real_id=decrypt($request->id);
            $videos = Video::findOrFail($real_id);
            //---------------update in videos table --------------------
            $videos-> name_ar= $request->name_ar;
            $videos->name_en = $request->name_en;
            $videos-> link = $request->link;
            $videos-> sort=$request->sort;
            $videos-> status=$request->status;
            $videos->save();
            //---------------update in section all pages table -----------
             $videos->rel_section()->syncWithPivotValues($request->site_id,['type' => 'videos']);
            //-----------------------------------------------------------
             DB::commit();
             toastr()->success('تم التعديل بنجاح');
            return redirect()->route('video.index');
        }
        catch(\Exception $e)
        {
            DB::rollback();
            toastr()->error('حدث خطا اثناء التعديل');
            return redirect()->back();
        }
    }   
    //--------------------------------------------------------//
    public function destroy($id)
    {
        try
        {
             //call trait to handel aut-increament
             $this->refreshTable('videos');
            $real_id=decrypt($id);
            Video::findOrfail($real_id)->delete();
            toastr()->success('تم الحذف بنجاح');
            return redirect()->route('video.index');
        }
        catch
        (\Exception $e)
        {
            toastr()->error('حدث خطا اثناء الحذف');
            return redirect()->back();
        }
    }
    //--------------------------------------------------------//
    public function bulkDelete($request){
        $all_ids = explode(',',$request->delete_all_id);
        //call trait to handel aut-increament
        $this->refreshTable('videos');  
        Video::whereIn('id',$all_ids)->delete();
        //-----------------anthor way -----------
       // foreach($all_ids as $id){
       //   if($id=='on'){}else{
       //    Section_All_Page::where('type_id',$id)->where('type','videos')->delete();
       //    Video::find($id)->delete();
       //   }
       //----------------------------------------
       toastr()->success('تم الحذف بنجاح');
       return redirect()->route('video.index');
    }
    //--------------------------------------------------------//
}
?>
