<?php

namespace App\Http\Controllers\Video;
use App\Http\Interfaces\VideoInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\VideoRequest;


use App\Traits\TableAutoIncreamentTrait;
class VideoController extends Controller
{
    use TableAutoIncreamentTrait;
    protected $data; 
    //---------construct to relate interface with controller----------
       public function __construct(VideoInterface $Data) 
       {
           return $this->data = $Data;
       }
    //---------------------show video function----------------------------
        public function index()
        {
           return $this->data->index();
        }
    //-----------------------shoe adding form----------------------------
        public function create()
        {
            return $this->data->create();
           
        }
   //---------------------------------------------------------------------
        public function show($id)
        {
            //
        }
   //---------------------------------------------------------------------
        public function store(VideoRequest $request)
        {
            return $this->data->store($request);  
        }
   //--------------------------------------------
        public function edit($id)
        {
            return $this->data->edit($id);  
        }

//--------------------------------------------
    public function update(VideoRequest $request)
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
        return $this->data->bulkDelete($request);
    }

}
