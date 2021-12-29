<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Sitesection;

class SectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('site_sections')->delete();
        
        $data=[
           'ايرادكو الزراعية','ايرادكو للصحة العامة'
        ];

        foreach($data as $d){
            $section=new Sitesection;

            $section->site_name_ar=$d;
            $section->site_name_en=$d;
            $section->image='';
            $section->statues=1;
            $section->save();
        }
    }
}
