<?php

App::uses('AppController', 'Controller');

/**

 * Instruments Controller

 *

 */



class DataManagementsController extends AppController

{





    public function beforeFilter()
    {

        parent::beforeFilter();



        //$this->Auth->allow('test');

        $this->Auth->allow();

        Configure::write('debug', 2);



    }
    public function home2()
    {
        Configure::write('debug', 2);
        /*   App::uses('DataBanksIntraday', 'Model');
           $DataBanksIntraday = new DataBanksIntraday();
           $res=$DataBanksIntraday->find('TodayPreviousMinuteData');
           pr($DataBanksIntraday->getLastQuery());
           echo round(microtime(true) - TIME_START, 3);
           pr($res);
           exit;*/

        $model = ClassRegistry::init('DataBanksIntraday');
        $data = $this->Market->Trade->find('PreviousDayData', array(
            'autocache'=>array('config'=>'minute')
        ));
        $res=$model->find('TodayPreviousMinuteData', array(
            'autocache'=>array('config'=>'minute')
        ));
        pr($model->getLastQuery());
        echo round(microtime(true) - TIME_START, 3);
        pr($res);
        exit;

        /* $market = $this->Market->find('TradeDates', array(

         ));*/
        $data = $this->Market->DataBanksIntraday->find('TodayPreviousMinuteData', array(
            'autocache'=>array('config'=>'minute')
        ));

        pr( $this->Market->DataBanksIntraday->getLastQuery());
        pr($data);
        echo round(microtime(true) - TIME_START, 3);
        exit;
        $data = $this->Market->DataBanksIntraday->find('TodayPreviousMinuteData', array(
            'autocache'=>array('config'=>'minute')
        ));
        //    pr($data);
        $data = $this->Market->IndexValue->find('TodayData', array(
            'autocache'=>array('config'=>'minute')
        ));
        //   pr($data);
        $data = $this->Market->IndexValue->find('PreviousDayData', array(
            'autocache'=>array('config'=>'minute')
        ));
        //   pr($data);

        $data = $this->Market->Trade->find('PreviousDayData', array(
            'autocache'=>array('config'=>'minute')
        ));
        pr($data);

        $data = $this->Market->Trade->find('PreviousDayData', array(
            'autocache'=>array('config'=>'minute')
        ));
        pr($data);
        exit;
        $market = $this->Market->find('TradeDates', array(
            //  'autocache'=>array('config'=>'minute')
        ));

        $todayBatch=$market[0]['Market']['data_bank_intraday_batch'];
        $todayData = $this->Market->DataBanksIntraday->find('all', array(
            'conditions' => "DataBanksIntraday.batch=$todayBatch"
        ,'recursive' =>0
            // ,'autocache' => array('config' => 'minute')
        ));
        echo "<pre>";
        print_r($market);
        pr($todayData);
        exit;


        App::uses('CakeTime', 'Utility');


        $adsArr=Configure::read('ads');
        $dsb = $this->Components->load('Dsb');
        $allnews=$dsb->getLatestNews(5);

        $this->set('allnews',$allnews['live']);
        $this->set('interviewArr',$allnews['interview']);
        $this->set('ipo',$allnews['ipo']);
        $this->set('agm',$allnews['agm']);
        $this->set('marketAnalysis',$allnews['marketAnalysis']);
        // pr($allnews);



        //CakeResponse::compress()
        $StockBangladesh = $this->Components->load('StockBangladesh');

        $this->layout = 'default_3_3';

        /*
         * TRY TO MINIMUM USE MODEL IN COMPONENT. SO WE ARE USING _prepareLastTradeInfo INSTEAD OF $this->StockBangladesh->getLastTradeInfo();
         */
        // $lastTradeInfo=$this->StockBangladesh->getLastTradeInfo();
        $lastTradeInfoToday = $this->_prepareLastTradeInfo();
        $lastTradeInfoYesterday = $this->_prepareLastTradeInfo(0);
        $lastTradeInfo = $StockBangladesh->merge_with_yesterday($lastTradeInfoToday, $lastTradeInfoYesterday);




        $marketId = $StockBangladesh->getMarketInfo(0);
        $lastIndexValues = $StockBangladesh->getLastIndexValues($marketId);
        $lastTradeStats = $StockBangladesh->getLastTradeStats($marketId);


        $this->set('lastTradeInfo', $lastTradeInfo);
        $this->set('lastIndexValues', $lastIndexValues);
        $this->set('lastTradeStats', $lastTradeStats);



        //   pr($lastTradeInfo);
        //  exit;

        /*     echo "<pre>";
     print_r($lastTradeInfoToday);
             exit;*/
//print_r($_SESSION);
        //$this->Session->write('Auth.User.uuid','test');
        /*  pr($this->Session->read('Auth.User'));
          pr($this->Auth->user());
          exit;*/
        //$this->set('lastTradeInfo', $lastTradeInfo);
        //pr($lastTradeInfo);

        /*   $nextTradeInfo = Cache::read('nextTradeInfo');
           $exchangeId = Configure::read('EXCHANGE_ID');
           //$nextTradeInfo = Cache::delete('nextTradeInfo');
           if (!$nextTradeInfo) {
               //pr("mem empty here");
               $nextTradeInfo = $this->Market->find('first', array(
                   'order' => array('Market.id' => 'asc'),
                   'conditions' => "Market.is_trading_day=2 and Market.exchange_id=$exchangeId",
                   'recursive' => 0
               ));
               Cache::write('nextTradeInfo', $nextTradeInfo, 'minute');

           }*/


        /*
         * @TODO TIME SHOULD BE INTERNATIONALIZE. CONSIDER USER TIME ZONE
         */

//    pr(CakeTime::nice(CakeTime::fromString('Dec 19 2013 02:30:53:073PM')));

        /*
                $tradeDayTime = $lastTradeInfo['Market']['trade_date'] . " " . $lastTradeInfo['Market']['market_closed'];
                if (CakeTime::isPast($tradeDayTime)) {
                    $nextTradeDayTime = $nextTradeInfo['Market']['trade_date'] . " " . $nextTradeInfo['Market']['market_started'];
                    $remainingTime = CakeTime::fromString($nextTradeDayTime) - CakeTime::fromString('now');
                    $remainingText = "to open market";
                } else {
                    $remainingTime = CakeTime::fromString($tradeDayTime) - CakeTime::fromString('now');
                    $remainingText = "to close market";
                }
                $this->set('remainingTime', $remainingTime);
                $this->set('remainingText', $remainingText);*/

        // DSEX CHART





        $this->set('table_row_display',5);
        //$this->market_summary(0);
        //   $this->index_chart(0);
        //   $this->trade_chart(0);
        //  $this->value_chart(0);
        //   echo "4";
        //   exit;
    }

