<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMetasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('metas', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->integer('meta_group_id')->index('fk_metas_meta_groups1_idx');
			$table->string('meta_key')->nullable()->index('meta_key');
			$table->text('meta_description')->nullable();
			$table->dateTime('meta_created')->nullable();
			$table->string('single', 200)->nullable();
			$table->string('dual', 200)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('metas');
	}

}
