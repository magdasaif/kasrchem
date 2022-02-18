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
        // DB::table('site_sections')->delete();

        // $data=[
        //   'اختر القسم', 'ايرادكو الزراعية','ايرادكو للصحة العامة'
        // ];

        // foreach($data as $d){
        //     $section=new Sitesection;

        //     $section->site_name_ar=$d;
        //     $section->site_name_en=$d;
        //     $section->image='';
        //     $section->priority=0;
        //     $section->statues=1;
        //     $section->save();
        // }
        DB::table('site_sections')->delete();
        $site_sections_data = array(
            array(
                
                'site_name_ar' => "اختر",
                 'site_name_en' => "choose sitsection",
                 'image'=>'' ,
                 'priority'=>'0',
                 'statues'=>'1',
                 'visible'=>'0',
                  'created_at'=>date('Y-m-d H:i:s'),
                 'updated_at'=>date('Y-m-d H:i:s'),
                ),

                array(
                    'site_name_ar' => "ايرادكو الزراعية",
                     'site_name_en' => "Eradco Agricultural",
                     'image'=>'' ,
                     'priority'=>'0',
                     'statues'=>'1',
                     'visible'=>'1',
                      'created_at'=>date('Y-m-d H:i:s'),
                     'updated_at'=>date('Y-m-d H:i:s'),
                    ),

                    array(
                        'site_name_ar' => "ايرادكو للصحة العامة ",
                         'site_name_en' => "Eradco Public Health",
                         'image'=>'' ,
                         'priority'=>'0',
                         'statues'=>'1',
                         'visible'=>'1',
                          'created_at'=>date('Y-m-d H:i:s'),
                         'updated_at'=>date('Y-m-d H:i:s'),
                        ),
        );
        DB::table('site_sections')->insert($site_sections_data);
    }
}
