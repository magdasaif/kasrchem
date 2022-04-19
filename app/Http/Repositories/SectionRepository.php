<?php

namespace App\Http\Repositories;
use App\Models\Sitesection;
use App\Models\Section_All_Page;
use App\Models\Video;
use App\Models\Article;
use App\Models\Photo_Gallery;
use App\Models\Release;
use App\Models\Image;
use App\Traits\ImageTrait;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Traits\TableAutoIncreamentTrait;
use App\Http\Interfaces\SectionInterface;
use toastr;

class SectionRepository implements SectionInterface{

    use TableAutoIncreamentTrait;
    use ImageTrait;
    //----------------------------------------------------------------------
    public function index()
    {
        $data['title']  ='الاقسام';
        $data['Sitesections']=Sitesection::where('visible', '!=' , 0)->orderBy('sort','asc')->paginate(10);

        $searching_result=Sitesection::where('visible', '!=' , 0)->get();
        $data['searching_count']=count($searching_result);
       return view('pages.Sitesection.Sitesection',$data);
    }
    //-----------------------------------------------------------------------------//
        function search($request)
        {
        // dd($request->all());
             $data['title']  ='الاقسام';
            $search_text = $request->query_text;
            //dd($search_text);
            $data['Sitesections']=Sitesection::where('name_ar','LIKE','%'.$search_text.'%')->where('visible', '!=' , 0)->orderBy('sort','asc')->paginate(10);
          
              $searching_result=Sitesection::where('name_ar','LIKE','%'.$search_text.'%')->where('visible', '!=' , 0)->get();
              $searching_count=$data['searching_count']=count($searching_result);
             // dd($searching_count);
             // return view('pages.products.show',compact('searching_result','title'));
            return view('pages.Sitesection.Sitesection',$data);

        }

