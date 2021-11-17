<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->text('About')->nullable();
			$table->string('commission')->nullable();
			$table->string('phone')->nullable();
			$table->string('site')->nullable();
			$table->string('facebook')->nullable();
			$table->string('logo')->nullable();
			$table->string('FIREBASE_API_KEY')->nullable();
			$table->string('JWT_SECRET')->nullable();
			$table->string('GOOGLE_API')->nullable();
			$table->string('FACEBOOK_APP_ID')->nullable();
			$table->string('FACEBOOK_APP_SECRET')->nullable();
			$table->string('sms_USERNAME')->nullable();
			$table->string('sms_PASSWORD')->nullable();
			$table->string('sms_SENDER')->nullable();
			$table->string('sms_URL')->nullable();
			$table->string('publishable_api_key')->nullable();
			$table->string('value_added_tax')->nullable();
			$table->integer('normal_ratio')->nullable();
			$table->integer('zero_ratio')->nullable();
			$table->integer('platinum_ratio')->nullable();
			$table->integer('silver_ratio')->nullable();
			$table->integer('golden_ratio')->nullable();
			$table->integer('massey_ratio')->nullable();

			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}
