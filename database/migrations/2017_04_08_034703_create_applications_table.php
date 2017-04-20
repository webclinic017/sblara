<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateApplicationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('applications', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('apps_code', 45)->nullable();
			$table->string('apps_name', 45)->nullable();
			$table->boolean('active')->nullable()->default(1);
			$table->dateTime('developed_on')->nullable();
			$table->text('dependency', 65535)->nullable()->comment('table.coloumn string seperated by comma');
			$table->text('input', 65535)->nullable();
			$table->text('output', 65535)->nullable();
			$table->string('manager', 45)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('applications');
	}

}
