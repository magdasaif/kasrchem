<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleryPhotoImagesTable extends Migration
{
    
    public function up()
    {
        Schema::create('gallery_photo_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gallery_id');
            $table->foreign('gallery_id')->references('id')->on('photo_gallerys')->onDelete('cascade');
            $table->string('image');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('gallery_photo_images');
    }
}
