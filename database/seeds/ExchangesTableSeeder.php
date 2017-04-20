<?php

use Illuminate\Database\Seeder;

class ExchangesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('exchanges')->delete();
        
        \DB::table('exchanges')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'DSE',
                'full_name' => 'Dhaka Stock Exchange',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'CSE',
                'full_name' => 'Chittagong Stock Exchange',
            ),
        ));
        
        
    }
}