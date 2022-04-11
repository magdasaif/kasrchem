<?php

namespace App\Http\Controllers\Branches;
use App\Http\Interfaces\BrancheInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branche;
use App\Http\Requests\BranchRequest;
use App\Traits\TableAutoIncreamentTrait;
class BrancheController extends Controller
{
    use TableAutoIncreamentTrait;
    protected $xx;    //variable to use  interface functions

    //---------construct to relate interface with controller----------
    public function __construct(BrancheInterface $y) 
   {
       return $this->xx = $y;
   }
   //--------------------------------------------
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
    public function store(BranchRequest $request)
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
  public function update(BranchRequest $request)
    {
       return $this->xx->update($request); 
    }
//--------------------------------------------
    public function destroy($id)
    {
        return $this->xx->destroy($id); 
    }
//--------------------------------------------
     
    public function deleteAll(Request $request)
    {
        return $this->xx->bulkDelete($request);
    }
    
}
