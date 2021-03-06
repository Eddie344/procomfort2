<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRollStoragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roll_storages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('label');
            $table->unsignedBigInteger('catalog_id');
            $table->foreign('catalog_id')->references('id')->on('catalogs');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('roll_categories');
            $table->unsignedBigInteger('picture_id');
            $table->foreign('picture_id')->references('id')->on('roll_pictures');
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
        Schema::dropIfExists('roll_storages');
    }
}
