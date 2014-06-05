<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('activity_table', function ($table) {
			$table->increments('id');
			$table->integer('activity_column')->unsigned();
			$table->integer('doer_id')->unsigned();
			$table->integer('victim_id')->nullable()->unsigned();
			$table->string('action');
			$table->integer('item_id')->unsigned();
			$table->string('item_type')->nullable();
			$table->string('feed_type')->nullable();
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
		Schema::drop('activity_table');
	}

}