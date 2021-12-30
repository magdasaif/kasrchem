<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSitesectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
<<<<<<< HEAD
<<<<<<< HEAD
      //  Schema::create('sitesections', function (Blueprint $table) {
=======
>>>>>>> yasmeen
=======
      //  Schema::create('sitesections', function (Blueprint $table) {
>>>>>>> magda
        Schema::create('site_sections', function (Blueprint $table) {
            $table->id();
            $table->string('site_name_ar');
            $table->string('site_name_en');
<<<<<<< HEAD
<<<<<<< HEAD
            $table->integer('statues');
            $table->string('image');
            $table->timestamps();
=======
            $table->int('statues');
            $table->string('image');
            $table->timestamps();


>>>>>>> yasmeen
=======
            $table->integer('statues');
            $table->string('image');
            $table->timestamps();
>>>>>>> magda
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_sections');
    }
}
