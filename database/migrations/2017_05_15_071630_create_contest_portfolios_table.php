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
            // $table->decimal('portfolio_value', 10, 2);
            $table->decimal('cash_amount', 10, 2);
            // $table->decimal('current_portfolio_value', 10, 2);
            // $table->string('portfolio_name');
            // $table->decimal('broker_fee', 10, 2);
            // $table->string('broker');
            // $table->string('email_alert');
            $table->timestamp('join_date');
            $table->integer('contest_id')->unsigned()->index();
            // $table->integer('is_trade');
            // $table->integer('contest_is_active');
            // $table->integer('is_active');
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