    public function temp()
    {
       
    }


    public function remove_duplicate_eod($instrument_id=0)
    {
        Configure::write('debug', 2);

        $StockBangladesh = $this->Components->load('StockBangladesh');
        $instrumentList2 = $StockBangladesh->instrumentList(3);

        if($instrument_id)
        {

            $model = ClassRegistry::init('DataBanksEod');

            $eodData = $model->find('all', array(

                'conditions' => "DataBanksEod.instrument_id=$instrument_id",
                'order' => array('DataBanksEod.updated' => 'asc'),
                'recursive' => -1

            ));

            $eodData = Hash::combine($eodData, '{n}.DataBanksEod.market_id', '{n}.DataBanksEod');

            if (!empty($eodData)) {

                $model->deleteAll(array('DataBanksEod.instrument_id' => $instrument_id), false);
                $model->saveMany($eodData, array('atomic' => true));

            }

            pr($eodData);

        }
        else
        {
            foreach($instrumentList2 as $ins_id=>$code)
            echo "<a  target='_blank' href='http://www.new.stockbangladesh.com/DataManagements/remove_duplicate_eod/$ins_id'>$code</a> <br />";
        }

      //  pr($instrumentList2);
        exit;

    }


    public function meta()
    {
        //  Configure::write('debug', 2);
        // $StockBangladesh = $this->Components->load('StockBangladesh');


        // $t=$StockBangladesh->getLastTradeInfo();
        // require_once(APP . 'Vendor' . DS . 'xcrud' . DS . 'xcrud.php');
        require_once(APP . 'webroot' . DS . 'xcrud' . DS . 'xcrud.php');
        $xcrud = Xcrud::get_instance();
        $xcrud->table('metas');
        $xcrud->show_primary_ai_column(true);
        $xcrud->default_tab('Meta list');
        $metadetails = $xcrud->nested_table('Meta Group details','meta_group_id','meta_groups','id'); // 2nd level
        $fundamentals = $xcrud->nested_table('Fundamentals','id','fundamentals','meta_id'); // 2nd level
        //   $xcrud->join('meta_group_id','meta_groups','id');
        $xcrud->relation('meta_group_id','meta_groups','id','group_key');
        $fundamentals->relation('instrument_id','instruments','id','instrument_code');
        $fundamentals->relation('meta_id','metas','id','meta_key');
        //  $xcrud->columns('id,meta_key,meta_groups.group_key');
        $xcrud->benchmark(true);
        $xcrud->unset_csv();
        //$user_table= $xcrud->render();


        $xcrud2 = Xcrud::get_instance();
        $xcrud2->table('meta_groups');
        $related_meta = $xcrud2->nested_table('Related Meta','id','metas','meta_group_id'); // 2nd level

        $this->set('xcrud',$xcrud);
        $this->set('xcrud2',$xcrud2);
        // pr($t);
        //  exit;
    }
    public function news()
    {
        //  Configure::write('debug', 2);
        // $StockBangladesh = $this->Components->load('StockBangladesh');


        // $t=$StockBangladesh->getLastTradeInfo();
        // require_once(APP . 'Vendor' . DS . 'xcrud' . DS . 'xcrud.php');
        require_once(APP . 'webroot' . DS . 'xcrud' . DS . 'xcrud.php');
        $xcrud = Xcrud::get_instance();
        $xcrud->table('news');
        $xcrud->relation('instrument_id', 'instruments', 'id', 'instrument_code');
      //  $xcrud->relation('market_id', 'markets', 'id', 'trade_date');


        $this->set('xcrud',$xcrud);
     //   $this->set('xcrud2',$xcrud2);
        // pr($t);
        //  exit;
    }
    public function market()
    {
        //  Configure::write('debug', 2);
        // $StockBangladesh = $this->Components->load('StockBangladesh');


        // $t=$StockBangladesh->getLastTradeInfo();
        // require_once(APP . 'Vendor' . DS . 'xcrud' . DS . 'xcrud.php');
        require_once(APP . 'webroot' . DS . 'xcrud' . DS . 'xcrud.php');
        $xcrud = Xcrud::get_instance();
        $xcrud->table('markets');
        $xcrud->default_tab('market');


        $this->set('xcrud',$xcrud);

        // pr($t);
        //  exit;
    }

