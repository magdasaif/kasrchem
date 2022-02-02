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
            $table->string('title_ar');
            $table->string('title_en');
            $table->string('mission_ar');
            $table->string('mission_en');
            $table->string('vision_ar');
            $table->string('vision_en');
            $table->string('goal_ar');
            $table->string('goal_en');
            $table->string('image');
            $table->timestamps();
        });
    }

   public function down()
    {
        Schema::dropIfExists('about_us');
    }
}
