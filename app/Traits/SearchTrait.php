<?php

namespace App\Traits;

Trait SearchTrait{
    
   //---------------------------------------------------------//
    function search($searchData)
    {
        $model="App\Models\\".$searchData['model']; 
        $title  =$searchData['title'];   //"use"
        $search_text = $searchData['search_text'];  //"use"
        $searching_result= $model::where('visible',1)->where('name_ar','LIKE','%'.$search_text.'%')->get();
        
        $searching_count=count($searching_result); //count result  "use"
        $searching="search";   //"use"
        $Sitesections= $model::where('name_ar','LIKE','%'.$search_text.'%')->where('visible',1)->orderBy('sort','asc')->paginate(2);
         $data=[];
         array_push($data,  $title ,  $search_text , $searching_count, $Sitesections );
        return $data;
        //return $model;
        



    }
}
?>