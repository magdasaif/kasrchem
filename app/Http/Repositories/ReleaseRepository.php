<?php

namespace App\Http\Repositories;
use toastr;
use App\Models\Image;
use App\Models\Release;
use App\Traits\ImageTrait;
use App\Models\Sitesection;
use App\Models\Section_All_Page;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Traits\TableAutoIncreamentTrait;
use App\Http\Interfaces\ReleaseInterface;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Traits\MediaTrait;
class ReleaseRepository implements ReleaseInterface{
    use TableAutoIncreamentTrait,ImageTrait,MediaTrait;
    //----------------------show release function----------------------------------//
    public function index()
    {
        $data['releases']= Release::withoutTrashed()->orderBy('sort','asc')->paginate(10);
        $data['title']='النشرات';
        return view('pages.Release.Show', $data);
    }
    //-----------------------------------------------------------------------------//
    function search($request)
    {
        if($request->ajax())
        {
            $data['title']='النشرات';
            $search_text = $request->get('query');
            $data['searching']="search";
            $data['releases']=Release::withoutTrashed()
            ->where('name_ar','LIKE','%'.$search_text.'%')
            ->orWhere('name_en', 'like', '%'.$search_text.'%')
            ->orWhere('sort', 'like', '%'.$search_text.'%')
            ->paginate(10);
           return view('pages.Release.paginate_release',$data)->render();   
        }
    }
    //------------------------create adding form ---------------------------------//
    public function create()
    {
        $data['sections']= Sitesection::where('parent_id', '=', Null)->where('visible', '!=' , 0)->get(); //get all parent section that not visible
        $data['title']='النشرات';
        return view('pages.Release.add', $data);
    }
   
