<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

Trait  MediaTrait
{
    //---------------------- retrive media id from media url-------------------------------
     function get_media_id($url){         
         //$url==> http://localhost:8000/storage/media/62/conversions/download_(2)-edit.jpg
        $get_media_folder= explode('media/',$url);//[0=>'http://localhost:8000/storage/',1=>'62/conversions/download_(2)-edit.jpg']
        //$get_media_folder[1] ==> 62/conversions/download_(2)-edit.jpg
        $folder_name= explode('/',$get_media_folder[1]);//[0=>'62',1=>'conversions/download_(2)-edit.jpg']
        $media_id= $folder_name[0]; // 62 ==> id that we can delete it
        return $media_id;
    }

    
 }