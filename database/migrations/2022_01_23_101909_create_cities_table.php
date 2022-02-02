<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar');
            $table->string('title_en');
            $table->integer('charge_spend'); //مصاريف الشحن
            $table->integer('status');
            $table->timestamps();
        });
    }

  
    public function down()
    {
        Schema::dropIfExists('cities');
    }
}
