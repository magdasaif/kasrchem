<?php

namespace App\Http\Controllers\Photo_Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\GalleryInterface;
use App\Http\Requests\Photo_Gallery_Request;

class Photo_GalleryController extends Controller
{

    protected $xx;
    public function __construct(GalleryInterface $y) {
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
    
    public function store(Photo_Gallery_Request $request)
    {
        return  $this->xx->store($request);
    }

    public function edit($id)
    {
        return  $this->xx->edit($id);
    }

    public function update(Photo_Gallery_Request $request)
    {
        return  $this->xx->update($request);
    }

    public function show_gallery($id){
        return  $this->xx->show_gallery($id);
    }
    
    public function add_gallery_images(Request $request,$id){
        return  $this->xx->add_gallery_images($request,$id);
    }

    public function delete_gallery_images(Request $request,$id){
        return  $this->xx->delete_gallery_images($request,$id);
    }
    
    public function destroy($id)
    {
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

}
