<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
   
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            
            $table->string('name_ar');//title_ar
            $table->string('name_en'); //title_en
            
            $table->longText('description_ar');
            $table->longText('description_en');

            $table->longText('content_ar');
            $table->longText('content_en');

            $table->integer('sort');
            
            $table->integer('status');
            
            $table->SoftDeletes();//column of deleted_at

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
