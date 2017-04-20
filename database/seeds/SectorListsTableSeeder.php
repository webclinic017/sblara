<?php

use Illuminate\Database\Seeder;

class SectorListsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sector_lists')->delete();
        
        \DB::table('sector_lists')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Bank',
                'full_name' => 'Bank',
                'dse_sector_id' => 11,
                'exchange_id' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Cement',
                'full_name' => 'Cement',
                'dse_sector_id' => 21,
                'exchange_id' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Ceramics Sector',
                'full_name' => 'Ceramics S',
                'dse_sector_id' => 24,
                'exchange_id' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Corporate Bond',
                'full_name' => 'Corporate ',
                'dse_sector_id' => 26,
                'exchange_id' => 1,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Debenture',
                'full_name' => 'Debenture',
                'dse_sector_id' => 91,
                'exchange_id' => 1,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Engineering',
                'full_name' => 'Engineerin',
                'dse_sector_id' => 13,
                'exchange_id' => 1,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Financial Institutions',
                'full_name' => 'Financial ',
                'dse_sector_id' => 28,
                'exchange_id' => 1,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Food & Allied',
                'full_name' => 'Food & All',
                'dse_sector_id' => 14,
                'exchange_id' => 1,
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Fuel & Power',
                'full_name' => 'Fuel & Pow',
                'dse_sector_id' => 15,
                'exchange_id' => 1,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Insurance',
                'full_name' => 'Insurance',
                'dse_sector_id' => 25,
                'exchange_id' => 1,
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'IT Sector',
                'full_name' => 'IT Sector',
                'dse_sector_id' => 22,
                'exchange_id' => 1,
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Jute',
                'full_name' => 'Jute',
                'dse_sector_id' => 16,
                'exchange_id' => 1,
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Miscellaneous',
                'full_name' => 'Miscellane',
                'dse_sector_id' => 19,
                'exchange_id' => 1,
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Mutual Funds',
                'full_name' => 'Mutual Fun',
                'dse_sector_id' => 12,
                'exchange_id' => 1,
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'Paper & Printing',
                'full_name' => 'Paper & Pr',
                'dse_sector_id' => 19,
                'exchange_id' => 1,
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'Pharmaceuticals & Chemicals',
                'full_name' => 'Pharmaceut',
                'dse_sector_id' => 18,
                'exchange_id' => 1,
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'Services & Real Estate',
                'full_name' => 'Services &',
                'dse_sector_id' => 20,
                'exchange_id' => 1,
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'Tannery Industries',
                'full_name' => 'Tannery In',
                'dse_sector_id' => 23,
                'exchange_id' => 1,
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'Telecommunication',
                'full_name' => 'Telecommun',
                'dse_sector_id' => 27,
                'exchange_id' => 1,
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'Textile',
                'full_name' => 'Textile',
                'dse_sector_id' => 17,
                'exchange_id' => 1,
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'Travel & Leisure',
                'full_name' => 'Travel & L',
                'dse_sector_id' => 29,
                'exchange_id' => 1,
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'Treasury Bond',
                'full_name' => 'Treasury B',
                'dse_sector_id' => 88,
                'exchange_id' => 1,
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'index',
                'full_name' => 'index',
                'dse_sector_id' => 0,
                'exchange_id' => 1,
            ),
        ));
        
        
    }
}