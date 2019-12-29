<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetalRetirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metal_retirements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')->references('id')->on('product_types');
            $table->unsignedBigInteger('construction_id')->nullable();
            $table->foreign('construction_id')->references('id')->on('complectation_types');
            $table->string('label');
            $table->unsignedBigInteger('metal_id')->nullable();
            $table->foreign('metal_id')->references('id')->on('metal_storages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('metal_retirements');
    }
}
