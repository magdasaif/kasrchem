<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSitesectionsTable extends Migration
{
    public function up()
    {
        Schema::create('site_sections', function (Blueprint $table) {
            $table->id()->start_from(1);            
            $table->unsignedBigInteger('parent_id')->unsigned()->nullable();
            $table->foreign('parent_id')->references('id')->on('site_sections')->onDelete('cascade');

            $table->text('name_ar');
            $table->text('name_en');
         
            $table->longText('description_ar');
            $table->longText('description_en');

            $table->integer('sort');//proirity

            $table->integer('status');//statues

            // $table->string('image');
            $table->boolean('visible')->default(1);
            $table->timestamps();


        });
        

    }


    public function down()
    {
        Schema::dropIfExists('site_sections');
    }
}
