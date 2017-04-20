<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMarketsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('markets', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->date('trade_date')->index('trade_date');
			$table->boolean('is_trading_day')->default(1)->comment('1-trading day
');
			$table->time('market_started')->nullable();
			$table->time('market_closed')->nullable();
			$table->string('comments', 124)->nullable()->comment('Reason of market close, delay etc');
			$table->integer('exchange_id')->nullable()->index('fk_markets_exchanges1_idx')->comment('DSE or CSE');
			$table->integer('data_bank_intraday_batch')->index('data_bank_intraday_batch');
			$table->integer('batch_total_trades');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('markets');
	}

}
