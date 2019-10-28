<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetalPartsStoragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metal_parts_storages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('metal_storage_id');
            $table->foreign('metal_storage_id')->references('id')->on('metal_storages')->onDelete('cascade');
            $table->float('lenght');
            $table->float('price');
            $table->unsignedBigInteger('provider_id');
            $table->foreign('provider_id')->references('id')->on('providers');
            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id')->references('id')->on('part_statuses');
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
        Schema::dropIfExists('metal_parts_storages');
    }
}
