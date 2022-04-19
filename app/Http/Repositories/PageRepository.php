<?php

namespace App\Http\Repositories;

use App\Models\Page;
use App\Traits\ImageTrait;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Interfaces\PageInterface;
use App\Traits\TableAutoIncreamentTrait;
use App\Traits\MediaTrait;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class PageRepository implements PageInterface{

    use TableAutoIncreamentTrait,ImageTrait,MediaTrait;
    
    public function index(){
        $data['Page']=Page::withoutTrashed()->orderBy('sort','asc')->paginate(10);
        return view('pages.pages.Show',$data);
    }
    //---------------------------------------------------------------------------

    public function create(){
        $data['title']='اضافه صفحه';
        return view('pages.pages.add',$data);
    }
    //---------------------------------------------------------------------------
    public function store($request){
       //to handel multiple insertion
       DB::beginTransaction();
       
       try{
            //call trait to handel aut-increament
            $this->refreshTable('pages');
     
            $page = new Page
            ([
            
                'name_ar'        =>  $request->name_ar,
                'name_en'        =>  $request->name_en,
                'description_ar' =>  $request->description_ar,
                'description_en' =>  $request->description_en,
                'content_ar'     =>  $request->content_ar,
                'content_en'     =>  $request->content_en,
                'sort'           =>  $request->sort,
                'status'         =>  $request->status,
            ]);
            
            $page->save();

            if(!empty($request->photos)){
                foreach($request->photos as $photo){
                    //optimize image
                    $page->addMedia($photo)->toMediaCollection('sub_pages');
                }
            }
            
            DB::commit();
             toastr()->success('تمت الاضافه بنجاح');
             return redirect()->route('page.index')->with(['success'=>'تمت الاضافه بنجاح']);

        }catch(\Exception $e){

            DB::rollback();
            toastr()->error('حدث خطا اثناء الاضافه');
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
           // return redirect()->back()->withErrors(['error'=>'حدث خطا اثناء الاضافه']);
        }
    }
    //----------------------------------------------------------------------------
    public function edit($id){
        
        $real_id=decrypt($id);
        
        $data['page']       = Page::findOrfail($real_id);
        $data['title']      ='تعديل صفحه';

        //this will retrevie all images for collection 'sub_pages'
		$data['Pages_images'] = Page::find($real_id)->getMedia('sub_pages');
        
         return view('pages.pages.edit',$data);
        
    }
    //-----------------------------------------------------------------------------
    public function update($request){       
        try 
        {
            $real_id=decrypt($request->id);
            $Page = Page::findOrFail($real_id);
            
            $Page->name_ar          = $request->name_ar;
            $Page->name_en          = $request->name_en;
            $Page->description_ar   = $request->description_ar;
            $Page->description_en   = $request->description_en;
            $Page->content_ar       = $request->content_ar;
            $Page->content_en       = $request->content_en;
            $Page->sort             = $request->sort;
            $Page->status           = $request->status;
            $Page->save();

           toastr()->success('تم التعديل بنجاح');
           return redirect()->route('page.index')->with(['success'=>'تم التعديل بنجاح']);

      }catch(\Exception $e){

          toastr()->error('حدث خطا اثناء التعديل');
          return redirect()->route('page.index')->with(['success'=>'حدث خطا اثناء التعديل']);
      }
  
    }
    //-----------------------------------------------------------------------------
    public function pages_images($page_id){

        $real_id=decrypt($page_id);
        
        $data['title']          ='الصور الفرعيه';
        $data['page_id']        = $real_id;

        //this will retrevie all images for collection 'sub_pages'
		$data['Pages_images']   = Page::find($real_id)->getMedia('sub_pages');
               
       return view('pages.Pages.images',$data);
    }
    //-----------------------------------------------------------------------------
    public function add_page_images($request,$page_id){
       
         try{
            //decrypt page_id which is encryptrd
            $real_id=decrypt($page_id);
            $page=Page::findOrfail($real_id);
          //  dd($real_id);
            if(!empty($request->photos)){
                foreach($request->photos as $photo){
                    //optimize image
                    $page->addMedia($photo)->toMediaCollection('sub_pages');
                }
            }

            toastr()->success('تمت الاضافه بنجاح');
            return redirect()->back()->with(['success'=>'تمت الاضافه بنجاح']);

       }catch(\Exception $e){
           toastr()->error('حدث خطا اثناء الاضافه');
           return redirect()->back()->with(['error'=>'حدث خطا اثناء الاضافه']);
       }
    }
    //-----------------------------------------------------------------------------
    public function delete_page_images($request){
        //dd($request->all());
        try{
           
            Media::findOrfail($request->media_id)->delete();
            //call trait to handel aut-increament
            $this->refreshTable('media');
            
            toastr()->success('تم الحذف بنجاح');
            return redirect()->back()->with(['success'=>'تم الحذف']);
        }catch(\Exception $e){
            toastr()->error('حدث خطا اثناء الحذف');
            return redirect()->back()->with(['error'=>'حدث خطا اثناء الحذف']);
        }
    
    }
    //-----------------------------------------------------------------------------
    public function destroy($id){
        try 
        {
            $real_id=decrypt($id);
            Page::findOrfail($real_id)->delete();
            //call trait to handel aut-increament
            $this->refreshTable('pages');
            toastr()->error('تم الحذف');
            return redirect()->route('page.index')->with(['success'=>'تم الحذف ']);
        }
       catch(\Exception $e)
       {
           toastr()->error(' حدث خطا اثناء الحذف');
           return redirect()->back()->with(['error' =>' حدث خطا اثناء الحذف']);
       }
    }
    //------------------------------------------------------------------------------
    public function bulkDelete($request){

        $all_ids = explode(',',$request->delete_all_id);
        // dd($all_ids);
        Page::whereIn('id',$all_ids)->delete();
     
         //call trait to handel aut-increament
         $this->refreshTable('pages');
         
         toastr()->error('تم الحذف');
         return redirect()->route('page.index')->with(['success'=>'تم الحذف ']);
     }

     //------------------------------------------------------------------------------
    public function yajra_data($request){

     }
}
?>
