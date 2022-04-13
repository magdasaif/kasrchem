<?php
namespace App\Http\Controllers\Pages;
use App\Models\Page;
use App\Models\PageImage;
use Illuminate\Http\Request;
use App\Http\Requests\PageRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ImageRequest;
use App\Http\Controllers\Controller;

use App\Http\Interfaces\PageInterface;
use App\Traits\TableAutoIncreamentTrait;

class PageController extends Controller
{
    use TableAutoIncreamentTrait;
    
    protected $xx;
    public function __construct(PageInterface $y) {
        $this->xx = $y;
    }
    
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
    public function store(PageRequest $request)
    {
        return $this->xx->store($request);
    }

//--------------------------------------------
    public function edit($id)
    {
        return $this->xx->edit($id);
    }
//--------------------------------------------
    public function update(PageRequest $request)
    {
        return $this->xx->update($request);
    }
//----------------------------------------------------------
    public function destroy($id)
    {
        return $this->xx->destroy($id);
    }
//-------------------------------------------------------------
    public function deleteAll(Request $request)
    {
        return $this->xx->bulkDelete($request);
    }

  // --------------start pages images funcrion -----------------------
  public function pages_images($page_id)
  {
    return $this->xx->pages_images($page_id);
  }
  //-----------------------------------------------------------------------------//
  public function add_page_images(ImageRequest $request,$page_id){
    return $this->xx->add_page_images($request,$page_id);
  }
//-----------------------------------------------------------------------------//
  public function delete_page_images(Request $request){
        return $this->xx->delete_page_images($request);
  }
  // --------------end pages images funcrion -----------------------

    
}
