<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDataBanksAdjustedEodsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('data_banks_adjusted_eods', function(Blueprint $table)
		{
			$table->integer('id');
			$table->integer('market_id')->nullable();
			$table->integer('instrument_id')->nullable();
			$table->float('open', 10, 0)->nullable();
			$table->float('high', 10, 0)->nullable();
			$table->float('low', 10, 0)->nullable();
			$table->float('close', 10, 0)->nullable();
			$table->integer('volume')->nullable();
			$table->integer('trade')->nullable();
			$table->float('tradevalues', 10, 0)->nullable();
			$table->date('date')->nullable();
			$table->dateTime('updated')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('data_banks_adjusted_eods');
	}

}
