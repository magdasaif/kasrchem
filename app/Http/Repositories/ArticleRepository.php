<?php

namespace App\Http\Repositories;

use App\Models\Image;
use App\Models\Article;
use App\Traits\ImageTrait;
use App\Models\Sitesection;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Traits\TableAutoIncreamentTrait;
use App\Http\Interfaces\ArticleInterface;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Traits\MediaTrait;
class ArticleRepository implements ArticleInterface{

    use TableAutoIncreamentTrait,ImageTrait,MediaTrait;
    
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
            $Article-> name_en = $request->name_en;
            $Article-> content_ar = $request->content_ar;
            $Article-> content_en = $request->content_en;
            $Article-> status=$request->status;
            $Article-> sort=$request->sort;
            $Article->save();
            $Article->rel_section()->syncWithPivotValues($request->site_id,['type' => 'articles']);

           if($request->image){
                //optimize image
                $Article->addMedia($request->image)->toMediaCollection('article');

                if(isset($request->media_url)){
                    //remove  folder from disk //remove old media
                    Media::find($this->get_media_id($request->media_url))->delete(); // this will also remove folder from disk
                    // rmdir(storage_path().'/app/public/media/'.$request->media_id);

                    //call trait to handel aut-increament
                    $this->refreshTable('media');
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
           // return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
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
