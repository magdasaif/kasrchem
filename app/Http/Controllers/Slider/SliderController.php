<?php

namespace App\Http\Controllers\Slider;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;

use App\Http\Interfaces\SliderInterface;
use App\Traits\TableAutoIncreamentTrait;

class SliderController extends Controller
{
    protected $xx;
    public function __construct(SliderInterface $y) {
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
    
    public function store(SliderRequest $request)
    {
        return  $this->xx->store($request);
    }

    public function edit($id)
    {
        return  $this->xx->edit($id);
    }

    public function update(SliderRequest $request)
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
    public function search(Request $request){
        //  dd('ddddd');
          return $this->xx->search($request);
      }
  

// //--------------------------------------------

//     public function deleteAll(Request $request)
//     {
//       $all_ids = explode(',',$request->delete_all_id);
//      // dd($all_ids);
//      Slider::whereIn('id',$all_ids)->delete();

//      //call trait to handel aut-increament
//      $this->refreshTable('sliders');
     
//      return redirect()->route('slider.index')->with(['success'=>'تم الحذف بنجاح']);
//     }
}
