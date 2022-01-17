<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('main_cate_id');
            $table->foreign('main_cate_id')->references('id')->on('main_categories')->onDelete('cascade');
            
            $table->unsignedBigInteger('sub1_id');
            $table->foreign('sub1_id')->references('id')->on('sub2_categories')->onDelete('cascade');
            
            $table->unsignedBigInteger('sub2_id');
            $table->foreign('sub2_id')->references('id')->on('Sub_Categorys3')->onDelete('cascade');
           
            $table->unsignedBigInteger('sub3_id');
            $table->foreign('sub3_id')->references('id')->on('sub_categorys4')->onDelete('cascade');
          
            $table->string('title_ar');
            $table->string('title_en');
            $table->longText('content_ar');
            $table->longText('content_en');
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
        Schema::dropIfExists('articles');
    }
}
