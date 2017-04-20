<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInstrumentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('instruments', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('exchange_id')->index('dse_code');
			$table->integer('sector_list_id')->index('fk_instruments_sectors1_idx');
			$table->string('instrument_code', 100);
			$table->string('isin', 16)->nullable();
			$table->text('name', 65535);
			$table->integer('is_spot')->default(0);
			$table->enum('active', array('0','1'))->default('1');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('instruments');
	}

}