    //---------------------------------------------------------//
    public function store($request)
    {
       //dd($request->all());
        
        DB::beginTransaction(); //to handel multiple insertion
        try
        {
            $this->refreshTable('releases');       //call trait to handel auto-increament

            //========= deal with images with trait "ImageTrait"==========================//

            //getTableLastId('Release')==> get last id in release model
            //storeImage($imageData)==>return photo name of image to store in db
            //==============================insert in releases table===========================================//
            $releases = new Release();
            $releases->name_ar=$request->name_ar;
            $releases->name_en=$request->name_en;
            $releases->sort=$request->sort;
            $releases->status=$request->status;
            $releases->save();
            //==============================insert in pivot table "section_all_pages"===========================================//
             //attach sections with release  to insert in releases_sections
            $releases->rel_section()->attach($request->site_id,['type' => 'releases']);
           
            //============================image===========================================//
            if($request->image)
            {
                 //-----------2-relate image with media with collection name "releases"---------------
               $releases->addMedia($request->image)->toMediaCollection('releases');

            }
        //============================files===========================================//
          if($request->file)
            {
                // handel file array to pass file_data to ImageTrait function
                $fileData=
                [
                    'file_name'    => $request->file,
                   'folder_name'   => 'release_no_'.$releases->id,
                    'disk_name'     => 'releases',
                ];
               //call to storeImage fun that save image in disk and return back with photo name from trait to insert in db
               $file_name=$this->storeFile($fileData);
               //==============================insert in morh table "files"===========================================//
                 //start morph image for product main image
                $file =new Image();
                $file->imageable_type='App\Models\Release';
                $file->imageable_id=$releases->id;
                $file->image_or_file='2';//file
                $file->main_or_sub='1'; //main file
                $file->filename=$file_name;
                $file->save();
            }
        //=======================================================================================//
            DB::commit();
            toastr()->success('تمت الاضافه بنجاح');
            return redirect()->route('release.index');
        }
        catch(\Exception $e)
        {
            DB::rollback();
            toastr()->error('حدث خطا اثناء الاضافه');
            return redirect()->back();       
         }
    }
    //---------------------------------------------------------//
    public function edit($id)
    {
        $real_id=decrypt($id);
        $data['releases']=Release::findOrfail($real_id);
      //  $data['releases']->rel_section->dd();
        $data['sections']= Sitesection::whereNull('parent_id')->where('visible', '!=' , 0)->get();
        $data['title']=' تعديل النشرة';
        return view('pages.Release.edit', $data);
    }
    //---------------------------------------------------------//
    public function update($request)
    { 
        //dd($request->all());
        DB::beginTransaction(); //to handel multiple insertion
        try {
            $real_id=decrypt($request->release_id);
            $releases = Release::findOrFail($real_id);
        //==============================update in releases table===========================================//
            $releases->name_ar=$request->name_ar;
            $releases->name_en=$request->name_en;
            $releases->status=$request->status;
            $releases->sort=$request->sort;
            $releases->save();
        //==============================update in pivot table "section_all_pages"========================//
             //sync sections with release  to  in section_all_pages "updated"
            $releases->rel_section()->sync($request->site_id);
        //============================image===========================================//
            if($request->image)
            {
               //optimize image
               $releases->addMedia($request->image)->toMediaCollection('releases');

               if(isset($request->media_url)){
                   //remove  folder from disk //remove old media
                   Media::find($this->get_media_id($request->media_url))->delete(); // this will also remove folder from disk
                   // rmdir(storage_path().'/app/public/media/'.$request->media_id);

                   //call trait to handel aut-increament
                   $this->refreshTable('media');
               }
                  
            }
        //============================files===========================================//
        if($request->filee)
        {
            if($request->old_file){
                //  //------------call to unLinkImage fun that unLink old_image in disk----------------
                $imageData= 
                [
                    'path'    => storage_path().'/app/public/releases/release_no_'.$real_id.'/'.$request->old_file,
                ];

                $this->unLinkImage($imageData);
            }
               //----------------------------------------------------------------------------------
             // handel file array to pass file_data to ImageTrait function
            $fileData=
            [
                'file_name'    => $request->filee,
               'folder_name'   => 'release_no_'.$releases->id,
                'disk_name'     => 'releases',
            ];
           //call to storeImage fun that save image in disk and return back with photo name from trait to insert in db
           $file_name=$this->storeFile($fileData);
           //==============================update in morph table "files"===========================================//
           $morphic_file=Image::findOrFail($request->morph_file_id);
           $morphic_file->filename=$file_name;
           $morphic_file->save();
        
    //=======================================================================================//
        }
         DB::commit();
         toastr()->success('تمت التعديل بنجاح');
         return redirect()->route('release.index');
       }
   
    catch(\Exception $e)
    {
        DB::rollback();
        toastr()->error(' حدث خطااثناء التعديل');
        return redirect()->back();   
    }
   }
    //---------------------soft delete------------------------------------//
    public function destroy($id)
    {  
        try
        {
            // dd($id);
            $real_id=decrypt($id);
            //Section_All_Page::where('type_id',$real_id)->where('type','releases')->delete();
            Release::find($real_id)->delete();
            //call trait to handel aut-increament
            $this->refreshTable('releases');
            toastr()->success(' تم الحذف بنجاح');
            return redirect()->route('release.index');
        }catch(\Exception $e){
            toastr()->error(' حدث خطااثناء الحذف');
            return redirect()->back();  
        }

    }
    //---------------------------------------------------------//
    public function bulkDelete($request)
    {
        //DD($request->delete_all_id);
        $all_ids = explode(',',$request->delete_all_id);
        Release::whereIn('id',$all_ids)->delete();
        //---------------------WHERE ON --------------------------------
            // dd($all_ids);
            // foreach($all_ids as $ids){
            //     if($ids=='on'){}else{
            //     Release_Section::where('release_id',$ids)->delete();
            //     Release::find($ids)->delete();
            //     }
            // }
        //-----------------------------------------------------
            //call trait to handel aut-increament
            $this->refreshTable('releases');
            toastr()->success(' تم الحذف بنجاح');
            return redirect()->route('release.index');
    }
    //---------------------------------------------------------//
    public function yajra_data($request)
    {
    
    }
    //---------------------------------------------------------//
}
?>
