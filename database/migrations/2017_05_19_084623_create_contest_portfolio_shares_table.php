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
            // $table->integer('portfolio_id')->unsigned()->index();
            // $table->integer('contest_id')->unsigned()->index();
            // $table->integer('transaction_type_id')->unsigned()->index();
            $table->integer('instrument_id')->unsigned()->index();
            $table->decimal('no_of_shares', 9,2);
            $table->decimal('buying_price', 9,2);
            $table->timestamp('buying_date');
            $table->boolean('is_active')->default(1);
            $table->enum('share_status', ['sell','watch','buy'])->default('buy');
            $table->decimal('sell_quantity', 9,2);
            $table->decimal('sell_price', 9,2);
            $table->timestamp('sell_date');
            $table->decimal('commission', 9,2)->default(0.5);
            $table->enum('market', ['DSE','CSE'])->default('DSE');
            $table->boolean('is_mature')->default(0);
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
