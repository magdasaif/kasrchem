<?php

namespace App\Http\Repositories;

use App\Models\Image;
use App\Models\Article;
use App\Models\Partner;
use App\Traits\ImageTrait;
use App\Models\Sitesection;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Traits\TableAutoIncreamentTrait;
use App\Http\Interfaces\ArticleInterface;

class ArticleRepository implements ArticleInterface{

    use TableAutoIncreamentTrait,ImageTrait;
    
    public function index(){
        $data['title']  ='المقالات';
        $data['articles']=Article::withoutTrashed()->orderBy('sort','asc')->paginate(10);
         return view('pages.article.show',$data);
    }

    public function create(){
        $data['title']='اضافه مقال';
        $data['sections']  = Sitesection::where('visible', '!=' , 0)->whereNull('parent_id')->get();
        return view('pages.article.add',$data);
    }
    
    public function store($request){
        DB::beginTransaction();
        try{           
            //call trait to handel aut-increament
             $this->refreshTable('articles');
    
             $article =new Article();
             $article->name_ar=$request->name_ar;
             $article->name_en=$request->name_en;
             $article->content_ar=$request->content_ar;
             $article->content_en=$request->content_en;
             $article->status=$request->status;
             $article->sort=$request->sort;
             $article->save();
             $article->rel_section()->attach($request->site_id,['type' => 'articles']);

           if($request->image){
                // handel image array to pass image data to trait function
                $imageData=[
                    'image_name'    => $request->image,
                    'folder_name'   => '',
                    'disk_name'     => 'article',
                ];
                
                //call to storeImage fun to save image in disk and return back with photo name
                $photo_name=$this->storeImage($imageData);

                 //start morph image for product main imagحe
                $image =new Image();
                $image->imageable_type='App\Models\Article';
                $image->imageable_id=$article->id;
                $image->image_or_file='1';//image
                $image->main_or_sub='1'; //main image
                $image->filename=$photo_name;
                $image->save();
             
                //optimize image
                $article->addMedia($request->image)->toMediaCollection('article');
            }

            

             DB::commit();
            toastr()->success('تمت الاضافه بنجاح');
            return redirect()->route('article.index')->with(['success'=>'تمت الاضافه بنجاح']);
        }catch(\Exception $e){
            DB::rollback();
            toastr()->error('حدث خطا اثناء الاضافه');
            return redirect()->back()->withErrors(['error'=>'حدث خطا اثناء الاضافه']);
          //  return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }

    }


    //---------------------------------------------------------
    public function edit($id){
        $real_id=decrypt($id);
        $data['article']=Article::findOrfail($real_id);
        $data['sections'] = Sitesection::where('visible', '!=' , 0)->whereNull('parent_id')->get();

        $data['title']='تعديل مقال';
        return view('pages.article.edit',$data);
    }
    //---------------------------------------------------------
    public function update($request){
        DB::beginTransaction();
        try{
            $real_id=decrypt($request->id);
            
            $Article=Article::findOrfail($real_id);
            $Article-> name_ar= $request->name_ar;
            $Article->name_en = $request->name_en;
            $Article-> content_ar = $request->content_ar;
            $Article->content_en = $request->content_en;
            $Article-> status=$request->status;
            $Article-> sort=$request->sort;
            $Article->save();
            $Article->rel_section()->syncWithPivotValues($request->site_id,['type' => 'articles']);

           if($request->image){
                // handel image array to pass image data to trait function
                $imageData=[
                    'image_name'    => $request->image,
                    'folder_name'   => '',
                    'disk_name'     => 'article',
                ];
                //call to storeImage fun to save image in disk and return back with photo name
                $photo_name=$this->storeImage($imageData);

                //optimize image
                $Article->addMedia($request->image)->toMediaCollection('article');
                    
                //start morph image for product sub images
                $img=Image::find($request->image_id);

                if($img){ // if there are image stored before-->update it

                    $img->filename=$photo_name;
                    $img->save();
                    
                }else{// if there are no image stored before-->add it
                    
                        //start morph image for product main image
                        $image =new Image();
                        $image->imageable_type='App\Models\Article';
                        $image->imageable_id=$Article->id;
                        $image->image_or_file='1';//image
                        $image->main_or_sub='1'; //main image
                        $image->filename=$photo_name;
                        $image->save();
                    
                }
                
                if($request->deleted_image){
                    //  dd('1');
                    // handel image array to pass image path to trait function
                    $imageData=[
                        'path'=>storage_path().'/app/public/article/'.$request->deleted_image,
                    ];
                    //call to unLinkImage fun to delete old image from disk 
                    $this->unLinkImage($imageData);
                }
             }


            //toastr()->success('تمت الاضافه بنجاح');
            DB::commit();
            toastr()->success('تم التعديل بنجاح');
            return redirect()->route('article.index')->with(['success'=>'تم التعديل بنجاح']);
        }catch(\Exception $e){
            DB::rollback();
            toastr()->error('حدث خطا اثناء التعديل');
            return redirect()->back()->withErrors(['error'=>'حدث خطا اثناء التعديل']);
        }
            
    }
    //-------------------------------------------------------
    public function destroy($id){
        $real_id=decrypt($id);
        Article::findOrfail($real_id)->delete();
        //call trait to handel aut-increament
        $this->refreshTable('articles');
        toastr()->error('تم الحذف');
        return redirect()->route('article.index')->with(['success'=>'تم الحذف ']);

    }
    public function bulkDelete($request){

        $all_ids = explode(',',$request->delete_all_id);
        // dd($all_ids);
        Article::whereIn('id',$all_ids)->delete();
     
         //call trait to handel aut-increament
         $this->refreshTable('articles');
         
         toastr()->error('تم الحذف');
         return redirect()->route('article.index')->with(['success'=>'تم الحذف ']);
     }

    public function yajra_data($request){

     }
}
?>
