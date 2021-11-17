<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTokenTable extends Migration {

	public function up()
	{
		Schema::create('token', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('tokntable_id');
			$table->string('tokntable_type');
			$table->string('token');
			$table->enum('platform', array('android', 'ios'));
		});
	}

	public function down()
	{
		Schema::drop('token');
	}
}