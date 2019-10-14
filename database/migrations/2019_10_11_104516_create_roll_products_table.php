<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRollProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roll_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('material_id');
            $table->foreign('material_id')->references('id')->on('storages');

            $table->unsignedBigInteger('complectation_type_id');
            $table->foreign('complectation_type_id')->references('id')->on('complectation_types');

            $table->unsignedBigInteger('furn_colors_id');
            $table->foreign('furn_colors_id')->references('id')->on('furn_colors');

            $table->unsignedBigInteger('measurement_type_id');
            $table->foreign('measurement_type_id')->references('id')->on('measurement_types');

            $table->unsignedBigInteger('mount_type_id');
            $table->foreign('mount_type_id')->references('id')->on('mount_types');

            $table->boolean('chain_lock');
            $table->boolean('chain_tensioner');
            $table->boolean('fishing_line');
            $table->boolean('magnets');
            $table->boolean('without_drilling');
            $table->boolean('mounting_profile');
            $table->boolean('cover_box');


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
        Schema::dropIfExists('roll_products');
    }
}
