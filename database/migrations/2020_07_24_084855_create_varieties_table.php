<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVarietiesTable extends Migration {

	public function up()
	{
		Schema::create('varieties', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('category_id');
			$table->string('name');
            $table->boolean('activated')->default(0);
            $table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('varieties');
	}
}
