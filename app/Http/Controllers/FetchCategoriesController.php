<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Main_Category; 
use App\Models\Sub_Category2;
use App\Models\sub_Category3;
use App\Models\Sub_Category4;

class FetchCategoriesController extends Controller
{
    //--------------------------------------------
    public function findsub2($id)
    {

    // $sub_Category3= sub_Category3::where('sub2_id',$id)->pluck("id");
     //$sub_Category3= sub_Category3::select("id")->get();
     
    $sub_Category3= sub_Category3::pluck("id"); 
    $data= Sub_Category2::where('cate_id',$id)->whereIn('id',  $sub_Category3)-> pluck("subname2_ar", "id");
     return response()->json($data); //then sent this data to ajax success
    return $data;
    
    }
    
//--------------------------------------------
    public function findsub3($id)
    {
   //  $sub_Category4= sub_Category4::where('sub3_id',$id)->pluck("id");
     $sub_Category4= sub_Category4::pluck("id");
     $data= Sub_Category3::where('sub2_id',$id)->whereIn('id',  $sub_Category4)-> pluck("subname_ar", "id");
      return response()->json($data); //then sent this data to ajax success
     return $data;
    }
    //---------------------------------------------//
    public function findsub4($id)
    {
        $data= Sub_Category4::where('sub3_id',$id)->pluck("subname_ar", "id");
        return response()->json($data); //then sent this data to ajax success
        //return $data;
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
