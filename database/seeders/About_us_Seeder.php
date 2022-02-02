<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class About_us_Seeder extends Seeder
{

    public function run()
    {

        DB::table('about_us')->delete();
        $about_us_data = array(
            array(
                'title_ar' => "من نحن",
                 'title_en' => "about",
                 'mission_ar'=>'الرسالة',
                 'mission_en'=>'mission',
                 'vision_ar'=>'الرؤية',
                 'vision_en'=>'vision',
                 'goal_ar'=>'الهدف',
                 'goal_en'=>'goal',
                 'image'=>'' ,
                'created_at'=>date('Y-m-d H:i:s'),
                 'updated_at'=>date('Y-m-d H:i:s'),
                ),
        );
        DB::table('about_us')->insert($about_us_data);
 

}
}