<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutUsTable extends Migration
{
   
    public function up()
    {
        Schema::create('about_us', function (Blueprint $table) {
            $table->id();
            $table->longText('title_ar');
            $table->longText('title_en');
            $table->longText('mission_ar');
            $table->longText('mission_en');
            $table->longText('vision_ar');
            $table->longText('vision_en');
            $table->longText('goal_ar');
            $table->longText('goal_en');
            $table->longText('image');
            $table->timestamps();
        });
    }

   public function down()
    {
        Schema::dropIfExists('about_us');
    }
}
