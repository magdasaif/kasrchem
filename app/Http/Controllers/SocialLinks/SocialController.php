<?php

namespace App\Http\Controllers\SocialLinks;
use App\Http\Interfaces\SocialInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Social;
use App\Http\Requests\SocialRequest;
use App\Traits\TableAutoIncreamentTrait;

class SocialController extends Controller
{
    use TableAutoIncreamentTrait; //trait to  trueAutoIncreament if delete record
     protected $xx;    //variable to use  interface functions

     //---------construct to relate interface with controller----------
     public function __construct(SocialInterface $y) 
    {
        return $this->xx = $y;
    }
      //-------------------show release function-----------------------
      public function index()
      {
          return $this->xx->index();
      }
//--------------------------------------------------

    public function create()
    {
        return $this->xx->create();
       
    }

    public function store(SocialRequest $request)
    {
        return $this->xx->store($request);
        
    }

   
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return $this->xx->edit($id);
       
    }

    public function update(SocialRequest $request)
    {
        return $this->xx->update($request);
        
    }

    public function destroy($id)
    {
        return $this->xx->destroy($id);

    }
    public function deleteAll(Request $request)
    {
        return $this->xx->bulkDelete($request);
     
    }
}
