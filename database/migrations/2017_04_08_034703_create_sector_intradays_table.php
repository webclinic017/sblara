<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSectorIntradaysTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sector_intradays', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->integer('market_id')->nullable();
			$table->integer('sector_list_id')->nullable();
			$table->float('index_change', 10, 0)->nullable();
			$table->float('index_change_per', 10, 0)->nullable();
			$table->float('price_change', 10, 0)->nullable();
			$table->integer('volume')->nullable();
			$table->float('value', 10, 0);
			$table->float('contribution', 10, 0)->nullable();
			$table->date('index_date')->nullable();
			$table->time('index_time')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sector_intradays');
	}

}
