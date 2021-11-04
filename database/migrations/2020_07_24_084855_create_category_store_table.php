<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoryStoreTable extends Migration {

    public function up()
    {
        Schema::create('category_store', function (Blueprint $table) {

            $table->integer('store_id')->unsigned();

            $table->integer('category_id')->unsigned();

//            $table->foreign('store_id')->references('id')->on('stores')
//
//                ->onDelete('cascade');
//
//            $table->foreign('category_id')->references('id')->on('categories')
//
//                ->onDelete('cascade');

        });
    }

    public function down()
    {
        Schema::drop('category_store');
    }
}
