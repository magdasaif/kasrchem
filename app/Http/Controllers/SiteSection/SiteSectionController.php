<?php

namespace App\Http\Controllers\SiteSection;
use App\Http\Controllers\Controller;
use App\Http\Requests\SiteSectionRequest;
use App\Http\Interfaces\SectionInterface;
use Illuminate\Http\Request;

class SiteSectionController extends Controller
{
    protected $xx;
    public function __construct(SectionInterface $y) {
        $this->xx = $y;
    }
    //------------------------------------------------------
    public function index()
    {
      return $this->xx->index();
    }
    //--------------------------------------------
    public function create()
    {
        return $this->xx->create();     
    }
   //--------------------------------------------
    public function store(SiteSectionRequest $request)
    {
        return $this->xx->store($request);     
      
    }
   //--------------------------------------------
    public function show($id)
    {
        //
    }
  //--------------------------------------------
   public function edit($id)
    {
        return $this->xx->edit($id); 
    }
  //--------------------------------------------
  public function update(SiteSectionRequest $request)
    {
       return $this->xx->update($request); 
    }
   //--------------------------------------------
    public function destroy($id)
    {
        return $this->xx->destroy($id); 
    }
  //--------------------------------------------
  public function search(Request $request){
    //  dd('ddddd');
      return $this->xx->search($request);
  } 
//--------------------------------------------
  public function section_images($section_id){
    return $this->xx->section_images($section_id);
  }
  //--------------------------------------------
  public function add_section_images(Request $request,$section_id){
    return $this->xx->add_section_images($request,$section_id);
  }
  //--------------------------------------------
  public function delete_section_images(Request $request){
    return $this->xx->delete_section_images($request);
  }
  
}

