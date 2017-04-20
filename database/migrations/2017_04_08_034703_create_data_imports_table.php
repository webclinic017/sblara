<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDataImportsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('data_imports', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('import_from', 124)->nullable();
			$table->string('import_to', 124)->nullable();
			$table->integer('last_import_start_id')->nullable();
			$table->integer('last_import_end_id');
			$table->dateTime('last_updated')->nullable();
			$table->binary('summary', 65535);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('data_imports');
	}

}
