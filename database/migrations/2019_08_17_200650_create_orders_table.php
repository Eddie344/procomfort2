<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('creator_id');
            $table->unsignedBigInteger('diller_id');
            $table->string('prefix')->nullable(); //Либо номер заказа заказчика, либо имя заказчика, которое ставит админ, если заказчика нет в бд

            $table->unsignedBigInteger('product_type');
            $table->unsignedBigInteger('status_id')->default('1');
            $table->text('admin_msg');
            $table->text('diller_msg');

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('creator_id')->references('id')->on('users');
            $table->foreign('diller_id')->references('id')->on('users');
            $table->foreign('product_type')->references('id')->on('product_types');
            $table->foreign('status_id')->references('id')->on('order_statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
