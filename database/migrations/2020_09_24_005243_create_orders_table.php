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
            $table->increments('id');
            $table->integer('client_id')->unsigned();
            $table->integer('car_id')->unsigned();
            $table->integer('store_id')->unsigned();
            $table->integer('address_id')->unsigned();
            $table->string('name_buyer');
            $table->enum('payment', ['cash', 'visa']);
            $table->string('description')->nullable();
            $table->integer('rate')->nullable();
            $table->string('rate_comment')->nullable();
            $table->text('billing_address')->nullable();
            $table->string('billing_phone')->nullable();
//            $table->string('billing_name_on_card')->nullable();
            $table->double('billing_discount')->default(0);
            $table->string('billing_discount_code')->nullable();
            $table->double('billing_subtotal');
            $table->double('billing_tax');
            $table->double('billing_total');
            $table->string('payment_gateway')->nullable();
            $table->double('shipped')->nullable();
            $table->integer('code_delivered')->nullable();
            $table->enum('status',['unpaid', 'new', 'padding','cancel', 'Delivered']);
            $table->text('note')->nullable();
            $table->string('invoice_image')->nullable();

//            $table->foreign('client_id')->references('id')->on('clients');
//            $table->foreign('store_id')->references('id')->on('store');
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