    public function instrument()
    {
        //  Configure::write('debug', 2);
        // $StockBangladesh = $this->Components->load('StockBangladesh');


        // $t=$StockBangladesh->getLastTradeInfo();
        // require_once(APP . 'Vendor' . DS . 'xcrud' . DS . 'xcrud.php');
        require_once(APP . 'webroot' . DS . 'xcrud' . DS . 'xcrud.php');
        $xcrud = Xcrud::get_instance();
        $xcrud->table('instruments');
        $xcrud->default_tab('Instrument list');
       // $xcrud->relation('exchange_id','exchanges','id','name');
  //      $xcrud->relation('sector_list_id','sector_lists','id','name');
//        $xcrud->change_type('name', 'image');

        // $year_news_Info = $xcrud->nested_table('Year news Info','id','fundamentals','instrument_id'); // 2nd level
        // $year_news_Info->join('meta_id','metas','id','metastable',true);
        // $year_news_Info->where('metastable.meta_group_id =', 7);
        // $year_news_Info->columns('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        // $year_news_Info->fields('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        // $year_news_Info->relation('meta_id','metas','id','meta_key','metas.meta_group_id = 7');
        // $year_news_Info->relation('instrument_id','instruments','id','instrument_code');


// se change
       ///////////////////////////////////////////////////////
        $q1_eps_cont_op = $xcrud->nested_table('q1_eps_cont_op','id','fundamentals','instrument_id'); // 2nd level
        $q1_eps_cont_op->join('meta_id','metas','id','metastable',true);
        $q1_eps_cont_op->where('metastable.id =', 225);
        $q1_eps_cont_op->columns('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.is_latest,fundamentals.created_at,fundamentals.updated_at');
        $q1_eps_cont_op->fields('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.is_latest,fundamentals.created_at,fundamentals.updated_at');
        // $q1_report_news_info->relation('meta_id','metas','id','meta_key','metas.meta_group_id = 12');
        $q1_eps_cont_op->relation('instrument_id','instruments','id','instrument_code');
       ///////////////////////////////////////////////////////
       ///////////////////////////////////////////////////////
       /* $q2_eps_cont_op = $xcrud->nested_table('q2_eps_cont_op','id','fundamentals','instrument_id'); // 2nd level
        $q2_eps_cont_op->join('meta_id','metas','id','metastable',true);
        $q2_eps_cont_op->where('metastable.id =', 226);
        $q2_eps_cont_op->columns('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.is_latest,fundamentals.created_at,fundamentals.updated_at');
        $q2_eps_cont_op->fields('fundamentals.instrument_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.is_latest,fundamentals.created_at,fundamentals.updated_at');
        // $q1_report_news_info->relation('meta_id','metas','id','meta_key','metas.meta_group_id = 12');
        $q2_eps_cont_op->relation('instrument_id','instruments','id','instrument_code');
       ///////////////////////////////////////////////////////
       ///////////////////////////////////////////////////////
        $q2_eps_cont_op = $xcrud->nested_table('half_year_eps_cont_op','id','fundamentals','instrument_id'); // 2nd level
        $q2_eps_cont_op->join('meta_id','metas','id','metastable',true);
        $q2_eps_cont_op->where('metastable.id =', 434);
        $q2_eps_cont_op->columns('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.is_latest,fundamentals.created_at,fundamentals.updated_at');
        $q2_eps_cont_op->fields('fundamentals.instrument_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.is_latest,fundamentals.created_at,fundamentals.updated_at');
        // $q1_report_news_info->relation('meta_id','metas','id','meta_key','metas.meta_group_id = 12');
        $q2_eps_cont_op->relation('instrument_id','instruments','id','instrument_code');
       ///////////////////////////////////////////////////////
       ///////////////////////////////////////////////////////
        $q2_eps_cont_op = $xcrud->nested_table('q3_eps_cont_op','id','fundamentals','instrument_id'); // 2nd level
        $q2_eps_cont_op->join('meta_id','metas','id','metastable',true);
        $q2_eps_cont_op->where('metastable.id =', 227);
        $q2_eps_cont_op->columns('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.is_latest,fundamentals.created_at,fundamentals.updated_at');
        $q2_eps_cont_op->fields('fundamentals.instrument_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.is_latest,fundamentals.created_at,fundamentals.updated_at');
        // $q1_report_news_info->relation('meta_id','metas','id','meta_key','metas.meta_group_id = 12');
        $q2_eps_cont_op->relation('instrument_id','instruments','id','instrument_code');
       ///////////////////////////////////////////////////////
       ///////////////////////////////////////////////////////
        $q2_eps_cont_op = $xcrud->nested_table('q3_nine_months_eps','id','fundamentals','instrument_id'); // 2nd level
        $q2_eps_cont_op->join('meta_id','metas','id','metastable',true);
        $q2_eps_cont_op->where('metastable.id =', 308);
        $q2_eps_cont_op->columns('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.is_latest,fundamentals.created_at,fundamentals.updated_at');
        $q2_eps_cont_op->fields('fundamentals.instrument_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.is_latest,fundamentals.created_at,fundamentals.updated_at');
        // $q1_report_news_info->relation('meta_id','metas','id','meta_key','metas.meta_group_id = 12');
        $q2_eps_cont_op->relation('instrument_id','instruments','id','instrument_code');
       ///////////////////////////////////////////////////////
       ///////////////////////////////////////////////////////
        $earning_per_share = $xcrud->nested_table('earning_per_share','id','fundamentals','instrument_id'); // 2nd level
        $earning_per_share->join('meta_id','metas','id','metastable',true);
        $earning_per_share->where('metastable.id =', 201);
        $earning_per_share->columns('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.is_latest,fundamentals.created_at,fundamentals.updated_at');
        $earning_per_share->fields('fundamentals.instrument_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.is_latest,fundamentals.created_at,fundamentals.updated_at');
        // $q1_report_news_info->relation('meta_id','metas','id','meta_key','metas.meta_group_id = 12');
        $earning_per_share->relation('instrument_id','instruments','id','instrument_code');
       ///////////////////////////////////////////////////////
       ///////////////////////////////////////////////////////
        $earning_per_share = $xcrud->nested_table('net_asset_val_per_share','id','fundamentals','instrument_id'); // 2nd level
        $earning_per_share->join('meta_id','metas','id','metastable',true);
        $earning_per_share->where('metastable.id =', 205);
        $earning_per_share->columns('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.is_latest,fundamentals.created_at,fundamentals.updated_at');
        $earning_per_share->fields('fundamentals.instrument_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.is_latest,fundamentals.created_at,fundamentals.updated_at');
        // $q1_report_news_info->relation('meta_id','metas','id','meta_key','metas.meta_group_id = 12');
        $earning_per_share->relation('instrument_id','instruments','id','instrument_code');*/
       ///////////////////////////////////////////////////////
// se change
        // $yearly_change_info = $xcrud->nested_table('Yearly change info','id','fundamentals','instrument_id'); // 2nd level
        // $yearly_change_info->join('meta_id','metas','id','metastable',true);
        // $yearly_change_info->where('metastable.meta_group_id =', 8);
        // $yearly_change_info->columns('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        // $yearly_change_info->fields('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        // $yearly_change_info->relation('meta_id','metas','id','meta_key','metas.meta_group_id = 8');
        // $yearly_change_info->relation('instrument_id','instruments','id','instrument_code');


        // $yearly_fixed_info = $xcrud->nested_table('yearly_fixed_info','id','fundamentals','instrument_id'); // 2nd level
        // $yearly_fixed_info->join('meta_id','metas','id','metastable',true);
        // $yearly_fixed_info->where('metastable.meta_group_id =', 9);
        // $yearly_fixed_info->columns('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        // $yearly_fixed_info->fields('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        // $yearly_fixed_info->relation('meta_id','metas','id','meta_key','metas.meta_group_id = 9');
        // $yearly_fixed_info->relation('instrument_id','instruments','id','instrument_code');

        // $yearly_other_info = $xcrud->nested_table('yearly_other_info','id','fundamentals','instrument_id'); // 2nd level
        // $yearly_other_info->join('meta_id','metas','id','metastable',true);
        // $yearly_other_info->where('metastable.meta_group_id =', 10);
        // $yearly_other_info->columns('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        // $yearly_other_info->fields('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        // $yearly_other_info->relation('meta_id','metas','id','meta_key','metas.meta_group_id = 10');
        // $yearly_other_info->relation('instrument_id','instruments','id','instrument_code');

        // $q1_report_news_info = $xcrud->nested_table('q1_report_news_info','id','fundamentals','instrument_id'); // 2nd level
        // $q1_report_news_info->join('meta_id','metas','id','metastable',true);
        // $q1_report_news_info->where('metastable.meta_group_id =', 12);
        // $q1_report_news_info->columns('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        // $q1_report_news_info->fields('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        // $q1_report_news_info->relation('meta_id','metas','id','meta_key','metas.meta_group_id = 12');
        // $q1_report_news_info->relation('instrument_id','instruments','id','instrument_code');
       
        // $q2_report_news_info = $xcrud->nested_table('q2_report_news_info','id','fundamentals','instrument_id'); // 2nd level
        // $q2_report_news_info->join('meta_id','metas','id','metastable',true);
        // $q2_report_news_info->where('metastable.meta_group_id =', 14);
        // $q2_report_news_info->columns('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        // $q2_report_news_info->fields('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        // $q2_report_news_info->relation('meta_id','metas','id','meta_key','metas.meta_group_id = 14');
        // $q2_report_news_info->relation('instrument_id','instruments','id','instrument_code');

        // $q3_report_news_info = $xcrud->nested_table('q3_report_news_info','id','fundamentals','instrument_id'); // 2nd level
        // $q3_report_news_info->join('meta_id','metas','id','metastable',true);
        // $q3_report_news_info->where('metastable.meta_group_id =', 13);
        // $q3_report_news_info->columns('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        // $q3_report_news_info->fields('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        // $q3_report_news_info->relation('meta_id','metas','id','meta_key','metas.meta_group_id = 13');
        // $q3_report_news_info->relation('instrument_id','instruments','id','instrument_code');

        // $logo = $xcrud->nested_table('Logo','id','fundamentals','instrument_id'); // 2nd level
        // $logo->join('meta_id','metas','id','metastable',true);
        // $logo->where('metastable.meta_group_id =', 15);
        // $logo->columns('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        // $logo->fields('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        // $logo->change_type('fundamentals.meta_value','image','', array('path'=>'../files/uploads','url'=>'http://www.new.stockbangladesh.com/files/uploads/'));
        // $logo->relation('meta_id','metas','id','meta_key','metas.meta_group_id = 15');
        // $logo->relation('instrument_id','instruments','id','instrument_code');

        // $report = $xcrud->nested_table('Reports','id','fundamentals','instrument_id'); // 2nd level
        // $report->join('meta_id','metas','id','metastable',true);
        // $report->where('metastable.meta_group_id =', 16);
        // $report->columns('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        // $report->fields('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        // $report->change_type('fundamentals.meta_value','file','', array('path'=>'../files/uploads/reports','url'=>'http://www.new.stockbangladesh.com/files/uploads/reports/'));
        // $report->relation('meta_id','metas','id','meta_key','metas.meta_group_id = 16');
        // $report->relation('instrument_id','instruments','id','instrument_code');



        $this->set('xcrud',$xcrud);

    }
    public function fundamental()
    {
        //  Configure::write('debug', 2);
        // $StockBangladesh = $this->Components->load('StockBangladesh');


        // $t=$StockBangladesh->getLastTradeInfo();
        // require_once(APP . 'Vendor' . DS . 'xcrud' . DS . 'xcrud.php');
        require_once(APP . 'webroot' . DS . 'xcrud' . DS . 'xcrud.php');
        $xcrud = Xcrud::get_instance();
        $xcrud->table('instruments');
        $xcrud->where('instruments.active =', 1);
        $xcrud->default_tab('Instrument info');
        $xcrud->relation('exchange_id','exchanges','id','name');
        $xcrud->relation('sector_list_id','sector_lists','id','name');
//        $xcrud->change_type('name', 'image');

        $tab = $xcrud->nested_table('All','id','fundamentals','instrument_id'); // 2nd level
        $tab->join('meta_id','metas','id','metastable',true);
        $tab->where('metastable.meta_group_id =', 18);
        $tab->columns('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        $tab->fields('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        $tab->relation('meta_id','metas','id','meta_key','metas.meta_group_id = 18');
        $tab->relation('instrument_id','instruments','id','instrument_code');


        $tab = $xcrud->nested_table('share_percentage_director','id','fundamentals','instrument_id'); // 2nd level
        $tab->join('meta_id','metas','id','metastable',true);
        $tab->where('metastable.meta_key =', array('share_percentage_director'));
        $tab->columns('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        $tab->fields('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        $tab->relation('meta_id','metas','id','meta_key');
        $tab->relation('instrument_id','instruments','id','instrument_code');

        $tab = $xcrud->nested_table('share_percentage_public','id','fundamentals','instrument_id'); // 2nd level
        $tab->join('meta_id','metas','id','metastable',true);
        $tab->where('metastable.meta_key =', array('share_percentage_public'));
        $tab->columns('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        $tab->fields('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        $tab->relation('meta_id','metas','id','meta_key');
        $tab->relation('instrument_id','instruments','id','instrument_code');

        $tab = $xcrud->nested_table('share_percentage_govt','id','fundamentals','instrument_id'); // 2nd level
        $tab->join('meta_id','metas','id','metastable',true);
        $tab->where('metastable.meta_key =', array('share_percentage_govt'));
        $tab->columns('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        $tab->fields('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        $tab->relation('meta_id','metas','id','meta_key');
        $tab->relation('instrument_id','instruments','id','instrument_code');

        $tab = $xcrud->nested_table('share_percentage_institute','id','fundamentals','instrument_id'); // 2nd level
        $tab->join('meta_id','metas','id','metastable',true);
        $tab->where('metastable.meta_key =', array('share_percentage_institute'));
        $tab->columns('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        $tab->fields('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        $tab->relation('meta_id','metas','id','meta_key');
        $tab->relation('instrument_id','instruments','id','instrument_code');

        $tab = $xcrud->nested_table('share_percentage_foreign','id','fundamentals','instrument_id'); // 2nd level
        $tab->join('meta_id','metas','id','metastable',true);
        $tab->where('metastable.meta_key =', array('share_percentage_foreign'));
        $tab->columns('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        $tab->fields('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        $tab->relation('meta_id','metas','id','meta_key');
        $tab->relation('instrument_id','instruments','id','instrument_code');

//        array('q1_eps_cont_op','q2_eps_cont_op','q3_eps_cont_op','half_year_eps_cont_op','q3_nine_months_eps','earning_per_share');

        $tab = $xcrud->nested_table('q1_eps_cont_op','id','fundamentals','instrument_id'); // 2nd level
        $tab->join('meta_id','metas','id','metastable',true);
        $tab->where('metastable.meta_key =', array('q1_eps_cont_op'));
        $tab->columns('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        $tab->fields('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        $tab->relation('meta_id','metas','id','meta_key');
        $tab->relation('instrument_id','instruments','id','instrument_code');

        $tab = $xcrud->nested_table('q2_eps_cont_op','id','fundamentals','instrument_id'); // 2nd level
        $tab->join('meta_id','metas','id','metastable',true);
        $tab->where('metastable.meta_key =', array('q2_eps_cont_op'));
        $tab->columns('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        $tab->fields('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        $tab->relation('meta_id','metas','id','meta_key');
        $tab->relation('instrument_id','instruments','id','instrument_code');

        $tab = $xcrud->nested_table('q3_eps_cont_op','id','fundamentals','instrument_id'); // 2nd level
        $tab->join('meta_id','metas','id','metastable',true);
        $tab->where('metastable.meta_key =', array('q3_eps_cont_op'));
        $tab->columns('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        $tab->fields('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        $tab->relation('meta_id','metas','id','meta_key');
        $tab->relation('instrument_id','instruments','id','instrument_code');

        $tab = $xcrud->nested_table('half_year_eps_cont_op','id','fundamentals','instrument_id'); // 2nd level
        $tab->join('meta_id','metas','id','metastable',true);
        $tab->where('metastable.meta_key =', array('half_year_eps_cont_op'));
        $tab->columns('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        $tab->fields('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        $tab->relation('meta_id','metas','id','meta_key');
        $tab->relation('instrument_id','instruments','id','instrument_code');

        $tab = $xcrud->nested_table('q3_nine_months_eps','id','fundamentals','instrument_id'); // 2nd level
        $tab->join('meta_id','metas','id','metastable',true);
        $tab->where('metastable.meta_key =', array('q3_nine_months_eps'));
        $tab->columns('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        $tab->fields('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        $tab->relation('meta_id','metas','id','meta_key');
        $tab->relation('instrument_id','instruments','id','instrument_code');

        $tab = $xcrud->nested_table('earning_per_share','id','fundamentals','instrument_id'); // 2nd level
        $tab->join('meta_id','metas','id','metastable',true);
        $tab->where('metastable.meta_key =', array('earning_per_share'));
        $tab->columns('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        $tab->fields('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        $tab->relation('meta_id','metas','id','meta_key');
        $tab->relation('instrument_id','instruments','id','instrument_code');

        //array('q1_net_prft_aft_tx_cont_op','q2_net_prft_aft_tx_cont_op','q3_net_prft_aft_tx_cont_op','half_year_net_prft_aft_tx_cont_op','q3_nine_months_net_profit_after_tax','profit_after_tax');

        $tab = $xcrud->nested_table('q1_net_prft_aft_tx_cont_op','id','fundamentals','instrument_id'); // 2nd level
        $tab->join('meta_id','metas','id','metastable',true);
        $tab->where('metastable.meta_key =', array('q1_net_prft_aft_tx_cont_op'));
        $tab->columns('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        $tab->fields('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        $tab->relation('meta_id','metas','id','meta_key');
        $tab->relation('instrument_id','instruments','id','instrument_code');

        $tab = $xcrud->nested_table('q2_net_prft_aft_tx_cont_op','id','fundamentals','instrument_id'); // 2nd level
        $tab->join('meta_id','metas','id','metastable',true);
        $tab->where('metastable.meta_key =', array('q2_net_prft_aft_tx_cont_op'));
        $tab->columns('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        $tab->fields('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        $tab->relation('meta_id','metas','id','meta_key');
        $tab->relation('instrument_id','instruments','id','instrument_code');

        $tab = $xcrud->nested_table('q3_net_prft_aft_tx_cont_op','id','fundamentals','instrument_id'); // 2nd level
        $tab->join('meta_id','metas','id','metastable',true);
        $tab->where('metastable.meta_key =', array('q3_net_prft_aft_tx_cont_op'));
        $tab->columns('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        $tab->fields('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        $tab->relation('meta_id','metas','id','meta_key');
        $tab->relation('instrument_id','instruments','id','instrument_code');

        $tab = $xcrud->nested_table('half_year_net_prft_aft_tx_cont_op','id','fundamentals','instrument_id'); // 2nd level
        $tab->join('meta_id','metas','id','metastable',true);
        $tab->where('metastable.meta_key =', array('half_year_net_prft_aft_tx_cont_op'));
        $tab->columns('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        $tab->fields('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        $tab->relation('meta_id','metas','id','meta_key');
        $tab->relation('instrument_id','instruments','id','instrument_code');

        $tab = $xcrud->nested_table('q3_nine_months_net_profit_after_tax','id','fundamentals','instrument_id'); // 2nd level
        $tab->join('meta_id','metas','id','metastable',true);
        $tab->where('metastable.meta_key =', array('q3_nine_months_net_profit_after_tax'));
        $tab->columns('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        $tab->fields('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        $tab->relation('meta_id','metas','id','meta_key');
        $tab->relation('instrument_id','instruments','id','instrument_code');

        $tab = $xcrud->nested_table('profit_after_tax','id','fundamentals','instrument_id'); // 2nd level
        $tab->join('meta_id','metas','id','metastable',true);
        $tab->where('metastable.meta_key =', array('profit_after_tax'));
        $tab->columns('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        $tab->fields('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        $tab->relation('meta_id','metas','id','meta_key');
        $tab->relation('instrument_id','instruments','id','instrument_code');

        $xcrud->unset_csv();

        $this->set('xcrud',$xcrud);

    }

    public function getDataForJavaChart($instrumentId=12,$adjusted='n')
    { $this->Auth->allow();
       // Configure::write('debug',2);

        App::uses('DataBanksEod', 'Model');
        $DataBanksEod = new DataBanksEod();

        App::uses('DataBanksAdjustedEod', 'Model');
        $DataBanksAdjustedEod = new DataBanksAdjustedEod();



        if($adjusted=='n') {


            $dataList = $DataBanksEod->find('all', array(
                'conditions' => "DataBanksEod.instrument_id=$instrumentId",
                'recursive' => -1
            ));

        }else {
            $dataList = $DataBanksAdjustedEod->find('all', array(
                'conditions' => "DataBanksAdjustedEod.instrument_id=$instrumentId",
                 'recursive' => -1
            ));
            // get real time data during trade time
           // $query_trade_time	=	"SELECT instruments.instrument_code, data_banks_eods.date, data_banks_eods.open, data_banks_eods.high, data_banks_eods.low, data_banks_eods.close, data_banks_eods.volume FROM instruments, data_banks_eods WHERE instruments.id=data_banks_eods.instrument_id AND instruments.instrument_code= '".$symbol."' ORDER BY data_banks_eods.id DESC LIMIT 1";
          //  $result_trade_time	=	mysql_fetch_array(mysql_query($query_trade_time));
        }


       // $query	=	"SELECT instruments.instrument_code, data_banks_eods.date, data_banks_eods.open, data_banks_eods.high, data_banks_eods.low, data_banks_eods.close, data_banks_eods.volume FROM instruments, data_banks_eods WHERE instruments.id=data_banks_eods.instrument_id  AND instruments.instrument_code = '".$symbol."'";
        //echo $query."<br/>";
      //  $result	=	mysql_query($query) or die(mysql_error());
        $str	=	null;
        $vis_str	=	null;
      //  echo $str	=	"<DTYYYYMMDD>,<OPEN>,<HIGH>,<LOW>,<CLOSE>,<VOL>\n";
        $vis_str	.=	"&lt;DTYYYYMMDD&gt;,&lt;OPEN&gt;,&lt;HIGH&gt;,&lt;LOW&gt;,&lt;CLOSE&gt;,&lt;VOL&gt;<br/>";
        if($dataList)
        {
            foreach($dataList as $sdata )
            {
               // echo $str	= date('Ymd', strtotime($sdata ["DataBanksEod"]["date"])).",".$sdata["DataBanksEod"]["open"].",".$sdata["DataBanksEod"]["high"].",".$sdata["DataBanksEod"]["low"].",".$sdata["DataBanksEod"]["close"].",".$sdata["DataBanksEod"]["volume"]."\n";
                $vis_str	.= date('Ymd', strtotime($sdata["DataBanksEod"]["date"])).",".$sdata["DataBanksEod"]["open"].",".$sdata["DataBanksEod"]["high"].",".$sdata["DataBanksEod"]["low"].",".$sdata["DataBanksEod"]["close"].",".$sdata["DataBanksEod"]["volume"]."<br/>";
            }

            /*if($sdata["DataBanksEod"]["date"]!=$result_trade_time['date']) {
                echo $str	= date('Ymd', strtotime($result_trade_time["DataBanksEod"]["date"])).",".$result_trade_time["DataBanksEod"]["open"].",".$result_trade_time["DataBanksEod"]["high"].",".$result_trade_time["DataBanksEod"]["low"].",".$result_trade_time["DataBanksEod"]["close"].",".$result_trade_time["DataBanksEod"]["volume"]."\n";
            }*/
            //echo "<textarea cols='80' rows='20'>".$str."</textarea>";
            //echo "<h2>Formatted Txt</h2>".$vis_str;
            //echo $str;
        }
        else{die("<h1>NO SYMBOL FOUND</h1>");}
        $this->set('vis_str', $vis_str);
        //pr($vis_str);

    }
    public  function links()
    {

    }

    public function sbads()
    {
        require_once(APP . 'webroot' . DS . 'xcrud' . DS . 'xcrud.php');
        $xcrud = Xcrud::get_instance();
        $xcrud->table('sbads');
        //$xcrud->change_type('sbads.img', 'image', '', array('crop' => false,'path' => '../files/uploads/ads', 'url' => 'http://www.new.stockbangladesh.com/files/uploads/ads/'));
        $xcrud->change_type('sbads.img', 'file', '', array('not_rename' => true,'path' => '../files/uploads/ads', 'url' => 'http://www.new.stockbangladesh.com/files/uploads/ads/'));
        //$xcrud->change_type('sbads.img', 'file', '', array('not_rename' => false));



       /* $logo = $xcrud->nested_table('Logo', 'id', 'fundamentals', 'instrument_id'); // 2nd level
        $logo->join('meta_id', 'metas', 'id', 'metastable', true);
        $logo->where('metastable.meta_group_id =', 15);
        $logo->columns('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        $logo->fields('fundamentals.instrument_id,fundamentals.meta_id,fundamentals.meta_value,fundamentals.meta_date,fundamentals.created_at,fundamentals.updated_at');
        $logo->change_type('fundamentals.meta_value', 'image', '', array('path' => '../files/uploads', 'url' => 'http://www.new.stockbangladesh.com/files/uploads/'));
        $logo->relation('meta_id', 'metas', 'id', 'meta_key', 'metas.meta_group_id = 15');
        $logo->relation('instrument_id', 'instruments', 'id', 'instrument_code');*/


        $this->set('xcrud', $xcrud);
    }

    public function start_market()
    {
        require_once(APP . 'webroot' . DS . 'xcrud_old' . DS . 'xcrud.php');
        $xcrud = Xcrud::get_instance();
        $xcrud->table('configuration');
        $this->set('xcrud', $xcrud);
    }



    public function eod()
    {
        require_once(APP . 'webroot' . DS . 'xcrud_old' . DS . 'xcrud.php');
        $xcrud = Xcrud::get_instance();
        $xcrud->table('outputs');
        $this->set('xcrud', $xcrud);
    }

    public function market_old()
    {
        require_once(APP . 'webroot' . DS . 'xcrud_old' . DS . 'xcrud.php');
        $xcrud = Xcrud::get_instance();
        $xcrud->table('market_summeries');
        $this->set('xcrud', $xcrud);
    }


    public function test()
    {

        Configure::write('debug', 2);

        mysql_connect('localhost', 'stock_newdbuser', '(WeyLfu2+;O4');
        //or die("Could not connect: " . mysql_error());
        mysql_select_db("stock_sbnew");

        $result = mysql_query("SELECT *  FROM sbads WHERE `active` = 1 ORDER BY position ASC");

        $ads=array();
        while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
            $temp=array();
            $temp['url']= $row[1];
            $temp['img']= $row[2];
            $ads[$row[4]][]= $temp;
        }

        mysql_free_result($result);
pr($ads);
        exit;

    }

    // calculating q1,q2,q3,q4 date based on year end
    public  function rectify_q_date_x()
    {
        Configure::write('debug', 2);

        App::uses('CakeTime', 'Utility');
        $StockBangladesh = $this->Components->load('StockBangladesh');
        $instrumentList=$StockBangladesh->instrumentList(3);

        App::uses('Fundamental', 'Model');
        $Fundamental = new Fundamental();

        $metaKey=array("year_end","q1_eps_cont_op");
        $funda_data=$Fundamental->find('FundamentalDataHistory', array('meta'=>$metaKey));



        /*
         * OLD (Dec) ----> New (June)
         * ==================================
         * Year
         * -------------
         * New Q1 year same as OLD Q1
         * New Q2/Halfyear year same as OLD Q2
         * New Q3/9month year is  1 + OLD Q3
         * New Q4/fullyear year is  1 + OLD Q4
         *
         * Month
         * --------------------------
         * (old month+6)%12
         *
         * Day
         * ------------------------
         * no change
         *
         * */


        /*
         * OLD (June) ----> New (Dec)
         * ==================================
         * Year
         * -------------
         * New Q1 year is  1 + OLD Q1
         * New Q2 year is  1 + OLD Q2
         * New Q3/9month year same as OLD Q3
         * New Q4/fullyear year same as OLD Q3
         *
         * Month
         * --------------------------
         * (old month+6)%12
         *
         * Day
         * ------------------------
         * no change
         *
         * */



        foreach($funda_data as $instrument_id=>$data)
        {
            if(!isset($data['q1_eps_cont_op']))
                continue;

            $year_end=$data['year_end'][0]['meta_value'];
            $current_year_end_month=date('m',strtotime($year_end));

            if($current_year_end_month==6)  // OLD (Dec) ----> New (June)
            {
                foreach($data['q1_eps_cont_op'] as $meta_data)
                {
                    $old_date=$meta_data['meta_date'];
                    $should_be_month=(date('m',strtotime("$old_date +180 days")));

                    $database_day=date('d',strtotime($meta_data['meta_date']));
                    $database_month=date('m',strtotime($meta_data['meta_date']));
                    $database_year=date('Y',strtotime($meta_data['meta_date']));


                    //$should_be_month=($database_month+06)%12;



                    // Year end Changed from DEC -> June
                    if($database_month!=$should_be_month)
                    {
                        pr($instrumentList[$instrument_id]);
                        pr("===============================");
                        $should_be_q1_date="$database_year-$should_be_month-30";
                       // pr("current_year_end_month=$current_year_end_month | database_q1_month=$database_month -> should_be_q1_month=$should_be_month");
                        pr("Old Date=$old_date New Q1 date=$should_be_q1_date");
                    }



                }

            }
            if($current_year_end_month==12)  // OLD (June) ----> New (Dec)
            {
                foreach($data['q1_eps_cont_op'] as $meta_data)
                {
                    $old_date=$meta_data['meta_date'];

                    $database_day=date('d',strtotime($meta_data['meta_date']));
                    $database_month=date('m',strtotime($meta_data['meta_date']));
                    $database_year=date('Y',strtotime($meta_data['meta_date']));

                    $current_year_end_month=date('m',strtotime($year_end));
                    $currect_q1_month=
                    //$should_be_month=($database_month+06)%12;

                    $should_be_month=(date('m',strtotime("$old_date +180 days")));

                    // Year end Changed from June -> Dec
                    if($database_month!=$should_be_month)
                    {
                        pr($instrumentList[$instrument_id]);
                        pr("===============================");
                        $should_be_q1_date="$database_year-$should_be_month-31";
                        pr("current_year_end_month=$current_year_end_month | database_q1_month=$database_month -> should_be_q1_month=$should_be_month");
                        pr("Old Date=$old_date Q1 date=$should_be_q1_date");
                    }



                }

            }



        }




        exit;

        $MetaManagement = $this->Components->load('MetaManagement');
        $return=$MetaManagement->saveFundamentalInfo($dataToSave);
        pr($return);
        exit;
    }

    /*
        * OLD (Dec) ----> New (June)
        * ==================================
        * Year
        * -------------
        * New Q1 year same as OLD Q1
        * New Q2/Halfyear year same as OLD Q2
        * New Q3/9month year is  1 + OLD Q3
        * New Q4/fullyear year is  1 + OLD Q4
        *
        * Month
        * --------------------------
        * (old month+6)%12
        *
        * Day
        * ------------------------
        * no change
        *
        * */


    /*
     * OLD (June) ----> New (Dec)
     * ==================================
     * Year
     * -------------
     * New Q1 year is  1 + OLD Q1
     * New Q2 year is  1 + OLD Q2
     * New Q3/9month year same as OLD Q3
     * New Q4/fullyear year same as OLD Q3
     *
     * Month
     * --------------------------
     * (old month+6)%12
     *
     * Day
     * ------------------------
     * no change
     *
     * */

    // http://www.new.stockbangladesh.com/DataManagements/rectify_q_date/q1_eps_cont_op/3/9
    // http://www.new.stockbangladesh.com/DataManagements/rectify_q_date/q2_eps_cont_op/6/12
    // http://www.new.stockbangladesh.com/DataManagements/rectify_q_date/q3_eps_cont_op/9/3
    // http://www.new.stockbangladesh.com/DataManagements/rectify_q_date/earning_per_share/12/6

    public  function rectify_q_date($q='q1_eps_cont_op',$dec_ended_q_month=3,$june_ended_q_month=9)
    {
        Configure::write('debug', 2);

        App::uses('CakeTime', 'Utility');
        $StockBangladesh = $this->Components->load('StockBangladesh');
        $instrumentList=$StockBangladesh->instrumentList(3);

        App::uses('Fundamental', 'Model');
        $Fundamental = new Fundamental();

        $metaKey=array("year_end","$q");
        $funda_data=$Fundamental->find('FundamentalDataHistory', array('meta'=>$metaKey));




        $dataToSave=array();
        foreach($funda_data as $instrument_id=>$data)
        {
            if(!isset($data[$q]))
                continue;

            $year_end=$data['year_end'][0]['meta_value'];
            $current_year_end_month=date('m',strtotime($year_end));


            if($current_year_end_month==6)  // OLD (Dec) ----> New (June)
            {
                if($june_ended_q_month==9 || $june_ended_q_month==6)
                {
                    $day=30;
                }else
                {
                    $day=31;
                }

                foreach($data[$q] as $meta_data)
                {
                    $old_date=$meta_data['meta_date'];

                    $database_month=date('m',strtotime($meta_data['meta_date']));
                    $database_year=date('Y',strtotime($meta_data['meta_date']));




                    // Year end Changed from DEC -> June
                    if($database_month!=$june_ended_q_month)
                    {
                        $code=$instrumentList[$instrument_id];
                        //pr("================OLD (Dec) ----> New (June)===============");
                        $date_str="$database_year-$june_ended_q_month-$day";
                        $should_be_q1_date=date('Y-m-d',strtotime($date_str));
                        //pr("current_year_end_month=$current_year_end_month | database_q1_month=$database_month -> current_q1_month=$june_ended_q_month");
                        pr("June ending (new) | <b><i>$code</i></b> $q Old Date=$old_date => <b>New date=$should_be_q1_date</b>");

                        $temp=array();
                        $temp['id']=$meta_data['id'];
                        $temp['instrument_id']=$meta_data['instrument_id'];
                        $temp['meta_id']=$meta_data['meta_id'];
                        $temp['meta_value']=$meta_data['meta_value'];
                        $temp['meta_date']=$should_be_q1_date;
                        $temp['created']=$meta_data['created'];

                        $dataToSave[]=$temp;

                    }



                }

            }



            if($current_year_end_month==12)  // OLD (June) ----> New (Dec)
            {
                if($dec_ended_q_month==9 || $dec_ended_q_month==6)
                {
                    $day=30;
                }else
                {
                    $day=31;
                }

                foreach($data[$q] as $meta_data)
                {
                    $old_date=$meta_data['meta_date'];



                    $database_month=date('m',strtotime($meta_data['meta_date']));
                    $database_year=date('Y',strtotime($meta_data['meta_date']));

                    $current_q1_month=3;

                    // Year end Changed from June -> Dec
                    if($database_month!=$dec_ended_q_month)
                    {
                        $code=$instrumentList[$instrument_id];

                      //  pr("===============OLD (June) ----> New (Dec)================");
                        $date_str="$database_year-$dec_ended_q_month-$day";
                        $should_be_q1_date=date('Y-m-d',strtotime($date_str));
                     //   pr("current_year_end_month=$current_year_end_month | database_q1_month=$database_month -> current_q1_month=$current_q1_month");
                        pr("Dec ending (new)|| <b><i>$code</i></b> $q Old Date=$old_date => <b>New date=$should_be_q1_date</b>");

                        $temp=array();
                        $temp['id']=$meta_data['id'];
                        $temp['instrument_id']=$meta_data['instrument_id'];
                        $temp['meta_id']=$meta_data['meta_id'];
                        $temp['meta_value']=$meta_data['meta_value'];
                        $temp['meta_date']=$should_be_q1_date;
                        $temp['created']=$meta_data['created'];

                        $dataToSave[]=$temp;
                    }



                }

            }



        }

exit;
        if ($Fundamental->saveMany($dataToSave, array('atomic' => true))) {
            echo "data updated <b>successfully</b>";
            pr($dataToSave);
        } else
            echo "data update is <b>unsuccessful</b>";


        exit;



    }


    // setting meta_value=meta_date for year_end
    public  function meta_value_reset()
    {
        App::uses('CakeTime', 'Utility');
        Configure::write('debug', 2);
        App::uses('Fundamental', 'Model');
        $Fundamental = new Fundamental();

        $metaKey=array("year_end");
        $all_year_end=$Fundamental->find('FundamentalDataHistory', array('meta'=>$metaKey));

        $dataToSave=array();
        foreach($all_year_end as $instrument_id=>$meta_data)
        {
            //$year_end_arr=$meta_data['year_end'][0]['meta_value'];
            $meta=$meta_data['year_end'][0];
            $temp=array();

            $temp['instrument_id']=$instrument_id;
            $temp['meta_key']='year_end';
            $temp['meta_value']=$meta['meta_value'];
            $temp['meta_date']=$meta['meta_value'];
            $dataToSave[]=$temp;


        }

        $MetaManagement = $this->Components->load('MetaManagement');
        $return=$MetaManagement->saveFundamentalInfo($dataToSave);
        pr($return);
        exit;
    }


}
