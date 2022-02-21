<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class Sub2Seeder extends Seeder
{
    public function run()
    {
        DB::table('sub_categorys2')->delete();
        $sub_categorys2_data = array(
            array(
              
                'cate_id' => "1",
                 'subname2_ar' => "اختر التصنيف الفرعى ",
                 'subname2_en'=>"choose sub2",
                 'status'=>'1',
                 'image2'=>'' ,
                 'visible'=>'0',
                  'created_at'=>date('Y-m-d H:i:s'),
                 'updated_at'=>date('Y-m-d H:i:s'),
                ),
        );
        DB::table('sub_categorys2')->insert($sub_categorys2_data);
    }
}
