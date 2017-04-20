<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIndexValuesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('index_values', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('market_id')->nullable()->index('fk_index_values_markets1_idx');
			$table->integer('instrument_id')->index('fk_index_values_indexes1_idx');
			$table->float('capital_value', 10, 0);
			$table->float('deviation', 10, 0);
			$table->float('percentage_deviation', 10, 0);
			$table->dateTime('date_time');
			$table->date('index_date');
			$table->time('index_time')->index('index_time');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('index_values');
	}

}
