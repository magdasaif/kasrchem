<?php

namespace App\Http\Repositories;

use App\Models\Image;
use App\Traits\ImageTrait;
use App\Models\Sitesection;
use App\Models\Photo_Gallery;

use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

use App\Traits\TableAutoIncreamentTrait;
use App\Http\Interfaces\GalleryInterface;

class GalleryRepository implements GalleryInterface{

    use TableAutoIncreamentTrait,ImageTrait;
    
    public function index(){
        $data['title']      ='معرض الصور';
        $data['Photo_Gal']  =Photo_Gallery::withoutTrashed()->orderBy('sort','asc')->paginate(10);
        return view('pages.Photo_Gallery.Show',$data);
    }
    //-------------------------------------------------------------------------------------
    public function create(){
        $data['title']      ='اضافه معرض';
        $data['sections']   = Sitesection::where('visible', '!=' , 0)->whereNull('parent_id')->get();
          //+++++++++++++++++++++++++++++++++++++++++++++//
        return view('pages.Photo_Gallery.add',$data);
    }
    //-------------------------------------------------------------------------------------
    public function store($request){
        DB::beginTransaction();
        try{           
            //call trait to handel aut-increament
             $this->refreshTable('photo_gallerys');
    
             $photo_gallery = new Photo_Gallery();       
           
            $photo_gallery->name_ar=$request->name_ar;
            $photo_gallery->name_en=$request->name_en;
            $photo_gallery->sort=$request->sort;
            $photo_gallery->status=$request->status;
            $photo_gallery->save();

            $photo_gallery->rel_section()->attach($request->site_id,['type' => 'photos']);
             
           if($request->image){
                // handel image array to pass image data to trait function
                $imageData=[
                    'image_name'    => $request->image,
                    'folder_name'   => 'gallery_photo_images_no_'. $photo_gallery->id,
                    'disk_name'     => 'photo_gallery',
                ];
                
                //call to storeImage fun to save image in disk and return back with photo name
                $photo_name=$this->storeImage($imageData);

                //optimize image
                $photo_gallery->addMedia($request->image)->toMediaCollection('gallery');
                
            }else{
                $photo_name='';
            }

             //start morph image for product main imagحe
             $image =new Image();
             $image->imageable_type='App\Models\Photo_Gallery';
             $image->imageable_id=$photo_gallery->id;
             $image->image_or_file='1';//image
             $image->main_or_sub='1'; //main image
             $image->filename=$photo_name;
             $image->save();


             if(!empty($request->photos)){
                foreach($request->photos as $photo){

                     // handel image array to pass image data to trait function
                      $imageData=[
                       'image_name'    => $photo,
                       'folder_name'   => 'gallery_photo_images_no_'. $photo_gallery->id,
                       'disk_name'     => 'photo_gallery',
                       ];
                       
                       //call to storeImage fun to save image in disk and return back with photo name
                       $photo_name=$this->storeImage($imageData);

                       //start morph image for product sub images
                       Image::create([
                           'imageable_type'=>'App\Models\Photo_Gallery',
                           'imageable_id'=>$photo_gallery->id,
                           'image_or_file'=>'1',//image
                           'main_or_sub'=>'2', //sub image
                           'filename'=>$photo_name
                       ]);
                       //optimize image
               $photo_gallery->addMedia($photo)->toMediaCollection('sub_gallery');
                }
            }
            
             DB::commit();
            toastr()->success('تمت الاضافه بنجاح');
            return redirect()->route('photo_gallery.index')->with(['success'=>'تمت الاضافه بنجاح']);
        }catch(\Exception $e){
            DB::rollback();
            toastr()->error('حدث خطا اثناء الاضافه');
            return redirect()->back()->withErrors(['error'=>'حدث خطا اثناء الاضافه']);
           // return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }         
    }
    //----------------------------------------------------------------------------------------
    public function edit($id){
        $real_id=decrypt($id);
        $data['photo_gallery']=Photo_Gallery::findOrfail($real_id);
        $data['title']='تعديل صفحه';
        $data['sections']   = Sitesection::where('visible', '!=' , 0)->whereNull('parent_id')->get();

         return view('pages.Photo_Gallery.edit',$data);
    }
    //--------------------------------------------------------------------------------------
    public function update($request){
        DB::beginTransaction();
        try{
            $real_id=decrypt($request->id);

            $Photo_Gallery = Photo_Gallery::findOrFail($real_id);
            $Photo_Gallery->name_ar=$request->name_ar;
            $Photo_Gallery->name_en=$request->name_en;
            $Photo_Gallery->status=$request->status;
            $Photo_Gallery->sort=$request->sort;
            $Photo_Gallery->save();

            if(isset($request->site_id)){
                $Photo_Gallery->rel_section()->syncWithPivotValues($request->site_id, ['type' => 'photos']);
            }else{
                $Photo_Gallery->rel_section()->sync();
            }
          

           if($request->image){
                // handel image array to pass image data to trait function
                $imageData=[
                    'image_name'    => $request->image,
                    'folder_name'   => 'gallery_photo_images_no_'. $Photo_Gallery->id,
                    'disk_name'     => 'photo_gallery',
                ];
                //call to storeImage fun to save image in disk and return back with photo name
                $photo_name=$this->storeImage($imageData);

                //optimize image
                $Photo_Gallery->addMedia($request->image)->toMediaCollection('gallery');
                    
                //start morph image for product sub images
                $img=Image::find($request->image_id);

                if($img){ // if there are image stored before-->update it

                    $img->filename=$photo_name;
                    $img->save();
                    
                }else{// if there are no image stored before-->add it
                    
                        //start morph image for product main image
                        $image =new Image();
                        $image->imageable_type='App\Models\Photo_Gallery';
                        $image->imageable_id=$Photo_Gallery->id;
                        $image->image_or_file='1';//image
                        $image->main_or_sub='1'; //main image
                        $image->filename=$photo_name;
                        $image->save();
                    
                }
                if($request->deleted_image){
                //  dd('1');
                    // handel image array to pass image path to trait function
                    $imageData=[
                        'path'=>storage_path().'/app/public/photo_gallery/'.$request->deleted_image,
                    ];
                    //call to unLinkImage fun to delete old image from disk 
                    $this->unLinkImage($imageData);
                }
            }
            DB::commit();
            toastr()->success('تم التعديل بنجاح');
            return redirect()->route('photo_gallery.index')->with(['success'=>'تم التعديل بنجاح']);
        }catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->with(['error' => $e->getMessage()]);
            toastr()->error('حدث خطا اثناء التعديل');
            return redirect()->back()->withErrors(['error'=>'حدث خطا اثناء التعديل']);
        }

    }
    
