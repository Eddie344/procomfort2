<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZebraPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zebra_prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('construction_id');
            $table->foreign('construction_id')->references('id')->on('zebra_constructions');
            $table->unsignedBigInteger('catalog_id');
            $table->foreign('catalog_id')->references('id')->on('catalogs');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('zebra_categories');
            $table->string('width');
            $table->string('height');
            $table->float('price', 8, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zebra_prices');
    }
}
