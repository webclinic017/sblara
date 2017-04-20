<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDataBanksEodsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('data_banks_eods', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('market_id')->nullable()->index('fk_data_banks_daily_markets1_idx');
			$table->integer('instrument_id')->nullable()->index('fk_data_banks_daily_instruments1_idx');
			$table->float('open', 10, 0)->nullable();
			$table->float('high', 10, 0)->nullable();
			$table->float('low', 10, 0)->nullable();
			$table->float('close', 10, 0)->nullable();
			$table->integer('volume')->nullable();
			$table->integer('trade')->nullable();
			$table->float('tradevalues', 10, 0)->nullable();
			$table->date('date')->nullable()->index('date');
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
		Schema::drop('data_banks_eods');
	}

}
