<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCruisesTable extends Migration {

	public function up()
	{
		Schema::create('cruises', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('car_id');
			$table->string('client_id');
			$table->string('duration');
			$table->string('starting_point');
			$table->string('end_point');
			$table->string('code');
			$table->float('price');
			$table->enum('status', array('pending', 'accepted', 'canceled'));
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('cruises');
	}
}
