<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNewsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('news', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->integer('market_id');
			$table->integer('instrument_id')->nullable();
			$table->string('prefix', 45);
			$table->string('title')->nullable();
			$table->text('details')->nullable();
			$table->dateTime('post_date')->nullable();
			$table->dateTime('expire_date')->nullable();
			$table->boolean('is_active')->nullable()->default(1);
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
		Schema::drop('news');
	}

}