    //----------------------------------------------------------------------
    
public function create(){
        $data['title']='اضافه قسم';
        $data['parent_sites']= Sitesection::where('parent_id', '=', Null)->where('visible', '!=' , 0)->get();
        return view('pages.Sitesection.add',$data);
    }
    //----------------------------------------------------------------------
    public function store($request)
    {
       // dd($request->all());
        DB::beginTransaction();

        try{           
            if(  Sitesection::where('name_ar',$request->name_ar)->orWhere('name_en',$request->name_en)->exists())
            {
             return redirect()->back()->withErrors('هذا القسم مُضاف بالفعل من قبل ');
            }
            //call trait to handel aut-increament
            $this->refreshTable('site_sections');
            //-----------------store in  db-----------------------
            //==============store in  site_sections table===============
            $Sitesection =new Sitesection();
             //check if parent or child from select
             if($request->site_or_sub=='0') 
             { $Sitesection->parent_id=Null; }
             else
              { $Sitesection->parent_id=$request->site_or_sub;}

            //$Sitesection->parent_id = $parent_id_value,
            $Sitesection->name_ar   = $request->name_ar;
            $Sitesection->name_en   = $request->name_en;
            $Sitesection->sort      = $request->sort;
            $Sitesection->status    = $request->status;
            $Sitesection->save();
            //=======================image media=========//
            if($request->image)
            {
                // handel image array to pass image data to trait function
                $imageData=[
                    'image_name'    => $request->image,
                    'folder_name'   => 'section_no_'.$Sitesection->id,
                    'disk_name'     => 'site_sections',
                ];
                 //call to storeImage fun to save image in disk and return back with photo name
                 $photo_name=$this->storeImage($imageData);

                 //start morph image for product main image
                $image =new Image();
                $image->imageable_type='App\Models\Sitesection';
                $image->imageable_id=$Sitesection->id;
                $image->image_or_file='1';//image
                $image->main_or_sub='1'; //main image
                $image->filename=$photo_name;
                $image->save();
                //-----------media library-----------------
              $Sitesection->addMedia($request->image)->toMediaCollection('sections');
            }
            //---------------------------------------------------
            DB::commit();
            toastr()->success('تمت الاضافه بنجاح');
            return redirect()->route('site_section.index');
            }
            catch(\Exception $e)
            {
                DB::rollback();
                toastr()->error('حدث خطا اثناء الاضافه');
                return redirect()->back();       
            } 
    }
    //----------------------------------------------------------------------
    public function edit($id)
    {
        $real_id=decrypt($id);
        $data['title']='تعديل قسم';
        $real_id=decrypt($id);
        $data['title']='تعديل قسم';
        $data['section'] =$section= Sitesection::findOrfail($real_id);  //data of edited supplier
        if($section->parent_id==null)
        {
            $data['first_selec']=0; // قسـم رئيسى selected
            $parent_of_section='';//مفيش parent
            $data['all_sections'] =Sitesection::where('parent_id', '=', Null)->where('visible', '!=' , 0)->where('id','!=',$id)->get();
        }
        else
        {
            $data['first_select']='';
            $data['parent_of_section'] =$parent_of_section= Sitesection::findOrfail($section->parent_id);
           // dd($parent_of_section);
            $data['all_sections']=$all_sections=Sitesection::where('parent_id', '=', Null)->where('visible', '!=' , 0)->where('id', '!=', $parent_of_section->id)->get(); //  كبيرنت والاتشيلد الخاصيين بيه علشان اللى كان مختاره ميظهرش فى السليكت
            //dd($all_sections);
        }
      
        if(!$parent_of_section){ $data['first_select']=0;}
        else{ $data['first_select']='';}
        return view('pages.Sitesection.edit',$data);
    }
    //----------------------------------------------------------------------
    public function update($request)
    {
       // dd($request->all());
        DB::beginTransaction();
        try{
            $real_id=decrypt($request->id);
            $Sitesection = Sitesection::findOrfail($real_id);
            $Sitesection->name_ar=$request->name_ar;
            $Sitesection->name_en=$request->name_en;
            $Sitesection->sort= $request->sort;
            $Sitesection->status= $request->status;

            if($request->site_or_sub=='0'){ $Sitesection->parent_id=Null;}
            else {$Sitesection->parent_id=$request->site_or_sub;}
            $Sitesection->save();
            
           if($request->image)
           {
               //----------------1------------------
                if($request->deleted_image)
                { 
                    //هيحذفها لو هى موجودة فى الفولدر
                    //------------call to unLinkImage fun that unLink old_image in disk----------------
                    $imageData= 
                    [
                        'path'  => storage_path().'/app/public/site_sections/section_no_'.$real_id.'/'.$request->deleted_image,
                    ];
                    $this->unLinkImage($imageData);
                }
                 //----------------2------------------
                // handel image array to pass image data to trait function
                $imageData=[
                    'image_name'    => $request->image,
                    'folder_name'   => 'section_no_'.$Sitesection->id,
                    'disk_name'     => 'site_sections',
                ];
                //call to storeImage fun to save image in disk and return back with photo name
                $photo_name=$this->storeImage($imageData);
                 //=====================update in morph table "images"===================//
               
               $morphic_image=Image::findOrFail($request->morph_image_id);
               // if there are image stored before-->update it
               $morphic_image->filename=$photo_name;
               $morphic_image->save();
          //--------جزء لو الصورة موجودة فى جدول المورف ولا لا --------------
            //    if($morphic_image)
            //     { 
            //        // if there are image stored before-->update it
            //         $morphic_image->filename=$photo_name;
            //         $morphic_image->save();
            //     }
            //     else
            //     {
            //         // if there are no image stored before-->add it
            //         $image =new Image();
            //         $image->imageable_type='App\Models\Sitesection';
            //         $image->imageable_id=$Sitesection->id;
            //         $image->image_or_file='1';//image
            //         $image->main_or_sub='1'; //main image
            //         $image->filename=$photo_name;
            //         $image->save();  
            //     }
          //-----------3-relate image with media with collection name "releases"--------------
             $Sitesection->addMedia($request->image)->toMediaCollection('Sitesection');      
       //=======================================================================================//    
        }
            DB::commit();
            toastr()->success('تمت التعديل بنجاح');
            return redirect()->route('site_section.index');
        }
        catch(\Exception $e)
        {
        DB::rollback();
        toastr()->error(' حدث خطااثناء التعديل');
        return redirect()->back();   
        }
    }
    //-------------------------------------------------------
    public function destroy($id)
    {
        //dd($id);
        $real_id=decrypt($id);
        //call trait to handel aut-increament
        $this->refreshTable('site_sections');

  // ------check if section relate with other or not------------
        //dd($id);
       $site_section_=Sitesection::where('visible', '!=' , 0)->where('parent_id',$real_id)->get(); //case related_section
       //dd($site_section_);
       //--------------check if section relate with article ,release,photo,video------------------------------------//
         $videos_related_id=Section_All_Page::where("sitesection_id",$real_id)->where("type","videos")->pluck("type_id");
         $articles_related_id=Section_All_Page::where("sitesection_id",$real_id)->where("type","articles")->pluck("type_id");
         $photos_related_id=Section_All_Page::where("sitesection_id",$real_id)->where("type","photos")->pluck("type_id");
         $releases_related_id= Section_All_Page::where("sitesection_id",$real_id)->where("type","releases")->pluck("type_id");
        //  $releases_related_id= Release_Section::where("sitesection_id",$id)->pluck("release_id"); 
         //======
         //-------------------------------------------------//
        $videoo= Video::withoutTrashed()->whereIn('id',$videos_related_id)->get();
        $article= Article::withoutTrashed()->whereIn('id',$articles_related_id)->get();
        $photo_gallery= Photo_Gallery::withoutTrashed()->whereIn('id',$photos_related_id)->get();
        $releases=Release::withoutTrashed()->whereIn('id',$releases_related_id)->get();
         //------------------------------------------
        if( $site_section_->count()== 0 && $releases_related_id->count()== 0  &&  $videos_related_id->count()== 0  && $articles_related_id->count()== 0 && $photos_related_id->count()== 0)
        
        {
            //done soft delete
            try
            {
                $Sitesections=Sitesection::findOrFail($real_id);
                $Sitesections->visible= 0; //SOFT  DELETED WITH VISIBLE
                $Sitesections->save();
                toastr()->success('تم الحذف بنجاح');
                return redirect()->route('site_section.index')->with(['success'=>'تم الحذف بنجاح']);
            }
            catch
            (\Exception $e)
            {
                toastr()->error('حدث خطا اثناء الحذف');
                return redirect()->back()->with(['error' => $e->getMessage()]);
            }
        }
        else
        {
            //show messages with related article,release,photo
                return redirect()->back()->with
                ([
                'msg'               => " هذا القسم مرتبط باقسام فرعية اخرى",
                'msg_video'         => " هذا القسم مرتبط  بفيديو ",
                'msg_article'       => " هذا القسم مرتبط بمقالات ",
                'msg_photo_gallery' => " هذا القسم مرتبط بمعرض ",
                'msg_release'      =>"  هذا القسم مرتبط بنشرة",

                'data'              =>$site_section_,
                'data_video'        =>$videoo,
                'data_article'      =>$article,
                'data_photo_gallery'=>$photo_gallery,
                'data_release'        =>$releases,
                'msg2'=>' قم بتغييرالقسم اولا واعد المحاولة'
                ]);           
       
        }

    }
//----------------------------------------------------------------------
    public function bulkDelete($request)
    {
    }
//----------------------------------------------------------------------
    public function yajra_data($request)
    {
    }
}

?>
