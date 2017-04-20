<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContestPortfoliosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contest_portfolios', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id')->default(0)->index('user_id');
			$table->float('portfolio_value', 10, 0)->default(0);
			$table->string('cash_amount', 100)->default('0');
			$table->string('portfolio_name', 100)->default('');
			$table->float('broker_fee', 10, 0)->default(0);
			$table->string('broker', 100)->default('');
			$table->integer('email_alert')->default(0);
			$table->integer('creation_date')->default(0);
			$table->date('join_date');
			$table->integer('contest_id');
			$table->integer('is_trade')->default(0);
			$table->integer('contest_isactive')->default(1);
			$table->integer('is_active')->default(0);
			$table->float('current_portfolio_value', 10, 0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('contest_portfolios');
	}

}
