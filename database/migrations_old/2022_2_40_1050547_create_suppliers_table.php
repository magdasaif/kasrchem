<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en');
<<<<<<< HEAD
            // $table->string('logo');
=======
            $table->string('logo');
            $table->integer('sort');
>>>>>>> ed0918f9da3e9e6c1b7f461ea3b242ada7243ee2
            $table->longText('description_ar');
            $table->longText('description_en');
            $table->integer('parent_id');
            $table->string('type');

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
        Schema::dropIfExists('suppliers');
    }
}
