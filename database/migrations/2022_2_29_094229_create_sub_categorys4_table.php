<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubCategorys4Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_categorys4', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sub3_id');
            $table->foreign('sub3_id')->references('id')->on('sub_categorys3')->onDelete('cascade');
            $table->string('subname_ar');
            $table->string('subname_en');
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
        Schema::dropIfExists('sub_categorys4');
    }
}
