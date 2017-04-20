<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFundamentalsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fundamentals', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->integer('instrument_id')->index('instrument_id');
			$table->integer('meta_id')->index('meta_key_id');
			$table->text('meta_value');
			$table->date('meta_date')->index('meta_date');
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
		Schema::drop('fundamentals');
	}

}
