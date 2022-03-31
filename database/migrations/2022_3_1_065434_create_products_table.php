<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {

            $table->id();
           
            $table->longText('name_ar');
            $table->longText('name_en');

            $table->longText('description_ar');
            $table->longText('description_en');

            // $table->string('image');

            $table->string('video_link');
            $table->string('link');

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
        Schema::dropIfExists('products');
    }
}
