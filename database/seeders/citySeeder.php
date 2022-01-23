<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class citySeeder extends Seeder
{
    
    public function run()
    {
        
        DB::table('cities')->delete();
        $cities_data = array(
            array('title_ar' => "تبوك",'title_en' => "Tabuk",'charge_spend'=>0,'status'=>1,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')),
            array('title_ar' => "تبوك",'title_en' => "Tabuk",'charge_spend'=>0,'status'=>1,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')),

            array('title_ar' => "تبوك",'title_en' => "Tabuk",'charge_spend'=>0,'status'=>1,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')),

            array('title_ar' => "تبوك",'title_en' => "Tabuk",'charge_spend'=>0,'status'=>1,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')),

            array('title_ar' => "تبوك",'title_en' => "Tabuk",'charge_spend'=>0,'status'=>1,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')),

            array('title_ar' => "تبوك",'title_en' => "Tabuk",'charge_spend'=>0,'status'=>1,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')),

            array('title_ar' => "تبوك",'title_en' => "Tabuk",'charge_spend'=>0,'status'=>1,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')),
            array('title_ar' => "تبوك",'title_en' => "Tabuk",'charge_spend'=>0,'status'=>1,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')),

            array('title_ar' => "تبوك",'title_en' => "Tabuk",'charge_spend'=>0,'status'=>1,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')),

            array('title_ar' => "تبوك",'title_en' => "Tabuk",'charge_spend'=>0,'status'=>1,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')),

            array('title_ar' => "تبوك",'title_en' => "Tabuk",'charge_spend'=>0,'status'=>1,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')),

            array('title_ar' => "تبوك",'title_en' => "Tabuk",'charge_spend'=>0,'status'=>1,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')),

            array('title_ar' => "تبوك",'title_en' => "Tabuk",'charge_spend'=>0,'status'=>1,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')),

            array('title_ar' => "تبوك",'title_en' => "Tabuk",'charge_spend'=>0,'status'=>1,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')),

            array('title_ar' => "تبوك",'title_en' => "Tabuk",'charge_spend'=>0,'status'=>1,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')),

            );
            DB::table('cities')->insert($cities_data);
     

    }
}
