<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStorageRollMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storage_roll_materials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('width');
            $table->float('lenght');
            $table->float('price');
            $table->bigInteger('storageable_id')->nullable();
            $table->string('storageable_type')->nullable();
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
        Schema::dropIfExists('storage_roll_materials');
    }
}
