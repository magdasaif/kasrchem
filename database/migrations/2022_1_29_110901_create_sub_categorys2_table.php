<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubCategorys2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_categorys2', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('cate_id');
            $table->foreign('cate_id')->references('id')->on('main_categorys')->onDelete('cascade');

            $table->string('subname2_ar');
            $table->string('subname2_en');

            $table->integer('status');

            $table->string('image2');

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
        Schema::dropIfExists('sub_categorys2');
    }
}
