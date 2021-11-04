<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpacialCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spacial_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('store_id');
            $table->string('status')->default('1'); // عملتها كدا علشان تكون مظبوطه مع حالات المنتج  1 - تشغيل  4- ايقاف
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spacial_categories');
    }
}
