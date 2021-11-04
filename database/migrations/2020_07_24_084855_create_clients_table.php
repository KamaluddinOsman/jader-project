<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->bigInteger('id')->autoIncrement();
			$table->string('first_name', 255);
			$table->string('last_name', 255);
			$table->string('full_name', 255);
			$table->string('email')->nullable();
			$table->string('phone');
            $table->enum('gender', ['Male', 'Female']);
            $table->string('activated')->default(2);
			$table->string('image', 255)->nullable();
			$table->string('password', 255);
			$table->integer('verification_code')->nullable();
			$table->integer('district_id');
			$table->string('provider')->nullable();
			$table->string('provider_id')->nullable();
            $table->bigInteger('facebook_id')->nullable();
            $table->string('accessToken')->nullable();
            $table->string('lang')->nullable();
            $table->string('late')->nullable();
            $table->rememberToken();

			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}
