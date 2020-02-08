<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRollProductMetal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roll_product_metal', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('roll_product_id');
            $table->bigInteger('metal_id');
            $table->string('count');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roll_product_metal');
    }
}
