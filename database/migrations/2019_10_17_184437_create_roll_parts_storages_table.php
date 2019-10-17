<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRollPartsStoragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roll_parts_storages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('roll_storage_id');
            $table->foreign('roll_storage_id')->references('id')->on('roll_storages');
            $table->float('width');
            $table->float('lenght');
            $table->float('price');
            $table->unsignedBigInteger('provider_id');
            $table->foreign('provider_id')->references('id')->on('providers');
            $table->unsignedBigInteger('part_status_id');
            $table->foreign('part_status_id')->references('id')->on('part_statuses');
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
        Schema::dropIfExists('roll_parts_storages');
    }
}
