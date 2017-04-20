<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDataBanksIntradaysTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('data_banks_intradays', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('market_id')->nullable()->index('fk_data_banks_intradays_markets1_idx');
			$table->integer('instrument_id')->nullable()->index('fk_data_banks_intradays_instruments1_idx');
			$table->string('quote_bases', 10);
			$table->float('open_price', 10, 0)->default(0);
			$table->float('pub_last_traded_price', 10, 0)->default(0);
			$table->float('spot_last_traded_price', 10, 0)->default(0);
			$table->float('high_price', 10, 0)->default(0);
			$table->float('low_price', 10, 0)->default(0);
			$table->float('close_price', 10, 0)->default(0);
			$table->float('yday_close_price', 10, 0)->default(0);
			$table->integer('total_trades')->default(0);
			$table->integer('total_volume')->default(0);
			$table->float('total_value', 10, 0)->default(0);
			$table->integer('public_total_trades')->default(0);
			$table->integer('public_total_volume')->default(0);
			$table->float('public_total_value', 10, 0)->default(0);
			$table->integer('spot_total_trades')->default(0);
			$table->integer('spot_total_volume')->default(0);
			$table->float('spot_total_value', 10, 0)->default(0);
			$table->dateTime('lm_date_time')->index('lm_date_time');
			$table->time('trade_time')->index('trade_time');
			$table->date('trade_date')->index('trade_date');
			$table->integer('batch')->index('batch');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('data_banks_intradays');
	}

}
