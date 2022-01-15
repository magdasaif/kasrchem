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

            $table->unsignedBigInteger('main_cate_id');
            $table->foreign('main_cate_id')->references('id')->on('main_categories')->onDelete('cascade');

            $table->string('name_ar');
            $table->string('name_en');

            $table->string('code');

            $table->longText('desc_ar');
            $table->longText('desc_en');

            $table->float('price');
            $table->float('tax');
            $table->float('offer_price');

            $table->integer('amount');
            $table->integer('min_amount');
            $table->integer('max_amount');

            $table->float('shipped_weight');
            $table->integer('sell_through')->comment('1 for site_branch,2 for site,3 for branch');
            $table->integer('sort');

            $table->string('image');

            $table->string('video_link');

            $table->integer('availabe_or_no');
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
        Schema::dropIfExists('products');
    }
}
