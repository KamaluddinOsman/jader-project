<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriesTable extends Migration {

	public function up()
	{
		Schema::create('categories', function(Blueprint $table) {
			$table->increments('id');
            $table->integer('parent_id')->nullable();
            $table->string('name');
			$table->string('image');
			$table->boolean('activated')->default(1);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('categories');
	}
}
