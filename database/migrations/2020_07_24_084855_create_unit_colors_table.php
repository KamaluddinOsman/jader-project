<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUnitColorsTable extends Migration {

	public function up()
	{
		Schema::create('unit_colors', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('category_id');
			$table->string('name');
			$table->string('code')->nullable();
			$table->enum('type', array('unit', 'color'));
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('unit_colors');
	}
}
