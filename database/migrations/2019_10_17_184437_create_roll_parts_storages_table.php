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
            $table->foreign('roll_storage_id')->references('id')->on('roll_storages')->onDelete('cascade');
            $table->float('width', 8, 2);
            $table->float('lenght', 8, 2);
            $table->float('price', 8, 2);
            $table->unsignedBigInteger('provider_id');
            $table->foreign('provider_id')->references('id')->on('providers');
            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id')->references('id')->on('part_statuses');
            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')->references('id')->on('part_types');
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
