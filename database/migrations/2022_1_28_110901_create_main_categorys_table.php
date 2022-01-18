<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMainCategorysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_categorys', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('section_id');
            $table->foreign('section_id')->references('id')->on('site_sections')->onDelete('cascade');

            $table->string('subname_ar');
            $table->string('subname_en');

            $table->integer('status');

            $table->string('image');

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
        Schema::dropIfExists('main_categorys');
    }
}
