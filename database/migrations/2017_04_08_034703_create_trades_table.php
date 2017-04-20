<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTradesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('trades', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->integer('market_id')->nullable()->index('market_id');
			$table->bigInteger('TRD_SNO')->nullable();
			$table->bigInteger('TRD_TOTAL_TRADES')->nullable();
			$table->bigInteger('TRD_TOTAL_VOLUME')->nullable();
			$table->float('TRD_TOTAL_VALUE', 10, 0)->nullable();
			$table->dateTime('TRD_LM_DATE_TIME')->nullable();
			$table->date('trade_date')->nullable();
			$table->time('trade_time')->nullable()->index('trade_time');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('trades');
	}

}
