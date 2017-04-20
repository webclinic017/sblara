<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSectorListsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sector_lists', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name', 32);
			$table->string('full_name', 10)->nullable();
			$table->integer('dse_sector_id');
			$table->integer('exchange_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sector_lists');
	}

}
