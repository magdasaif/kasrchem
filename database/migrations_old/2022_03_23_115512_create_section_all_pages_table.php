<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionAllPagesTable extends Migration
{
   
    public function up()
    {
        Schema::create('section_all_pages', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->integer('type_id');
            $table->unsignedBigInteger('sitesection_id');
            $table->foreign('sitesection_id')->references('id')->on('site_sections')->onDelete('cascade');
            $table->timestamps();
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('section_all_pages');
    }
}
