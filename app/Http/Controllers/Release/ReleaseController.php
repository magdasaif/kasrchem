<?php

namespace App\Http\Controllers\Release;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\ReleaseRequest;
use App\Http\Interfaces\ReleaseInterface;
use App\Traits\TableAutoIncreamentTrait;

class ReleaseController extends Controller
{
    use TableAutoIncreamentTrait; //trait to  trueAutoIncreament if delete record
     protected $data;    //variable to use  interface functions

    //---------construct to relate interface with controller----------
     public function __construct(ReleaseInterface $Data) 
    {
        return $this->data = $Data;
    }
    //-------------------show release function-----------------------
    public function index()
    {
        return $this->data->index();
    }
    //-------------------create adding form -------------------------
    public function create()
    {
        return $this->data->create();
    }
   //--------------------------------------------
    public function store(ReleaseRequest $request)
    {
        return $this->data->store($request);
    }
   //--------------------------------------------
    public function edit($id)
    {
        return $this->data->edit($id);
    }
   //--------------------------------------------
    public function update(Request $request)
    {
        return $this->data->update($request);
    }
    //--------------------------------------------
    public function destroy($id)
    {
        return $this->data->destroy($id);
    }
    //--------------------------------------------
    public function deleteAll(Request $request)
    {
        return $this->data->deleteAll($request);
    }

}
