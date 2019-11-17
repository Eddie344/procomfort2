<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGorizPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goriz_prices', function (Blueprint $table) {
            Schema::create('vert_prices', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('catalog_id');
                $table->foreign('catalog_id')->references('id')->on('catalogs');
                $table->unsignedBigInteger('category_id');
                $table->foreign('category_id')->references('id')->on('vert_categories');
                $table->float('price', 8, 2);
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goriz_prices');
    }
}
