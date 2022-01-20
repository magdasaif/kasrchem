<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {

            //'id','name_ar','name_en','address_ar','address_en','email','phone','fax','latitude','longitude','status'
            $table->id();

            $table->string('name_ar');
            $table->string('name_en');

            $table->text('address_ar');
            $table->text('address_en');

            $table->string('email');

            $table->string('phone');
            $table->string('fax');

            $table->double('latitude',15,8);
            $table->double('longitude',15,8);
            
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
        Schema::dropIfExists('branches');
    }
}
