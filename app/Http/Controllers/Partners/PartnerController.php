<?php

namespace App\Http\Controllers\Partners;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PartnerRequest;
use App\Http\Interfaces\PartnerInterface;

class PartnerController extends Controller
{
    protected $xx;
    public function __construct(PartnerInterface $y) {
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
    
    public function store(PartnerRequest $request)
    {
        return  $this->xx->store($request);
    }

    public function edit($id)
    {
        return  $this->xx->edit($id);
    }

    public function update(PartnerRequest $request)
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

}
