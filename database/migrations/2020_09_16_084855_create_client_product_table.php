<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientProductTable extends Migration {

	public function up()
	{
        Schema::create('client_product', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned();
//            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');

            $table->integer('product_id')->unsigned();
//            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            $table->timestamps();

        });
	}

	public function down()
	{
		Schema::drop('client_product');
	}
}