    //---------------------------------------------------------------------
    public function show_gallery($id){
        
         //decrypt product_id which is encryptrd
         $real_id=decrypt($id);

         //retreive all products images &files(main&sub)
         //  Product::find($product_id)->images();
 
         $data['title'] = 'اضافة صور لمعرض';
         $data['id']    = $real_id;
         
         //subImages() is a scope function in gallery model
         $data['Gallery_Photo'] = Photo_Gallery::find($real_id)->subImages();

         //when use media library package
        // $data['Gallery_Photo']= Photo_Gallery::find($real_id)->getMedia('sub_gallery');//'sub_product','thumb'

        return view('pages.Photo_Gallery.show_gallery_image',$data);

    }

    //--------------------------------------------------------------------------
    public function add_gallery_images($request,$id)
    {
        try{
            $real_id=decrypt($id);
            $photo_gallery=Photo_Gallery::findOrfail($real_id);
            // dd($request->image);
             if(!empty($request->photos)){
                 foreach($request->photos as $photo){

                      // handel image array to pass image data to trait function
                       $imageData=[
                        'image_name'    => $photo,
                        'folder_name'   => 'gallery_photo_images_no_'. $real_id,
                        'disk_name'     => 'photo_gallery',
                        ];
                        
                        //call to storeImage fun to save image in disk and return back with photo name
                        $photo_name=$this->storeImage($imageData);

                        //start morph image for product sub images
                        Image::create([
                            'imageable_type'=>'App\Models\Photo_Gallery',
                            'imageable_id'=>$real_id,
                            'image_or_file'=>'1',//image
                            'main_or_sub'=>'2', //sub image
                            'filename'=>$photo_name
                        ]);
                        //optimize image
                $photo_gallery->addMedia($photo)->toMediaCollection('sub_gallery');
                 }
             }
 
             toastr()->success('تمت الاضافه بنجاح');
             return redirect()->back()->with(['success'=>'تمت الاضافه بنجاح']);

        }catch(\Exception $e){
         // dd('eee');
            toastr()->error('حدث خطا اثناء الاضافه');
            return redirect()->back()->with(['error'=>'حدث خطا اثناء الاضافه']);

         //   return redirect()->back()->with(['error'=>$e->getMessage()]);
        }
    }
 //--------------------------------------------------------------------------
    public function delete_gallery_images($request ,$id){

        try{
           // dd($request->gallery_id);
            $real_id=decrypt($id);
            // handel image array to pass image path to trait function
            $imageData=[
                'path'=>storage_path().'/app/public/photo_gallery/gallery_photo_images_no_'.$request->gallery_id.'/'.$request->deleted_image,
            ];

            //call to unLinkImage fun to delete image from disk 
            $this->unLinkImage($imageData);
            Image::findOrfail($real_id)->delete();

            //call trait to handel aut-increament
            $this->refreshTable('images');
            
            toastr()->success('تم الحذف بنجاح');
            return redirect()->back()->with(['success'=>'تم الحذف']);
        }catch(\Exception $e){
            toastr()->error('حدث خطا اثناء الحذف');
            return redirect()->back()->with(['error'=>'حدث خطا اثناء الحذف']);
        }
        
    }
//--------------------------------------------------------------------------
    //---------------------------------------------------------------------
    public function destroy($id){
        $real_id=decrypt($id);
        Photo_Gallery::findOrfail($real_id)->delete();
        //call trait to handel aut-increament
        $this->refreshTable('photo_gallerys');
        toastr()->error('تم الحذف');
        return redirect()->route('photo_gallery.index')->with(['success'=>'تم الحذف ']);

    }
         //-------------------------------------------------------

    public function bulkDelete($request){

        $all_ids = explode(',',$request->delete_all_id);
        // dd($all_ids);
        Photo_Gallery::whereIn('id',$all_ids)->delete();
     
         //call trait to handel aut-increament
         $this->refreshTable('photo_gallerys');
         
         toastr()->error('تم الحذف');
         return redirect()->route('photo_gallery.index')->with(['success'=>'تم الحذف ']);
     }

     //-------------------------------------------------------
    public function yajra_data($request){

     }
}
?>
