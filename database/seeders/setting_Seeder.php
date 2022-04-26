<?php

namespace Database\Seeders;
use App\Models\SiteInfo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Traits\TableAutoIncreamentTrait;
class setting_Seeder extends Seeder
{ use TableAutoIncreamentTrait;

    public function run()
    {

        DB::table('site_infos')->delete();
        
        //call trait to handel aut-increament
        $this->refreshTable('site_infos');
        
        $info = new SiteInfo;
        $info->site_name_ar="قصر كيم";
        $info->site_name_en="Kasr chem";
        $info->site_desc_ar="وصف موقع قصر كيم";
        $info->site_desc_en="description for Kasr  chem site";
        $info->site_mail="kasrchem.murabba.dev";
        $info->site_phone="01020304050";
        $info->site_fax="01020304050";
        $info->site_whatsapp="01020304050";
        $info->ios_link="https://murabba.com/";
        $info->android_link="https://murabba.com/";
        $info->created_at=date('Y-m-d H:i:s');
        $info->updated_at=date('Y-m-d H:i:s');
        $info->save();

        //optimize image
        // $image=asset('images/logo2.jpg');//default
        //  $info->addMedia($image)->toMediaCollection('site_logo');
        


}
}
