<?php
namespace App\Http\Controllers\Pages;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PageRequest;
use App\Models\Page;


class PageController extends Controller
{
    public function index()
    {
        $Page=Page::all();
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

            return redirect()->route('page.index')->with(['success'=>'تمت الاضافه بنجاح']);
        }
        catch(\Exception $e){
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
        $Page=Page::find($id);  
        $Page->delete(); 
        return redirect()->route('page.index')->with(['success'=>'تم الحذف بنجاح']);
        }
       catch
       (\Exception $e)
       {
           return redirect()->back()->with(['error' => $e->getMessage()]);
       }
    }
}
