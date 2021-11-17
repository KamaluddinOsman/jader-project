<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOffersTable extends Migration {

	public function up()
	{
		Schema::create('offers', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('product_id');
			$table->string('image_license')->nullable();
			$table->string('name');
			$table->string('desc');
			$table->float('price');
			$table->float('discount');
			$table->float('discount_value');
			$table->string('start');
			$table->string('end');
			$table->boolean('status')->default('0');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('offers');
	}
}
