<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliversCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivers_costs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('from_k')->nullable();
            $table->integer('to_k')->nullable();
            $table->integer('from_price')->nullable();
            $table->integer('to_price')->nullable();
            $table->integer('type_car')->nullable();

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
        Schema::dropIfExists('delivers_costs');
    }
}
