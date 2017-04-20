<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFeedbacksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('feedbacks', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('application_id')->nullable()->index('fk_feedbacks_apps1_idx')->comment('0 for no application (feedback for site)');
			$table->string('apps_code', 100);
			$table->integer('user_id')->nullable()->comment('0 if not registerred ');
			$table->string('feedback_user_name', 45)->nullable();
			$table->string('feedback_user_email', 45)->nullable();
			$table->string('feedback_user_contact', 45)->nullable();
			$table->text('feedback', 65535)->nullable();
			$table->string('status', 45)->nullable();
			$table->dateTime('created')->nullable();
			$table->boolean('can_communicate')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('feedbacks');
	}

}
