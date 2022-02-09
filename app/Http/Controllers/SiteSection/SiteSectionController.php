<?php

namespace App\Http\Controllers\SiteSection;
use App\Http\Controllers\Controller;
use App\Http\Requests\SiteSectionRequest;
use App\Models\Sitesection;
use App\Traits\SitesectionTrait;
use Illuminate\Http\Request;

class SiteSectionController extends Controller
{
    public function index()
    {
       // return "Sitesection";
       $site_section=Sitesection::orderBy('priority','asc')->get();

      return view('pages.Sitesection.Sitesection',compact('site_section'));
    }

    public function create()
    {
        return view('pages.Sitesection.add');
    }

    public function store(SiteSectionRequest $request)
    {


        if(  Sitesection::where('site_name_ar',$request->site_name_ar)
        ->orWhere('site_name_en',$request->site_name_en)
        ->exists()
        ){
            return redirect()->back()->withErrors('هذا القسم مُضاف بالفعل من قبل ');
        }

    try{
            //vaildation
           $validated = $request->validated();

           if($request->image){
               $folder_name='site_section_image';
                $photo_name= str_replace(' ', '_',($request->image)->getClientOriginalName());
                 ($request->image)->storeAs($folder_name,$photo_name,$disk="site_sections");
               // ($request->image)->storeAs($folder_name,$photo_name);
           }else{
               $photo_name='';
           }


           $Sitesection = new Sitesection
           ([
            'site_name_ar' => $request->site_name_ar,
            'site_name_en' => $request->site_name_en,
            'priority' => $request-> priority,
            'statues' =>  $request->statues,
            'image' =>$photo_name,
        ]);
        $Sitesection->save();

            return redirect()->route('site_section.index')->with(['success'=>'تمت الاضافه بنجاح']);
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }
        // $requested_data = $request->all();
        // dd($requested_data);



    }

    public function edit($id)
    {
        $section = Sitesection::findOrfail($id);
        if(!$section)
             return redirect()->back();
        return view('pages.Sitesection.edit',compact('section'));
    }

    public function update(SiteSectionRequest $request,$id)
    {
       try {

          $validated = $request->validated();
          $Sitesections = Sitesection::findOrFail($request->id);

          // $file_name = $this->saveImage($request->image,'images\site_sections');

            ///----------------------------///----------------------------
            // if(Input::hasFile('image'))

                // File::delete('site_sections/'.$request->image); // Delete old flyer
               // File::delete(asset("storage/site_sections/{$section->image}"));

            //    if(!empty($request->image))
            //    {
            //    $old_image = "storage/app/public/site_sections/{$request->image}";
            //    if (file_exists($old_image)) {
            //        @unlink($old_image);
            //    }
            //    }
///----------------------------///----------------------------
      if($request->image){
              $folder_name='site_section_image';
              $photo_name= str_replace(' ', '_',($request->image)->getClientOriginalName());
              ($request->image)->storeAs($folder_name,$photo_name,$disk="site_sections");
             $Sitesections->image = $photo_name;
        }
           ///------------------------------
         
            $Sitesections->site_name_ar = $request->site_name_ar;
            $Sitesections->site_name_en = $request->site_name_en;
            $Sitesections->priority = $request->priority;
            $Sitesections->statues = $request->statues;
          
        $Sitesections->save();

        //   toastr()->success('تم التعديل بنجاح');
        //   return redirect()->route('site_section.index');
        return redirect()->route('site_section.index')->with(['success'=>'تم التعديل بنجاح']);

      }
      catch
      (\Exception $e) {
          return redirect()->back()->withErrors(['error' => $e->getMessage()]);
      }

      }

    public function show($id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
