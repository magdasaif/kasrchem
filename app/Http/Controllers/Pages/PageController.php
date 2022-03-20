<?php
namespace App\Http\Controllers\Pages;
use App\Models\Page;
use App\Models\PageImage;
use Illuminate\Http\Request;
use App\Http\Requests\PageRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function index()
    {
        $Page=Page::orderBy('id','desc')->get();
         return view('pages.Pages.Show',compact('Page'));
    }
//--------------------------------------------
 public function create()
    {
        return view('pages.Pages.add');
    }
  //--------------------------------------------
    public function store(PageRequest $request)
    {
       //dd($request->all());
       
       //to handel multiple insertion
       DB::beginTransaction();
       
       try{
            $validated = $request->validated();
            
            $page = new Page
            ([
            
                'title_ar' =>  $request->title_ar,
                'title_en' =>  $request->title_en,
                'description_ar' =>  $request->description_ar,
                'description_en' =>  $request->description_en,
                'content_ar' =>  $request->content_ar,
                'content_en' =>  $request->content_en,
                'status' =>  $request->status,
            ]);
            
            $page->save();

            //insert multiple page  images
            if(!empty($request->photos)){
                foreach($request->photos as $photo){

                    $folder_name0='page_no_'. $page->id;
                    $photo_name0= str_replace(' ', '_',($photo)->getClientOriginalName());
                    ($photo)->storeAs($folder_name0,$photo_name0,$disk="pages");

                    PageImage::create([
                        'image'=>$photo_name0,
                        'page_id'=>$page->id
                        // 'page_id'=>Page::latest()->first()->id
                    ]);
                }
            }
             DB::commit();
            return redirect()->route('page.index')->with(['success'=>'تمت الاضافه بنجاح']);
        }
        catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->with(['error'=>$e->getMessage()]);
        }
    }

//--------------------------------------------
    public function edit($id)
    {
        $page = Page::findOrfail($id);
        if(!$page) return redirect()->back();
         return view('pages.Pages.edit',compact('page'));
    }
//--------------------------------------------
    public function update(PageRequest $request)
    {
         //dd( $request->all());
         try 
        {

            $validated = $request->validated();
            $Page = Page::findOrFail($request->id);
            $Page-> title_ar= $request->title_ar;
            $Page->title_en = $request->title_en;
            $Page-> description_ar= $request->description_ar;
            $Page->description_en = $request->description_en;
            $Page-> content_ar = $request->content_ar;
            $Page->content_en = $request->content_en;
            $Page-> status=$request->status;
            $Page->save();
           return redirect()->route('page.index')->with(['success'=>'تم التعديل بنجاح']);
        }
        catch
        (\Exception $e) 
        {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
//----------------------------------------------------------
    public function destroy($id)
    {
      try 
        {
            //remove page images from folder in disk and then remove folder
            if(file_exists(storage_path().'/app/public/pages/page_no_'.$id)){
                $handle = opendir(storage_path().'/app/public/pages/page_no_'.$id);

                while($file = readdir($handle)){
                    if($file !== '.' && $file !== '..'){
                        unlink(storage_path().'/app/public/pages/page_no_'.$id.'/'.$file);// delete file
                    }
                }
                rmdir(storage_path().'/app/public/pages/page_no_'.$id);
            }

            //delete images of page in db
            $all_imgs=PageImage::where('page_id',$id)->pluck('id');
            if($all_imgs){
                PageImage::whereIn('id',$all_imgs)->delete();
            }
            
            //remove page
            Page::findOrfail($id)->delete();
            
            return redirect()->route('page.index')->with(['success'=>'تم الحذف بنجاح']);
        }
       catch(\Exception $e)
       {
           return redirect()->back()->with(['error' => $e->getMessage()]);
       }
    }

    public function deleteAll(Request $request)
    {
      $all_ids = explode(',',$request->delete_all_id);
     // dd($all_ids);
     Page::whereIn('id',$all_ids)->delete();
     return redirect()->route('page.index')->with(['success'=>'تم الحذف بنجاح']);
    }

  // --------------start pages images funcrion -----------------------
  public function pages_images($page_id)
  {
        $title='الصور الفرعيه';
       $Pages_images = PageImage::where([
          ['page_id', '=', $page_id],
      ])->get();
       return view('pages.Pages.images',compact('Pages_images','page_id','title'));
  }
  //-----------------------------------------------------------------------------//
  public function add_page_images(Request $request,$page_id){
      try{
         // dd($request->photos);
          if(!empty($request->photos)){
              foreach($request->photos as $photo){
                //  dd($photo);
                  $folder_name0='page_no_'. $page_id;
                  // dd($last_id->id,$folder_name);
                  $photo_name0= str_replace(' ', '_',($photo)->getClientOriginalName());
                  ($photo)->storeAs($folder_name0,$photo_name0,$disk="pages");

                  PageImage::create([
                      'image'=>$photo_name0,
                      'page_id'=>$page_id
                  ]);
              }
          }

          return redirect()->back()->with(['success'=>'تمت الاضافه بنجاح']);
      }catch(\Exception $e){
          return redirect()->back()->with(['error'=>$e->getMessage()]);
      }
  }
//-----------------------------------------------------------------------------//
  public function delete_page_images(Request $request){

      //dd($request->page_id);
      if(file_exists(storage_path().'/app/public/pages/page_no_'.$request->page_id.'/'.$request->image_name)){
          unlink(storage_path().'/app/public/pages/page_no_'.$request->page_id.'/'.$request->image_name);
      }
      
      PageImage::findOrfail($request->id)->delete();
      return redirect()->back()->with(['success'=>'تم الحذف']);
  }
  // --------------end pages images funcrion -----------------------

    
}
