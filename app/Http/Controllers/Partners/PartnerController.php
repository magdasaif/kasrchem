<?php

namespace App\Http\Controllers\Partners;

use App\Models\Partner;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\PartnerRequest;

use App\Traits\TableAutoIncreamentTrait;
use App\Http\Interfaces\PartnerInterface;

class PartnerController extends Controller
{
    use TableAutoIncreamentTrait;
   
    protected $xx;
    public function __construct(PartnerInterface $y) {
        $this->xx = $y;
    }
    
    public function index()
    {
        return $this->xx->index();
    }

    public function yajra_data(Request $request)
    {
        //dd('ffff');
        return $this->xx->yajra_data($request);
       
    }
    public function create()
    {
        $title='اضافه شريك';
         return view('pages.partners.add',compact('title'));
    }

    
    public function store(PartnerRequest $request)
    {
        try{
            //vaildation
           $validated = $request->validated();

            //call trait to handel aut-increament
             $this->refreshTable('partners');
    
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

        //call trait to handel aut-increament
        $this->refreshTable('partners');
        
        return redirect()->route('partner.index')->with(['success'=>'تم الحذف ']);

    }

    
  public function deleteAll(Request $request)
  {
    $all_ids = explode(',',$request->delete_all_id);
   // dd($all_ids);
   Partner::whereIn('id',$all_ids)->delete();

    //call trait to handel aut-increament
    $this->refreshTable('partners');
    
   return redirect()->route('partner.index')->with(['success'=>'تم الحذف بنجاح']);
  }

}
