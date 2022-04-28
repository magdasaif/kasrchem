<?php

namespace App\Http\Resources;

use App\Models\Release;
use Illuminate\Http\Resources\Json\JsonResource;

class ReleaseResource extends JsonResource
{
   
    public function toArray($request)
    {

        $files=Release::find($this->id)->mainFile();
        $new_files='';
        foreach($files as $fi){
            $new_files=asset('storage/releases/release_no_'.$this->id.'/' . $fi->filename);
        }
        return [

            'id' =>$this->id,
            'title' =>$this->title,
            'image' =>  $this->getFirstMediaUrl('releases'),
            'attachment' =>  $new_files,
           
        ];           
      //  return parent::toArray($request);
    }
}