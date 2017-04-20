<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDataBankBlocksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('data_bank_blocks', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('market_id')->nullable();
			$table->integer('instrument_id')->nullable();
			$table->float('max_price', 10, 0)->nullable();
			$table->float('min_price', 10, 0)->nullable();
			$table->integer('volume')->nullable();
			$table->integer('trade')->nullable();
			$table->float('tradevalues', 10, 0)->nullable();
			$table->date('date')->nullable();
			$table->timestamp('updated')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('data_bank_blocks');
	}

}
