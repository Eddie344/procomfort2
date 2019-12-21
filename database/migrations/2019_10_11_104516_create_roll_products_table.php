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

            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders');

            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')->references('id')->on('product_types');

            $table->unsignedBigInteger('construction_id');
            $table->foreign('construction_id')->references('id')->on('construction_types');

            $table->unsignedBigInteger('rule_type_id');
            $table->foreign('rule_type_id')->references('id')->on('product_rule_types');

            $table->float('rule_lenght');

            $table->float('price', 8, 2);
            $table->float('width', 8, 2);
            $table->float('height', 8, 2);
            $table->text('note');

            $table->unsignedBigInteger('material_id');
            $table->foreign('material_id')->references('id')->on('roll_storages');

            $table->unsignedBigInteger('complectation_type_id');
            $table->foreign('complectation_type_id')->references('id')->on('complectation_types');

            $table->unsignedBigInteger('furn_color_id');
            $table->foreign('furn_color_id')->references('id')->on('furn_colors');

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
