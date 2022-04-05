<?php

namespace App\Traits;

Trait ImageTrait{
    
    //-------------------get last id of table to handel folder name to store image on it ---------------
    function getTableLastId($model){
        $modelFullPath="App\Models\\".$model;
        $last_id = $modelFullPath::orderBy('id', 'desc')->first();           
        if($last_id){$new_id = $last_id->id + 1;}else{$new_id=1;}
        return  $new_id; 
    }

    //-------------------handel name of image ,then store it in disk-------------------------
    function storeImage($imageData){
        $photo_name= str_replace(' ', '_',($imageData['image_name'])->getClientOriginalName());
        ($imageData['image_name'])->storeAs($imageData['folder_name'],$photo_name,$disk=$imageData['disk_name']);
        return  $photo_name;
    }

    //--------------------------unlink image from disk----------------------------------------
    function unLinkImage($imageData){
        if(file_exists($imageData['path'])){
            unlink($imageData['path']);
        }
    }

    //-------------------handel name of file ,then store it in disk-------------------------
    function storeFile($fileData)
    {
         $file_name= str_replace(' ', '_',($fileData['file_name'])->getClientOriginalName());
         ($fileData['file_name'])->storeAs($fileData['folder_name'],$file_name,$disk=$fileData['disk_name']);
         return  $file_name;
    }
    
}
?>