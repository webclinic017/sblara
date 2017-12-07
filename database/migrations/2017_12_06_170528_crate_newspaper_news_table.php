<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrateNewspaperNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('NewspaperNews', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->longText('details')->nullable();
            $table->date('published_date')->nullable();
            $table->integer('status')->nullable()->default(1)->comment = "1= Active 0= Pending";
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
        Schema::dropIfExists('NewspaperNews');
    }
}
