<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFurnRetirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('furn_retirements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')->references('id')->on('product_types');
            $table->unsignedBigInteger('construction_id')->nullable();
            $table->foreign('construction_id')->references('id')->on('complectation_types');
            $table->string('label');
            $table->unsignedBigInteger('furn_id')->nullable();
            $table->foreign('furn_id')->references('id')->on('furn_storages');
            $table->string('depends');
            $table->string('dependsCount');
            $table->bigInteger('count');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('furn_retirements');
    }
}
