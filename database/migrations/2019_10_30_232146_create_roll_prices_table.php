<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRollPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roll_prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('construction_id');
            $table->foreign('construction_id')->references('id')->on('roll_constructions');
            $table->unsignedBigInteger('catalog_id');
            $table->foreign('catalog_id')->references('id')->on('catalogs');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('roll_categories');
            $table->unsignedBigInteger('width_id');
            $table->foreign('width_id')->references('id')->on('roll_price_widths');
            $table->unsignedBigInteger('height_id');
            $table->foreign('height_id')->references('id')->on('roll_price_heights');
            $table->float('price', 8, 2);
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
        Schema::dropIfExists('roll_prices');
    }
}
