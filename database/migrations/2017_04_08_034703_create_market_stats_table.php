<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMarketStatsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('market_stats', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->integer('market_id')->nullable();
			$table->integer('meta_id')->nullable();
			$table->text('meta_value')->nullable();
			$table->date('meta_date')->nullable();
			$table->time('meta_time')->nullable()->default('00:00:00');
			$table->dateTime('created')->nullable();
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
		Schema::drop('market_stats');
	}

}
