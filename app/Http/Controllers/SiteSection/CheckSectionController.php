<?php

namespace App\Http\Controllers\SiteSection;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Release_Section;
use App\Models\Supplier_section;
use App\Models\Sitesection;
use App\Models\Release;
use App\Models\Supplier;
class CheckSectionController extends Controller
{
     //--------------------------------------------
     public function check_section($section_id)
     {
        //-----------------------------------------------//
        $releases_sections= Release_Section::where("sitesection_id",$section_id)->pluck("release_id"); 
        $supllier_section= Supplier_section::where("sitesection_id",$section_id)->pluck("supplier_id");
        //-----------------------------------------------//
        //   $data= Sitesection::where('id',$section_id)
        //  ->whereIn('id',  $supllier_section)
        //  ->orWhereIn('id',  $releases_sections)
        //  ->get();
        //-------------------------------------------------------//

        
      // dd($data);
       // return $data;
         //return  $releases_sections->count();
       // return  $releases_sections;
       // return  $supllier_section;
       // return  $supllier_section->count();
       //-------------------------------------------------------//
       if($releases_sections->count()>=1 && $supllier_section->count()>=1)
       {
      //  $data = array( "بموردين ونشرات ");
       // $data_release_ = array( "النشرة ");
        $data = array("<span style='color:#009879;font-style: italic;font-weight: bold;font-size: 14px;'>__النشرة التالية__</span>" ,"<br>");
        $data_release= Release::whereIn('id',  $releases_sections)->pluck("title_ar");
        array_push($data, "(",$data_release,")", "<br><br>","<span style='color:#009879;font-style: italic;font-weight: bold;font-size: 14px;'> __ المورد التالى__</span>", "<br>");   


        $data_supplier= Supplier::whereIn('id',  $supllier_section)->pluck("name_ar");
        array_push($data,"(",$data_supplier,")",$releases_sections,$supllier_section);   
        return $data;
       // return  "بموردين ونشرات ";
        }
        


        elseif($releases_sections->count()>=1)
       {
        $data = array("<span style='color:#009879;font-style: italic;font-weight: bold;font-size: 14px;'>__النشرة__</span>" ,"<br>");
        $data_release= Release::whereIn('id',  $releases_sections)->pluck("title_ar");
       array_push($data, $data_release,$releases_sections);   
       return $data ;
       }



       elseif($supllier_section->count()>=1)
       {
        $data = array("<span style='color:#009879;font-style: italic;font-weight: bold;font-size: 14px;'>__المورد__</span>" ,"<br>","<br>");
        $data_supplier= Supplier::whereIn('id',  $supllier_section)->pluck("name_ar");
        array_push($data, $data_supplier,$supllier_section);
        return  $data ;
       }
     }
    
}
