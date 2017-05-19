<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContestPortfolioSharesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contest_portfolio_shares', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contest_portfolio_id')->unsigned()->index();
            $table->integer('instrument_id')->unsigned()->index();
            $table->integer('portfolio_id')->unsigned()->index();
            $table->integer('transaction_type_id')->unsigned()->index();

            $table->integer('amount');
            $table->integer('rate');
            $table->integer('commision');
            $table->timestamp('transaction_time');
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
        Schema::dropIfExists('contest_portfolio_shares');
    }
}
