<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class Sub3Seeder extends Seeder
{
    public function run()
    {
        DB::table('sub_categorys3')->delete();
        $sub_categorys3_data = array(
            array(
                
                'sub2_id' => "1",
                 'subname_ar' => "اختر ",
                'subname_en'=>"choose sub3",
                'status'=>'1',
                 'image'=>'' ,
                 'visible'=>'0',
                  'created_at'=>date('Y-m-d H:i:s'),
                 'updated_at'=>date('Y-m-d H:i:s'),
                ),
        );
        DB::table('sub_categorys3')->insert($sub_categorys3_data);
    }
}
