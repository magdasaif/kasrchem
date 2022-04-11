<?php

namespace App\Http\Repositories;
use App\Http\Interfaces\BrancheInterface;
use App\Models\Branche;
use Yajra\DataTables\DataTables;
use App\Traits\TableAutoIncreamentTrait;
class BrancheRepository implements BrancheInterface{
    use TableAutoIncreamentTrait;
    //--------------------------------------------------------//
    public function index()
    {
         $data['title']='قائمه الفروع';
         $data['branches']=Branche::withoutTrashed()->orderBy('sort','asc')->paginate(10);
        return view('pages.branches.show',$data); }
    //--------------------------------------------------------//
    public function yajra_data($request)
    { 
    }
     
    //--------------------------------------------------------//
    public function create(){
        $data['title']='اضافه الفروع';
        return view('pages.branches.add',$data);
    }
    //--------------------------------------------------------//
    public function store($request)
    {
        //dd($request->all());
        try{
            //vaildation
           //$validated = $request->validated();

           //call trait to handel aut-increament
            $this->refreshTable('branches');
        
            $branche =new Branche();

            $branche->name_ar=$request->name_ar;
            $branche->name_en=$request->name_en;
            $branche->address_ar=$request->address_ar;
            $branche->address_en=$request->address_en;
            $branche->status= $request->status;
            $branche->sort= $request->sort;
            if( $request->email==null)
            { $branche->email=''; } else {$branche->email= $request->email;}

            if( $request->phone==null)
            { $branche->phone='';} else{$branche->phone= $request->phone;}
            
            if( $request->fax==null){ $branche->fax=''; }else{$branche->fax= $request->fax;}
           
            $branche->latitude= $request->latitude;
            $branche->longitude= $request->longitude;

            $branche->save();
            return redirect()->route('branches.index')->with(['success'=>'تمت الاضافه بنجاح']);
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
        $data['title']='تعديل فرع';
        $data['branch']= Branche::findOrfail($real_id);
        return view('pages.branches.edit',$data);
    }
    //--------------------------------------------------------//
    public function update($request){
        // dd($request->all());
        try{
            $real_id=decrypt($request->id);
            $branche =Branche::findOrfail($real_id);

            $branche->name_ar=$request->name_ar;
            $branche->name_en=$request->name_en;
            $branche->address_ar=$request->address_ar;
            $branche->address_en=$request->address_en;
            $branche->status= $request->status;
            $branche->sort= $request->sort;
           if( $request->email==null){ $branche->email='';}else{$branche->email= $request->email;}
           if( $request->phone==null){ $branche->phone='';}else{ $branche->phone= $request->phone;}
           if( $request->fax==null){ $branche->fax='';}else { $branche->fax= $request->fax;}
            $branche->latitude= $request->latitude;
            $branche->longitude= $request->longitude;
            $branche->save();
            return redirect()->route('branches.index')->with(['success'=>'تم التعديل بنجاح']);
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
        Branche::findOrfail($real_id)->delete();
          //call trait to handel aut-increament
          $this->refreshTable('branches');
        return redirect()->route('branches.index')->with(['success'=>'تم الحذف بنجاح']);
    }
    //--------------------------------------------------------//
    public function bulkDelete($request)
    {
       $all_ids = explode(',',$request->delete_all_id);
       // dd($all_ids);
         Branche::whereIn('id',$all_ids)->delete();
       //call trait to handel aut-increament
         $this->refreshTable('branches');
          return redirect()->route('branches.index')->with(['success'=>'تم الحذف بنجاح']);
    }
    //--------------------------------------------------------//
}
?>
