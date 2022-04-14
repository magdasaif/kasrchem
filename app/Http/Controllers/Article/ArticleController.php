<?php
namespace App\Http\Controllers\Article;
use App\Models\Article;
use App\Models\Sitesection;
use Illuminate\Http\Request;
use App\Models\Section_All_Page;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;

use App\Traits\TableAutoIncreamentTrait;
use App\Http\Interfaces\ArticleInterface;

class ArticleController extends Controller
{
  use TableAutoIncreamentTrait;


  protected $xx;
    public function __construct(ArticleInterface $y) {
        $this->xx = $y;
    }
    
    public function index()
    {
        return $this->xx->index();
    }
    public function create()
    {
        return $this->xx->create();
    }
    
    public function store(ArticleRequest $request)
    {
        return  $this->xx->store($request);
    }

    public function edit($id)
    {
        return  $this->xx->edit($id);
    }

    public function update(ArticleRequest $request)
    {
        return  $this->xx->update($request);
    }

    
    public function destroy($id)
    {
      //  dd($id);
      return  $this->xx->destroy($id);
    }

    public function deleteAll(Request $request){
        return $this->xx->bulkDelete($request);
   }

  public function yajra_data(Request $request)
    {
        //dd('ffff');
        return $this->xx->yajra_data($request);
       
    }

   
// //--------------------------------------------
//     public function destroy(Request $request ,$id)
//     {
//         // dd($id);
        
//         if(file_exists(storage_path().'/app/public/article/'.$request->deleted_image)){
//             unlink(storage_path().'/app/public/article/'.$request->deleted_image);
//         }
        
//         try 
//         {
//             Section_All_Page::where('type_id',$id)->where('type','articles')->delete();
//             Article::find($id)->delete();

//             //call trait to handel aut-increament
//             $this->refreshTable('articles');
       
     
//         return redirect()->route('article.index')->with(['success'=>'تم الحذف بنجاح']);
//        }
//        catch
//        (\Exception $e)
//        {
//            return redirect()->back()->with(['error' => $e->getMessage()]);
//        }
//     }
    
//     public function deleteAll(Request $request)
//     {
//       $all_ids = explode(',',$request->delete_all_id);
//      // dd($all_ids);
//      foreach($all_ids as $id){
//         if($id=='on'){}else{
//          Section_All_Page::where('type_id',$id)->where('type','articles')->delete();
//          Article::find($id)->delete();
//         }
//      }
//      //call trait to handel aut-increament
//      $this->refreshTable('articles');
     
//     //  Article::whereIn('id',$all_ids)->delete();
//      return redirect()->route('article.index')->with(['success'=>'تم الحذف بنجاح']);
//     }
}
