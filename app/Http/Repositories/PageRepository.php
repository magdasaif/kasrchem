<?php

namespace App\Http\Repositories;

use App\Models\Page;
use App\Models\Image;
use App\Models\Partner;
use App\Traits\ImageTrait;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Interfaces\PageInterface;
use App\Traits\TableAutoIncreamentTrait;

class PageRepository implements PageInterface{

    use TableAutoIncreamentTrait,ImageTrait;
    
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
                    // handel image array to pass image data to trait function
                    $imageData=[
                        'image_name'    => $photo,
                        'folder_name'   => 'page_no_'. $page->id,
                        'disk_name'     => 'pages',
                    ];
                    
                    //call to storeImage fun to save image in disk and return back with photo name
                    $photo_name2=$this->storeImage($imageData);
               
                     //start morph image for product sub images
                    Image::create([
                        'imageable_type'=>'App\Models\Page',
                        'imageable_id'=>$page->id,
                        'image_or_file'=>'1',//image
                        'main_or_sub'=>'2', //sub image
                        'filename'=>$photo_name2
                    ]);

                    //optimize image
                    $page->addMedia($photo)->toMediaCollection('pages');
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
        $page_data              = Page::findorfail($real_id);
        $data['Pages_images']   = $page_data->images;
       
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
                    // handel image array to pass image data to trait function
                    $imageData=[
                        'image_name'    => $photo,
                        'folder_name'   => 'page_no_'. $real_id,
                        'disk_name'     => 'pages',
                    ];
                    
                    //call to storeImage fun to save image in disk and return back with photo name
                    $photo_name=$this->storeImage($imageData);

                    //start morph image for product sub images
                    Image::create([
                        'imageable_type'=>'App\Models\Page',
                        'imageable_id'=>$real_id,
                        'image_or_file'=>'1',//image
                        'main_or_sub'=>'2', //sub image
                        'filename'=>$photo_name
                    ]);
                    
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
            // handel image array to pass image path to trait function
            $imageData=[
                'path'=>storage_path().'/app/public/pages/page_no_'.decrypt($request->page_id).'/'.$request->image_name,
            ];

            //call to unLinkImage fun to delete image from disk 
            $this->unLinkImage($imageData);
            Image::findOrfail($request->image_id)->delete();

            //call trait to handel aut-increament
            $this->refreshTable('images');
            
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
