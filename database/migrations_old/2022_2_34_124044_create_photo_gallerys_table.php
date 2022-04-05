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

            $table->string('name_ar');//title_ar
            $table->string('name_en'); //title_en
            
            // $table->string('image');
            $table->integer('sort');
            $table->integer('status');
            $table->SoftDeletes();//column of deleted_at
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
