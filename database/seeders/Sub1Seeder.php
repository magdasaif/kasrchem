<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class Sub1Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        DB::table('main_categorys')->delete();
        $main_categorys_data = array(
            array(
                'section_id' => "1",
                 'subname_ar' => "اختر التصنيف الرئيسى",
                'subname_en'=>"choose main_category",
                'status'=>'1',
                 'image'=>'' ,
                 'visible'=>'0',
                  'created_at'=>date('Y-m-d H:i:s'),
                 'updated_at'=>date('Y-m-d H:i:s'),
                ),
        );
        DB::table('main_categorys')->insert($main_categorys_data);
 
    }
}
