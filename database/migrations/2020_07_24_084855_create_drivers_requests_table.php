<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDriversRequestsTable extends Migration {

	public function up()
	{
		Schema::create('drivers_requests', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('client_id');
			$table->integer('car_id');
			$table->integer('address_id');
			$table->integer('order_id')->nullable();
			$table->float('price')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('drivers_requests');
	}
}
