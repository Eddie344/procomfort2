<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGorizProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goriz_products', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders');

            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')->references('id')->on('product_types');

            $table->unsignedBigInteger('rule_type');
            $table->foreign('rule_type')->references('id')->on('product_rule_types');

            $table->float('rule_lenght');

            $table->unsignedBigInteger('mount_type_id');
            $table->foreign('mount_type_id')->references('id')->on('mount_types');

            $table->unsignedBigInteger('material_id');
            $table->foreign('material_id')->references('id')->on('goriz_storages');

            $table->float('price', 8, 2);
            $table->float('width', 8, 2);
            $table->float('height', 8, 2);
            $table->text('note')->nullable();
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
        Schema::dropIfExists('goriz_products');
    }
}
