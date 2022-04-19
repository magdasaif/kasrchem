<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_infos', function (Blueprint $table) {
            $table->id();

            $table->string('site_name_ar');
            $table->string('site_name_en');

            $table->longText('site_desc_ar');
            $table->longText('site_desc_en');

            $table->string('site_mail');
            $table->string('site_phone');
            $table->string('site_fax');
            $table->string('site_whatsapp');
            
            //$table->string('site_logo');
            
            $table->string('ios_link');
            $table->string('android_link');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_infos');
    }
}
