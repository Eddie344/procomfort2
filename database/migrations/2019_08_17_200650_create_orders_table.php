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
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->string('order_name')->nullable(); //Либо номер заказа заказчика, либо имя заказчика, которое ставит админ, если заказчика нет в бд

            $table->unsignedBigInteger('status');

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('creator_id')->references('id')->on('users');
            $table->foreign('customer_id')->references('id')->on('users');
            $table->foreign('status')->references('id')->on('order_statuses');
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
