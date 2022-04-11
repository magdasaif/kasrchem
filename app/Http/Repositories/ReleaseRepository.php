<?php

namespace App\Http\Repositories;
use App\Http\Interfaces\ReleaseInterface;
use App\Traits\TableAutoIncreamentTrait;
use App\Models\Release;
use App\Models\Sitesection;

use Yajra\DataTables\DataTables;
use App\Traits\ImageTrait;
use toastr;
use App\Models\Image;
use App\Models\Section_All_Page;
use Illuminate\Support\Facades\DB;
class ReleaseRepository implements ReleaseInterface{
    use TableAutoIncreamentTrait;
    use ImageTrait;
    //----------------------show release function----------------------------------//
    public function index()
    {
        $data['releases']= Release::orderBy('id','desc')->get();
        
        $data['title']='النشرات';
        return view('pages.Release.Show', $data);
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
                // handel image array to pass image_data to ImageTrait function
                $imageData=
                [
                    'image_name'    => $request->image,
                    'folder_name'   => 'release_no_'.$releases->id,
                    'disk_name'     => 'releases',
                ];
               //call to storeImage fun that save image in disk and return back with photo name from trait to insert in db
                $photo_name=$this->storeImage($imageData);
               //==============================insert in morh table "images"===========================================//
               //start morph image for product main image
                $image =new Image();
                $image->imageable_type='App\Models\Release';
                $image->imageable_id=$releases->id;
                $image->image_or_file='1';//image
                $image->main_or_sub='1'; //main image
                $image->filename=$photo_name;
               // $image->save();
            }
            else
            {
                $photo_name='';
            }
            $image->save();
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
               // $file->save();
            }
            else
            {
                $file_name='';
            }
            $file->save();
        //=======================================================================================//
            DB::commit();
            return redirect()->route('release.index')->with(['success'=>'تمت الاضافه بنجاح']);

          //  return redirect()->back()->with(['success'=>'تمت الاضافه بنجاح']);
          //  toastr()->success('تمت الاضافه بنجاح');
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }
    }
    //---------------------------------------------------------//
    public function edit($id)
    {
        $real_id=decrypt($id);
        $data['releases']=Release::findOrfail($real_id);
        if(!$data['releases']) return redirect()->back();
        $data['sections']= Sitesection::where('parent_id', '=', Null)->where('visible', '!=' , 0)->get();
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
                if($request->old_image){
                    //------------call to unLinkImage fun that unLink old_image in disk----------------
                    $imageData= 
                    [
                        'path'  => storage_path().'/app/public/releases/release_no_'.$real_id.'/'.$request->old_image,
                    ];
                    $this->unLinkImage($imageData);
                }
                  //----------------------------------------------------------------------------------
                // handel image array to pass image_data to ImageTrait function
                $imageData=
                [
                    'image_name'    => $request->image,
                    'folder_name'   => 'release_no_'.$releases->id,
                    'disk_name'     => 'releases',
                ];
               //call to storeImage fun that save image in disk and return back with photo name from trait to insert in db
                $photo_name=$this->storeImage($imageData);
           
               //=====================update in morph table "images"===================//
               
                $morphic_image=Image::findOrFail($request->morph_image_id);
                $morphic_image->filename=$photo_name;
                $morphic_image->save();
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
        
         DB::commit();
         return redirect()->route('release.index')->with(['success'=>'تم التعديل بنجاح']);
       }
    }
    catch(\Exception $e)
    {
        DB::rollback();
         return redirect()->back()->with(['error' => $e->getMessage()]);
    }
   }
    //---------------------soft delete------------------------------------//
    public function destroy($id)
    {
          // dd($id);
           $real_id=decrypt($id);
      try
        {
            //Section_All_Page::where('type_id',$real_id)->where('type','releases')->delete();
            Release::find($real_id)->delete();
          //call trait to handel aut-increament
            $this->refreshTable('releases');
                
        return redirect()->route('release.index')->with(['success'=>'تم الحذف بنجاح']);
       }
       catch
       (\Exception $e)
       {
           return redirect()->back()->with(['error' => $e->getMessage()]);
       }

    }
    //---------------------------------------------------------//
    public function deleteAll($request)
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
            return redirect()->route('release.index')->with(['success'=>'تم الحذف بنجاح']);
    }
    //---------------------------------------------------------//
    public function yajra_data($request)
    {
    
    }
    //---------------------------------------------------------//
}
?>
