<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuarterlyStatsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('quarterly_stats', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('meta_id');
			$table->float('meta_value', 10, 0);
			$table->date('meta_date_start');
			$table->date('meta_date_end');
			$table->string('type', 128);
			$table->dateTime('created');
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
		Schema::drop('quarterly_stats');
	}

}
