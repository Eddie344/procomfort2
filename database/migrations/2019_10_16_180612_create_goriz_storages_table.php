<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGorizStoragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goriz_storages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('label');
            $table->unsignedBigInteger('catalog_id');
            $table->foreign('catalog_id')->references('id')->on('catalogs');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('goriz_categories');
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
        Schema::dropIfExists('goriz_storages');
    }
}
