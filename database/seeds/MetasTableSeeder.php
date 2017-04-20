<?php

use Illuminate\Database\Seeder;

class MetasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('metas')->delete();
        
        \DB::table('metas')->insert(array (
            0 => 
            array (
                'id' => 72,
                'meta_group_id' => 3,
                'meta_key' => 'Record_date_dividend',
                'meta_description' => 'company yearly dividend record date.',
                'meta_created' => '2014-11-10 15:09:00',
                'single' => '',
                'dual' => '',
            ),
            1 => 
            array (
                'id' => 75,
                'meta_group_id' => 3,
                'meta_key' => 'event_type',
                'meta_description' => '',
                'meta_created' => '2014-10-19 07:25:00',
                'single' => '',
                'dual' => '',
            ),
            2 => 
            array (
                'id' => 76,
                'meta_group_id' => 4,
                'meta_key' => 'cap_equity',
                'meta_description' => 'cap_equity',
                'meta_created' => '2014-10-23 11:49:00',
                'single' => '',
                'dual' => '',
            ),
            3 => 
            array (
                'id' => 77,
                'meta_group_id' => 4,
                'meta_key' => 'cap_mutual_fund',
                'meta_description' => 'cap_mutual_fund',
                'meta_created' => '2014-10-23 11:49:00',
                'single' => '',
                'dual' => '',
            ),
            4 => 
            array (
                'id' => 78,
                'meta_group_id' => 4,
                'meta_key' => 'cap_debt_sec',
                'meta_description' => 'cap_debt_sec',
                'meta_created' => '2014-10-23 11:50:00',
                'single' => '',
                'dual' => '',
            ),
            5 => 
            array (
                'id' => 79,
                'meta_group_id' => 4,
                'meta_key' => 'cap_total',
                'meta_description' => 'cap_total',
                'meta_created' => '2014-10-23 11:50:00',
                'single' => '',
                'dual' => '',
            ),
            6 => 
            array (
                'id' => 80,
                'meta_group_id' => 4,
                'meta_key' => 'issueadvance',
                'meta_description' => 'issueadvance',
                'meta_created' => '2014-10-23 11:50:00',
                'single' => '',
                'dual' => '',
            ),
            7 => 
            array (
                'id' => 81,
                'meta_group_id' => 4,
                'meta_key' => 'issuedecline',
                'meta_description' => 'issuedecline',
                'meta_created' => '2014-10-23 11:51:00',
                'single' => '',
                'dual' => '',
            ),
            8 => 
            array (
                'id' => 82,
                'meta_group_id' => 4,
                'meta_key' => 'issueunchange',
                'meta_description' => 'issueunchange',
                'meta_created' => '2014-10-23 11:51:00',
                'single' => '',
                'dual' => '',
            ),
            9 => 
            array (
                'id' => 83,
                'meta_group_id' => 4,
                'meta_key' => 'issuetraded',
                'meta_description' => 'issuetraded',
                'meta_created' => '2014-10-23 11:52:00',
                'single' => '',
                'dual' => '',
            ),
            10 => 
            array (
                'id' => 84,
                'meta_group_id' => 4,
                'meta_key' => 'market_pe',
                'meta_description' => 'market_pe',
                'meta_created' => '2014-10-23 11:52:00',
                'single' => '',
                'dual' => '',
            ),
            11 => 
            array (
                'id' => 85,
                'meta_group_id' => 5,
                'meta_key' => 'dsex_listed',
                'meta_description' => 'If it is included in dsex index',
                'meta_created' => '2014-10-28 10:27:00',
                'single' => '',
                'dual' => '',
            ),
            12 => 
            array (
                'id' => 2,
                'meta_group_id' => 1,
                'meta_key' => 'dse_code',
                'meta_description' => 'dse_code',
                'meta_created' => '2014-07-21 12:22:29',
                'single' => '',
                'dual' => '',
            ),
            13 => 
            array (
                'id' => 4,
                'meta_group_id' => 1,
                'meta_key' => 'name',
                'meta_description' => 'name',
                'meta_created' => '2014-07-21 12:22:29',
                'single' => '',
                'dual' => '',
            ),
            14 => 
            array (
                'id' => 5,
                'meta_group_id' => 1,
                'meta_key' => 'category',
                'meta_description' => 'category',
                'meta_created' => '2014-07-21 12:22:29',
                'single' => '',
                'dual' => '',
            ),
            15 => 
            array (
                'id' => 6,
                'meta_group_id' => 1,
                'meta_key' => 'cse_code',
                'meta_description' => 'cse_code',
                'meta_created' => '2014-07-21 12:22:29',
                'single' => '',
                'dual' => '',
            ),
            16 => 
            array (
                'id' => 7,
                'meta_group_id' => 1,
                'meta_key' => 'update_time',
                'meta_description' => 'update_time',
                'meta_created' => '2014-07-21 12:22:29',
                'single' => '',
                'dual' => '',
            ),
            17 => 
            array (
                'id' => 10,
                'meta_group_id' => 1,
                'meta_key' => 'outstanding_capital',
                'meta_description' => 'outstanding_capital',
                'meta_created' => '2014-07-21 12:22:29',
                'single' => '',
                'dual' => '',
            ),
            18 => 
            array (
                'id' => 11,
                'meta_group_id' => 1,
                'meta_key' => 'face_value',
                'meta_description' => 'face_value',
                'meta_created' => '2014-07-21 12:22:29',
                'single' => '',
                'dual' => '',
            ),
            19 => 
            array (
                'id' => 12,
                'meta_group_id' => 1,
                'meta_key' => 'market_lot',
                'meta_description' => 'market_lot',
                'meta_created' => '2014-07-21 12:22:29',
                'single' => '',
                'dual' => '',
            ),
            20 => 
            array (
                'id' => 13,
                'meta_group_id' => 1,
                'meta_key' => 'no_of_securities',
                'meta_description' => 'no_of_securities',
                'meta_created' => '2014-07-21 12:22:29',
                'single' => '',
                'dual' => '',
            ),
            21 => 
            array (
                'id' => 14,
                'meta_group_id' => 1,
                'meta_key' => 'business_segment',
                'meta_description' => 'business_segment',
                'meta_created' => '2014-07-21 12:22:29',
                'single' => '',
                'dual' => '',
            ),
            22 => 
            array (
                'id' => 15,
                'meta_group_id' => 1,
                'meta_key' => 'dse_listing_year',
                'meta_description' => 'dse_listing_year',
                'meta_created' => '2014-07-21 12:22:29',
                'single' => '',
                'dual' => '',
            ),
            23 => 
            array (
                'id' => 16,
                'meta_group_id' => 1,
                'meta_key' => 'cse_listing_year',
                'meta_description' => 'cse_listing_year',
                'meta_created' => '2014-07-21 12:22:29',
                'single' => '',
                'dual' => '',
            ),
            24 => 
            array (
                'id' => 17,
                'meta_group_id' => 1,
                'meta_key' => 'electronic_share',
                'meta_description' => 'electronic_share',
                'meta_created' => '2014-07-21 12:22:29',
                'single' => '',
                'dual' => '',
            ),
            25 => 
            array (
                'id' => 18,
                'meta_group_id' => 1,
                'meta_key' => 'share_percentage_director',
                'meta_description' => 'share_percentage_director',
                'meta_created' => '2014-07-21 12:22:29',
                'single' => 'ss',
                'dual' => 'dd',
            ),
            26 => 
            array (
                'id' => 19,
                'meta_group_id' => 1,
                'meta_key' => 'share_percentage_govt',
                'meta_description' => 'share_percentage_govt',
                'meta_created' => '2014-07-21 12:22:29',
                'single' => '',
                'dual' => '',
            ),
            27 => 
            array (
                'id' => 20,
                'meta_group_id' => 1,
                'meta_key' => 'share_percentage_institute',
                'meta_description' => 'share_percentage_institute',
                'meta_created' => '2014-07-21 12:22:29',
                'single' => '',
                'dual' => '',
            ),
            28 => 
            array (
                'id' => 21,
                'meta_group_id' => 1,
                'meta_key' => 'share_percentage_foreign',
                'meta_description' => 'share_percentage_foreign',
                'meta_created' => '2014-07-21 12:22:29',
                'single' => '',
                'dual' => '',
            ),
            29 => 
            array (
                'id' => 22,
                'meta_group_id' => 1,
                'meta_key' => 'share_percentage_public',
                'meta_description' => 'share_percentage_public',
                'meta_created' => '2014-07-21 12:22:29',
                'single' => '',
                'dual' => '',
            ),
            30 => 
            array (
                'id' => 27,
                'meta_group_id' => 1,
                'meta_key' => 'market_capital',
                'meta_description' => 'market_capital',
                'meta_created' => '2014-07-21 12:22:29',
                'single' => '',
                'dual' => '',
            ),
            31 => 
            array (
                'id' => 28,
                'meta_group_id' => 1,
                'meta_key' => 'last_agm_held',
                'meta_description' => 'last_agm_held',
                'meta_created' => '2014-07-21 12:22:29',
                'single' => '',
                'dual' => '',
            ),
            32 => 
            array (
                'id' => 29,
                'meta_group_id' => 1,
                'meta_key' => 'bonus_issue',
                'meta_description' => 'bonus_issue',
                'meta_created' => '2014-07-21 12:22:29',
                'single' => '',
                'dual' => '',
            ),
            33 => 
            array (
                'id' => 30,
                'meta_group_id' => 1,
                'meta_key' => 'right_issue',
                'meta_description' => 'right_issue',
                'meta_created' => '2014-07-21 12:22:29',
                'single' => '',
                'dual' => '',
            ),
            34 => 
            array (
                'id' => 37,
                'meta_group_id' => 1,
                'meta_key' => 'finance_update_time',
                'meta_description' => 'finance_update_time',
                'meta_created' => '2014-07-21 12:22:29',
                'single' => '',
                'dual' => '',
            ),
            35 => 
            array (
                'id' => 43,
                'meta_group_id' => 1,
                'meta_key' => 'otc_market',
                'meta_description' => 'otc_market',
                'meta_created' => '2014-07-21 12:22:29',
                'single' => '',
                'dual' => '',
            ),
            36 => 
            array (
                'id' => 44,
                'meta_group_id' => 1,
                'meta_key' => 'show_at_pe_lists',
                'meta_description' => 'show_at_pe_lists',
                'meta_created' => '2014-07-21 12:22:29',
                'single' => '',
                'dual' => '',
            ),
            37 => 
            array (
                'id' => 45,
                'meta_group_id' => 1,
                'meta_key' => 'inactive',
                'meta_description' => 'inactive',
                'meta_created' => '2014-07-21 12:22:29',
                'single' => '',
                'dual' => '',
            ),
            38 => 
            array (
                'id' => 51,
                'meta_group_id' => 1,
                'meta_key' => 'corporate_declaration_restriction',
                'meta_description' => 'corporate_declaration_restriction',
                'meta_created' => '2014-07-21 12:22:29',
                'single' => '',
                'dual' => '',
            ),
            39 => 
            array (
                'id' => 52,
                'meta_group_id' => 1,
                'meta_key' => 'sb71_index',
                'meta_description' => 'sb71_index',
                'meta_created' => '2014-07-21 12:22:29',
                'single' => '',
                'dual' => '',
            ),
            40 => 
            array (
                'id' => 53,
                'meta_group_id' => 1,
                'meta_key' => 'is_ycp_updated',
                'meta_description' => 'is_ycp_updated',
                'meta_created' => '2014-07-21 12:22:29',
                'single' => '',
                'dual' => '',
            ),
            41 => 
            array (
                'id' => 54,
                'meta_group_id' => 1,
                'meta_key' => 'dse_code_bangla',
                'meta_description' => 'dse_code_bangla',
                'meta_created' => '2014-07-21 12:22:29',
                'single' => '',
                'dual' => '',
            ),
            42 => 
            array (
                'id' => 55,
                'meta_group_id' => 1,
                'meta_key' => 'name_bangla',
                'meta_description' => 'name_bangla',
                'meta_created' => '2014-07-21 12:22:29',
                'single' => '',
                'dual' => '',
            ),
            43 => 
            array (
                'id' => 56,
                'meta_group_id' => 1,
                'meta_key' => 'category_bangla',
                'meta_description' => 'category_bangla',
                'meta_created' => '2014-07-21 12:22:29',
                'single' => '',
                'dual' => '',
            ),
            44 => 
            array (
                'id' => 57,
                'meta_group_id' => 1,
                'meta_key' => 'business_segment_bangla',
                'meta_description' => 'business_segment_bangla',
                'meta_created' => '2014-07-21 12:22:29',
                'single' => '',
                'dual' => '',
            ),
            45 => 
            array (
                'id' => 187,
                'meta_group_id' => 7,
                'meta_key' => 'basic_eps',
                'meta_description' => 'yearly basic EPS',
                'meta_created' => '2014-12-01 00:00:00',
                'single' => '',
                'dual' => '',
            ),
            46 => 
            array (
                'id' => 68,
                'meta_group_id' => 1,
                'meta_key' => 'dsex_index',
                'meta_description' => 'dsex_index',
                'meta_created' => '2014-07-21 12:22:29',
                'single' => '',
                'dual' => '',
            ),
            47 => 
            array (
                'id' => 86,
                'meta_group_id' => 5,
                'meta_key' => 'ds30_listed',
                'meta_description' => 'If it is share of ds30',
                'meta_created' => '2014-10-28 15:03:00',
                'single' => '',
                'dual' => '',
            ),
            48 => 
            array (
                'id' => 87,
                'meta_group_id' => 5,
                'meta_key' => 'dses_listed',
                'meta_description' => 'If it is a share of DSES',
                'meta_created' => '2014-10-28 15:04:00',
                'single' => '',
                'dual' => '',
            ),
            49 => 
            array (
                'id' => 90,
                'meta_group_id' => 3,
                'meta_key' => 'AGM',
                'meta_description' => 'Yearly Annual General Meeting Date',
                'meta_created' => '2014-11-10 12:44:00',
                'single' => '',
                'dual' => '',
            ),
            50 => 
            array (
                'id' => 93,
                'meta_group_id' => 3,
                'meta_key' => 'Publish_date_dividend',
                'meta_description' => 'Company yearly eps, nav,dividend,record date, AGM publish date. ',
                'meta_created' => '2014-11-10 13:00:00',
                'single' => '',
                'dual' => '',
            ),
            51 => 
            array (
                'id' => 99,
                'meta_group_id' => 6,
                'meta_key' => 'first_name',
                'meta_description' => '',
                'meta_created' => '2014-11-30 10:26:00',
                'single' => '',
                'dual' => '',
            ),
            52 => 
            array (
                'id' => 100,
                'meta_group_id' => 6,
                'meta_key' => 'last_name',
                'meta_description' => '',
                'meta_created' => '2014-11-30 10:27:00',
                'single' => '',
                'dual' => '',
            ),
            53 => 
            array (
                'id' => 101,
                'meta_group_id' => 6,
                'meta_key' => 'mobile_number',
                'meta_description' => '',
                'meta_created' => '2014-11-30 10:27:00',
                'single' => '',
                'dual' => '',
            ),
            54 => 
            array (
                'id' => 102,
                'meta_group_id' => 6,
                'meta_key' => 'interests',
                'meta_description' => '',
                'meta_created' => '2014-11-30 10:28:00',
                'single' => '',
                'dual' => '',
            ),
            55 => 
            array (
                'id' => 192,
                'meta_group_id' => 16,
                'meta_key' => 'q2_report',
                'meta_description' => NULL,
                'meta_created' => '2014-12-07 14:25:07',
                'single' => '',
                'dual' => '',
            ),
            56 => 
            array (
                'id' => 193,
                'meta_group_id' => 16,
                'meta_key' => 'q3_report',
                'meta_description' => NULL,
                'meta_created' => NULL,
                'single' => '',
                'dual' => '',
            ),
            57 => 
            array (
                'id' => 107,
                'meta_group_id' => 7,
                'meta_key' => 'stock_dividend',
                'meta_description' => NULL,
                'meta_created' => '2014-12-01 00:00:00',
                'single' => '',
                'dual' => '',
            ),
            58 => 
            array (
                'id' => 108,
                'meta_group_id' => 7,
                'meta_key' => 'cash_dividend',
                'meta_description' => NULL,
                'meta_created' => '2014-12-01 00:00:00',
                'single' => '',
                'dual' => '',
            ),
            59 => 
            array (
                'id' => 109,
                'meta_group_id' => 7,
                'meta_key' => 'date_of_agm',
                'meta_description' => NULL,
                'meta_created' => '2014-12-01 00:00:00',
                'single' => '',
                'dual' => '',
            ),
            60 => 
            array (
                'id' => 111,
                'meta_group_id' => 7,
                'meta_key' => 'record_date',
                'meta_description' => NULL,
                'meta_created' => '2014-12-01 00:00:00',
                'single' => '',
                'dual' => '',
            ),
            61 => 
            array (
                'id' => 112,
                'meta_group_id' => 7,
                'meta_key' => 'spot_trade',
                'meta_description' => NULL,
                'meta_created' => '2014-12-01 00:00:00',
                'single' => '',
                'dual' => '',
            ),
            62 => 
            array (
                'id' => 115,
                'meta_group_id' => 7,
                'meta_key' => 'net_asset_value_per_share',
                'meta_description' => NULL,
                'meta_created' => '2014-12-01 13:00:08',
                'single' => '',
                'dual' => '',
            ),
            63 => 
            array (
                'id' => 188,
                'meta_group_id' => 15,
                'meta_key' => 'logo_small',
                'meta_description' => NULL,
                'meta_created' => '2014-12-07 10:07:35',
                'single' => '',
                'dual' => '',
            ),
            64 => 
            array (
                'id' => 119,
                'meta_group_id' => 8,
                'meta_key' => 'authorized_capital',
                'meta_description' => NULL,
                'meta_created' => '2014-12-01 13:09:06',
                'single' => '',
                'dual' => '',
            ),
            65 => 
            array (
                'id' => 120,
                'meta_group_id' => 8,
                'meta_key' => 'paidup_capital',
                'meta_description' => NULL,
                'meta_created' => '2014-12-01 13:09:20',
                'single' => '',
                'dual' => '',
            ),
            66 => 
            array (
                'id' => 121,
                'meta_group_id' => 8,
                'meta_key' => 'total_no_of_securities',
                'meta_description' => NULL,
                'meta_created' => '2014-12-01 13:09:39',
                'single' => '',
                'dual' => '',
            ),
            67 => 
            array (
                'id' => 318,
                'meta_group_id' => 18,
                'meta_key' => 'nocf_per_share',
                'meta_description' => 'yearly stats',
                'meta_created' => '2016-07-25 15:00:00',
                'single' => 'single_year_meta_date',
                'dual' => 'dual_year_meta_date',
            ),
            68 => 
            array (
                'id' => 195,
                'meta_group_id' => 17,
                'meta_key' => 'cost_price',
                'meta_description' => 'cost price',
                'meta_created' => '2016-07-14 00:00:00',
                'single' => '',
                'dual' => '',
            ),
            69 => 
            array (
                'id' => 194,
                'meta_group_id' => 17,
                'meta_key' => 'current_market_price',
                'meta_description' => 'current market price',
                'meta_created' => '2016-07-14 00:00:00',
                'single' => '',
                'dual' => '',
            ),
            70 => 
            array (
                'id' => 127,
                'meta_group_id' => 8,
                'meta_key' => 'reserve_&_surplus',
                'meta_description' => NULL,
                'meta_created' => '2014-12-01 13:11:00',
                'single' => '',
                'dual' => '',
            ),
            71 => 
            array (
                'id' => 128,
                'meta_group_id' => 8,
                'meta_key' => 'basic_eps_restarted',
                'meta_description' => NULL,
                'meta_created' => '2014-12-01 13:11:22',
                'single' => '',
                'dual' => '',
            ),
            72 => 
            array (
                'id' => 129,
                'meta_group_id' => 8,
                'meta_key' => 'net_asset_value_per_share_restated',
                'meta_description' => NULL,
                'meta_created' => '2014-12-01 13:11:40',
                'single' => '',
                'dual' => '',
            ),
            73 => 
            array (
                'id' => 130,
                'meta_group_id' => 8,
                'meta_key' => 'net_profit_after_tax',
                'meta_description' => NULL,
                'meta_created' => '2014-12-01 13:11:55',
                'single' => '',
                'dual' => '',
            ),
            74 => 
            array (
                'id' => 131,
                'meta_group_id' => 8,
                'meta_key' => 'dividend_yield',
                'meta_description' => NULL,
                'meta_created' => '2014-12-01 13:12:07',
                'single' => '',
                'dual' => '',
            ),
            75 => 
            array (
                'id' => 133,
                'meta_group_id' => 8,
                'meta_key' => 'annual_turnover',
                'meta_description' => NULL,
                'meta_created' => '2014-12-01 13:13:40',
                'single' => '',
                'dual' => '',
            ),
            76 => 
            array (
                'id' => 201,
                'meta_group_id' => 20,
                'meta_key' => 'earning_per_share',
                'meta_description' => 'Yearly eps - currently maintaining',
                'meta_created' => '2016-07-25 15:00:00',
                'single' => 'single_year_meta_date',
                'dual' => 'dual_year_meta_date',
            ),
            77 => 
            array (
                'id' => 317,
                'meta_group_id' => 18,
                'meta_key' => 'q3_nocf_per_share',
                'meta_description' => '3 months stats',
                'meta_created' => '2016-07-25 16:06:08',
                'single' => '',
                'dual' => '',
            ),
            78 => 
            array (
                'id' => 149,
                'meta_group_id' => 10,
                'meta_key' => 'right_issue_%',
                'meta_description' => NULL,
                'meta_created' => '2014-12-01 14:08:13',
                'single' => '',
                'dual' => '',
            ),
            79 => 
            array (
                'id' => 150,
                'meta_group_id' => 10,
                'meta_key' => 'right_issue_record_date',
                'meta_description' => NULL,
                'meta_created' => '2014-12-01 14:08:31',
                'single' => '',
                'dual' => '',
            ),
            80 => 
            array (
                'id' => 151,
                'meta_group_id' => 10,
                'meta_key' => 'interim_dividend_%',
                'meta_description' => NULL,
                'meta_created' => '2014-12-01 14:09:12',
                'single' => '',
                'dual' => '',
            ),
            81 => 
            array (
                'id' => 189,
                'meta_group_id' => 15,
                'meta_key' => 'logo_medium',
                'meta_description' => NULL,
                'meta_created' => '2014-12-07 10:08:09',
                'single' => '',
                'dual' => '',
            ),
            82 => 
            array (
                'id' => 153,
                'meta_group_id' => 10,
                'meta_key' => 'interim_dividend_record_date',
                'meta_description' => NULL,
                'meta_created' => '2014-12-01 14:09:53',
                'single' => '',
                'dual' => '',
            ),
            83 => 
            array (
                'id' => 154,
                'meta_group_id' => 10,
                'meta_key' => 'prefrerence_issue_%_div',
                'meta_description' => NULL,
                'meta_created' => '2014-12-01 14:10:13',
                'single' => '',
                'dual' => '',
            ),
            84 => 
            array (
                'id' => 155,
                'meta_group_id' => 10,
                'meta_key' => 'prefrerence_issue_lock_in',
                'meta_description' => NULL,
                'meta_created' => '2014-12-01 14:10:35',
                'single' => '',
                'dual' => '',
            ),
            85 => 
            array (
                'id' => 156,
                'meta_group_id' => 10,
                'meta_key' => 'dividend_crediting_date',
                'meta_description' => NULL,
                'meta_created' => '2014-12-01 14:10:56',
                'single' => '',
                'dual' => '',
            ),
            86 => 
            array (
                'id' => 157,
                'meta_group_id' => 10,
                'meta_key' => 'cr._rating_long',
                'meta_description' => NULL,
                'meta_created' => '2014-12-01 14:11:10',
                'single' => '',
                'dual' => '',
            ),
            87 => 
            array (
                'id' => 158,
                'meta_group_id' => 10,
                'meta_key' => 'cr._rating_short',
                'meta_description' => NULL,
                'meta_created' => '2014-12-01 14:11:23',
                'single' => '',
                'dual' => '',
            ),
            88 => 
            array (
                'id' => 160,
                'meta_group_id' => 11,
                'meta_key' => 'trading_code',
                'meta_description' => NULL,
                'meta_created' => '2014-12-01 14:14:00',
                'single' => '',
                'dual' => '',
            ),
            89 => 
            array (
                'id' => 162,
                'meta_group_id' => 11,
                'meta_key' => 'company_name',
                'meta_description' => NULL,
                'meta_created' => '2014-12-01 14:14:27',
                'single' => '',
                'dual' => '',
            ),
            90 => 
            array (
                'id' => 167,
                'meta_group_id' => 12,
                'meta_key' => 'q1_eps_basic',
                'meta_description' => NULL,
                'meta_created' => '2014-12-01 14:20:54',
                'single' => '',
                'dual' => '',
            ),
            91 => 
            array (
                'id' => 168,
                'meta_group_id' => 12,
                'meta_key' => 'q1_restat_eps',
                'meta_description' => NULL,
                'meta_created' => '2014-12-01 14:21:16',
                'single' => '',
                'dual' => '',
            ),
            92 => 
            array (
                'id' => 169,
                'meta_group_id' => 12,
                'meta_key' => 'q1_net_pft_aft._tax',
                'meta_description' => NULL,
                'meta_created' => '2014-12-01 14:21:46',
                'single' => '',
                'dual' => '',
            ),
            93 => 
            array (
                'id' => 190,
                'meta_group_id' => 16,
                'meta_key' => 'annual_report',
                'meta_description' => NULL,
                'meta_created' => '2014-12-07 14:24:23',
                'single' => '',
                'dual' => '',
            ),
            94 => 
            array (
                'id' => 171,
                'meta_group_id' => 12,
                'meta_key' => 'q1_turnover_mn',
                'meta_description' => NULL,
                'meta_created' => '2014-12-01 14:22:23',
                'single' => '',
                'dual' => '',
            ),
            95 => 
            array (
                'id' => 173,
                'meta_group_id' => 13,
                'meta_key' => 'q3_eps_3_months',
                'meta_description' => NULL,
                'meta_created' => '2014-12-01 14:23:01',
                'single' => '',
                'dual' => '',
            ),
            96 => 
            array (
                'id' => 174,
                'meta_group_id' => 13,
                'meta_key' => 'q3_3_months_net_pft_aft._tax_mn',
                'meta_description' => NULL,
                'meta_created' => '2014-12-01 14:23:26',
                'single' => '',
                'dual' => '',
            ),
            97 => 
            array (
                'id' => 175,
                'meta_group_id' => 13,
                'meta_key' => 'q3_eps_9_months',
                'meta_description' => NULL,
                'meta_created' => '2014-12-01 14:23:40',
                'single' => '',
                'dual' => '',
            ),
            98 => 
            array (
                'id' => 176,
                'meta_group_id' => 13,
                'meta_key' => 'q3_9_months_net_pft_aft._tax_mn',
                'meta_description' => NULL,
                'meta_created' => '2014-12-01 14:24:11',
                'single' => '',
                'dual' => '',
            ),
            99 => 
            array (
                'id' => 191,
                'meta_group_id' => 16,
                'meta_key' => 'q1_report',
                'meta_description' => NULL,
                'meta_created' => '2014-12-07 14:24:48',
                'single' => '',
                'dual' => '',
            ),
            100 => 
            array (
                'id' => 178,
                'meta_group_id' => 13,
                'meta_key' => 'q3_turnover_mn',
                'meta_description' => NULL,
                'meta_created' => '2014-12-01 14:24:46',
                'single' => '',
                'dual' => '',
            ),
            101 => 
            array (
                'id' => 180,
                'meta_group_id' => 14,
                'meta_key' => 'q2_eps_3_months',
                'meta_description' => NULL,
                'meta_created' => '2014-12-01 14:35:07',
                'single' => '',
                'dual' => '',
            ),
            102 => 
            array (
                'id' => 181,
                'meta_group_id' => 14,
                'meta_key' => 'q2_3_months_net_pft_aft._tax_mn',
                'meta_description' => NULL,
                'meta_created' => '2014-12-01 14:35:30',
                'single' => '',
                'dual' => '',
            ),
            103 => 
            array (
                'id' => 182,
                'meta_group_id' => 14,
                'meta_key' => 'half_yearly_eps_6_months',
                'meta_description' => NULL,
                'meta_created' => '2014-12-01 14:36:50',
                'single' => '',
                'dual' => '',
            ),
            104 => 
            array (
                'id' => 183,
                'meta_group_id' => 14,
                'meta_key' => 'half_yearly_restat_eps',
                'meta_description' => NULL,
                'meta_created' => '2014-12-01 14:37:12',
                'single' => '',
                'dual' => '',
            ),
            105 => 
            array (
                'id' => 184,
                'meta_group_id' => 14,
                'meta_key' => 'half_yearly_6_months_net_pft_aft_tax_mn',
                'meta_description' => NULL,
                'meta_created' => '2014-12-01 14:37:42',
                'single' => '',
                'dual' => '',
            ),
            106 => 
            array (
                'id' => 186,
                'meta_group_id' => 14,
                'meta_key' => 'half_yearly_turnover_mn',
                'meta_description' => NULL,
                'meta_created' => '2014-12-01 14:38:13',
                'single' => '',
                'dual' => '',
            ),
            107 => 
            array (
                'id' => 205,
                'meta_group_id' => 18,
                'meta_key' => 'net_asset_val_per_share',
                'meta_description' => 'Yearly NAV / yearly book value  - currently maintaining',
                'meta_created' => '2016-07-25 15:00:00',
                'single' => 'single_year_meta_date',
                'dual' => 'dual_year_meta_date',
            ),
            108 => 
            array (
                'id' => 207,
                'meta_group_id' => 18,
                'meta_key' => 'profit_after_tax',
                'meta_description' => 'yeraly stats of net_profit_after_tax',
                'meta_created' => '2016-07-25 15:00:00',
                'single' => 'single_year_meta_date',
                'dual' => 'dual_year_meta_date',
            ),
            109 => 
            array (
                'id' => 208,
                'meta_group_id' => 18,
                'meta_key' => 'net_profit_extra_inc',
                'meta_description' => 'Yearly stats',
                'meta_created' => '2016-07-25 15:00:00',
                'single' => 'single_year_meta_date',
                'dual' => 'dual_year_meta_date',
            ),
            110 => 
            array (
                'id' => 211,
                'meta_group_id' => 18,
                'meta_key' => 'stock_dividend',
                'meta_description' => 'stock dividend / bonus dividend- yearly stats',
                'meta_created' => '2016-07-25 15:00:00',
                'single' => 'single_year_meta_date',
                'dual' => 'dual_year_meta_date',
            ),
            111 => 
            array (
                'id' => 212,
                'meta_group_id' => 18,
                'meta_key' => 'dividend_yield',
                'meta_description' => 'Yearly stats',
                'meta_created' => '2016-07-25 15:00:00',
                'single' => 'single_year_meta_date',
                'dual' => 'dual_year_meta_date',
            ),
            112 => 
            array (
                'id' => 213,
                'meta_group_id' => 18,
                'meta_key' => 'q1_turn_over',
                'meta_description' => '3 months stat',
                'meta_created' => '2016-07-25 15:00:00',
                'single' => 'single_q1_meta_date',
                'dual' => 'dual_q1_meta_date',
            ),
            113 => 
            array (
                'id' => 214,
                'meta_group_id' => 18,
                'meta_key' => 'q2_turn_over',
                'meta_description' => '3 months stat',
                'meta_created' => '2016-07-25 15:00:00',
                'single' => 'single_q2_meta_date',
                'dual' => 'dual_q2_meta_date',
            ),
            114 => 
            array (
                'id' => 215,
                'meta_group_id' => 18,
                'meta_key' => 'q3_turn_over',
                'meta_description' => '3 months stat',
                'meta_created' => '2016-07-25 15:00:00',
                'single' => '',
                'dual' => '',
            ),
            115 => 
            array (
                'id' => 217,
                'meta_group_id' => 18,
                'meta_key' => 'q1_net_prft_aft_tx_cont_op',
                'meta_description' => '3 months stat',
                'meta_created' => '2016-07-25 15:00:00',
                'single' => 'single_q1_meta_date',
                'dual' => 'dual_q1_meta_date',
            ),
            116 => 
            array (
                'id' => 218,
                'meta_group_id' => 18,
                'meta_key' => 'q2_net_prft_aft_tx_cont_op',
                'meta_description' => '3 months stat',
                'meta_created' => '2016-07-25 15:00:00',
                'single' => 'single_q2_meta_date',
                'dual' => 'dual_q2_meta_date',
            ),
            117 => 
            array (
                'id' => 219,
                'meta_group_id' => 18,
                'meta_key' => 'q3_net_prft_aft_tx_cont_op',
                'meta_description' => '3 months stat',
                'meta_created' => '2016-07-25 15:00:00',
                'single' => 'single_q3_meta_date',
                'dual' => 'dual_q3_meta_date',
            ),
            118 => 
            array (
                'id' => 221,
                'meta_group_id' => 18,
                'meta_key' => 'q1_net_prft_aft_tx_extra_inc',
                'meta_description' => '3 months stat',
                'meta_created' => '2016-07-25 15:00:00',
                'single' => '',
                'dual' => '',
            ),
            119 => 
            array (
                'id' => 222,
                'meta_group_id' => 18,
                'meta_key' => 'q2_net_prft_aft_tx_extra_inc',
                'meta_description' => '3 months stat',
                'meta_created' => '2016-07-25 15:00:00',
                'single' => '',
                'dual' => '',
            ),
            120 => 
            array (
                'id' => 223,
                'meta_group_id' => 18,
                'meta_key' => 'q3_net_prft_aft_tx_extra_inc',
                'meta_description' => '3 months stat',
                'meta_created' => '2016-07-25 15:00:00',
                'single' => '',
                'dual' => '',
            ),
            121 => 
            array (
                'id' => 225,
                'meta_group_id' => 20,
                'meta_key' => 'q1_eps_cont_op',
                'meta_description' => '3 months stat',
                'meta_created' => '2016-07-25 15:00:00',
                'single' => 'single_q1_meta_date',
                'dual' => 'dual_q1_meta_date',
            ),
            122 => 
            array (
                'id' => 226,
                'meta_group_id' => 20,
                'meta_key' => 'q2_eps_cont_op',
                'meta_description' => '3 months stat',
                'meta_created' => '2016-07-25 15:00:00',
                'single' => 'single_q2_meta_date',
                'dual' => 'dual_q2_meta_date',
            ),
            123 => 
            array (
                'id' => 227,
                'meta_group_id' => 20,
                'meta_key' => 'q3_eps_cont_op',
                'meta_description' => '3 months stat',
                'meta_created' => '2016-07-25 15:00:00',
                'single' => 'single_q3_meta_date',
                'dual' => 'dual_q3_meta_date',
            ),
            124 => 
            array (
                'id' => 229,
                'meta_group_id' => 18,
                'meta_key' => 'q1_eps_extra_inc',
                'meta_description' => '3 months stat',
                'meta_created' => '2016-07-25 15:00:00',
                'single' => '',
                'dual' => '',
            ),
            125 => 
            array (
                'id' => 230,
                'meta_group_id' => 18,
                'meta_key' => 'q2_eps_extra_inc',
                'meta_description' => '3 months stat',
                'meta_created' => '2016-07-25 15:00:00',
                'single' => '',
                'dual' => '',
            ),
            126 => 
            array (
                'id' => 231,
                'meta_group_id' => 18,
                'meta_key' => 'q3_eps_extra_inc',
                'meta_description' => '3 months stat',
                'meta_created' => '2016-07-25 15:00:00',
                'single' => '',
                'dual' => '',
            ),
            127 => 
            array (
                'id' => 243,
                'meta_group_id' => 18,
                'meta_key' => 'half_year_net_prft_aft_tx_cont_op',
                'meta_description' => 'total 6 month\'s profit',
                'meta_created' => '2016-07-25 15:00:00',
                'single' => 'single_q2_meta_date',
                'dual' => 'dual_q2_meta_date',
            ),
            128 => 
            array (
                'id' => 245,
                'meta_group_id' => 18,
                'meta_key' => 'cash_dividend',
                'meta_description' => NULL,
                'meta_created' => '2016-07-25 15:00:00',
                'single' => 'single_year_meta_date',
                'dual' => 'dual_year_meta_date',
            ),
            129 => 
            array (
                'id' => 246,
                'meta_group_id' => 18,
                'meta_key' => 'half_year_turn_over_cont_op',
                'meta_description' => '6 months stat',
                'meta_created' => '2016-07-25 15:00:00',
                'single' => 'single_q2_meta_date',
                'dual' => 'dual_q2_meta_date',
            ),
            130 => 
            array (
                'id' => 316,
                'meta_group_id' => 18,
                'meta_key' => 'q2_nocf_per_share',
                'meta_description' => '3 months stats',
                'meta_created' => '2016-07-25 16:05:43',
                'single' => '',
                'dual' => '',
            ),
            131 => 
            array (
                'id' => 251,
                'meta_group_id' => 18,
                'meta_key' => 'spot_trading_date',
                'meta_description' => NULL,
                'meta_created' => '2016-07-25 15:00:00',
                'single' => 'single_year_meta_date',
                'dual' => 'dual_year_meta_date',
            ),
            132 => 
            array (
                'id' => 253,
                'meta_group_id' => 18,
                'meta_key' => 'agm_date',
                'meta_description' => NULL,
                'meta_created' => '2016-07-25 15:00:00',
                'single' => 'single_year_meta_date',
                'dual' => 'dual_year_meta_date',
            ),
            133 => 
            array (
                'id' => 254,
                'meta_group_id' => 18,
                'meta_key' => 'dividend_crediting_date',
                'meta_description' => NULL,
                'meta_created' => '2016-07-25 15:00:00',
                'single' => 'single_year_meta_date',
                'dual' => 'dual_year_meta_date',
            ),
            134 => 
            array (
                'id' => 315,
                'meta_group_id' => 18,
                'meta_key' => 'q1_nocf_per_share',
                'meta_description' => '3 months stats',
                'meta_created' => NULL,
                'single' => '',
                'dual' => '',
            ),
            135 => 
            array (
                'id' => 256,
                'meta_group_id' => 18,
                'meta_key' => 'paid_up_capital',
                'meta_description' => NULL,
                'meta_created' => '2016-07-25 15:00:00',
                'single' => 'single_year_meta_date',
                'dual' => 'dual_year_meta_date',
            ),
            136 => 
            array (
                'id' => 258,
                'meta_group_id' => 18,
                'meta_key' => 'authorized_capital',
                'meta_description' => NULL,
                'meta_created' => '2016-07-25 15:00:00',
                'single' => 'single_year_meta_date',
                'dual' => 'dual_year_meta_date',
            ),
            137 => 
            array (
                'id' => 259,
                'meta_group_id' => 18,
                'meta_key' => 'reserve_and_surp',
                'meta_description' => NULL,
                'meta_created' => '2016-07-25 15:00:00',
                'single' => 'single_year_meta_date',
                'dual' => 'dual_year_meta_date',
            ),
            138 => 
            array (
                'id' => 260,
                'meta_group_id' => 18,
                'meta_key' => 'notes',
                'meta_description' => NULL,
                'meta_created' => '2016-07-25 15:00:00',
                'single' => 'single_year_meta_date',
                'dual' => 'dual_year_meta_date',
            ),
            139 => 
            array (
                'id' => 261,
                'meta_group_id' => 18,
                'meta_key' => 'interim_dividend',
                'meta_description' => NULL,
                'meta_created' => '2016-07-25 15:00:00',
                'single' => '',
                'dual' => '',
            ),
            140 => 
            array (
                'id' => 265,
                'meta_group_id' => 18,
                'meta_key' => 'credit_rating_long',
                'meta_description' => NULL,
                'meta_created' => '2016-07-25 15:00:00',
                'single' => 'single_year_meta_date',
                'dual' => 'dual_year_meta_date',
            ),
            141 => 
            array (
                'id' => 266,
                'meta_group_id' => 18,
                'meta_key' => 'credit_rating_short',
                'meta_description' => NULL,
                'meta_created' => '2016-07-25 15:00:00',
                'single' => 'single_year_meta_date',
                'dual' => 'dual_year_meta_date',
            ),
            142 => 
            array (
                'id' => 267,
                'meta_group_id' => 18,
                'meta_key' => 'director_sell',
                'meta_description' => NULL,
                'meta_created' => '2016-07-25 15:00:00',
                'single' => '',
                'dual' => '',
            ),
            143 => 
            array (
                'id' => 268,
                'meta_group_id' => 18,
                'meta_key' => 'direcotr_buy',
                'meta_description' => NULL,
                'meta_created' => '2016-07-25 15:00:00',
                'single' => '',
                'dual' => '',
            ),
            144 => 
            array (
                'id' => 269,
                'meta_group_id' => 18,
                'meta_key' => 'total_no_securities',
                'meta_description' => 'Yearly stats',
                'meta_created' => '2016-07-25 15:00:00',
                'single' => 'single_year_meta_date',
                'dual' => 'dual_year_meta_date',
            ),
            145 => 
            array (
                'id' => 314,
                'meta_group_id' => 18,
                'meta_key' => 'q3_nine_months_net_asset_val_per_share',
                'meta_description' => '9 months stats',
                'meta_created' => NULL,
                'single' => '',
                'dual' => '',
            ),
            146 => 
            array (
                'id' => 313,
                'meta_group_id' => 18,
                'meta_key' => 'half_year_net_asset_val_per_share',
                'meta_description' => '6 months stats',
                'meta_created' => NULL,
                'single' => '',
                'dual' => '',
            ),
            147 => 
            array (
                'id' => 312,
                'meta_group_id' => 18,
                'meta_key' => 'q3_net_asset_val_per_share',
                'meta_description' => '3 month stats',
                'meta_created' => NULL,
                'single' => '',
                'dual' => '',
            ),
            148 => 
            array (
                'id' => 276,
                'meta_group_id' => 18,
                'meta_key' => 'interim_dividend_record_date',
                'meta_description' => NULL,
                'meta_created' => '2016-07-25 15:00:00',
                'single' => '',
                'dual' => '',
            ),
            149 => 
            array (
                'id' => 311,
                'meta_group_id' => 18,
                'meta_key' => 'q2_net_asset_val_per_share',
                'meta_description' => '3 months stats',
                'meta_created' => NULL,
                'single' => '',
                'dual' => '',
            ),
            150 => 
            array (
                'id' => 278,
                'meta_group_id' => 18,
                'meta_key' => 'director_share_per',
                'meta_description' => NULL,
                'meta_created' => '2016-07-25 15:00:00',
                'single' => 'single_year_meta_date',
                'dual' => 'dual_year_meta_date',
            ),
            151 => 
            array (
                'id' => 279,
                'meta_group_id' => 18,
                'meta_key' => 'public_share_per',
                'meta_description' => NULL,
                'meta_created' => '2016-07-25 15:00:00',
                'single' => 'single_year_meta_date',
                'dual' => 'dual_year_meta_date',
            ),
            152 => 
            array (
                'id' => 280,
                'meta_group_id' => 18,
                'meta_key' => 'institute_share_per',
                'meta_description' => NULL,
                'meta_created' => '2016-07-25 15:00:00',
                'single' => 'single_year_meta_date',
                'dual' => 'dual_year_meta_date',
            ),
            153 => 
            array (
                'id' => 281,
                'meta_group_id' => 18,
                'meta_key' => 'govt_share_per',
                'meta_description' => NULL,
                'meta_created' => '2016-07-25 15:00:00',
                'single' => 'single_year_meta_date',
                'dual' => 'dual_year_meta_date',
            ),
            154 => 
            array (
                'id' => 282,
                'meta_group_id' => 18,
                'meta_key' => 'foriegn_share_per',
                'meta_description' => NULL,
                'meta_created' => '2016-07-25 15:00:00',
                'single' => 'single_year_meta_date',
                'dual' => 'dual_year_meta_date',
            ),
            155 => 
            array (
                'id' => 283,
                'meta_group_id' => 18,
                'meta_key' => 'chairman',
                'meta_description' => NULL,
                'meta_created' => '2016-07-25 15:00:00',
                'single' => 'single_year_meta_date',
                'dual' => 'dual_year_meta_date',
            ),
            156 => 
            array (
                'id' => 284,
                'meta_group_id' => 18,
                'meta_key' => 'v_chairman',
                'meta_description' => NULL,
                'meta_created' => '2016-07-25 15:00:00',
                'single' => '',
                'dual' => '',
            ),
            157 => 
            array (
                'id' => 285,
                'meta_group_id' => 18,
                'meta_key' => 'md',
                'meta_description' => NULL,
                'meta_created' => '2016-07-25 15:00:00',
                'single' => 'single_year_meta_date',
                'dual' => 'dual_year_meta_date',
            ),
            158 => 
            array (
                'id' => 286,
                'meta_group_id' => 18,
                'meta_key' => 'd_md',
                'meta_description' => NULL,
                'meta_created' => '2016-07-25 15:00:00',
                'single' => 'single_year_meta_date',
                'dual' => 'dual_year_meta_date',
            ),
            159 => 
            array (
                'id' => 287,
                'meta_group_id' => 18,
                'meta_key' => 'director',
                'meta_description' => NULL,
                'meta_created' => '2016-07-25 15:00:00',
                'single' => 'single_year_meta_date',
                'dual' => 'dual_year_meta_date',
            ),
            160 => 
            array (
                'id' => 288,
                'meta_group_id' => 18,
                'meta_key' => 'auditor',
                'meta_description' => NULL,
                'meta_created' => '2016-07-25 15:00:00',
                'single' => 'single_year_meta_date',
                'dual' => 'dual_year_meta_date',
            ),
            161 => 
            array (
                'id' => 289,
                'meta_group_id' => 18,
                'meta_key' => 'cradit_rating_agency',
                'meta_description' => NULL,
                'meta_created' => '2016-07-25 15:00:00',
                'single' => 'single_year_meta_date',
                'dual' => 'dual_year_meta_date',
            ),
            162 => 
            array (
                'id' => 292,
                'meta_group_id' => 18,
                'meta_key' => 'subsidiaries',
                'meta_description' => NULL,
                'meta_created' => '2016-07-25 15:00:00',
                'single' => 'single_year_meta_date',
                'dual' => 'dual_year_meta_date',
            ),
            163 => 
            array (
                'id' => 294,
                'meta_group_id' => 18,
                'meta_key' => 'business_summery',
                'meta_description' => NULL,
                'meta_created' => '2016-07-25 15:00:00',
                'single' => 'single_year_meta_date',
                'dual' => 'dual_year_meta_date',
            ),
            164 => 
            array (
                'id' => 295,
                'meta_group_id' => 18,
                'meta_key' => 'chairman_statement',
                'meta_description' => NULL,
                'meta_created' => '2016-07-25 15:00:00',
                'single' => 'single_year_meta_date',
                'dual' => 'dual_year_meta_date',
            ),
            165 => 
            array (
                'id' => 296,
                'meta_group_id' => 18,
                'meta_key' => 'corporate_milestones',
                'meta_description' => NULL,
                'meta_created' => '2016-07-25 15:00:00',
                'single' => 'single_year_meta_date',
                'dual' => 'dual_year_meta_date',
            ),
            166 => 
            array (
                'id' => 297,
                'meta_group_id' => 18,
                'meta_key' => 'company_mission_vission',
                'meta_description' => NULL,
                'meta_created' => '2016-07-25 15:00:00',
                'single' => 'single_year_meta_date',
                'dual' => 'dual_year_meta_date',
            ),
            167 => 
            array (
                'id' => 298,
                'meta_group_id' => 18,
                'meta_key' => 'major_product',
                'meta_description' => NULL,
                'meta_created' => '2016-07-25 15:00:00',
                'single' => 'single_year_meta_date',
                'dual' => 'dual_year_meta_date',
            ),
            168 => 
            array (
                'id' => 310,
                'meta_group_id' => 18,
                'meta_key' => 'q1_net_asset_val_per_share',
                'meta_description' => '3 months stat',
                'meta_created' => '2016-07-25 15:58:07',
                'single' => '',
                'dual' => '',
            ),
            169 => 
            array (
                'id' => 300,
                'meta_group_id' => 18,
                'meta_key' => 'taxation',
                'meta_description' => NULL,
                'meta_created' => '2016-07-25 15:00:00',
                'single' => 'single_year_meta_date',
                'dual' => 'dual_year_meta_date',
            ),
            170 => 
            array (
                'id' => 301,
                'meta_group_id' => 18,
                'meta_key' => 'tax_holiday',
                'meta_description' => NULL,
                'meta_created' => '2016-07-25 15:00:00',
                'single' => 'single_year_meta_date',
                'dual' => 'dual_year_meta_date',
            ),
            171 => 
            array (
                'id' => 302,
                'meta_group_id' => 18,
                'meta_key' => 'office_address',
                'meta_description' => NULL,
                'meta_created' => '2016-07-25 15:00:00',
                'single' => 'single_year_meta_date',
                'dual' => 'dual_year_meta_date',
            ),
            172 => 
            array (
                'id' => 303,
                'meta_group_id' => 18,
                'meta_key' => 'phone_number',
                'meta_description' => NULL,
                'meta_created' => '2016-07-25 15:00:00',
                'single' => 'single_year_meta_date',
                'dual' => 'dual_year_meta_date',
            ),
            173 => 
            array (
                'id' => 304,
                'meta_group_id' => 18,
                'meta_key' => 'fax_number',
                'meta_description' => NULL,
                'meta_created' => '2016-07-25 15:00:00',
                'single' => 'single_year_meta_date',
                'dual' => 'dual_year_meta_date',
            ),
            174 => 
            array (
                'id' => 305,
                'meta_group_id' => 18,
                'meta_key' => 'email',
                'meta_description' => NULL,
                'meta_created' => '2016-07-25 15:00:00',
                'single' => 'single_year_meta_date',
                'dual' => 'dual_year_meta_date',
            ),
            175 => 
            array (
                'id' => 306,
                'meta_group_id' => 18,
                'meta_key' => 'website',
                'meta_description' => NULL,
                'meta_created' => '2016-07-25 15:00:00',
                'single' => 'single_year_meta_date',
                'dual' => 'dual_year_meta_date',
            ),
            176 => 
            array (
                'id' => 308,
                'meta_group_id' => 18,
                'meta_key' => 'q3_nine_months_eps',
                'meta_description' => '9 moths stats',
                'meta_created' => '2016-07-25 15:00:00',
                'single' => 'single_q3_meta_date',
                'dual' => 'dual_q3_meta_date',
            ),
            177 => 
            array (
                'id' => 309,
                'meta_group_id' => 18,
                'meta_key' => 'q3_nine_months_net_profit_after_tax',
                'meta_description' => '9 months stats',
                'meta_created' => '2016-07-25 15:00:00',
                'single' => 'single_q3_meta_date',
                'dual' => 'dual_q3_meta_date',
            ),
            178 => 
            array (
                'id' => 319,
                'meta_group_id' => 18,
                'meta_key' => 'q3_nine_months_nocf_per_share',
                'meta_description' => '9 months stats',
                'meta_created' => '2016-07-25 16:07:02',
                'single' => '',
                'dual' => '',
            ),
            179 => 
            array (
                'id' => 320,
                'meta_group_id' => 18,
                'meta_key' => 'half_year_nocf_per_share',
                'meta_description' => '6 months stats',
                'meta_created' => '2016-07-25 16:07:26',
                'single' => '',
                'dual' => '',
            ),
            180 => 
            array (
                'id' => 434,
                'meta_group_id' => 18,
                'meta_key' => 'half_year_eps_cont_op',
                'meta_description' => '6 months stats',
                'meta_created' => NULL,
                'single' => 'single_q2_meta_date',
                'dual' => 'dual_q2_meta_date',
            ),
            181 => 
            array (
                'id' => 435,
                'meta_group_id' => 18,
                'meta_key' => 'year_end',
                'meta_description' => 'year_end
NB : Meta Value and Meta Date will be same value.',
                'meta_created' => '2017-03-23 00:00:00',
                'single' => NULL,
                'dual' => NULL,
            ),
            182 => 
            array (
                'id' => 436,
                'meta_group_id' => 18,
                'meta_key' => 'shifting_date',
                'meta_description' => 'Company financial year change December to June OR June to December. 
All Data are fixed from 30.09.2016 Quarter. 
For that shifting date is 01.09.2016.',
                'meta_created' => '2017-03-29 13:08:19',
                'single' => NULL,
                'dual' => NULL,
            ),
        ));
        
        
    }
}