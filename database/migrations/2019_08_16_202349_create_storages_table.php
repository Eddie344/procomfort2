<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('label');
            $table->string('route');
//            $table->unsignedBigInteger('type_id');
//            $table->foreign('type_id')->references('id')->on('storages_types');
//
//            $table->bigInteger('categoriable_id')->default('1');
//            $table->string('categoriable_type')->nullable();
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
        Schema::dropIfExists('storages');
    }
}
