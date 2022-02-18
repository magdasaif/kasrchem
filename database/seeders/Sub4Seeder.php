<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class Sub4Seeder extends Seeder
{
    
    public function run()
    {
        DB::table('sub_categorys4')->delete();
        $sub_categorys4_data = array(
            array(
               
                'sub3_id' => "1",
                 'subname_ar' => "اختر ",
                'subname_en'=>"choose sub4",
                'status'=>'1','visible'=>'0',
                  'created_at'=>date('Y-m-d H:i:s'),
                 'updated_at'=>date('Y-m-d H:i:s'),
                ),
        );
        DB::table('sub_categorys4')->insert($sub_categorys4_data);
    }
}
