<?php

use Illuminate\Database\Seeder;

class MetaGroupsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('meta_groups')->delete();
        
        \DB::table('meta_groups')->insert(array (
            0 => 
            array (
                'id' => 3,
                'group_key' => 'event_Meta_group',
                'group_description' => 'group of event meta',
                'group_created' => '2014-10-16 09:19:00',
            ),
            1 => 
            array (
                'id' => 4,
                'group_key' => 'market_stats',
                'group_description' => 'Meta of Market Stats Table',
                'group_created' => '2014-10-23 11:45:00',
            ),
            2 => 
            array (
                'id' => 5,
                'group_key' => 'index_list',
                'group_description' => 'Instrument list for dsex, dses, ds30',
                'group_created' => '2014-10-28 10:25:00',
            ),
            3 => 
            array (
                'id' => 1,
                'group_key' => 'basic',
            'group_description' => 'Basic fundamental information (previously it was stored in symbol table)',
                'group_created' => '2014-07-20 15:53:00',
            ),
            4 => 
            array (
                'id' => 15,
                'group_key' => 'instruments_logo',
                'group_description' => NULL,
                'group_created' => '2014-12-07 10:07:01',
            ),
            5 => 
            array (
                'id' => 6,
                'group_key' => 'user_informations',
                'group_description' => 'Group for user_informations table',
                'group_created' => '2014-11-27 12:18:00',
            ),
            6 => 
            array (
                'id' => 7,
                'group_key' => 'year_news_Info',
                'group_description' => 'All Year end News Information input here.',
                'group_created' => '2014-12-01 00:00:00',
            ),
            7 => 
            array (
                'id' => 8,
                'group_key' => 'yearly_change_info',
                'group_description' => 'Yearly change data which comes after AGM.',
                'group_created' => '2014-12-01 13:08:17',
            ),
            8 => 
            array (
                'id' => 9,
                'group_key' => 'yearly_fixed_info',
                'group_description' => 'When company add in dse/cse as well as those information which are fixed all time.',
                'group_created' => '2014-12-01 13:36:08',
            ),
            9 => 
            array (
                'id' => 10,
                'group_key' => 'yearly_other_info',
                'group_description' => 'Company other information which comes rarely.',
                'group_created' => '2014-12-01 14:07:24',
            ),
            10 => 
            array (
                'id' => 11,
                'group_key' => 'add_new_company',
                'group_description' => 'Add company when it comes in dse,cse',
                'group_created' => '2014-12-01 14:12:21',
            ),
            11 => 
            array (
                'id' => 12,
                'group_key' => 'q1_report_news_info',
                'group_description' => 'Company First Quarter information.',
                'group_created' => '2014-12-01 14:18:44',
            ),
            12 => 
            array (
                'id' => 13,
                'group_key' => 'q3_report_news_info',
            'group_description' => 'Company  Q3(9 month) & 3rd Quarter(3 month) information.',
                'group_created' => '2014-12-01 14:29:00',
            ),
            13 => 
            array (
                'id' => 14,
                'group_key' => 'q2_report_news_info',
            'group_description' => 'Company Half(6 month) & 2ndd Quarter(3 month) information.',
                'group_created' => '2014-12-01 14:27:01',
            ),
            14 => 
            array (
                'id' => 16,
                'group_key' => 'financial_reports',
                'group_description' => 'Annual, q1, q2, q3',
                'group_created' => '2014-12-07 14:23:51',
            ),
            15 => 
            array (
                'id' => 17,
                'group_key' => 'mutual_fund_data',
                'group_description' => NULL,
                'group_created' => '2016-07-14 00:00:00',
            ),
            16 => 
            array (
                'id' => 18,
                'group_key' => 'company_financial_performance',
                'group_description' => 'This should be removed after importing all data correctly',
                'group_created' => '2016-07-25 14:11:05',
            ),
            17 => 
            array (
                'id' => 20,
                'group_key' => 'quarterly_data',
            'group_description' => 'Save data in quarterly_stats  (id, meta_id, meta_value, meta_date_start, meta_date_end, type)',
                'group_created' => '2017-03-30 00:00:00',
            ),
        ));
        
        
    }
}