<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned()->nullable();
            $table->integer('store_id')->nullable();
//            $table->foreign('client_id')->references('id')
//                  ->on('clients')->onUpdate('cascade')->onDelete('cascade');

            $table->integer('product_id')->unsigned()->nullable();
//            $table->foreign('product_id')->references('id')
//                ->on('products')->onUpdate('cascade')->onDelete('cascade');

            $table->string('extra_product')->nullable();
            $table->string('remove_product')->nullable();

            $table->integer('size_id')->nullable();
            $table->integer('color_id')->nullable();

            $table->json('questions')->nullable();


            $table->integer('quantity')->unsigned();
            $table->float('total_price')->unsigned();
            $table->float('original_price')->unsigned();
            $table->float('discount')->unsigned()->nullable();
            $table->dateTime('end_offer')->nullable();
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
        Schema::dropIfExists('cart');
    }
}
