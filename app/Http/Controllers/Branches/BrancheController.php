<?php

namespace App\Http\Controllers\Branches;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branche;
use App\Http\Requests\BranchRequest;
use App\Traits\TableAutoIncreamentTrait;
class BrancheController extends Controller
{
    use TableAutoIncreamentTrait;

    public function index()
    {
        $title='قائمه الفروع';
        $branches=Branche::orderBy('id','desc')->get();;
        return view('pages.branches.show',compact('branches','title'));
        
    }

    public function create()
    {
        $title='اضافه الفروع';
        return view('pages.branches.add',compact('title'));
    }

    public function store(BranchRequest $request)
    {
       //dd($request->all());
        try{
            //vaildation
           $validated = $request->validated();

           //call trait to handel aut-increament
            $this->refreshTable('branches');
        
            $branche =new Branche();

            $branche->name_ar=$request->name_ar;
            $branche->name_en=$request->name_en;
            $branche->address_ar=$request->address_ar;
            $branche->address_en=$request->address_en;
            $branche->status= $request->status;
            if( $request->email==null)
            {
                $branche->email='';
            }
            else
            {
              $branche->email= $request->email;
            }

            if( $request->phone==null)
            {
                $branche->phone='';
            }
            else
            {
                $branche->phone= $request->phone;
            }
            
            if( $request->fax==null)
            {
                $branche->fax='';
            }
            else
            {
                $branche->fax= $request->fax;
            }
           
            $branche->latitude= $request->map_lat;
            $branche->longitude= $request->map_long;

            $branche->save();


            //toastr()->success('تمت الاضافه بنجاح');

            return redirect()->route('branches.index')->with(['success'=>'تمت الاضافه بنجاح']);
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
       $branch = Branche::findOrfail($id);
       $title=' تعديل فرع';
       return view('pages.branches.edit',compact('title','branch'));
    }

    
    public function update(BranchRequest $request)
    {
       // dd($request->all());
        try{
            //vaildation
           $validated = $request->validated();
           
            $branche =Branche::findOrfail($request->id);

            $branche->name_ar=$request->name_ar;
            $branche->name_en=$request->name_en;
            $branche->address_ar=$request->address_ar;
            $branche->address_en=$request->address_en;
            $branche->status= $request->status;
           // $branche->email= $request->email;
          //  $branche->phone= $request->phone;
           // $branche->fax= $request->fax;
           if( $request->email==null)
           {
               $branche->email='';
           }
           else
           {
             $branche->email= $request->email;
           }

           if( $request->phone==null)
           {
               $branche->phone='';
           }
           else
           {
               $branche->phone= $request->phone;
           }
           
           if( $request->fax==null)
           {
               $branche->fax='';
           }
           else
           {
               $branche->fax= $request->fax;
           }
          
            $branche->latitude= $request->map_lat;
            $branche->longitude= $request->map_long;

            $branche->save();


            //toastr()->success('تمت الاضافه بنجاح');

            return redirect()->route('branches.index')->with(['success'=>'تم التعديل بنجاح']);
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        Branche::findOrfail($id)->delete();

        //call trait to handel aut-increament
         $this->refreshTable('branches');
         
        return redirect()->route('branches.index')->with(['success'=>'تم الحذف بنجاح']);

    }

     
    public function deleteAll(Request $request)
    {
      $all_ids = explode(',',$request->delete_all_id);
     // dd($all_ids);
     Branche::whereIn('id',$all_ids)->delete();
     
        //call trait to handel aut-increament
        $this->refreshTable('branches');
        
     return redirect()->route('branches.index')->with(['success'=>'تم الحذف بنجاح']);
    }
    
}
