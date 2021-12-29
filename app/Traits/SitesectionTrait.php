<?php

namespace App\Traits;

Trait  SitesectionTrait
{
     function saveImage($image,$folder){
        //save photo in folder
        $file_extension = $image -> getClientOriginalExtension();
        $file_name = time().'.'.$file_extension;
        $path = $folder;
        $image -> move($path,$file_name);

        return $file_name;
    }



    // $file_name = time().'.'.$request->image->extension();  
   // $request->image->move(public_path('images\site_sections'), $file_name);
}
