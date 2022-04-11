<?php

namespace App\Http\Repositories;
use App\Http\Interfaces\SocialInterface;
use App\Models\Social;
use Yajra\DataTables\DataTables;

class SocialRepository implements SocialInterface{
    //--------------------------------------------------------//
    public function index()
    {
         $data['title']='وسائل التواصل';
         $data['socialLinks']=Social::orderBy('id','desc')->paginate(10);
        return view('pages.social_links.show',$data);

    }
    //--------------------------------------------------------//
    public function yajra_data($request)
    { 
    }
     
//--------------------------------------------------------//
    public function create(){
        $data['title']=' اضافه رابط';
        return view('pages.social_links.add',$data);
    }
    //--------------------------------------------------------//
    public function store($request)
    {
        try
        {
            //vaildation
           $validated = $request->validated();
           
            $social =new Social();
            $social->name=$request->name;
            $social->link=$request->link;
            $social->icon=$request->icon;
            $social->status= $request->status;
            $social->save();
            //toastr()->success('تمت الاضافه بنجاح');

            return redirect()->route('social.index')->with(['success'=>'تمت الاضافه بنجاح']);
        }
        catch(\Exception $e)
        {
            return redirect()->back()->withErrors(['error' =>'حدث خطا اثناء الاضافه']);
        }
    }
    //--------------------------------------------------------//
    public function edit($id)
    {
        $real_id=decrypt($id);
        $data['title']=' تعديل رابط';
        $data['social']= Social::findOrfail($real_id);
        return view('pages.social_links.edit',$data);
    }
    //--------------------------------------------------------//
    public function update($request){
        try
        {
           // $validated = $request->validated();
           $real_id=decrypt($request->id);
            $social =Social::findOrfail($real_id);
            $social->name=$request->name;
            $social->link=$request->link;
            $social->icon=$request->icon;
            $social->status= $request->status;
            $social->save();
            return redirect()->route('social.index')->with(['success'=>'تم التعديل بنجاح']);
        }
        catch(\Exception $e)
        {
            return redirect()->back()->withErrors([ 'error' =>'حدث خطا اثناء التعديل']);
        }
    }
    //--------------------------------------------------------//
    public function destroy($id)
    {
        $real_id=decrypt($id);
        Social::findOrfail($real_id)->delete();
        return redirect()->route('social.index')->with(['success'=>'تم الحذف بنجاح']);
    }
    //--------------------------------------------------------//
    public function bulkDelete($request){
        $all_ids = explode(',',$request->delete_all_id);
        // dd($all_ids);
        Social::whereIn('id',$all_ids)->delete();
        return redirect()->route('social.index')->with(['success'=>'تم الحذف بنجاح']);
    }
    //--------------------------------------------------------//
}
?>
