<?php

namespace App\Http\Controllers\Partners;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Partner;
use App\Http\Requests\PartnerRequest;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title='الشركاء';
        $partners=Partner::orderBy('id','desc')->get();
         return view('pages.partners.show',compact('partners','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title='اضافه شريك';
         return view('pages.partners.add',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PartnerRequest $request)
    {
        try{
            //vaildation
           $validated = $request->validated();
            
           if($request->image){
                $folder_name='';
                $photo_name= ($request->image)->getClientOriginalName();
                ($request->image)->storeAs($folder_name,$photo_name,$disk="partners");
           }else{
               $photo_name='';
           }

           //when using trait
           //$file_name = $this->saveImage($request->image, 'images/categories');

            $partner =new Partner();

            $partner->name_ar=$request->name_ar;
            $partner->name_en=$request->name_en;
            $partner->status= $request->status;
            $partner->external_link= $request->external_link;
            $partner->image= $photo_name;

            $partner->save();


            //toastr()->success('تمت الاضافه بنجاح');

            return redirect()->route('partner.index')->with(['success'=>'تمت الاضافه بنجاح']);
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
        $partner=Partner::findOrfail($id);
        $title='تعديل شريك';
         return view('pages.partners.edit',compact('title','partner'));
    }

    public function update(PartnerRequest $request)
    {
        try{
            //vaildation
           $validated = $request->validated();

           $partner=Partner::findOrfail($request->id);

           if($request->image){
                $folder_name='';
                $photo_name= ($request->image)->getClientOriginalName();
                ($request->image)->storeAs($folder_name,$photo_name,$disk="partners");
                $partner->image= $photo_name;
           }
            
            $partner->name_ar=$request->name_ar;
            $partner->name_en=$request->name_en;
            $partner->status= $request->status;
            $partner->external_link= $request->external_link;

            $partner->save();


            //toastr()->success('تمت الاضافه بنجاح');

            return redirect()->route('partner.index')->with(['success'=>'تم التعديل بنجاح']);
        }catch(\Exception $e){
            return redirect()->back()->with(['error'=>$e->getMessage()]);
        }
    }

    
    public function destroy($id)
    {
      //  dd($id);
        Partner::findOrfail($id)->delete();
        return redirect()->route('partner.index')->with(['success'=>'تم الحذف ']);

    }
}
