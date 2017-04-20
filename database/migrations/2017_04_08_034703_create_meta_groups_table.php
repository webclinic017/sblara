<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMetaGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('meta_groups', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('group_key')->nullable();
			$table->string('group_description')->nullable();
			$table->dateTime('group_created')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('meta_groups');
	}

}
