<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCorporateActionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('corporate_action', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('instrument_id');
			$table->string('action', 100);
			$table->float('value', 10, 0);
			$table->float('premium', 10, 0);
			$table->date('record_date');
			$table->integer('active');
			$table->integer('adjusted');
			$table->dateTime('updated');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('corporate_action');
	}

}
