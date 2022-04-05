<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReleasesSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //convert to deal with section_all_pages******************************
        
        Schema::create('releases_sections', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('release_id');
            $table->foreign('release_id')->references('id')->on('releases')->onDelete('cascade');

            $table->unsignedBigInteger('sitesection_id');
            $table->foreign('sitesection_id')->references('id')->on('site_sections')->onDelete('cascade');
           
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
        Schema::dropIfExists('releases_sections');
    }
}
