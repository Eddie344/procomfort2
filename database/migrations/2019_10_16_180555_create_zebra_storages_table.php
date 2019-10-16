<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZebraStoragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zebra_storages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('label');
            $table->unsignedBigInteger('catalog_id');
            $table->foreign('catalog_id')->references('id')->on('catalogs');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('zebra_categories');
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
        Schema::dropIfExists('zebra_storages');
    }
}
