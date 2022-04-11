<?php

namespace App\Http\Repositories;

use App\Models\Partner;
use Yajra\DataTables\DataTables;
use App\Http\Interfaces\PartnerInterface;

class PartnerRepository implements PartnerInterface{
    
    public function index(){
        $data['title']  ='الشركاء';
        $data['partner']=Partner::withoutTrashed()->orderBy('id','desc')->paginate(10);
         return view('pages.partners.show',$data);
    }

    public function yajra_data($request){

        //if ($request->ajax()) {
         $data  = Partner::orderBy('id','DESC')->get();
        // dd($data);
        return Datatables::of($data)
            ->addColumn('record_select',function (Partner $partner) {
                return view('pages.partners.data_table.record_select', compact('partner'));
            })
            ->addColumn('actions',function (Partner $partner) {
                return view('pages.partners.data_table.actions', compact('partner'));
            })
            ->rawColumns(['record_select','actions'])
            ->make(true);
            // ->toJson();
       // }else{return'fffffffff';}
     }
     

    public function create(){

    }
    public function store($request){

    }
    
    public function edit($id){

    }
    public function update($request){

    }
    public function destroy($id){

    }
    public function bulkDelete($request){

    }
}
?>
