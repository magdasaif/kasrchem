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
                'site_name_ar' => "ايرادكو يونيتد",
                 'site_name_en' => "Erad United",
                 'site_desc_ar'=>'وصف موقع ايرادكو',
                 'site_desc_en'=>'description for eradco site',
                 'site_mail'=>'eradunited@murabba.dev',
                 'site_phone'=>'01020304050',
                 'site_fax'=>'01020304050',
                 'site_whatsapp'=>'01020304050',
                 'site_logo'=>'logo.jpg' ,
                 'ios_link'=>'https://murabba.com/' ,
                 'android_link'=>'https://murabba.com/' ,

                 'created_at'=>date('Y-m-d H:i:s'),
                 'updated_at'=>date('Y-m-d H:i:s'),
                ),
        );
        DB::table('site_infos')->insert($site_infos);


}
}
