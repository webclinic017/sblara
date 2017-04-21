<?php

use Illuminate\Database\Seeder;

class TransactionTypeTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        \DB::table('transaction_types')->delete();

        \DB::table('transaction_types')->insert(array(
            array(
                'id' => 1,
                'description' => 'Buy',
                'multiplier' => '1',
            ),
            array(
                'id' => 2,
                'description' => 'Sell',
                'multiplier' => '-1',
            ),
            array(
                'id' => 3,
                'description' => 'Edit',
                'multiplier' => '1',
            ),
            array(
                'id' => 4,
                'description' => 'Delete',
                'multiplier' => '-1',
            ),
        ));
    }

}
