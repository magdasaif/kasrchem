<?php

namespace App\Http\Controllers\SocialLinks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Social;
use App\Http\Requests\SocialRequest;

class SocialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title='وسائل التواصل';
        $socialLinks=Social::all();
        return view('pages.social_links.show',compact('title','socialLinks'));

    }

    public function create()
    {
        $title=' اضافه رابط';
        return view('pages.social_links.add',compact('title'));
    }

    public function store(SocialRequest $request)
    {
        try{
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
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

   
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $title=' تعديل رابط';
        $social= Social::findOrfail($id);
        return view('pages.social_links.edit',compact('title','social'));
    }

    public function update(SocialRequest $request)
    {
        try{
            //vaildation
           $validated = $request->validated();
           
            $social =Social::findOrfail($request->id);

            $social->name=$request->name;
            $social->link=$request->link;
            $social->icon=$request->icon;
            $social->status= $request->status;

            $social->save();


            //toastr()->success('تمت الاضافه بنجاح');

            return redirect()->route('social.index')->with(['success'=>'تمت الاضافه بنجاح']);
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        Social::findOrfail($id)->delete();
        return redirect()->route('social.index')->with(['success'=>'تم الحذف بنجاح']);

    }
}
