<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotoGallerysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photo_gallerys', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('site_id');
            $table->foreign('site_id')->references('id')->on('site_sections')->onDelete('cascade');

            $table->unsignedBigInteger('main_cate_id');
            $table->foreign('main_cate_id')->references('id')->on('main_categorys')->onDelete('cascade');
            
            $table->unsignedBigInteger('sub1_id');
            $table->foreign('sub1_id')->references('id')->on('sub_categorys2')->onDelete('cascade');
            
            $table->unsignedBigInteger('sub2_id');
            $table->foreign('sub2_id')->references('id')->on('sub_categorys3')->onDelete('cascade');
           
            $table->unsignedBigInteger('sub3_id');
            $table->foreign('sub3_id')->references('id')->on('sub_categorys4')->onDelete('cascade');
          
            $table->string('title_ar');
            $table->string('title_en');
            $table->string('image');
            $table->integer('status');
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
        Schema::dropIfExists('photo_gallerys');
    }
}
