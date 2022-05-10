<?php

namespace Database\Seeders;

use App\Models\Sitesection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Traits\TableAutoIncreamentTrait;

class SectionsSeeder extends Seeder
{
    use TableAutoIncreamentTrait;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        $this->refreshTable('site_sections');
        //=======check if found data in table or not ========
        $site_section = Sitesection::get();
       if (count($site_section)==0) {

            DB::table('site_sections')->delete();
            $sections_data = array(
                array(
                    
                    'name_ar' => "اختر اسم القسم",
                    'name_en' => "choose sitsection",
                    //  //'image'=>'' ,
                    'sort'=>'0',
                    'status'=>'1',
                    'visible'=>'0',
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s'),
                    ),

                    array(
                        'name_ar' => "ايرادكو الزراعية",
                        'name_en' => "Eradco Agricultural",
                        //'image'=>'' ,
                        'sort'=>'0',
                        'status'=>'1',
                        'visible'=>'1',
                        'created_at'=>date('Y-m-d H:i:s'),
                        'updated_at'=>date('Y-m-d H:i:s'),
                        ),

                        array(
                            'name_ar' => "ايرادكو للصحة العامة ",
                            'name_en' => "Eradco Public Health",
                            //'image'=>'' ,
                            'sort'=>'0',
                            'status'=>'1',
                            'visible'=>'1',
                            'created_at'=>date('Y-m-d H:i:s'),
                            'updated_at'=>date('Y-m-d H:i:s'),
                            ),
            );
            DB::table('site_sections')->insert($sections_data);
        }
    }
}
