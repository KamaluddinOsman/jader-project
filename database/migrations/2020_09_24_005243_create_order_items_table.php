<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('store_id')->unsigned()->nullable();
            $table->double('price', 10, 2);
            $table->double('original_price', 10, 2);
            $table->double('discount', 10, 2)->nullable();
            $table->integer('quantity');
            $table->text('extra_product')->nullable();
            $table->text('remove_product')->nullable();
            $table->integer('size_id')->nullable();
            $table->integer('color_id')->nullable();
            $table->dateTime('delivery_date')->nullable();
            $table->integer('rate')->nullable();
            $table->string('rate_comment')->nullable();
            $table->enum('status',['cancelled', 'accept', 'rejected', 'complete', 'Paid', 'Pending', 'Received', 'Refund', 'Delivered']);

//            $table->foreign('product_id')->references('id')->on('products');
//            $table->foreign('order_id')->references('id')->on('orders');
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
        Schema::dropIfExists('orders');
    }
}
