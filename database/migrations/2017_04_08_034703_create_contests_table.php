<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contests', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->dateTime('start_date');
			$table->dateTime('end_date');
			$table->boolean('access_level');
			$table->boolean('is_active')->default(1);
			$table->bigInteger('members');
			$table->float('contest_amount', 10, 0);
			$table->float('max_amount', 10, 0)->default(5);
			$table->integer('author');
			$table->string('contest_name');
			$table->string('max_member', 50)->default('0');
			$table->integer('contest_category');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('contests');
	}

}
