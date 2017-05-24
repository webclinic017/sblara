<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContestPortfoliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contest_portfolios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->decimal('portfolio_value', 10, 2); // Contest Amount
            $table->decimal('cash_amount', 10, 2); // Portfolio Value
            $table->string('portfolio_name');
            $table->decimal('broker_fee', 10, 2);
            $table->string('broker');
            $table->string('email_alert');
            $table->timestamp('creation_date');
            $table->timestamp('join_date');
            $table->integer('contest_id')->unsigned()->index();
            $table->boolean('is_trade')->default(0);
            $table->boolean('contest_isactive')->default(1);
            $table->boolean('is_active')->default(0);
            $table->decimal('current_portfolio_value', 10, 2);

            $table->boolean('approved')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contest_portfolios');
    }
}
