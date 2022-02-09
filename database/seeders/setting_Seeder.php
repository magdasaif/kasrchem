<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class setting_Seeder extends Seeder
{

    public function run()
    {

        DB::table('site_infos')->delete();
        $site_infos = array(
            array(
                'site_name_ar' => "ايرادكو",
                 'site_name_en' => "Eradco",
                 'site_desc_ar'=>'وصف موقع ايرادكو',
                 'site_desc_en'=>'description for eradco site',
                 'site_mail'=>'info@eradco.com',
                 'site_phone'=>'01020304050',
                 'site_fax'=>'01020304050',
                 'site_whatsapp'=>'01020304050',
                 'site_logo'=>'logo.jpg' ,
                 
                 'created_at'=>date('Y-m-d H:i:s'),
                 'updated_at'=>date('Y-m-d H:i:s'),
                ),
        );
        DB::table('site_infos')->insert($site_infos);
 

}
}