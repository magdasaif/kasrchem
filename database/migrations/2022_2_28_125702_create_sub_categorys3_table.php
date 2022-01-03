<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubCategorys3Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Sub_Categorys3', function (Blueprint $table) {
          
            $table->id();

            $table->unsignedBigInteger('sub2_id');
            $table->foreign('sub2_id')->references('id')->on('sub2_categories')->onDelete('cascade');

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
        Schema::dropIfExists('Sub_Categorys3');
    }

}
