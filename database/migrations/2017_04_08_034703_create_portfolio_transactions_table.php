<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePortfolioTransactionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('portfolio_transactions', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->integer('portfolio_id')->nullable();
			$table->integer('instrument_id')->nullable();
			$table->integer('transaction_type_id')->nullable()->comment('1-buy
2-sell
3-watch
4-bonus
5-withdraw
6-deposit');
			$table->integer('amount')->nullable()->comment('number of shares. in case of deposit/withdraw it will be 1');
			$table->float('rate', 10, 0)->nullable()->comment('share price/ deposit withdraw amount/ incase of bonus it will be 0');
			$table->dateTime('transaction_time')->nullable();
			$table->float('commission', 10, 0)->nullable();
			$table->bigInteger('parent_id')->default(0)->comment('0 means no parents');
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
		Schema::drop('portfolio_transactions');
	}

}
