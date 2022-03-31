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
            $table->unsignedBigInteger('site_id');
            $table->foreign('site_id')->references('id')->on('site_sections')->onDelete('cascade');
           
            $table->string('name_ar');//title_ar
            $table->string('name_en'); //title_en
            
            $table->longText('content_ar');
            $table->longText('content_en');
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
        Schema::dropIfExists('articles');
    }
}
