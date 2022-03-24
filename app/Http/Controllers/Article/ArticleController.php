<?php
namespace App\Http\Controllers\Article;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;
use App\Models\Article;

use App\Models\Sitesection;
use App\Models\Main_Category;
use App\Models\Sub_Category2;
use App\Models\Sub_Category3;
use App\Models\Sub_Category4; 

class ArticleController extends Controller
{
  
    public function index()
    {
        $Art=Article::orderBy('id','desc')->get();
         return view('pages.Article.Show',compact('Art'));
    }
//--------------------------------------------
 public function create()
    {
        //$Main_Cat = Main_Category::withCount('sub_cate2')->get();
       //++++++++++++++++++++new for unrequired++++++++++++++++++++//
         //visible', '!=' , 0 هيعرضلى على التصنيفات والاقسام اللى ال 
         $sub_Category4   = Sub_Category4::where('visible', '!=' , 0)->get(); 
         $sub_Category3   = Sub_Category3::where('visible', '!=' ,0)->get(); 
         $Sub_Category2 = Sub_Category2::where('visible', '!=' , 0)->get();
         $Main_Cat	= Main_Category::where('visible', '!=' , 0)->get();
         $sections  = Sitesection::where('visible', '!=' , 0)->where('parent_id', '=', Null)->get();
         //-++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//
        return view('pages.Article.add',compact('Main_Cat','sub_Category4','sub_Category3','Sub_Category2','sections'));
    }
//--------------------------------------------
    public function findsub2($id)
    {
    $sub_Category3= Sub_Category3::pluck("sub2_id");
    $data= Sub_Category2::where('cate_id',$id)->whereIn('id',  $sub_Category3)-> pluck("subname2_ar", "id");
     return response()->json($data); //then sent this data to ajax success
    return $data;
    
    }
    
//--------------------------------------------
    public function findsub3($id)
    {
     $sub_Category4= sub_Category4::pluck("sub3_id");
     $data= sub_Category3::where('sub2_id',$id)->whereIn('id',  $sub_Category4)-> pluck("subname_ar", "id");
      return response()->json($data); //then sent this data to ajax success
     return $data;
    }
    //---------------------------------------------//
    public function findsub4($id)
    {
        $data= Sub_Category4::where('sub3_id',$id)->pluck("subname_ar", "id");
        return response()->json($data); //then sent this data to ajax success
        //return $data;
    }
    //--------------------------------------------
    public function store(ArticleRequest $request)
    {
       //dd($request->all());
       try{
         $validated = $request->validated();
          $request->validate(['image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',]);
           if($request->image)
           {
            $folder_name='';
              //$photo_name= ($request->image)->getClientOriginalName();
              $photo_name= str_replace(' ', '_',($request->image)->getClientOriginalName());
               ($request->image)->storeAs($folder_name,$photo_name,$disk="article");
               
           }
            $article = new Article();
           /*
           $article = new Article([
            'main_cate_id' =>  $request->main_category,
            'sub1_id' =>  $request->sub2,
            'sub2_id' =>  $request->sub3,
            'sub3_id' =>  $request->sub4,
            'title_ar' =>  $request->title_ar,
            'title_en' =>  $request->title_en,
            'content_ar' =>  $request->content_ar,
            'content_en' =>  $request->content_en,
            'status' =>  $request->status,
            'image' =>$photo_name,
           ]);*/
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//            
            //---"!$request"=> علشان لو ظاهر جزء اضف تصنيف يحفظ بالقيمة 1 كانه مختارش حاجة++++++++++//
                    
            if(!$request->section_id)
            {
                $article->site_id= 1;
            }
            else
            {
                $article->site_id= $request->section_id; 
            }

            if(!$request->main_category)
            {
                $article->main_cate_id=1;
            }
            else
            {
                $article->main_cate_id= $request->main_category; 
            }

            if(!$request->sub2)
            {
                $article->sub1_id= 1;

            }
            else
            {
                $article->sub1_id= $request->sub2; 
            }

            if(!$request->sub3)
            {
                $article->sub2_id=1;
            }
            else
            {
                $article->sub2_id=$request->sub3; 
            }
            if(!$request->sub4)
            {
                $article->sub3_id=1;
            }
            else
            {
                $article->sub3_id= $request->sub4; 
            }
          
            $article->title_ar=$request->title_ar;
            $article->title_en=$request->title_en;
            $article->content_ar=$request->content_ar;
            $article->content_en=$request->content_en;
            $article->status=$request->status;
            $article->image=$photo_name;


            //++++++++++++++++++++++++++++++++++++++++++//
        $article->save();
        $article->rel_section()->attach($request->site_id,['type' => 'articles']);

            return redirect()->route('article.index')->with(['success'=>'تمت الاضافه بنجاح']);
        }
        catch(\Exception $e){
            return redirect()->back()->with(['error'=>$e->getMessage()]);
        }
    }
//--------------------------------------------
    public function show($id)
    {
        //
    }
//--------------------------------------------
    public function edit($id)
    {
       
        $article = Article::findOrfail($id);
        if(!$article) return redirect()->back();

        /* $sections     = Sitesection::get();
         $Main_Cat = Main_Category::get();
         $Sub_Category4      = Sub_Category4::get();
         $Sub_Category3      = Sub_Category3::get();
         $Sub_Category2      = Sub_Category2::get();

        //to retrive value of section
        $main_categories = Main_Category::findOrfail($article->main_cate_id);
        $s = Sitesection::findOrfail($main_categories->section_id);
        */
        //+++++++++++++++++++++++++new for unrequired+++++++++++++++++++++++++//
            $sections = Sitesection::where('visible', '!=' , 0)->where('parent_id', '=', Null)->get();
            $Main_Cat = Main_Category::where('visible', '!=' , 0)->get();
            $Sub_Category4 = Sub_Category4::where('visible', '!=' , 0)->get();
            $Sub_Category3 = Sub_Category3::where('visible', '!=' , 0)->get();
            $Sub_Category2 = Sub_Category2::where('visible', '!=' , 0)->get();
    //+++++++++++++++++++++++++++++++++++++++++++++//
        //return view('pages.Article.edit',compact('s','sections','article','Main_Cat','Sub_Category2','Sub_Category3','Sub_Category4'));
        return view('pages.Article.edit',compact('sections','article','Main_Cat','Sub_Category2','Sub_Category3','Sub_Category4'));

    }
//--------------------------------------------
    public function update(ArticleRequest $request)
    {
         //dd( $request->all());
         try {

            $validated = $request->validated();
            $Article = Article::findOrFail($request->id);
            //+++++++++++++++++++++  old before  unrequire category++++++++++++++++++++++++++++//
            // $Article->main_cate_id = $request->main_category;
           /*   $Article->main_cate_id = $request->main_cate_id;
             $Article->sub1_id =  $request->sub2;
            $Article->sub2_id = $request->sub3;
            $Article->sub3_id=  $request->sub4;*/
            //++++++++++++++++++++++for unrequire category+++++++++++++++++++++++++++//
              //---"!$request"=> علشان لو ظاهر جزء اضف تصنيف يحفظ بالقيمة 1 كانه مختارش حاجة++++++++++//          
              if(!$request->section_id)
              {
                  $Article->site_id= 1;
              }
              else
              {
                  $Article->site_id= $request->section_id; 
              }
  
              if(!$request->main_category)
              {
                  $Article->main_cate_id=1;
              }
              else
              {
                  $Article->main_cate_id= $request->main_category; 
              }
  
              if(!$request->sub2)
              {
                  $Article->sub1_id= 1;
  
              }
              else
              {
                  $Article->sub1_id= $request->sub2; 
              }
  
              if(!$request->sub3)
              {
                  $Article->sub2_id=1;
              }
              else
              {
                  $Article->sub2_id=$request->sub3; 
              }
              if(!$request->sub4)
              {
                  $Article->sub3_id=1;
              }
              else
              {
                  $Article->sub3_id= $request->sub4; 
              }
            
              //++++++++++++++++++++++++++++++++++++++++++//
            $Article-> title_ar= $request->title_ar;
            $Article->title_en = $request->title_en;
            $Article-> content_ar = $request->content_ar;
            $Article->content_en = $request->content_en;
            $Article-> status=$request->status;

            if($request->image)
            {
            $request->validate(['image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',]);
            $folder_name='';
            //$photo_name= ($request->image)->getClientOriginalName();
            $photo_name= str_replace(' ', '_',($request->image)->getClientOriginalName());
            ($request->image)->storeAs($folder_name,$photo_name,$disk="article");
            
            $Article->image = $photo_name;
            }
       $Article->save();
       if(isset($request->site_id)){
        $Article->rel_section()->sync($request->site_id,['type' => 'articles']);
    }else{
        $Article->rel_section()->sync();
    }
      return redirect()->route('article.index')->with(['success'=>'تم التعديل بنجاح']);
    }
    catch
    (\Exception $e) 
    {
        return redirect()->back()->with(['error' => $e->getMessage()]);
    }
    }
//--------------------------------------------
    public function destroy(Request $request ,$id)
    {
        // dd($id);
        
        if(file_exists(storage_path().'/app/public/article/'.$request->deleted_image)){
            unlink(storage_path().'/app/public/article/'.$request->deleted_image);
        }
        
        try 
        {
        $Article=Article::find($id);  
        $Article->delete(); 
        return redirect()->route('article.index')->with(['success'=>'تم الحذف بنجاح']);
       }
       catch
       (\Exception $e)
       {
           return redirect()->back()->with(['error' => $e->getMessage()]);
       }
    }
    
    public function deleteAll(Request $request)
    {
      $all_ids = explode(',',$request->delete_all_id);
     // dd($all_ids);
     Article::whereIn('id',$all_ids)->delete();
     return redirect()->route('article.index')->with(['success'=>'تم الحذف بنجاح']);
    }
}
