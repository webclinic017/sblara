<?php
/*
 * @author: A S M Abdur Rab (shibly) , shiblydu@yahoo.com
 * @Controller: To Manage Company List Functions
 *
 * Created: 14-02-2010
 *
 */
//ini_set ('extension_dir', '/home/stockban/public_html/lib');
//ini_set ('enable_dl', '1');
//App::import('Vendor', 'Phpchartdir', array('file' => 'FinanceChart.php'));
require_once(WWW_ROOT . DS . 'chart'. DS .'FinanceChart.php');

class SymbolsController extends AppController {
    
    var $uses = array('Symbol', 'DataBank','Symboladjustment','Output','MarketSummery');
    var $helpers = array('Html','Form','Javascript','Jmycake'); 
	
    var $timeStamps = null;
    var $volData    = null;
    var $highData   = null;
    var $lowData    = null;
    var $openData   = null;
    var $closeData  = null;
    var $timeadjust = 0;
    var $resolution = 0;
    
    var $cacheAction = false;
    //var $timeadjust = 1970*365*24*60*60 + 112*24*60*60;
    
    
	/*
    *   To set company list => alphabet wise
    */	
	function index() {
	    
        $this->layout ='default-one';
        $this->pageTitle = 'Stock Bangladesh :: Company List - Alphabet Wise'; 		
        		
		$companyList = $this->Symbol->find('all', 
            array('conditions' => array('Symbol.dse_code != \'\' '), 'fields' => array('Symbol.id', 'Symbol.dse_code', 'Symbol.name'), 'order' => array('Symbol.dse_code ASC')));        
		 
        $tempList = array();
        $tempListForNumericCode = array();
        
        if(!empty($companyList)) {
            foreach($companyList as $company) {
                  
                switch(substr($company['Symbol']['dse_code'], 0, 1)){
                    case 'a':
                    case 'A':
                             $tempList['A'][] = $company;
                             break;         
                    case 'b':
                    case 'B':
                             $tempList['B'][] = $company;
                             break;         
                    case 'c':
                    case 'C':
                             $tempList['C'][] = $company;
                             break;
                    case 'd':
                    case 'D':
                             $tempList['D'][] = $company;
                             break;
                    case 'e':
                    case 'E':
                             $tempList['E'][] = $company;
                             break;
                    case 'f':
                    case 'F':
                             $tempList['F'][] = $company;
                             break;
                    case 'g':
                    case 'G':
                             $tempList['G'][] = $company;
                             break;
                    case 'h':
                    case 'H':
                             $tempList['H'][] = $company;
                             break;
                    case 'i':
                    case 'I':
                             $tempList['I'][] = $company;
                             break;
                    case 'j':
                    case 'J':
                             $tempList['J'][] = $company;
                             break;
                    case 'k':
                    case 'K':
                             $tempList['K'][] = $company;
                             break;
                    case 'l':
                    case 'L':
                             $tempList['L'][] = $company;
                             break;
                    case 'm':
                    case 'M':
                             $tempList['M'][] = $company;
                             break;
                    case 'n':
                    case 'N':
                             $tempList['N'][] = $company;
                             break;
                    case 'o':
                    case 'O':
                             $tempList['O'][] = $company;
                             break;
                    case 'p':
                    case 'P':
                             $tempList['P'][] = $company;
                             break;
                    case 'q':
                    case 'Q':
                             $tempList['Q'][] = $company;
                             break;
                    case 'r':
                    case 'R':
                             $tempList['R'][] = $company;
                             break;
                    case 's':
                    case 'S':
                             $tempList['S'][] = $company;
                             break;
                    case 't':
                    case 'T':
                             $tempList['T'][] = $company;
                             break;
                    case 'u':
                    case 'U':
                             $tempList['U'][] = $company;
                             break;
                    case 'v':
                    case 'V':
                             $tempList['V'][] = $company;
                             break;
                    case 'w':
                    case 'W':
                             $tempList['W'][] = $company;
                             break;
                    case 'x':
                    case 'X':
                             $tempList['X'][] = $company;
                             break;
                    case 'y':
                    case 'Y':
                             $tempList['Y'][] = $company;
                             break;
                    case 'z':
                    case 'Z':
                             $tempList['Z'][] = $company;
                             break;
                    case '0':
                    case '1':
                    case '2':
                    case '3':
                    case '4':
                    case '5':
                    case '6':
                    case '7':
                    case '8':
                    case '9':                    
                             $tempListForNumericCode['#'][] = $company;
                             break;                                      
                }                  
            }
        }
        $tempList = $tempList + $tempListForNumericCode;
        $this->set('companyLists', $tempList);	
        $this->set('companyListHeader', array_keys($tempList));	        
	}




    function ABC()
    {
        echo "allah help me";
    }
    /*
    *   To set company list => alphabet wise
    */
    function alphabetwise()
    {
        $this->setAction('index');
        $this->layout ='default-one';
    }
    
    /*
    *   To set company list => sector wise
    */
    function sectorwise()
    {
        $this->layout ='default-one';        
        $this->pageTitle = 'Stock Bangladesh :: Company List - Sector Wise'; 
                
        $companyList = $this->Symbol->find('all', 
            array('conditions' => array('Symbol.dse_code != \'\' '), 'fields' => array('Symbol.id', 'Symbol.dse_code', 'Symbol.name', 'Symbol.business_segment'), 'order' => array('Symbol.business_segment ASC')));        
        
        $tempList = array();
        $tempListForNumericCode = array();
        
        $tempHeader  = '';
        $firstHeader = true;
        
        if(!empty($companyList)) {
            foreach($companyList as $company) {
                
                if($company['Symbol']['business_segment'] != '') {
                    
                    if($firstHeader && $tempHeader == '') 
                        $tempHeader = $company['Symbol']['business_segment'];                            
                    else 
                        $firstHeader = false;            
                                           
                    if(!$firstHeader && $tempHeader != $company['Symbol']['business_segment'])       
                    {
                        $firstHeader = true;
                        $tempHeader = $company['Symbol']['business_segment'];
                    }
                                    
                    $tempList[$tempHeader][] = $company;                
                } 
                else {
                    $tempListForNumericCode['Untitled'][] = $company;    
                }                 
            }
        }
        $tempList = $tempList + $tempListForNumericCode;
        $this->set('companyLists', $tempList);                
        $this->set('companyListHeader', array_keys($tempList));                        
    }
    
    /*
    *   To set company list => volume wise
    */
    function volumewise() {
        
        $this->redirect(array( 'action' => 'index' ));
                
        //$this->layout ='default-one';        
        //$this->pageTitle = 'Stock Bangladesh :: Company List - Volume Wise'; 
        
        /*        
        $companyList = $this->Symbol->find('all', 
            array('conditions' => array('Symbol.dse_code != \'\' '), 'fields' => array('Symbol.id', 'Symbol.dse_code', 'Symbol.name','Symbol.no_of_securities'), 'order' => array(' CAST(no_of_securities AS UNSIGNED) DESC')));        
        
        $tempList = array();
        
        if(!empty($companyList)) {
            foreach($companyList as $company) {
                
                if($company['Symbol']['no_of_securities'] != '')  
                switch($company['Symbol']['no_of_securities']){
                    case $company['Symbol']['no_of_securities'] > 100000000:
                                        $tempList['.. to 100000001'][] = $company;
                                        break;
                    case $company['Symbol']['no_of_securities'] <= 100000000
                                && $company['Symbol']['no_of_securities'] > 10000000:
                                        $tempList['100000000 to 10000001'][] = $company;
                                        break;
                    case $company['Symbol']['no_of_securities'] <= 10000000 
                                && $company['Symbol']['no_of_securities'] > 5000000:
                                        $tempList['10000000 to 5000001'][] = $company;
                                        break;         
                    case $company['Symbol']['no_of_securities'] <= 5000000
                                && $company['Symbol']['no_of_securities'] > 1000000:
                                        $tempList['5000000 to 1000001'][] = $company;
                                        break;                                     
                    case $company['Symbol']['no_of_securities'] <= 1000000
                                && $company['Symbol']['no_of_securities'] > 500000:
                                        $tempList['1000000 to 500001'][] = $company;
                                        break;                                     
                    case $company['Symbol']['no_of_securities'] <= 500000
                                && $company['Symbol']['no_of_securities'] > 100000:
                                        $tempList['500000 to 100001'][] = $company;
                                        break;                                     
                    case $company['Symbol']['no_of_securities'] <= 100000
                                && $company['Symbol']['no_of_securities'] > 50000:
                                        $tempList['100000 to 50001'][] = $company;
                                        break;                                     
                    case $company['Symbol']['no_of_securities'] <= 50000
                                && $company['Symbol']['no_of_securities'] > 10000:
                                        $tempList['50000 to 10001'][] = $company;
                                        break;                                     
                    case $company['Symbol']['no_of_securities'] <= 10000
                                && $company['Symbol']['no_of_securities'] > 5000:
                                        $tempList['10000 to 5000'][] = $company;
                                        break;                                     
                    case $company['Symbol']['no_of_securities'] <= 5000
                                && $company['Symbol']['no_of_securities'] > 1000:
                                        $tempList['5000 to 1001'][] = $company;
                                        break;                                     
                    case $company['Symbol']['no_of_securities'] <= 1000:                                
                            $tempList['1000 to 0'][] = $company;
                            break;                    
                }                  
            }
        }
        $this->set('companyLists', $tempList);    
        $this->set('companyListHeader', array_keys($tempList));
        //$this->render('sectorwise');  
        */          
    }
    
    /*
    *   To set company details for respective $symbol Index
    */    
    function details($symbolId = 0) 
    {       
        
$this->redirect(array( 'action' => "details2/$symbolId" ));        
		$this->layout ='default-bodyonly'; 
        $this->pageTitle = 'Stock Bangladesh :: Company Details'; 
        
		$this->Symbol->id = $symbolId;
        $shareInfo = $this->Symbol->read();	
        $face_value = $shareInfo['Symbol']['face_value'];
		
        if($shareInfo['Symbol']['q1']){
            $shareInfo['Symbol']['eps_in_bd'] = $shareInfo['Symbol']['q1'];
			$shareInfo['Symbol']['quarter'] = "Q1";
            $shareInfo['Symbol']['annualized_eps'] = $shareInfo['Symbol']['eps_in_bd']*4;
        }
        if($shareInfo['Symbol']['q2']){
			$shareInfo['Symbol']['eps_in_bd'] = $shareInfo['Symbol']['q2'];
			$shareInfo['Symbol']['quarter'] = "Q2";
            $shareInfo['Symbol']['annualized_eps'] = $shareInfo['Symbol']['eps_in_bd']*2;
		}
        if($shareInfo['Symbol']['q3']){
			$shareInfo['Symbol']['eps_in_bd'] = $shareInfo['Symbol']['q3'];
			$shareInfo['Symbol']['quarter'] = "Q3";
            $shareInfo['Symbol']['annualized_eps'] = ($shareInfo['Symbol']['eps_in_bd']/3)*4;
		}
        if($shareInfo['Symbol']['q4']){
			$shareInfo['Symbol']['eps_in_bd'] = $shareInfo['Symbol']['q4'];  
			$shareInfo['Symbol']['quarter'] = "Q4";
            $shareInfo['Symbol']['annualized_eps'] = $shareInfo['Symbol']['eps_in_bd'];
		}
        $this->set('share_info', $shareInfo);
		$this->set('symbol_id', $symbolId);
        
        // get Last trade price
		$this->DataBank->recursive = -1;
		//$dataBank = $this->Symbol->query('first', array('conditions' => array('DataBank.symbol_id' => $symbolId), 'order' => array('DataBank.id DESC'), 'limit' => 1	));
        //$dataBank = $this->Symbol->query('SELECT * FROM data_banks_intraday WHERE symbol_id='.$symbolId.' ORDER BY id DESC LIMIT 1');
        
        $dataBank = $this->Symbol->query('SELECT open, high, low, close, volume FROM outputs WHERE symbol=\''.$symbolId.'\' ORDER BY id DESC LIMIT 1');
		        
        $dataBank = $dataBank[0];
        $this->set('databank_info', $dataBank);
        		 
		$lastTradePrice = $shareInfo['Symbol']['lasttradeprice'];		
		$yClose         = $shareInfo['Symbol']['yclose'];
        
		if($yClose == 0) {
			$todayChange    = 0;
			$todayChangePer = 0;
		} else {
			$todayChange    = $lastTradePrice - $yClose;
            
            // change on single share
			$todayChangePer = ( $todayChange / $yClose ) * 100; 
		}
		$this->set('today_change', $todayChange);
		$this->set('today_change_per', $todayChangePer);
		 		
		$corporate_info = $this->Symbol->query('SELECT * FROM corporate_action WHERE symbol ='.$symbolId.' AND active=1 ORDER BY datestamp ASC');
        $corporate_arr = array();
        //pr($corporate_info);
        foreach($corporate_info as $corporate)
        {
            if($corporate['corporate_action']['action'] == 'cashdiv')
                {
                    $corporate_arr['cashdiv'] = $corporate;
                    $value = $corporate['corporate_action']['value'];
                    $actiondate = $corporate['corporate_action']['datestamp'];
                    $adjustmentFactor=$face_value*$value/100;
                    
                    $max52 = $this->Symbol->query('select MAX(high) as high52, daystamp as highDate from outputs WHERE symbol=\''.$symbolId.'\' AND (TO_DAYS(NOW()) - TO_DAYS(FROM_UNIXTIME(daystamp)) <=365) GROUP BY symbol');
                    if($max52[0]['outputs']['highDate']<$actiondate)
                    $this->set('max52', $max52[0][0]['high52']-$adjustmentFactor);
                    else 
                    $this->set('max52', $max52[0][0]['high52']);
                    
                    $min52 = $this->Symbol->query('select MIN(low) as low52, daystamp as lowDate from outputs  WHERE symbol=\''.$symbolId.'\' AND (TO_DAYS(NOW()) - TO_DAYS(FROM_UNIXTIME(daystamp)) <=365) GROUP BY symbol');
                    /*if($min52[0]['outputs']['lowDate']<$actiondate)
                    $this->set('min52', $min52[0][0]['low52']-$adjustmentFactor);
                    else */
                    $this->set('min52', $min52[0][0]['low52']);
                }
            if($corporate['corporate_action']['action'] == 'stockdiv')
            {
                $corporate_arr['stockdiv'] = $corporate;
                $value = $corporate['corporate_action']['value'];
                $actiondate = $corporate['corporate_action']['datestamp'];
                $adjustmentFactor=(100+$value)/100;
                
                $max52 = $this->Symbol->query('select MAX(high) as high52, daystamp as highDate from outputs WHERE symbol=\''.$symbolId.'\' AND (TO_DAYS(NOW()) - TO_DAYS(FROM_UNIXTIME(daystamp)) <=365) GROUP BY symbol');
                if($max52[0]['outputs']['highDate']<$actiondate)
                $this->set('max52', $max52[0][0]['high52']/$adjustmentFactor);
                else 
                $this->set('max52', $max52[0][0]['high52']);
                
                $min52 = $this->Symbol->query('select MIN(low) as low52, daystamp as lowDate from outputs  WHERE symbol=\''.$symbolId.'\' AND (TO_DAYS(NOW()) - TO_DAYS(FROM_UNIXTIME(daystamp)) <=365) GROUP BY symbol');
                /*if($min52[0]['outputs']['lowDate']<$actiondate)
                $this->set('min52', $min52[0][0]['low52']/$adjustmentFactor);
                else */
                $this->set('min52', $min52[0][0]['low52']);
            }
            if($corporate['corporate_action']['action'] == 'rightshare')
            {
                $corporate_arr['rightshare'] = $corporate;
                $value = $corporate['corporate_action']['value'];
                $premium = $corporate['corporate_action']['premium'];
                $actiondate = $corporate['corporate_action']['datestamp'];
                
                $adjustmentFactor1=(100+$value)/100;
                $adjustmentFactor=($premium+$face_value)-(($premium+$face_value)/$adjustmentFactor1);
                
                $max52 = $this->Symbol->query('select MAX(high) as high52, daystamp as highDate from outputs WHERE symbol=\''.$symbolId.'\' AND (TO_DAYS(NOW()) - TO_DAYS(FROM_UNIXTIME(daystamp)) <=365) GROUP BY symbol');
                if($max52[0]['outputs']['highDate']<$actiondate)
                $this->set('max52', ($max52[0][0]['high52']+$adjustmentFactor1)/$adjustmentFactor);
                else 
                $this->set('max52', $max52[0][0]['high52']);
                
                $min52 = $this->Symbol->query('select MIN(low) as low52, daystamp as lowDate from outputs  WHERE symbol=\''.$symbolId.'\' AND (TO_DAYS(NOW()) - TO_DAYS(FROM_UNIXTIME(daystamp)) <=365) GROUP BY symbol');
                /*if($min52[0]['outputs']['lowDate']<$actiondate)
                $this->set('min52', ($min52[0][0]['low52']+$adjustmentFactor1)/$adjustmentFactor);
                else */
                $this->set('min52', $min52[0][0]['low52']);
                
            }
            if($corporate['corporate_action']['action'] == 'split')
            {
                $corporate_arr['split'] = $corporate;
                $value = $corporate['corporate_action']['value'];
                $actiondate = $corporate['corporate_action']['datestamp'];
                $adjustmentFactor = $value;
                
                $max52 = $this->Symbol->query('select MAX(high) as high52, daystamp as highDate from outputs WHERE symbol=\''.$symbolId.'\' AND (TO_DAYS(NOW()) - TO_DAYS(FROM_UNIXTIME(daystamp)) <=365) GROUP BY symbol');
                if($max52[0]['outputs']['highDate']<$actiondate)
                $this->set('max52', ($max52[0][0]['high52']/$adjustmentFactor));
                else 
                $this->set('max52', $max52[0][0]['high52']);
                
                $min52 = $this->Symbol->query('select MIN(low) as low52, daystamp as lowDate from outputs  WHERE symbol=\''.$symbolId.'\' AND (TO_DAYS(NOW()) - TO_DAYS(FROM_UNIXTIME(daystamp)) <=365) GROUP BY symbol');
                /*if($min52[0]['outputs']['lowDate']<$actiondate)
                $this->set('min52', ($min52[0][0]['low52']/$adjustmentFactor));
                else */
                $this->set('min52', $min52[0][0]['low52']);
            }
        }
		
		$newsOfShare = $this->Symbol->query('SELECT id, code, details, UNIX_TIMESTAMP(str_to_date(postdate, \'%Y-%c-%d\')) as postdate, UNIX_TIMESTAMP(str_to_date(expiredate, \'%Y-%c-%d\')) as expiredate FROM news WHERE code = \''.$shareInfo['Symbol']['dse_code'].'\' ORDER BY postdate DESC LIMIT 0 , 3 ');
		$this->set('news_of_share', $newsOfShare);
		
		$financialPerformance = $this->Symbol->query('SELECT * FROM company_financial_performance as performance WHERE symbol_id='.$symbolId.' ORDER BY fin_year DESC');
        
        $this->set('financial_performance', $financialPerformance);		
	}
    
    function highchart_test($symbolstring ="") 
    {
       // Configure::write('debug',3);
        //$this->layout ='default-details2'; 
      $symbolpara=explode(',',$symbolstring)  ;
      $symbol_list = $this->FrontsideMenu->symbolList;  
      
      $chartparam="";
      $i=0;
      foreach($symbolpara as $symbol)
      {
          if(isset($symbol_list[$symbol]))
          {
          $code=$symbol_list[$symbol];
          if($i==0)
          {
             $chartparam.="'$code'"; 
          }
          else
          {
          $chartparam.=",'$code'"; 
          }
          
          
          $i++;
          }
      }
      
      /* echo $chartparam;
       print_r($symbolpara);
       die();
      */
        //$this->layout ='default-bodyonly';
        $this->layout =''; 
        
        $dataBank = $this->Symbol->query('SELECT name,open, high, low,FROM_UNIXTIME(daystamp) as days,date,close, volume,yvolume,tradevalues,ytradevalue,trade,ytrade FROM outputs WHERE symbol=\''.$symbolId.'\' ORDER BY id DESC LIMIT 0,5');
        
           $name=$dataBank[0]['outputs']['name'];
      $this->set("chartparam",$chartparam)  ;
           
    }
    function comparewith($symbolId = 11101,$submenu=0) 
    {
        //Configure::write('debug',3);  
        $this->layout ='default-bodyonly';
        $this->Symbol->id = $symbolId;
        $shareInfo = $this->Symbol->read();    
        
        //$symbol_list = $this->FrontsideMenu->symbolList;
        
        $sector=$shareInfo['Symbol']['business_segment'];
        
        //$sectorsymbol = $this->Symbol->query("SELECT id,dse_code FROM symbols WHERE business_segment like '$sector' ORDER BY dse_code ASC");
        $sectorsymbol = $this->Symbol->query("SELECT id,dse_code FROM symbols ORDER BY dse_code ASC");
         $sector_symbol_list=array();
        
           foreach ($sectorsymbol as $s)
           {
               $sector_symbol_list[$s['symbols']['id']]=$s['symbols']['dse_code'];
           }
        
       /*echo "<pre>";
        print_r($symbol_list);
        exit;*/
        $dataBank = $this->Symbol->query('SELECT open,name,high, low, close, volume FROM outputs WHERE symbol=\''.$symbolId.'\' ORDER BY id DESC LIMIT 1');
            $name=$dataBank[0]['outputs']['name'];
        $this->pageTitle = "$name-Company Comparison";
        $this->set("meta_description", "Compare trade history among companies listed in Dhaka Stock Exchange");
        $this->set("meta_keywords", "Share comparison,Dse,Fundamental,Company");

                
        $dataBank = $dataBank[0];
        $this->set('databank_info', $dataBank);
        
        
        $this->set("sector_symbol_list",$sector_symbol_list);
        $this->set("share_info",$shareInfo);
        
    }
    
    function make_jason($code="DSEGEN")
    {                                               
        $symbolInfo = $this->Symbol->query("SELECT id FROM symbols WHERE dse_code like '$code'");
        
         $symbolId= $symbolInfo[0]['symbols']['id'];
       $masterArr=array();  
       
        $dataBank = $this->Symbol->query("SELECT daystamp,UNIX_TIMESTAMP(str_to_date(date, '%d-%c-%Y')) as tdate,close FROM outputs WHERE symbol=$symbolId ORDER BY id DESC LIMIT 0,1000");
        //$dataBank = $this->Symbol->query("SELECT daystamp,UNIX_TIMESTAMP(str_to_date(date, '%d-%c-%Y')) as tdate,close FROM outputs WHERE symbol=$symbolId ORDER BY id DESC");
          $dataBankrev=array_reverse($dataBank,true);
        $dataarr=array();
           foreach ($dataBankrev as $day)
           {
               $temp=array();
               $temp[]=($day[0]['tdate']+24*60*60)*1000;
               $temp[]=$day['outputs']['close']*1;
               
            $dataarr[]=$temp;   
           }
           /*
           echo "SELECT daystamp,UNIX_TIMESTAMP(str_to_date(date, '%d-%c-%Y')) as tdate,close FROM outputs WHERE symbol=$symbolId ORDER BY id ASC LIMIT 0,500";
           echo "<pre>";
           print_r($dataBank);
//         */     asort($dataarr);

            $masterArr[]= $dataarr;
            $jsonresult = $this->__JEncode ( $dataarr );
            
            echo $jsonresult;
            die();
    }
    
    function details2($symbolId = 0,$submenu=0) 
    {
        //Configure::write('debug',3);
        $this->layout ='default-details2';        
        $this->_generateRedirectUrl('http://www.stockbangladesh.com/symbols/details2');
        $this->Symbol->id = $symbolId;
        $shareInfo = $this->Symbol->read();    
        $face_value = $shareInfo['Symbol']['face_value'];
        
        if($shareInfo['Symbol']['q1']){
            $shareInfo['Symbol']['eps_in_bd'] = $shareInfo['Symbol']['q1'];
            $shareInfo['Symbol']['quarter'] = "Q1";
            $shareInfo['Symbol']['annualized_eps'] = $shareInfo['Symbol']['eps_in_bd']*4;
        }
        if($shareInfo['Symbol']['q2']){
            $shareInfo['Symbol']['eps_in_bd'] = $shareInfo['Symbol']['q2'];
            $shareInfo['Symbol']['quarter'] = "Q2";
            $shareInfo['Symbol']['annualized_eps'] = $shareInfo['Symbol']['eps_in_bd']*2;
        }
        if($shareInfo['Symbol']['q3']){
            $shareInfo['Symbol']['eps_in_bd'] = $shareInfo['Symbol']['q3'];
            $shareInfo['Symbol']['quarter'] = "Q3";
            $shareInfo['Symbol']['annualized_eps'] = ($shareInfo['Symbol']['eps_in_bd']/3)*4;
        }
        if($shareInfo['Symbol']['q4']){
            $shareInfo['Symbol']['eps_in_bd'] = $shareInfo['Symbol']['q4'];  
            $shareInfo['Symbol']['quarter'] = "Q4";
            $shareInfo['Symbol']['annualized_eps'] = $shareInfo['Symbol']['eps_in_bd'];
        }
        $this->set('share_info', $shareInfo);        
        $this->set('symbol_id', $symbolId);
        
        // get Last trade price
        $this->DataBank->recursive = -1;
        //$dataBank = $this->Symbol->query('first', array('conditions' => array('DataBank.symbol_id' => $symbolId), 'order' => array('DataBank.id DESC'), 'limit' => 1    ));
        //$dataBank = $this->Symbol->query('SELECT * FROM data_banks_intraday WHERE symbol_id='.$symbolId.' ORDER BY id DESC LIMIT 1');
        
        $dataBank = $this->Symbol->query('SELECT name,open, high, low,FROM_UNIXTIME(daystamp) as days,date,close, volume,yvolume,tradevalues,ytradevalue,trade,ytrade FROM outputs WHERE symbol=\''.$symbolId.'\' ORDER BY id DESC LIMIT 0,5');
        
           $name=$dataBank[0]['outputs']['name'];
        $this->pageTitle = "$name-Company Details";
        $this->set("meta_description", "Trade and fundamental details of the company listed in Dhaka Stock Exchange");
        $this->set("meta_keywords", "Dse,Fundamental,Company");

        
        //$cat="['MSIE', 'Firefox', 'Chrome', 'Safari', 'Ooooopera']"; 
        $cat1stlevel="[";    
        $catdata="[";
        $data1st=array();
        $i=0;
        $totalvolume=0;
        foreach($dataBank as $day)
        {
            $lebel=$day['outputs']['date'];
            $volume=$day['outputs']['volume'];
            $totalvolume+=$volume;
            $closep=$day['outputs']['close'];
            $data1st[]=$closep;
            if($i==0)
            {
            $cat1stlevel.="'$lebel'";
            $catdata.="$closep";
            }
            else
            {
        
            $cat1stlevel.=",'$lebel'";
            $catdata.=",$closep";
            }
            
            
        //    $shareData = $this->Symbol->query ( 'select * from data_banks_intraday where symbol_id =' . $symbol . ' AND id > ' . $getLastIntradayId . ' ORDER BY id DESC' );
        //SELECT * FROM `data_banks_intraday` where currenttime>UNIX_TIMESTAMP('2012-03-20') and currenttime<UNIX_TIMESTAMP('2012-03-21') ORDER BY `id` DESC
        //SELECT FROM_UNIXTIME(date),FROM_UNIXTIME(currenttime),date_time FROM `data_banks_intraday` where currenttime>UNIX_TIMESTAMP('2012-03-20') and currenttime<UNIX_TIMESTAMP('2012-03-21') and symbol_id=11101
        //SELECT FROM_UNIXTIME(date),FROM_UNIXTIME(currenttime),date_time FROM `data_banks_intraday` where date>UNIX_TIMESTAMP('2012-03-20') and date<UNIX_TIMESTAMP('2012-03-21') and symbol_id=11101
            
            
            
            $i++;
        }
        $cat1stlevel.="]";
        $catdata.="]";
        $avgvolume=$totalvolume/$i;
      
      $drilllevel=array();
      $drilllevel[]=$cat1stlevel;
      $drilllevel[]=$cat1stlevel; 
      $drilldata=array();
      $drilldata[]=$data1st;
        /*  echo "<pre>";
                  print_r($drilllevel);
                  print_r($drilldata);
                  die();    
                  */
         $this->set('drilllevel', $drilllevel);       
         $this->set('drilldata', $drilldata);       
         
        $dataBank = $dataBank[0];
        $this->set('databank_info', $dataBank);
        $this->set('avgvolume', $avgvolume);
        
        
        
        
        //pr($shareInfo);
        $lastTradePrice = $shareInfo['Symbol']['lasttradeprice'];        
        $yClose         = $shareInfo['Symbol']['yclose'];
        
        if($yClose == 0) {
            $todayChange    = 0;
            $todayChangePer = 0;
        } else {
            $todayChange    = $lastTradePrice - $yClose;
            
            // change on single share
            $todayChangePer = ( $todayChange / $yClose ) * 100; 
        }
		//echo $todayChange."--";
        $this->set('todayChange', $todayChange);
        $this->set('todayChangePer', $todayChangePer);
                 
        $corporate_info = $this->Symbol->query('SELECT * FROM corporate_action WHERE symbol ='.$symbolId.' AND active=1 ORDER BY datestamp ASC');
        $corporate_arr = array();
        
              
        
         $oneyear = $this->Symbol->query('select close,high,low,daystamp,date from outputs WHERE symbol=\''.$symbolId.'\' AND (TO_DAYS(NOW()) - TO_DAYS(FROM_UNIXTIME(daystamp)) <=365)');
         $from=strtotime("2011-04-23"); 
          //$oneyear = $this->Symbol->query('select close,daystamp from outputs WHERE symbol=\''.$symbolId.'\' AND daystamp>'.$from);
          
$action="";
        foreach($corporate_info as $corporate)
        {
            $adjustedOneYear=array();
            if($corporate['corporate_action']['action'] == 'cashdiv')
                {
                    $corporate_arr['cashdiv'] = $corporate;
                    $value = $corporate['corporate_action']['value'];
                    $actiondate = $corporate['corporate_action']['datestamp'];
                    $adjustmentFactor=$face_value*$value/100;
                 
                    $crecord="";
                    
                    foreach($oneyear as $day)
                    {
                        $temp=array();
                        
                        $daystamp=$day['outputs']['daystamp'];
                        $adjclose=$day['outputs']['close'];
                        $adjhigh=$day['outputs']['high'];
                        $adjlow=$day['outputs']['low'];
                        
                        if($daystamp<$actiondate)
                        {
                        $adjclose=$day['outputs']['close']-$adjustmentFactor;
                        $adjhigh=$day['outputs']['high']-$adjustmentFactor;
                        $adjlow=$day['outputs']['low']-$adjustmentFactor;
                        $cdate=date("d-M-y",$actiondate);
                        $crecord="Cash ($cdate) ";
                        }
                        
                        
                        $temp['outputs']['close']= $adjclose;
                        $temp['outputs']['high']= $adjhigh;
                        $temp['outputs']['low']= $adjlow; 
                        $temp['outputs']['daystamp']= $daystamp;
                        
                        $adjustedOneYear[]=$temp;
                        
                    }
                    
                    $action.=$crecord;
                    $oneyear=$adjustedOneYear;
                   
                }
            if($corporate['corporate_action']['action'] == 'stockdiv')
            {
                $corporate_arr['stockdiv'] = $corporate;
                $value = $corporate['corporate_action']['value'];
                $actiondate = $corporate['corporate_action']['datestamp'];
                $adjustmentFactor=(100+$value)/100;
                
                
                 $crecord="";
                    
                    foreach($oneyear as $day)
                    {
                        $temp=array();
                        
                        $daystamp=$day['outputs']['daystamp'];
                        $adjclose=$day['outputs']['close'];
                        $adjhigh=$day['outputs']['high'];
                        $adjlow=$day['outputs']['low'];
                        
                        if($daystamp<$actiondate)
                        {
                        $adjclose=$day['outputs']['close']/$adjustmentFactor;
                        $adjhigh=$day['outputs']['high']/$adjustmentFactor;
                        $adjlow=$day['outputs']['low']/$adjustmentFactor;
                        
                        $cdate=date("d-M-y",$actiondate);
                        $crecord="Stock ($cdate) ";
                        }
                        
                        
                        $temp['outputs']['close']= $adjclose;
                        $temp['outputs']['high']= $adjhigh;
                        $temp['outputs']['low']= $adjlow; 
                        $temp['outputs']['daystamp']= $daystamp;
                        
                        $adjustedOneYear[]=$temp;
                        
                    }
                    
                    $action.=$crecord;
                    $oneyear=$adjustedOneYear;
                   
                
            }
            if($corporate['corporate_action']['action'] == 'rightshare')
            {
                $corporate_arr['rightshare'] = $corporate;
                $value = $corporate['corporate_action']['value'];
                $premium = $corporate['corporate_action']['premium'];
                $actiondate = $corporate['corporate_action']['datestamp'];
                
                $adjustmentFactor1=(100+$value)/100;
                $adjustmentFactor=($premium+$face_value)-(($premium+$face_value)/$adjustmentFactor1);
                
       
       
        $crecord="";
                    
                    foreach($oneyear as $day)
                    {
                        $temp=array();
                        
                        $daystamp=$day['outputs']['daystamp'];
                        $adjclose=$day['outputs']['close'];
                        $adjhigh=$day['outputs']['high'];
                        $adjlow=$day['outputs']['low'];
                        
                        if($daystamp<$actiondate)
                        {
                        $adjclose=($day['outputs']['close']+$adjustmentFactor1)/$adjustmentFactor;
                        $adjhigh=($day['outputs']['high']+$adjustmentFactor1)/$adjustmentFactor;
                        $adjlow=($day['outputs']['low']+$adjustmentFactor1)/$adjustmentFactor;
                        
                        
                        $cdate=date("d-M-y",$actiondate);
                        $crecord="Right ($cdate) ";
                        }
                        
                        
                        $temp['outputs']['close']= $adjclose;
                         $temp['outputs']['high']= $adjhigh;
                        $temp['outputs']['low']= $adjlow; 
                        $temp['outputs']['daystamp']= $daystamp;
                        
                        $adjustedOneYear[]=$temp;
                        
                    }
                    
                    $action.=$crecord;
                    $oneyear=$adjustedOneYear;
                   
       
                
            }
            if($corporate['corporate_action']['action'] == 'split')
            {
                $corporate_arr['split'] = $corporate;
                $value = $corporate['corporate_action']['value'];
                $actiondate = $corporate['corporate_action']['datestamp'];
                $adjustmentFactor = $value;
       
       
                 $crecord="";
                    
                    foreach($oneyear as $day)
                    {
                        $temp=array();
                        
                        $daystamp=$day['outputs']['daystamp'];
                        $adjclose=$day['outputs']['close'];
                        $adjhigh=$day['outputs']['high'];
                        $adjlow=$day['outputs']['low'];
                        
                        if($daystamp<$actiondate)
                        {
                        $adjclose=$day['outputs']['close']/$adjustmentFactor;
                        $adjhigh=$day['outputs']['high']/$adjustmentFactor;
                        $adjlow=$day['outputs']['low']/$adjustmentFactor;
                        $cdate=date("d-M-y",$actiondate);
                        $crecord="Split ($cdate) ";
                        }
                        
                        
                        $temp['outputs']['close']= $adjclose;
                        $temp['outputs']['high']= $adjhigh;
                        $temp['outputs']['low']= $adjlow; 
                        $temp['outputs']['daystamp']= $daystamp;
                        
                        $adjustedOneYear[]=$temp;
                        
                    }
                    
                    $action.=$crecord;
                    $oneyear=$adjustedOneYear;
       
       
            }
        }
        
        $adjustedOneYearHigh=array();
        $adjustedOneYearLow=array();
        $adjustedOneYear=array();
        foreach($oneyear as $day)
        {
            $daystamp=$day['outputs']['daystamp'];
            $adjclose=$day['outputs']['close'];
            $adjhigh=$day['outputs']['high'];
            $adjlow=$day['outputs']['low'];
            $adjustedOneYear[$daystamp]=$adjclose; 
            $adjustedOneYearHigh[$daystamp]=$adjhigh; 
            $adjustedOneYearLow[$daystamp]=$adjlow;
            
        }
        
      /*  echo "<pre>";
          print_r($adjustedOneYearHigh);
          print_r($adjustedOneYearLow);
          exit;  */
          
        asort($adjustedOneYearHigh);
        asort($adjustedOneYearLow); 
        $mx52=array();
       
        foreach($adjustedOneYearHigh as $day=>$price)
        {
            $mx52['close']=number_format($price,2,'.','');
            $mx52['date']=date("d-M-Y",$day);
            $mx52['daystamp']=$day;
            
            
        }
        $day=$mx52['daystamp'];
        $actualp = $this->Symbol->query("select close,daystamp from outputs WHERE symbol=$symbolId AND daystamp=$day");
        $mx52['actualp']=$actualp[0]['outputs']['close'];
        
        
        arsort($adjustedOneYearLow);
        
        $mn52=array();
        foreach($adjustedOneYearLow as $day=>$price)
        {
            $mn52['close']=number_format($price,2,'.','');
            $mn52['date']=date("d-M-Y",$day);
             $mn52['daystamp']=$day;
        }

         $day=$mn52['daystamp'];
        $actualp = $this->Symbol->query("select close,daystamp from outputs WHERE symbol=$symbolId AND daystamp=$day");
        $mn52['actualp']=$actualp[0]['outputs']['close'];
       
       /* echo "<pre>";
        print_r($mn52);
        print_r($actualp);
        echo "$action"; 
        die();
       */ 
        
        $this->set('mx52', $mx52);
        $this->set('mn52', $mn52);
        $this->set('action', $action);
        
        $newsOfShare = $this->Symbol->query('SELECT id, code, details, UNIX_TIMESTAMP(str_to_date(postdate, \'%Y-%c-%d\')) as postdate, UNIX_TIMESTAMP(str_to_date(expiredate, \'%Y-%c-%d\')) as expiredate FROM news WHERE code = \''.$shareInfo['Symbol']['dse_code'].'\' ORDER BY postdate DESC LIMIT 0 , 3 ');
        $this->set('news_of_share', $newsOfShare);
        
        $financialPerformance = $this->Symbol->query('SELECT * FROM company_financial_performance as performance WHERE symbol_id='.$symbolId.' ORDER BY fin_year DESC');
        
        $this->set('submenu', $submenu);  
        $this->set('symbol', $symbolId);  
         $dataSql = "SELECT date_time FROM data_banks_intraday WHERE symbol_id=$symbolId ORDER BY `id` DESC LIMIT 0 , 1";
        $dataInfo = $this->Symbol->query($dataSql);
       
       $sec=$shareInfo['Symbol']['business_segment'];
       $sector_details= $this->Symbol->query("SELECT *  FROM `newspaper_sector_pe` WHERE `sector` LIKE '$sec'"); 
       
       $this->set('sector_details', $sector_details[0]);
        $lastupdate=$dataInfo[0]["data_banks_intraday"]["date_time"];
        $this->set('lastupdate', $lastupdate);
              
        $this->set('financial_performance', $financialPerformance);        
        
        //Profit after tax chart -starts
        
        require_once(WWW_ROOT . DS . 'hchart'. DS .'Highchart.php');
        
        
         $companyFinPerf = "SELECT `code`,`fin_year`,`q1_net_prft_aft_tx_cont_op`,`half_year_net_prft_aft_tx_cont_op`,`q3_net_prft_aft_tx_cont_op`,`net_profit_cont_op` FROM `company_financial_performance` WHERE `symbol_id`=$symbolId";
                        $companyFinPerfResult = $this->Symbol->query($companyFinPerf);
                        
        $category=array();
       
       $seriesQ1=array();
       $seriesQ1['name']='Q1';
       $seriesQ2=array();
       $seriesQ2['name']='Q2';
       $seriesQ3=array();
       $seriesQ3['name']='Q3';
       $seriesQ4=array();
       $seriesQ4['name']='Q4';
        
       $dataQ1=array();         
       $dataQ2=array();
       $dataQ3=array();
       $dataQ4=array();
       $code="";
       foreach($companyFinPerfResult as $row)         
       {
           $code=trim($row['company_financial_performance']['code']);
           $q1_net_prft_aft_tx_cont_op=trim($row['company_financial_performance']['q1_net_prft_aft_tx_cont_op']);
           $q1_net_prft_aft_tx_cont_op=floatval(preg_replace("/[^-0-9\.]/","",$q1_net_prft_aft_tx_cont_op));
           
           $q2_net_prft_aft_tx_cont_op=trim($row['company_financial_performance']['half_year_net_prft_aft_tx_cont_op']);
           $q2_net_prft_aft_tx_cont_op=floatval(preg_replace("/[^-0-9\.]/","",$q2_net_prft_aft_tx_cont_op));
           
          
           $q3_net_prft_aft_tx_cont_op=trim($row['company_financial_performance']['q3_net_prft_aft_tx_cont_op']);
            $q3_net_prft_aft_tx_cont_op=floatval(preg_replace("/[^-0-9\.]/","",$q3_net_prft_aft_tx_cont_op));
            
           $q4_net_prft_aft_tx_cont_op=trim($row['company_financial_performance']['net_profit_cont_op']);
            $q4_net_prft_aft_tx_cont_op=floatval(preg_replace("/[^-0-9\.]/","",$q4_net_prft_aft_tx_cont_op));
           
           if(!empty($q1_net_prft_aft_tx_cont_op) && !empty($q2_net_prft_aft_tx_cont_op) && !empty($q3_net_prft_aft_tx_cont_op))
           {
              $category[] =$row['company_financial_performance']['fin_year'];
              $dataQ1[]=$q1_net_prft_aft_tx_cont_op-0; 
              $dataQ2[]=$q2_net_prft_aft_tx_cont_op-$q1_net_prft_aft_tx_cont_op;
              $dataQ3[]=$q3_net_prft_aft_tx_cont_op-$q2_net_prft_aft_tx_cont_op;
              $dataQ4[]=$q4_net_prft_aft_tx_cont_op-$q3_net_prft_aft_tx_cont_op;
              
           }
       }
       $seriesQ1['data']=$dataQ1;         
       $seriesQ2['data']=$dataQ2;
       $seriesQ3['data']=$dataQ3;
       $seriesQ4['data']=$dataQ4;
                
                
       $chart = new Highchart();
       $chart->chart->renderTo = "container";
       $chart->chart->borderWidth = 1;
       $chart->chart->borderColor = "#4572A7";
       $chart->chart->backgroundColor = "#FFFFFF";
       $chart->chart->spacingLeft = 2;
       $chart->chart->spacingRight = 2;
      
       
$chart->chart->type = "column";
$chart->title->text = "$code-Net Profit (After Tax)";
$chart->yAxis->title->text = "Net Profit After Tax";
$chart->credits->enabled = false;
$chart->xAxis->categories = $category;
 $chart->tooltip->formatter = new HighchartJsExpr("function() {
        return '' + this.series.name +': '+ this.y +'';}");
  
    $chart->series[] =$seriesQ1;
    $chart->series[] =$seriesQ2;
    $chart->series[] =$seriesQ3;
    $chart->series[] =$seriesQ4;
      
      
                $scriptadd="";
                             
                              foreach ($chart->getScripts() as $script) {
             $scriptadd.='<script type="text/javascript" src="' . $script . '"></script>';
          }
          
          $this->set("scriptadd",$scriptadd);
          $chartrender=$chart->render("chart1");
          $this->set("chartrender",$chartrender);          
          
          // Profit after tax -ends
        
       
        
        
    }
    
    
    
    
    
	
	function details_test($symbolId = 0,$submenu=0) 
    {
        Configure::write('debug',0);
        $this->layout ='default-details2';        
        
        $this->Symbol->id = $symbolId;
        $shareInfo = $this->Symbol->read();    
        $face_value = $shareInfo['Symbol']['face_value'];
        
        if($shareInfo['Symbol']['q1']){
            $shareInfo['Symbol']['eps_in_bd'] = $shareInfo['Symbol']['q1'];
            $shareInfo['Symbol']['quarter'] = "Q1";
            $shareInfo['Symbol']['annualized_eps'] = $shareInfo['Symbol']['eps_in_bd']*4;
        }
		
        if($shareInfo['Symbol']['q2']){
            $shareInfo['Symbol']['eps_in_bd'] = $shareInfo['Symbol']['q2'];
            $shareInfo['Symbol']['quarter'] = "Q2";
            $shareInfo['Symbol']['annualized_eps'] = $shareInfo['Symbol']['eps_in_bd']*2;
        }
		
        if($shareInfo['Symbol']['q3']){
            $shareInfo['Symbol']['eps_in_bd'] = $shareInfo['Symbol']['q3'];
            $shareInfo['Symbol']['quarter'] = "Q3";
            $shareInfo['Symbol']['annualized_eps'] = ($shareInfo['Symbol']['eps_in_bd']/3)*4;
        }
		
        if($shareInfo['Symbol']['q4']){
            $shareInfo['Symbol']['eps_in_bd'] = $shareInfo['Symbol']['q4'];  
            $shareInfo['Symbol']['quarter'] = "Q4";
            $shareInfo['Symbol']['annualized_eps'] = $shareInfo['Symbol']['eps_in_bd'];
        }
		
        $this->set('share_info', $shareInfo);
        $this->set('symbol_id', $symbolId);
        
        // get Last trade price
        $this->DataBank->recursive = -1;
        $dataBank = $this->Symbol->query('SELECT name,open, high, low,FROM_UNIXTIME(daystamp) as days,date,close, volume,yvolume,tradevalues,ytradevalue,trade,ytrade FROM outputs WHERE symbol=\''.$symbolId.'\' ORDER BY id DESC LIMIT 0,5');
        
        $name=$dataBank[0]['outputs']['name'];
        $this->pageTitle = "$name-Company Details";
        $this->set("meta_description", "Trade and fundamental details of the company listed in Dhaka Stock Exchange");
        $this->set("meta_keywords", "Dse,Fundamental,Company");

        
        //$cat="['MSIE', 'Firefox', 'Chrome', 'Safari', 'Ooooopera']"; 
        $cat1stlevel="[";    
        $catdata="[";
        $data1st=array();
        $i=0;
        $totalvolume=0;
        foreach($dataBank as $day)
        {
            $lebel=$day['outputs']['date'];
            $volume=$day['outputs']['volume'];
            $totalvolume+=$volume;
            $closep=$day['outputs']['close'];
            $data1st[]=$closep;
            if($i==0)
            {
            $cat1stlevel.="'$lebel'";
            $catdata.="$closep";
            }
            else
            {
        
            $cat1stlevel.=",'$lebel'";
            $catdata.=",$closep";
            }
           
            $i++;
        }
        $cat1stlevel.="]";
        $catdata.="]";
        $avgvolume=$totalvolume/$i;
      
      $drilllevel=array();
      $drilllevel[]=$cat1stlevel;
      $drilllevel[]=$cat1stlevel; 
      $drilldata=array();
      $drilldata[]=$data1st;

         $this->set('drilllevel', $drilllevel);       
         $this->set('drilldata', $drilldata);       
         
        $dataBank = $dataBank[0];
        $this->set('databank_info', $dataBank);
        $this->set('avgvolume', $avgvolume);
        
        //pr($shareInfo);
        $lastTradePrice = $shareInfo['Symbol']['lasttradeprice'];        
        $yClose         = $shareInfo['Symbol']['yclose'];
        
        if($yClose == 0) {
            $todayChange    = 0;
            $todayChangePer = 0;
        } else {
            $todayChange    = $lastTradePrice - $yClose;
            
            // change on single share
            $todayChangePer = ( $todayChange / $yClose ) * 100; 
        }
		//echo $todayChange."--";
        $this->set('todayChange', $todayChange);
        $this->set('todayChangePer', $todayChangePer);
                 
        $corporate_info = $this->Symbol->query('SELECT * FROM corporate_action WHERE symbol ='.$symbolId.' AND active=1 ORDER BY datestamp ASC');
        $corporate_arr = array();
        
         $oneyear = $this->Symbol->query('select close,high,low,daystamp,date from outputs WHERE symbol=\''.$symbolId.'\' AND (TO_DAYS(NOW()) - TO_DAYS(FROM_UNIXTIME(daystamp)) <=365)');
         $from=strtotime("2011-04-23"); 
          //$oneyear = $this->Symbol->query('select close,daystamp from outputs WHERE symbol=\''.$symbolId.'\' AND daystamp>'.$from);
          
$action="";
        foreach($corporate_info as $corporate)
        {
            $adjustedOneYear=array();
            if($corporate['corporate_action']['action'] == 'cashdiv')
                {
                    $corporate_arr['cashdiv'] = $corporate;
                    $value = $corporate['corporate_action']['value'];
                    $actiondate = $corporate['corporate_action']['datestamp'];
                    $adjustmentFactor=$face_value*$value/100;
                 
                    $crecord="";
                    
                    foreach($oneyear as $day)
                    {
                        $temp=array();
                        
                        $daystamp=$day['outputs']['daystamp'];
                        $adjclose=$day['outputs']['close'];
                        $adjhigh=$day['outputs']['high'];
                        $adjlow=$day['outputs']['low'];
                        
                        if($daystamp<$actiondate)
                        {
                        $adjclose=$day['outputs']['close']-$adjustmentFactor;
                        $adjhigh=$day['outputs']['high']-$adjustmentFactor;
                        $adjlow=$day['outputs']['low']-$adjustmentFactor;
                        $cdate=date("d-M-y",$actiondate);
                        $crecord="Cash ($cdate) ";
                        }
                        
                        
                        $temp['outputs']['close']= $adjclose;
                        $temp['outputs']['high']= $adjhigh;
                        $temp['outputs']['low']= $adjlow; 
                        $temp['outputs']['daystamp']= $daystamp;
                        
                        $adjustedOneYear[]=$temp;
                        
                    }
                    
                    $action.=$crecord;
                    $oneyear=$adjustedOneYear;
                   
                }
            if($corporate['corporate_action']['action'] == 'stockdiv')
            {
                $corporate_arr['stockdiv'] = $corporate;
                $value = $corporate['corporate_action']['value'];
                $actiondate = $corporate['corporate_action']['datestamp'];
                $adjustmentFactor=(100+$value)/100;
                
                
                 $crecord="";
                    
                    foreach($oneyear as $day)
                    {
                        $temp=array();
                        
                        $daystamp=$day['outputs']['daystamp'];
                        $adjclose=$day['outputs']['close'];
                        $adjhigh=$day['outputs']['high'];
                        $adjlow=$day['outputs']['low'];
                        
                        if($daystamp<$actiondate)
                        {
                        $adjclose=$day['outputs']['close']/$adjustmentFactor;
                        $adjhigh=$day['outputs']['high']/$adjustmentFactor;
                        $adjlow=$day['outputs']['low']/$adjustmentFactor;
                        
                        $cdate=date("d-M-y",$actiondate);
                        $crecord="Stock ($cdate) ";
                        }
                        
                        
                        $temp['outputs']['close']= $adjclose;
                        $temp['outputs']['high']= $adjhigh;
                        $temp['outputs']['low']= $adjlow; 
                        $temp['outputs']['daystamp']= $daystamp;
                        
                        $adjustedOneYear[]=$temp;
                        
                    }
                    
                    $action.=$crecord;
                    $oneyear=$adjustedOneYear;
                   
                
            }
            if($corporate['corporate_action']['action'] == 'rightshare')
            {
                $corporate_arr['rightshare'] = $corporate;
                $value = $corporate['corporate_action']['value'];
                $premium = $corporate['corporate_action']['premium'];
                $actiondate = $corporate['corporate_action']['datestamp'];
                
                $adjustmentFactor1=(100+$value)/100;
                $adjustmentFactor=($premium+$face_value)-(($premium+$face_value)/$adjustmentFactor1);
                
        $crecord="";
                    
                    foreach($oneyear as $day)
                    {
                        $temp=array();
                        
                        $daystamp=$day['outputs']['daystamp'];
                        $adjclose=$day['outputs']['close'];
                        $adjhigh=$day['outputs']['high'];
                        $adjlow=$day['outputs']['low'];
                        
                        if($daystamp<$actiondate)
                        {
                        $adjclose=($day['outputs']['close']+$adjustmentFactor1)/$adjustmentFactor;
                        $adjhigh=($day['outputs']['high']+$adjustmentFactor1)/$adjustmentFactor;
                        $adjlow=($day['outputs']['low']+$adjustmentFactor1)/$adjustmentFactor;
                        
                        
                        $cdate=date("d-M-y",$actiondate);
                        $crecord="Right ($cdate) ";
                        }
                        
                        
                        $temp['outputs']['close']= $adjclose;
                         $temp['outputs']['high']= $adjhigh;
                        $temp['outputs']['low']= $adjlow; 
                        $temp['outputs']['daystamp']= $daystamp;
                        
                        $adjustedOneYear[]=$temp;
                        
                    }
                    
                    $action.=$crecord;
                    $oneyear=$adjustedOneYear;                
            }
            if($corporate['corporate_action']['action'] == 'split')
            {
                $corporate_arr['split'] = $corporate;
                $value = $corporate['corporate_action']['value'];
                $actiondate = $corporate['corporate_action']['datestamp'];
                $adjustmentFactor = $value;       
       
                 $crecord="";
                    
                    foreach($oneyear as $day)
                    {
                        $temp=array();
                        
                        $daystamp=$day['outputs']['daystamp'];
                        $adjclose=$day['outputs']['close'];
                        $adjhigh=$day['outputs']['high'];
                        $adjlow=$day['outputs']['low'];
                        
                        if($daystamp<$actiondate)
                        {
                        $adjclose=$day['outputs']['close']/$adjustmentFactor;
                        $adjhigh=$day['outputs']['high']/$adjustmentFactor;
                        $adjlow=$day['outputs']['low']/$adjustmentFactor;
                        $cdate=date("d-M-y",$actiondate);
                        $crecord="Split ($cdate) ";
                        }                       
                        
                        $temp['outputs']['close']= $adjclose;
                        $temp['outputs']['high']= $adjhigh;
                        $temp['outputs']['low']= $adjlow; 
                        $temp['outputs']['daystamp']= $daystamp;
                        
                        $adjustedOneYear[]=$temp;                        
                    }
                    
                    $action.=$crecord;
                    $oneyear=$adjustedOneYear;					
            }
        }
        
        $adjustedOneYearHigh=array();
        $adjustedOneYearLow=array();
        $adjustedOneYear=array();
        foreach($oneyear as $day)
        {
            $daystamp=$day['outputs']['daystamp'];
            $adjclose=$day['outputs']['close'];
            $adjhigh=$day['outputs']['high'];
            $adjlow=$day['outputs']['low'];
            $adjustedOneYear[$daystamp]=$adjclose; 
            $adjustedOneYearHigh[$daystamp]=$adjhigh; 
            $adjustedOneYearLow[$daystamp]=$adjlow;            
        }
          
        asort($adjustedOneYearHigh);
        asort($adjustedOneYearLow); 
        $mx52=array();
       
        foreach($adjustedOneYearHigh as $day=>$price)
        {
            $mx52['close']=number_format($price,2,'.','');
            $mx52['date']=date("d-M-Y",$day);
            $mx52['daystamp']=$day;      
        }
        $day=$mx52['daystamp'];
        $actualp = $this->Symbol->query("select close,daystamp from outputs WHERE symbol=$symbolId AND daystamp=$day");
        $mx52['actualp']=$actualp[0]['outputs']['close'];
        
        
        arsort($adjustedOneYearLow);
        
        $mn52=array();
        foreach($adjustedOneYearLow as $day=>$price)
        {
            $mn52['close']=number_format($price,2,'.','');
            $mn52['date']=date("d-M-Y",$day);
             $mn52['daystamp']=$day;
        }

         $day=$mn52['daystamp'];
        $actualp = $this->Symbol->query("select close,daystamp from outputs WHERE symbol=$symbolId AND daystamp=$day");
        $mn52['actualp']=$actualp[0]['outputs']['close'];

        $this->set('mx52', $mx52);
        $this->set('mn52', $mn52);
        $this->set('action', $action);
        
        $newsOfShare = $this->Symbol->query('SELECT id, code, details, UNIX_TIMESTAMP(str_to_date(postdate, \'%Y-%c-%d\')) as postdate, UNIX_TIMESTAMP(str_to_date(expiredate, \'%Y-%c-%d\')) as expiredate FROM news WHERE code = \''.$shareInfo['Symbol']['dse_code'].'\' ORDER BY postdate DESC LIMIT 0 , 3 ');
        $this->set('news_of_share', $newsOfShare);
        
        $financialPerformance = $this->Symbol->query('SELECT * FROM company_financial_performance as performance WHERE symbol_id='.$symbolId.' ORDER BY fin_year DESC');
        
        $this->set('submenu', $submenu);  
        $this->set('symbol', $symbolId);  
         $dataSql = "SELECT date_time FROM data_banks_intraday WHERE symbol_id=$symbolId ORDER BY `id` DESC LIMIT 0 , 1";
        $dataInfo = $this->Symbol->query($dataSql);
       
       $sec=$shareInfo['Symbol']['business_segment'];
       $sector_details= $this->Symbol->query("SELECT *  FROM `newspaper_sector_pe` WHERE `sector` LIKE '$sec'"); 
       
       $this->set('sector_details', $sector_details[0]);
        $lastupdate=$dataInfo[0]["data_banks_intraday"]["date_time"];
        $this->set('lastupdate', $lastupdate);
              
        $this->set('financial_performance', $financialPerformance);        
    } //end of detailsTest
	
	
	
    function webresearch($code = "DSEGEN",$submenu=0) 
    {
       //Configure::write('debug',3);
        $this->layout ='default_amibroker'; 
       $code=trim($code);
        $sql="select id from symbols where dse_code like '$code'";
        $dataInfo = $this->Symbol->query($sql);
        
        
        $symbolId=$dataInfo[0]['symbols']['id'];
        
    
        $this->Symbol->id = $symbolId;
        $shareInfo = $this->Symbol->read();    
        $face_value = $shareInfo['Symbol']['face_value'];
        
        if($shareInfo['Symbol']['q1']){
            $shareInfo['Symbol']['eps_in_bd'] = $shareInfo['Symbol']['q1'];
            $shareInfo['Symbol']['quarter'] = "Q1";
            $shareInfo['Symbol']['annualized_eps'] = $shareInfo['Symbol']['eps_in_bd']*4;
        }
        if($shareInfo['Symbol']['q2']){
            $shareInfo['Symbol']['eps_in_bd'] = $shareInfo['Symbol']['q2'];
            $shareInfo['Symbol']['quarter'] = "Q2";
            $shareInfo['Symbol']['annualized_eps'] = $shareInfo['Symbol']['eps_in_bd']*2;
        }
        if($shareInfo['Symbol']['q3']){
            $shareInfo['Symbol']['eps_in_bd'] = $shareInfo['Symbol']['q3'];
            $shareInfo['Symbol']['quarter'] = "Q3";
            $shareInfo['Symbol']['annualized_eps'] = ($shareInfo['Symbol']['eps_in_bd']/3)*4;
        }
        if($shareInfo['Symbol']['q4']){
            $shareInfo['Symbol']['eps_in_bd'] = $shareInfo['Symbol']['q4'];  
            $shareInfo['Symbol']['quarter'] = "Q4";
            $shareInfo['Symbol']['annualized_eps'] = $shareInfo['Symbol']['eps_in_bd'];
        }
        $this->set('share_info', $shareInfo);
        
        $this->set('symbol_id', $symbolId);
        
        // get Last trade price
        $this->DataBank->recursive = -1;
        //$dataBank = $this->Symbol->query('first', array('conditions' => array('DataBank.symbol_id' => $symbolId), 'order' => array('DataBank.id DESC'), 'limit' => 1    ));
        //$dataBank = $this->Symbol->query('SELECT * FROM data_banks_intraday WHERE symbol_id='.$symbolId.' ORDER BY id DESC LIMIT 1');
        
        $dataBank = $this->Symbol->query('SELECT name,open, high, low,FROM_UNIXTIME(daystamp) as days,date,close, volume,yvolume,tradevalues,ytradevalue,trade,ytrade FROM outputs WHERE symbol=\''.$symbolId.'\' ORDER BY id DESC LIMIT 0,5');
        
           $name=$dataBank[0]['outputs']['name'];
        $this->pageTitle = "$name-Company Details";
        $this->set("meta_description", "Trade and fundamental details of the company listed in Dhaka Stock Exchange");
        $this->set("meta_keywords", "Dse,Fundamental,Company");

        
        //$cat="['MSIE', 'Firefox', 'Chrome', 'Safari', 'Ooooopera']"; 
        $cat1stlevel="[";    
        $catdata="[";
        $data1st=array();
        $i=0;
        $totalvolume=0;
        foreach($dataBank as $day)
        {
            $lebel=$day['outputs']['date'];
            $volume=$day['outputs']['volume'];
            $totalvolume+=$volume;
            $closep=$day['outputs']['close'];
            $data1st[]=$closep;
            if($i==0)
            {
            $cat1stlevel.="'$lebel'";
            $catdata.="$closep";
            }
            else
            {
        
            $cat1stlevel.=",'$lebel'";
            $catdata.=",$closep";
            }
            
            
        //    $shareData = $this->Symbol->query ( 'select * from data_banks_intraday where symbol_id =' . $symbol . ' AND id > ' . $getLastIntradayId . ' ORDER BY id DESC' );
        //SELECT * FROM `data_banks_intraday` where currenttime>UNIX_TIMESTAMP('2012-03-20') and currenttime<UNIX_TIMESTAMP('2012-03-21') ORDER BY `id` DESC
        //SELECT FROM_UNIXTIME(date),FROM_UNIXTIME(currenttime),date_time FROM `data_banks_intraday` where currenttime>UNIX_TIMESTAMP('2012-03-20') and currenttime<UNIX_TIMESTAMP('2012-03-21') and symbol_id=11101
        //SELECT FROM_UNIXTIME(date),FROM_UNIXTIME(currenttime),date_time FROM `data_banks_intraday` where date>UNIX_TIMESTAMP('2012-03-20') and date<UNIX_TIMESTAMP('2012-03-21') and symbol_id=11101
            
            
            
            $i++;
        }
        $cat1stlevel.="]";
        $catdata.="]";
        $avgvolume=$totalvolume/$i;
      
      $drilllevel=array();
      $drilllevel[]=$cat1stlevel;
      $drilllevel[]=$cat1stlevel; 
      $drilldata=array();
      $drilldata[]=$data1st;
        /*  echo "<pre>";
                  print_r($drilllevel);
                  print_r($drilldata);
                  die();    
                  */
         $this->set('drilllevel', $drilllevel);       
         $this->set('drilldata', $drilldata);       
         
        $dataBank = $dataBank[0];
        $this->set('databank_info', $dataBank);
        $this->set('avgvolume', $avgvolume);
        
        
        
        
                 
        $lastTradePrice = $shareInfo['Symbol']['lasttradeprice'];        
        $yClose         = $shareInfo['Symbol']['yclose'];
        
        if($yClose == 0) {
            $todayChange    = 0;
            $todayChangePer = 0;
        } else {
            $todayChange    = $lastTradePrice - $yClose;
            
            // change on single share
            $todayChangePer = ( $todayChange / $yClose ) * 100; 
        }
        $this->set('todayChange', $todayChange);
        $this->set('todayChangePer', $todayChangePer);
                 
        $corporate_info = $this->Symbol->query('SELECT * FROM corporate_action WHERE symbol ='.$symbolId.' AND active=1 ORDER BY datestamp ASC');
        $corporate_arr = array();
        
              
        
         $oneyear = $this->Symbol->query('select close,high,low,daystamp,date from outputs WHERE symbol=\''.$symbolId.'\' AND (TO_DAYS(NOW()) - TO_DAYS(FROM_UNIXTIME(daystamp)) <=365)');
         $from=strtotime("2011-04-23"); 
          //$oneyear = $this->Symbol->query('select close,daystamp from outputs WHERE symbol=\''.$symbolId.'\' AND daystamp>'.$from);
          
$action="";
        foreach($corporate_info as $corporate)
        {
            $adjustedOneYear=array();
            if($corporate['corporate_action']['action'] == 'cashdiv')
                {
                    $corporate_arr['cashdiv'] = $corporate;
                    $value = $corporate['corporate_action']['value'];
                    $actiondate = $corporate['corporate_action']['datestamp'];
                    $adjustmentFactor=$face_value*$value/100;
                 
                    $crecord="";
                    
                    foreach($oneyear as $day)
                    {
                        $temp=array();
                        
                        $daystamp=$day['outputs']['daystamp'];
                        $adjclose=$day['outputs']['close'];
                        $adjhigh=$day['outputs']['high'];
                        $adjlow=$day['outputs']['low'];
                        
                        if($daystamp<$actiondate)
                        {
                        $adjclose=$day['outputs']['close']-$adjustmentFactor;
                        $adjhigh=$day['outputs']['high']-$adjustmentFactor;
                        $adjlow=$day['outputs']['low']-$adjustmentFactor;
                        $cdate=date("d-M-y",$actiondate);
                        $crecord="Cash ($cdate) ";
                        }
                        
                        
                        $temp['outputs']['close']= $adjclose;
                        $temp['outputs']['high']= $adjhigh;
                        $temp['outputs']['low']= $adjlow; 
                        $temp['outputs']['daystamp']= $daystamp;
                        
                        $adjustedOneYear[]=$temp;
                        
                    }
                    
                    $action.=$crecord;
                    $oneyear=$adjustedOneYear;
                   
                }
            if($corporate['corporate_action']['action'] == 'stockdiv')
            {
                $corporate_arr['stockdiv'] = $corporate;
                $value = $corporate['corporate_action']['value'];
                $actiondate = $corporate['corporate_action']['datestamp'];
                $adjustmentFactor=(100+$value)/100;
                
                
                 $crecord="";
                    
                    foreach($oneyear as $day)
                    {
                        $temp=array();
                        
                        $daystamp=$day['outputs']['daystamp'];
                        $adjclose=$day['outputs']['close'];
                        $adjhigh=$day['outputs']['high'];
                        $adjlow=$day['outputs']['low'];
                        
                        if($daystamp<$actiondate)
                        {
                        $adjclose=$day['outputs']['close']/$adjustmentFactor;
                        $adjhigh=$day['outputs']['high']/$adjustmentFactor;
                        $adjlow=$day['outputs']['low']/$adjustmentFactor;
                        
                        $cdate=date("d-M-y",$actiondate);
                        $crecord="Stock ($cdate) ";
                        }
                        
                        
                        $temp['outputs']['close']= $adjclose;
                        $temp['outputs']['high']= $adjhigh;
                        $temp['outputs']['low']= $adjlow; 
                        $temp['outputs']['daystamp']= $daystamp;
                        
                        $adjustedOneYear[]=$temp;
                        
                    }
                    
                    $action.=$crecord;
                    $oneyear=$adjustedOneYear;
                   
                
            }
            if($corporate['corporate_action']['action'] == 'rightshare')
            {
                $corporate_arr['rightshare'] = $corporate;
                $value = $corporate['corporate_action']['value'];
                $premium = $corporate['corporate_action']['premium'];
                $actiondate = $corporate['corporate_action']['datestamp'];
                
                $adjustmentFactor1=(100+$value)/100;
                $adjustmentFactor=($premium+$face_value)-(($premium+$face_value)/$adjustmentFactor1);
                
       
       
        $crecord="";
                    
                    foreach($oneyear as $day)
                    {
                        $temp=array();
                        
                        $daystamp=$day['outputs']['daystamp'];
                        $adjclose=$day['outputs']['close'];
                        $adjhigh=$day['outputs']['high'];
                        $adjlow=$day['outputs']['low'];
                        
                        if($daystamp<$actiondate)
                        {
                        $adjclose=($day['outputs']['close']+$adjustmentFactor1)/$adjustmentFactor;
                        $adjhigh=($day['outputs']['high']+$adjustmentFactor1)/$adjustmentFactor;
                        $adjlow=($day['outputs']['low']+$adjustmentFactor1)/$adjustmentFactor;
                        
                        
                        $cdate=date("d-M-y",$actiondate);
                        $crecord="Right ($cdate) ";
                        }
                        
                        
                        $temp['outputs']['close']= $adjclose;
                         $temp['outputs']['high']= $adjhigh;
                        $temp['outputs']['low']= $adjlow; 
                        $temp['outputs']['daystamp']= $daystamp;
                        
                        $adjustedOneYear[]=$temp;
                        
                    }
                    
                    $action.=$crecord;
                    $oneyear=$adjustedOneYear;
                   
       
                
            }
            if($corporate['corporate_action']['action'] == 'split')
            {
                $corporate_arr['split'] = $corporate;
                $value = $corporate['corporate_action']['value'];
                $actiondate = $corporate['corporate_action']['datestamp'];
                $adjustmentFactor = $value;
       
       
                 $crecord="";
                    
                    foreach($oneyear as $day)
                    {
                        $temp=array();
                        
                        $daystamp=$day['outputs']['daystamp'];
                        $adjclose=$day['outputs']['close'];
                        $adjhigh=$day['outputs']['high'];
                        $adjlow=$day['outputs']['low'];
                        
                        if($daystamp<$actiondate)
                        {
                        $adjclose=$day['outputs']['close']/$adjustmentFactor;
                        $adjhigh=$day['outputs']['high']/$adjustmentFactor;
                        $adjlow=$day['outputs']['low']/$adjustmentFactor;
                        $cdate=date("d-M-y",$actiondate);
                        $crecord="Split ($cdate) ";
                        }
                        
                        
                        $temp['outputs']['close']= $adjclose;
                        $temp['outputs']['high']= $adjhigh;
                        $temp['outputs']['low']= $adjlow; 
                        $temp['outputs']['daystamp']= $daystamp;
                        
                        $adjustedOneYear[]=$temp;
                        
                    }
                    
                    $action.=$crecord;
                    $oneyear=$adjustedOneYear;
       
       
            }
        }
        
        $adjustedOneYearHigh=array();
        $adjustedOneYearLow=array();
        $adjustedOneYear=array();
        foreach($oneyear as $day)
        {
            $daystamp=$day['outputs']['daystamp'];
            $adjclose=$day['outputs']['close'];
            $adjhigh=$day['outputs']['high'];
            $adjlow=$day['outputs']['low'];
            $adjustedOneYear[$daystamp]=$adjclose; 
            $adjustedOneYearHigh[$daystamp]=$adjhigh; 
            $adjustedOneYearLow[$daystamp]=$adjlow;
            
        }
        
      /*  echo "<pre>";
          print_r($adjustedOneYearHigh);
          print_r($adjustedOneYearLow);
          exit;  */
          
        asort($adjustedOneYearHigh);
        asort($adjustedOneYearLow); 
        $mx52=array();
       
        foreach($adjustedOneYearHigh as $day=>$price)
        {
            $mx52['close']=number_format($price,2,'.','');
            $mx52['date']=date("d-M-Y",$day);
            $mx52['daystamp']=$day;
            
            
        }
        $day=$mx52['daystamp'];
        $actualp = $this->Symbol->query("select close,daystamp from outputs WHERE symbol=$symbolId AND daystamp=$day");
        $mx52['actualp']=$actualp[0]['outputs']['close'];
        
        
        arsort($adjustedOneYearLow);
        
        $mn52=array();
        foreach($adjustedOneYearLow as $day=>$price)
        {
            $mn52['close']=number_format($price,2,'.','');
            $mn52['date']=date("d-M-Y",$day);
             $mn52['daystamp']=$day;
        }

         $day=$mn52['daystamp'];
        $actualp = $this->Symbol->query("select close,daystamp from outputs WHERE symbol=$symbolId AND daystamp=$day");
        $mn52['actualp']=$actualp[0]['outputs']['close'];
       
       /* echo "<pre>";
        print_r($mn52);
        print_r($actualp);
        echo "$action"; 
        die();
       */ 
        
        $this->set('mx52', $mx52);
        $this->set('mn52', $mn52);
        $this->set('action', $action);
        
        $newsOfShare = $this->Symbol->query('SELECT id, code, details, UNIX_TIMESTAMP(str_to_date(postdate, \'%Y-%c-%d\')) as postdate, UNIX_TIMESTAMP(str_to_date(expiredate, \'%Y-%c-%d\')) as expiredate FROM news WHERE code = \''.$shareInfo['Symbol']['dse_code'].'\' ORDER BY postdate DESC LIMIT 0 , 3 ');
        $this->set('news_of_share', $newsOfShare);
        
        $financialPerformance = $this->Symbol->query('SELECT * FROM company_financial_performance as performance WHERE symbol_id='.$symbolId.' ORDER BY fin_year DESC');
        
        $this->set('submenu', $submenu);  
        $this->set('symbol', $symbolId);  
         $dataSql = "SELECT date_time FROM data_banks_intraday WHERE symbol_id=$symbolId ORDER BY `id` DESC LIMIT 0 , 1";
        $dataInfo = $this->Symbol->query($dataSql);
       
       $sec=$shareInfo['Symbol']['business_segment'];
       $sector_details= $this->Symbol->query("SELECT *  FROM `newspaper_sector_pe` WHERE `sector` LIKE '$sec'"); 
       
       $this->set('sector_details', $sector_details[0]);
        $lastupdate=$dataInfo[0]["data_banks_intraday"]["date_time"];
        $this->set('lastupdate', $lastupdate);
              
        $this->set('financial_performance', $financialPerformance);        
    }
   
    function detailsnext($symbolId = 0){
        $this->details2($symbolId);
        $this->layout =''; 
    }
    
    function details1($symbolId = 0) 
    {
        $this->layout ='default-two'; 
        
        $this->Symbol->id = $symbolId;
        $shareInfo = $this->Symbol->read();        
        
        if(!empty($shareInfo)){
            $newsOfShare = $this->Symbol->query('SELECT id, code, details, UNIX_TIMESTAMP(str_to_date(postdate, \'%Y-%c-%d\')) as postdate, UNIX_TIMESTAMP(str_to_date(expiredate, \'%Y-%c-%d\')) as expiredate,postdate AS postdateM FROM news WHERE code = \''.$shareInfo['Symbol']['dse_code'].'\' ORDER BY postdate DESC LIMIT 0 , 25 ');
            $this->set('news_of_share', $newsOfShare);                
            $this->set('share_info', $shareInfo);
        }
        
    }
    
    function detailsnext1($symbolId = 0){
        $this->details1($symbolId);
        $this->layout =''; 
    }
	
	function interactivechart($symbolId = 0,$adjusted = 'a'){
        $this->details1($symbolId);
        $this->layout =''; 
		$this->set("adjusted", $adjusted);
    }
	
	function ichart($symbolId = 0){
       $this->pageTitle = 'Stock Bangladesh :: Stock Market Chart';  
	$this->details1($symbolId);
        $this->layout ='layout_chart_main'; 
    }
    /*
    *   To set simple chart
    */ 	
    function simplechart($symbolId =0)
    {
        require_once(WWW_ROOT . DS . 'chart'. DS .'phpchartdir.php');
        require_once(WWW_ROOT . DS . 'chart'. DS .'Image_Toolbox.class.php');
        
        $noOfPoints = 200;
        
        $rantable = new RanTable(9, 1, 85);
        $rantable->setCol(0, 1800, -5, 5);

        $querySQL  = ' SELECT id, close, UNIX_TIMESTAMP(str_to_date(date, \'%d-%c-%Y\')) as date FROM outputs WHERE symbol='.$symbolId;
        $querySQL .= ' ORDER BY id DESC LIMIT 0 , '.$noOfPoints;
        
        $companyData = $this->Symbol->query($querySQL);
        $companyData = array_reverse($companyData);
        
        $ticker = $symbol_id;
        $querystr="SELECT * FROM `corporate_action` WHERE `symbol` =$symbolId and `active`=1 ORDER BY `datestamp` ASC";                                     
        $corporateAction = $this->Symbol->query($querystr);
        
        foreach($corporateAction as $row)
        {
                 if($row['corporate_action']['action']=='stockdiv')
                    {
                        $adjustmentFactor=(100+$row['corporate_action']['value'])/100;

                        $day=$row['corporate_action']['date'];
                        //$daystamp= strtotime($day)-24*60*60;
                        $daystamp=$row['corporate_action']['datestamp'];
                        $adjustedArr = '';
                        foreach ($companyData as $arr)
                        {
                            if($arr[0]['date']<$daystamp)
                            {                                
                                $arr['outputs']['close']=($arr['outputs']['close']/$adjustmentFactor);
                            }

                            $adjustedArr[]=$arr;
                        }

                        $companyArr=array();
                        $companyArr=$adjustedArr;

                    }
                 elseif($row['corporate_action']['action']=='cashdiv')
                    {

                        $symbolSQL = "SELECT face_value FROM symbols WHERE id=$symbolId";
                        $result = $this->Symbol->query($symbolSQL);
                        $facevalue  = $result[0]['symbols']['face_value'];

                        $adjustmentFactor=$facevalue*$row['corporate_action']['value']/100;
                        $day=$row['corporate_action']['date'];
                        //$daystamp= strtotime($day)-24*60*60;
                        $daystamp=$row['corporate_action']['datestamp'];
                        $adjustedArr = '';
                        foreach ($companyData as $arr)
                        {
                            if($arr[0]['date']<$daystamp)
                            {                                
                                $arr['outputs']['close']=($arr['outputs']['close']-$adjustmentFactor);
                            }

                            $adjustedArr[]=$arr;
                        }

                        $companyArr=array();
                        $companyArr=$adjustedArr;

                    }
                 elseif($row['corporate_action']['action']=='rightshare')
                    {

                        $symbolSQL = "SELECT face_value FROM symbols WHERE id=$symbolId";
                        $result = $this->Symbol->query($symbolSQL);
                        $facevalue  = $result[0]['symbols']['face_value'];
                        
                        $adjustmentFactor1=(100+$value)/100;
                        $adjustmentFactor=($premium+$facevalue)-(($premium+$facevalue)/$adjustmentFactor1);
                        
                        $daystamp=$row['corporate_action']['datestamp'];
                        //$daystamp= strtotime($day)-24*60*60;
                        //$daystamp= strtotime($day);
                        $adjustedArr = '';
                        foreach ($companyData as $arr)
                        {
                            if($arr[0]['date']<$daystamp)
                            {                                
                                $arr['outputs']['close']=($arr['outputs']['close']+$adjustmentFactor1)/$adjustmentFactor;
                            }

                            $adjustedArr[]=$arr;
                        }

                        $companyArr=array();
                        $companyArr=$adjustedArr;

                    }


                 elseif ($row['corporate_action']['action']=='split')
                    {
                        $adjustmentFactor=$row['corporate_action']['value'];

                        $day=$row['corporate_action']['date'];
                        //$daystamp= strtotime($day)-24*60*60;
                        $daystamp=$row['corporate_action']['datestamp'];
                        $adjustedArr = '';
                        foreach ($companyData as $arr)
                        {
                            if($arr[0]['date']<$daystamp)
                            {
                                $arr['outputs']['close']=$arr['outputs']['close']/$adjustmentFactor;
                            }

                            $adjustedArr[]=$arr;
                        }
                        $companyArr=array();
                        $companyArr=$adjustedArr;
                    }
          }
        
        $getGraphData = array();
        $getLabelData = array();
        
        foreach ($companyArr as $key => $gData)
        {
            $getGraphData[] = $gData['outputs']['close'];
            $getLabelData[] = date("M", $gData[0]['date']);    
        }

        $labels = array();
        $labels[0] = $getLabelData[0];
        for ($i=1; $i < count($getLabelData); $i++)
        {
            $prevmonth = $getLabelData[$i-1];
            $month     = $getLabelData[$i];
            if(strcmp($prevmonth,$month) == 0)
            {
                //$labels[$i]="-";
            }
            else 
            {
                $labels[]=$month;
            }
        }

        $c = new XYChart(420, 290, 0xf1f1f1);
        $c->setPlotArea(41, 41, 320, 200,0xffffff, -1, -1, 0xcccccc, 0xcccccc);
        
        $timesbiPath = WWW_ROOT . 'font'. DS . 'timesbi.ttf';
        
        $textBoxObj = $c->addText(275, 51, "www.stockbangladesh.com", $timesbiPath, 16, 0xc09090, '', 40);
        $textBoxObj->setAlignment(TopRight);

        $c->yAxis->setLabelStyle("", 7.5);

        $c->xAxis->setLinearScale(0, $noOfPoints - 1, $labels);

        $c->xAxis->setLabelStyle("", 7.5);
        $c->setYAxisOnRight();

        $c->addLineLayer($getGraphData, 0x000080);
        $chartData= $c->makeChart2(PNG);
        print($chartData);
        /*
        $chartImagePath = WWW_ROOT . 'chart'. DS . 'simplechart.png';
        
        $f = fopen($chartImagePath, 'wb');
        fwrite($f, $chartData);
        fclose($f);
        
        $img = new Image_Toolbox($chartImagePath);

        $width=$img->_img['main']['width'];

        $img->addImage($width,20,'#F1F1F1');
        //$img->blend('left','bottom',IMAGE_TOOLBOX_BLEND_COPY);
        $img->blendMask('left','bottom',IMAGE_TOOLBOX_BLEND_COPY, 0, 270);
        $img->output();  
        */
        exit();      
    }
    
     function pricescale($symbolId =0)
    {
        require_once(WWW_ROOT . DS . 'chart'. DS .'phpchartdir.php');
        require_once(WWW_ROOT . DS . 'chart'. DS .'Image_Toolbox.class.php');
        $timesbiPath = WWW_ROOT . 'font'. DS . 'arialbd.ttf'; 
       //  $textBoxObj = $c->addText(275, 51, "www.stockbangladesh.com", $timesbiPath, 16, 0xc09090, '', 40);
       
       
$noOfPoints = 1;
        
      
        $querySQL  = ' SELECT id, close,high,low,code,ycp,UNIX_TIMESTAMP(str_to_date(date, \'%d-%c-%Y\')) as date FROM outputs WHERE symbol='.$symbolId;
        $querySQL .= ' ORDER BY id DESC LIMIT 0 , '.$noOfPoints;       
        $companyData = $this->Symbol->query($querySQL);
        $close=$companyData[0]['outputs']['close'];
        $ycp=$companyData[0]['outputs']['ycp'];
         $high=$companyData[0]['outputs']['high'];
         $low=$companyData[0]['outputs']['low'];
         $code=$companyData[0]['outputs']['code'];
         $scal=($high-$low)/3;
         //$scal=number_format($scal,2,'.','');
        // $scal=round($scal,0);
  //$value = 75.35;  
# Create an LinearMeter object of size 250 x 75 pixels, using silver background with
# a 2 pixel black 3D depressed border.
$m = new LinearMeter(250, 75, 0xe0e0e0, 0, 0);

# Set the scale region top-left corner at (15, 25), with size of 200 x 50 pixels. The
# scale labels are located on the top (implies horizontal meter)
$m->setMeter(15, 25, 220, 20, Top);

# Set meter scale from 0 - 100, with a tick every 10 units
$m->setScale($low, $high, $scal);

# Set 0 - 50 as green (99ff99) zone, 50 - 80 as yellow (ffff66) zone, and 80 - 100 as
# red (ffcccc) zone
   $colorgap=($high-$low)/3;
 
 
$m->addZone($low, $low+$colorgap, 0xEDDE15);
$m->addZone($low+$colorgap, $low+$colorgap+$colorgap, 0xF7BD00);
$m->addZone($low+$colorgap+$colorgap, $high, 0xF79000);

# Add a blue (0000cc) pointer at the specified value
$m->addPointer($close, 0x0000cc);

# Add a label at bottom-left (10, 68) using Arial Bold/8 pts/red (c00000)
$m->addText(10, 68, "$code", $timesbiPath, 8, 0xc00000, BottomLeft);

# Add a text box to show the value formatted to 2 decimal places at bottom right. Use
# white text on black background with a 1 pixel depressed 3D border.
$textBoxObj = $m->addText(238, 70, $m->formatValue($close, "2"), $timesbiPath, 8,
    0xffffff, BottomRight);
$textBoxObj->setBackground(0, 0, -1);

# Output the chart
header("Content-type: image/png");
print($m->makeChart2(PNG));
        exit();
    }
    
     function pricescalegenerator($high,$low,$close,$code)
    {
        require_once(WWW_ROOT . DS . 'chart'. DS .'phpchartdir.php');
        require_once(WWW_ROOT . DS . 'chart'. DS .'Image_Toolbox.class.php');
        $timesbiPath = WWW_ROOT . 'font'. DS . 'arialbd.ttf'; 
       //  $textBoxObj = $c->addText(275, 51, "www.stockbangladesh.com", $timesbiPath, 16, 0xc09090, '', 40);
       
       
        /*$close=$companyData[0]['outputs']['close'];
        $ycp=$companyData[0]['outputs']['ycp'];
         $high=$companyData[0]['outputs']['high'];
         $low=$companyData[0]['outputs']['low'];
         $code=$companyData[0]['outputs']['code'];
        */ 
        
        $scal=($high-$low)/3;
        // $scal=round($scal,0);
  //$value = 75.35;  
# Create an LinearMeter object of size 250 x 75 pixels, using silver background with
# a 2 pixel black 3D depressed border.
$m = new LinearMeter(250, 75, 0xe0e0e0, 0, 0);

# Set the scale region top-left corner at (15, 25), with size of 200 x 50 pixels. The
# scale labels are located on the top (implies horizontal meter)
$m->setMeter(15, 25, 220, 20, Top);

# Set meter scale from 0 - 100, with a tick every 10 units
$m->setScale($low, $high, $scal);

# Set 0 - 50 as green (99ff99) zone, 50 - 80 as yellow (ffff66) zone, and 80 - 100 as
# red (ffcccc) zone
   $colorgap=($high-$low)/3;
 
 
$m->addZone($low, $low+$colorgap, 0xEDDE15);
$m->addZone($low+$colorgap, $low+$colorgap+$colorgap, 0xF7BD00);
$m->addZone($low+$colorgap+$colorgap, $high, 0xF79000);

# Add a blue (0000cc) pointer at the specified value
$m->addPointer($close, 0x0000cc);

# Add a label at bottom-left (10, 68) using Arial Bold/8 pts/red (c00000)
$m->addText(10, 68, "$code", $timesbiPath, 8, 0xc00000, BottomLeft);

# Add a text box to show the value formatted to 2 decimal places at bottom right. Use
# white text on black background with a 1 pixel depressed 3D border.
$textBoxObj = $m->addText(238, 70, $m->formatValue($close, "2"), $timesbiPath, 8,
    0xffffff, BottomRight);
$textBoxObj->setBackground(0, 0, -1);

# Output the chart
header("Content-type: image/png");
print($m->makeChart2(PNG));
        exit();
    }
    
    
    function epschart($symbolId =0)
    {
        /* App::import('Vendor', 'Phpchartdir', array('file' => 'phpchartdir.php'));  */
        require_once(WWW_ROOT . DS . 'chart'. DS .'phpchartdir.php');
        require_once(WWW_ROOT . DS . 'chart'. DS .'Image_Toolbox.class.php');
        
        
        $shareInfo = $this->Symbol->find('first', array('conditions' => array('id='.$symbolId)));        
        $code      = $shareInfo['Symbol']['dse_code'];
        $name      = $shareInfo['Symbol']['name'];       
        $fundamentalData = $this->Symbol->query('select * from company_financial_performance where symbol_id='.$symbolId.' order by fin_year');

        $xdata = array();
        $ydata = array();
        $vdata = array();

        foreach ($fundamentalData as $key=>$row)
        {
            $eps_cont_op = $row['company_financial_performance']['earning_per_share'];
            $eps_cont_op=str_replace("&gt;", "ee", $eps_cont_op);
            $eps_cont_op=trim($eps_cont_op);
            $eps_cont_op=floatval($eps_cont_op);
            
            $pe=$row['company_financial_performance']['price_earning_ratio'];
            $pe=str_replace("&gt;", " ", $pe);
            $pe=trim($pe);

            if($eps_cont_op!='n/a' && $eps_cont_op!=0)
            {
                $vdata[] = $eps_cont_op + 0;
                $ydata[] = $row['company_financial_performance']['fin_year'] + 0;
                $xdata[] = $pe + 0;
            }
        }
        
        $data0 = $xdata;
        $data1 = $vdata;
        $labels = $ydata;
        
        $c = new XYChart(320, 300, 0xf1f1f1);
        $c->setPlotArea(50, 50, 220, 180,0xffffff, -1, -1, 0xcccccc, 0xcccccc);
        $textBoxObj = $c->addText(245, 21, "www.stockbangladesh.com", "timesbi.ttf", 11, 0xc09090);
        $textBoxObj->setAlignment(TopRight);
        
        $arialbdPath = WWW_ROOT . 'font'. DS . 'arialbd.ttf';
        $c->addTitle("$code EPS-P/E", $arialbdPath, 8,0x008000);
        $c->xAxis->setLabels($labels);
        $c->xAxis->setLabelStyle("Arial", 8, TextColor, 90);
        $c->yAxis->setTitle("P/E");
        $c->yAxis->setColors(0x008000, 0x008000, 0x008000);
        $c->yAxis2->setTitle("EPS");
        $c->yAxis2->setColors(0x008000, 0x008000, 0x008000);
        $layer = $c->addLineLayer();
        $dataSetObj = $layer->addDataSet($data0, 0xcf4040, "Price");
        $dataSetObj->setDataSymbol(SquareSymbol, 5);
        $barLayerObj = $c->addBarLayer3($data1);
        $barLayerObj->setBarShape(CircleShape);
        $barLayerObj->setUseYAxis2();
        
        $timesbiPath = WWW_ROOT . 'font'. DS . 'timesbi.ttf';
        $barLayerObj->setAggregateLabelStyle("timesbi.ttf", 10, 0x663300,90);   
        
        $chartData = $c->makeChart2(PNG);
        print($chartData);
        /*
        $chartImagePath = WWW_ROOT . 'chart'. DS . 'epschart.png';
        $f = fopen($chartImagePath, "wb");
        fwrite($f, $chartData);
        fclose($f);
        $img = new Image_Toolbox($chartImagePath);
        $width=$img->_img['main']['width'];
        $img->addImage($width,20,'#F1F1F1');
        $img->blendMask('left','bottom',IMAGE_TOOLBOX_BLEND_COPY, 0, 290);
        $img->output();
        */
        exit();
    }
    /*
    *   To set dse chart
    */     
    function dsechart($chartType = 'dsi')
    {   
        //ob_start();
        require_once(WWW_ROOT . DS . 'chart'. DS .'phpchartdir.php');
        require_once(WWW_ROOT . DS . 'chart'. DS .'Image_Toolbox.class.php');
        
        $getLastIndex = $this->Symbol->query("select value from configuration WHERE `configuration`.`name` like 'index_last_id'");        
        $getLastIndex = $getLastIndex[0]['configuration']['value'];
                     
        $querySQL  = ' SELECT id, IDX_DATE_TIME, IDX_CAPITAL_VALUE, IDX_GROSS_VALUE, IDX_INDEX_ID, IDX_DEVIATION FROM `index` WHERE `id` > \''.$getLastIndex.'\' ';
        $graphData = $this->Symbol->query($querySQL);
        
        $dArr    = array();
        
        $dsiArr    = array();
        $dsiLabel  = array();
        $ds20Arr   = array();
        $ds20Label = array();
        $dgenArr   = array();
        $dgenLabel = array();
        
        foreach ($graphData as $data)
        {
            $datetime   = $data['index']['IDX_DATE_TIME'];
            $datetime   = strtotime($datetime);
            $grossValue = $data['index']['IDX_CAPITAL_VALUE'];
            $indexId    = trim($data['index']['IDX_INDEX_ID']);
                        
            if($data['index']['IDX_DEVIATION'])
            {
               if($indexId=='DSEX')
                {
                    $dsiArr[]    = $grossValue;
                    $ctime       = date('H:i',$datetime) ;
                    $dsiLabel[]  = $ctime;
                }
                if($indexId=='DS30')
                {
                    $ds20Arr[]   = $grossValue;
                    $ctime       = date('H:i',$datetime) ;
                    $ds20Label[] =$ctime;
                }
                if($indexId=='DGEN')
                {
                    $dgenArr[]   = $grossValue;
                    $ctime       = date('H:i',$datetime) ;
                    $dgenLabel[] = $ctime;
                }
            }
        }
                
        $labels = $dsiLabel;
        
        $setTitle = '';
        $setColour = '0x80ff0000';
        $setImage = '';
        
        if(!empty($graphData) && $chartType !='' ){
            switch($chartType){
                case 'DSEX':  
                           $dArr = $dsiArr;             
                           $setTitle  = 'DSEX';
                           $setImage  = 'dsi.png';
                           $setColour = 0x80ff0000;
                           break; 
                case 'ds30':       
                           $dArr = $ds20Arr;                    
                           $setTitle  = 'DS30';
                           $setImage  = 'dse20.png';
                           $setColour = 0x808080ff;
                           break; 
                case 'dgen':
                           $dArr = $dgenArr;
                           $setTitle  = 'Dse General';
                           $setImage  = 'dgen.png';
                           $setColour = 0x8000ff00;
                           break;                       
            }
        }
                
        $c = new XYChart(350, 130, 0xF6F6F6);

        $c->setPlotArea(40, 10, 300, 90,-1, -1, 0xcccccc, 0xcccccc);

        //$legendObj = $c->addLegend(55, 0, false, "", 8);
        //$legendObj->setBackground(Transparent);

        //$c->xAxis->setTitle("Time");
        
        //$c->yAxis->setTitle($setTitle);
        $c->xAxis->setLabels($labels);

        $c->xAxis->setLabelStep(6, 1);

        $c->xAxis->setLabelStyle("Arial",7, 0x000000,90);
        $c->yAxis->setLabelStyle("Arial",7, 0x000000,0);
        $c->addAreaLayer($dArr, $setColour);
        
        $chartData = $c->makeChart2(PNG);
        print($chartData);
        /*
        $chartImagePath = WWW_ROOT . 'chart'. DS . $setImage;
        
        $f = fopen($chartImagePath, "wb");
        fwrite($f, $chartData);
        fclose($f);
        $img = new Image_Toolbox($chartImagePath);
        
        $width = $img->_img['main']['width'];

        $img->addImage($width, 20, '#FFFFFF');
        $img->blendMask('left', 'bottom', IMAGE_TOOLBOX_BLEND_COPY, 0, 240);
        $img->output(); 
        */
        exit();
    }   
    
    /*
    *   To view company news for respective $symbol Index
    */
	function news($symbolId = 0) 
    {
        $this->layout ='default-one';
        $this->pageTitle = 'Stock Bangladesh :: Company News - '.$symbolId; 
        
        $shareInfo = $this->Symbol->find('first', array('conditions' => array('Symbol.dse_code' => $symbolId), 'fields' => array('Symbol.id','Symbol.dse_code', 'Symbol.name', 'Symbol.category', 'Symbol.business_segment')));
		$this->set("share_info", $shareInfo);
		
		$newsOfShare = $this->DataBank->query("SELECT id, code, details, UNIX_TIMESTAMP(str_to_date(postdate, '%Y-%c-%d')) as postdate,UNIX_TIMESTAMP(str_to_date(expiredate, '%Y-%c-%d')) as expiredate,postdate AS postdateM FROM news WHERE code = '".$shareInfo['Symbol']['dse_code']."' ORDER BY postdate DESC ");
		$this->set("news_of_share", $newsOfShare);
	} 
    function webresearch_news($symbolId = 0) 
    {
        $this->layout ='default_amibroker';
        $this->pageTitle = 'Stock Bangladesh :: Company News - '.$symbolId; 
        
        $shareInfo = $this->Symbol->find('first', array('conditions' => array('Symbol.dse_code' => $symbolId), 'fields' => array('Symbol.id','Symbol.dse_code', 'Symbol.name', 'Symbol.category', 'Symbol.business_segment')));
        $this->set("share_info", $shareInfo);
        
        $newsOfShare = $this->DataBank->query("SELECT id, code, details, UNIX_TIMESTAMP(str_to_date(postdate, '%Y-%c-%d')) as postdate,UNIX_TIMESTAMP(str_to_date(expiredate, '%Y-%c-%d')) as expiredate,postdate AS postdateM FROM news WHERE code = '".$shareInfo['Symbol']['dse_code']."' ORDER BY postdate DESC ");
        $this->set("news_of_share", $newsOfShare);
    } 
    
    
    /*
    *   To view ranked share for volume
    */   
    function rankedshare($filter = 'volume')
    {        
        $this->layout='';
                
        $nameOfTheDay = date('l');
        if($nameOfTheDay == 'Friday')
            $todayIs = mktime(0, 0, 0, date('m'), date('d')-1, date('Y')); 
        else if($nameOfTheDay == 'Saturday')
            $todayIs = mktime(0, 0, 0, date('m'), date('d')-2, date('Y'));            
        else
            $todayIs = mktime(0, 0, 0, date('m'), date('d'), date('Y')); 
                
        
        if($filter=='volume')
        {        
            $shareList = $this->Symbol->query('SELECT code FROM data_banks_intraday WHERE symbol_id >1000 AND currenttime <='.$todayIs.' GROUP BY code ORDER BY MAX(volume) DESC LIMIT 0, 10');
                                           
                                                
            if(count($shareList) > 0){
                
                foreach($shareList as $share)
                {                    
                    $shareInfo = $this->Symbol->query("SELECT id, lastprice, volume, symbol_id FROM data_banks_intraday WHERE code='".$share['data_banks_intraday']['code']."' AND currenttime <=$todayIs ORDER BY volume DESC limit 0, 1");
                    
                    if(!empty($shareInfo))
                    {                        
                        echo"<ul class='boxBg1'>";
                        echo "<li><a href='".$this->webroot."symbols/details/".$shareInfo[0]['data_banks_intraday']['symbol_id']."'><p style='border: 1px solid red; width: 120px !important;'>" . $share['data_banks_intraday']['code'] . '</p>&nbsp;&nbsp;<span class="red">Volume: </span>' .$shareInfo[0]['data_banks_intraday']['volume'] . "</a></li>";
                        echo"</ul>";
                    }                                        
                }                 
                
            }            
            die;
        }
                        
        if($filter=='trade')
        {
            $shareList = $this->Symbol->query('SELECT code FROM data_banks_intraday WHERE symbol_id >1000 AND currenttime >='.$todayIs.' GROUP BY code ORDER BY MAX(trade) DESC LIMIT 0,10');
                                                
            if(count($shareList) > 0){
                
                foreach($shareList as $share)
                {                    
                    $shareInfo = $this->Symbol->query("SELECT id, lastprice, trade, symbol_id FROM data_banks_intraday WHERE code='".$share['data_banks_intraday']['code']."' AND currenttime >=$todayIs ORDER BY trade DESC limit 1");
                    
                    if(!empty($shareInfo))
                    {                        
                        echo"<ul class='boxBg1'>";
                        echo "<li><a href='".$this->webroot."symbols/details/".$shareInfo[0]['data_banks_intraday']['symbol_id']."'>" . $share['data_banks_intraday']['code'] . '&nbsp;&nbsp;<span class="red">Trade: </span>' .$shareInfo[0]['data_banks_intraday']['trade'] . "</a></li>";
                        echo"</ul>";
                    }                                        
                }                 
                
            } 
            die;           
        }
        
        if($filter=='increase')
        /*{
            //$totalChangePer         = (($sortedResult[$symbol]['data_banks_intraday']['lastprice'] - $sortedResult[$symbol]['data_banks_intraday']['yclose']) / $sortedResult[$symbol]['data_banks_intraday']['yclose']) * 100;
            
            $shareList = $this->Symbol->query("select id, code, lastprice, yclose, symbol_id, value from data_banks_intraday where symbol_id >1000 AND currenttime <=$todayIs order by id DESC limit 0, 350");
            
            $tempshareList = array();
            if(count($shareList) > 0){
                
                $count = 0;
                $tempCode   = $shareList[0]['data_banks_intraday']['code'];                
                $tempChange = (($shareList[0]['data_banks_intraday']['lastprice'] - $shareList[0]['data_banks_intraday']['yclose'])/($shareList[0]['data_banks_intraday']['yclose']*100));
                $tempChange = number_format($tempChange, 2, '.', '');
                
                $shareList[0]['data_banks_intraday']['value'] = $tempChange;
                
                $tempshareList[$count] = $shareList[0]['data_banks_intraday'];                    
                
                foreach($shareList as $share)
                {
                    //$changeIs = ((lastprice-yclose)/(yclose*100))
                    $changeIs = (($share['data_banks_intraday']['lastprice'] - $share['data_banks_intraday']['yclose'])/$share['data_banks_intraday']['yclose'])*100;                                        
                    $changeIs = number_format($changeIs, 2, '.', '');
                    
                    $share['data_banks_intraday']['value'] = $changeIs;
                    
                    if($tempCode == $share['data_banks_intraday']['code'] && $changeIs > $tempChange){
                        $tempChange = $changeIs;                        
                        $share['data_banks_intraday']['value'] = $tempChange;                        
                        $tempshareList[$count] = $share['data_banks_intraday'];                                
                    }
                    else if($tempCode != $share['data_banks_intraday']['code']){
                        $count++;  
                        $tempshareList[$count] = $share['data_banks_intraday'];                                
                    }                    
                }                
                
                
                $secondTempshareList = array();
                $count = 0;
                $secondTempVal = $tempshareList[0]['value'];
                $secondTempshareList[$count] = $tempshareList[0];                
                $findTotal = 1;
                while($findTotal < 6)
                {
                    foreach($tempshareList as $share)
                    {
                        if($secondTempVal <= $share['value'])
                        {
                            $seondTempshareList[$count] =         
                        }
                        
                    }    
                }
                
                
            
                pr($tempshareList);
                die('now here');
                
                foreach($shareList as $share)
                {                                        
                    $shareInfo = $this->Symbol->query("SELECT id, lastprice, volume, symbol_id FROM data_banks_intraday WHERE code='".$share['data_banks_intraday']['code']."' ORDER BY id DESC limit 1");
                    
                    if(!empty($shareInfo))
                    {                        
                        echo"<ul class='boxBg1'>";
                        echo "<li><a href='".$this->webroot."symbols/details/".$shareInfo[0]['data_banks_intraday']['symbol_id']."'>" . $share['data_banks_intraday']['code'] . '&nbsp;&nbsp;<span class="red">VOL:</span>'.$shareInfo[0]['data_banks_intraday']['volume'] .'&nbsp;&nbsp;<span class="red">LTP:</span>' .$shareInfo[0]['data_banks_intraday']['lastprice'] . "</a></li>";
                        echo"</ul>";
                    }                                        
                }
            }            
        }*/
        // THIS IS A MARKER TO SPLIT THE MAIN RESPONSE
        die('-#-'); 
    }
    
    /*
    *   To view top ten gainer/loser
    */
    function lossandgain($filterType = 'gain')
    {
        $this->layout='';
        
        if($filterType == 'gain')
           $orderBy = ' id DESC '; 
        else if($filterType == 'loss')
           $orderBy = ' id ASC ';
        
        $shareStatusList = $this->Symbol->find('all', array('conditions' => ' Symbol.id > 1000 ', 'fields' => array('id', 'dse_code', 'category','lasttradeprice', ), 'order'=> $orderBy, 'limit' => 5));
                  
        foreach ($shareStatusList as $shareStatus) {
            echo '<ul class=\'boxBg1\'>';
            echo '<li><a href=\''. $this->webroot . 'symbols/details/' . $shareStatus['Symbol']['id'] . '\' >' . $shareStatus['Symbol']['dse_code'] .'&nbsp;&nbsp;<span class="red">CAT:</span>'.$shareStatus['Symbol']['category'] .'</span>&nbsp;&nbsp;<span class="red">LTP:</span>'.$shareStatus['Symbol']['lasttradeprice'].'</span></a></li>';
            echo '</ul>';                     
        }                                     
        $this->set('share_status_list', $shareStatusList);
        
        // THIS IS A MARKER TO SPLIT THE MAIN RESPONSE
        die('-#-');
    }
    
    /*
    *   To view general chart
    */
    function viewchart()
    {

         // Configure::write('debug',2);
        //error_reporting(E_ALL);
        $this->layout ='default-bodyonlychart';

        $this->pageTitle = 'Stock Bangladesh :: View Chart';
        $this->Session->write('Auth.gobackpage', 'symbols/viewchart');
        $this->set('myTimeRange',$_REQUEST['TimeRange']);

        # create the finance chart
        $this->timeStamps = null;
        $this->volData    = null;
        $this->highData   = null;
        $this->lowData    = null;
        $this->openData   = null;
        $this->closeData  = null;
        $this->timeadjust = 1970 * 365 * 24 * 60 * 60 + 112 * 24 * 60 * 60;





        # create the finance chart  
        $width = 700;
        $mainHeight = 250;
        $indicatorHeight = 85;
        //pr($_REQUEST);
        //die;
        /*
                $chartSize = $_REQUEST["ChartSize"];
                if ($chartSize == "S") {
                    # Small chart size
                    $width = 450;
                    $mainHeight = 160;
                    $indicatorHeight = 60;
                } else if ($chartSize == "M") {
                    # Medium chart size
                    $width = 620;
                    $mainHeight = 210;
                    $indicatorHeight = 65;
                } else if ($chartSize == "H") {
                    # Huge chart size
                    $width = 1000;
                    $mainHeight = 320;
                    $indicatorHeight = 90;
                }
                */







        $m = $this->__drawChart($_REQUEST);

        //print_r("Allah help me");


        $chart1URL = $m->makeSession("chart1");
        $this->set('chart1URL', $chart1URL);
        $imageMap = $m->getHTMLImageMap("", "", "title='".$m->getToolTipDateFormat()." {value|G}'");
        $this->set('imageMap', $imageMap);



     //   header("Content-type: image/png");
   //     print($m->makeChart2(PNG));

        //exit();

        $ticker    = $_REQUEST['TickerSymbol'];
        if(is_numeric($ticker))
            $shareInfo = $this->Symbol->find('id='.$ticker);
        else{
            $shareInfo['Symbol']['name']     = $ticker;
            $shareInfo['Symbol']['dse_code'] = $ticker;
        }

        $name      = $shareInfo['Symbol']['name'];
        $name      = ucwords(strtolower($name));

        $_SESSION['title'] = "$name - price chart / graph";
        $this->pageTitle = "$name - price chart / graph";
        $parameter = $_SERVER['REQUEST_URI'];

        $code      = $shareInfo['Symbol']['dse_code'];
        $this->set('code', $code);

        $querystr="SELECT * FROM `corporate_action` WHERE `symbol` =$ticker and `active`=1 ORDER BY `datestamp` ASC";
        $corporateAction = $this->Symbol->query($querystr);

        //pr($corporateAction);    
        if(isset($corporateAction[0]['corporate_action']['id'])) {
            $adjustedChart = 1;
        }else {
            $adjustedChart = 0;
        }
        /* Get Symbol List */
        $symbolList = $this->Symbol->find('all', array('conditions' => array(' Symbol.dse_code != \'\' ','Symbol.inactive=\'No\'','Symbol.otc_market=\'No\'', 'Symbol.id > 1'), 'fields' => array('Symbol.id', 'Symbol.dse_code'), 'order' => ' Symbol.dse_code ASC '));

        $prevSymbol = '';
        $nextSymbol = '';
        foreach($symbolList as $key => $eachcompany)
        {

            if($eachcompany['Symbol']['id'] == $ticker)
            {
                $prevSymbol = $key - 1;
                if(isset($symbolList[$prevSymbol]))
                {
                    $prevName   = $symbolList[$prevSymbol]['Symbol']['dse_code'];
                    $prevSymbol = $symbolList[$prevSymbol]['Symbol']['id'];
                }


                $nextSymbol = $key + 1;
                if(isset($symbolList[$nextSymbol])){
                    $nextName   = $symbolList[$nextSymbol]['Symbol']['dse_code'];
                    $nextSymbol = $symbolList[$nextSymbol]['Symbol']['id'];
                }
            }
        }

        if(isset($prevSymbol) && $prevSymbol !='' && isset($prevName))
        {
            $prevparameter=str_replace($ticker,$prevSymbol,$parameter);
            $prevparameter="http://www.stockbangladesh.com$prevparameter";
            $prevhrefcode='<a href='.$prevparameter.' title='.$prevName.'>Previous</a>';
            //$prevhrefcode = ' <a  href="'.$this->webroot.'symbols/viewchart?TickerSymbol='.$prevSymbol.'&TimeRange=150&ChartSize=H&Volume=on&VGrid=on&HGrid=on&ChartType=CandleStick&Band=BB&avgType1=SMA&movAvg1=10&avgType2=SMA&movAvg2=25&Indicator1=RSI&Indicator2=MACD&Indicator3=None&Indicator4=None&Button1=Show+Chart" title='.$prevName.'>Previous</a>';
            //$prevhrefcode = ' <a  href="'.$parameter." title='.$prevName.'>Previous</a>';
        }
        else
        {
            $prevhrefcode = "Previous";
        }
        $this->set('prevhrefcode', $prevhrefcode);

        if(isset($nextSymbol)  && $nextSymbol !='' && isset($nextName))
        {
            //$nexthrefcode = ' <a  href="'.$this->webroot.'symbols/viewchart?TickerSymbol='.$nextSymbol.'&TimeRange=150&ChartSize=H&Volume=on&VGrid=on&HGrid=on&ChartType=CandleStick&Band=BB&avgType1=SMA&movAvg1=10&avgType2=SMA&movAvg2=25&Indicator1=RSI&Indicator2=MACD&Indicator3=None&Indicator4=None&Button1=Show+Chart" title='.$nextName.'>Next</a>';

            $nextparameter=str_replace($ticker,$nextSymbol,$parameter);
            $nextparameter="http://www.stockbangladesh.com$nextparameter";
            $nexthrefcode='<a href='.$nextparameter.' title='.$nextName.'>Next</a>';
        }
        else
        {
            $nexthrefcode = "Next";
        }
        if($adjustedChart) {
            if(isset($_REQUEST['adjust'])){
                $adjust  = $_REQUEST['adjust'];
                if($adjust){
                    $adjustparameter=str_replace("adjust=1","adjust=0",$parameter);
                    $nexthrefcode.=' | <a href='.$adjustparameter.'>SEE ADJUSTED CHART</a>';
                }else {
                    $adjustparameter=str_replace("adjust=0","adjust=1",$parameter);
                    $nexthrefcode.=' | <a href='.$adjustparameter.'>SEE NON-ADJUSTED CHART</a>';
                }
            }else {
                $nexthrefcode.=' | <a href='.$parameter.'&adjust=1>SEE NON-ADJUSTED CHART</a>';
            }
        }

        $this->set('nexthrefcode', $nexthrefcode);
        $this->set('nexthrefcode', $nexthrefcode);
        $this->set('request_data', $_REQUEST);
        $login=$this->Session->check ( 'Auth.User' );
        $this->set('login', $login);


        // exit;
    }
    function viewchartTest()
    {

         // Configure::write('debug',3);
       
        //error_reporting(E_ALL);
        $this->layout ='default-bodyonlychart';

        $this->pageTitle = 'Stock Bangladesh :: View Chart';
        $this->Session->write('Auth.gobackpage', 'symbols/viewchart');
        $this->set('myTimeRange',$_REQUEST['TimeRange']);

        # create the finance chart
        $this->timeStamps = null;
        $this->volData    = null;
        $this->highData   = null;
        $this->lowData    = null;
        $this->openData   = null;
        $this->closeData  = null;
        $this->timeadjust = 1970 * 365 * 24 * 60 * 60 + 112 * 24 * 60 * 60;





        # create the finance chart
        $width = 700;
        $mainHeight = 250;
        $indicatorHeight = 85;
        //pr($_REQUEST);
        //die;
        /*
                $chartSize = $_REQUEST["ChartSize"];
                if ($chartSize == "S") {
                    # Small chart size
                    $width = 450;
                    $mainHeight = 160;
                    $indicatorHeight = 60;
                } else if ($chartSize == "M") {
                    # Medium chart size
                    $width = 620;
                    $mainHeight = 210;
                    $indicatorHeight = 65;
                } else if ($chartSize == "H") {
                    # Huge chart size
                    $width = 1000;
                    $mainHeight = 320;
                    $indicatorHeight = 90;
                }
                */







        $m = $this->__drawChart($_REQUEST);
        exit;
        //print_r("Allah help me");


        $chart1URL = $m->makeSession("chart1");
        $this->set('chart1URL', $chart1URL);
        $imageMap = $m->getHTMLImageMap("", "", "title='".$m->getToolTipDateFormat()." {value|G}'");
        $this->set('imageMap', $imageMap);



     //   header("Content-type: image/png");
   //     print($m->makeChart2(PNG));

        //exit();

        $ticker    = $_REQUEST['TickerSymbol'];
        if(is_numeric($ticker))
            $shareInfo = $this->Symbol->find('id='.$ticker);
        else{
            $shareInfo['Symbol']['name']     = $ticker;
            $shareInfo['Symbol']['dse_code'] = $ticker;
        }

        $name      = $shareInfo['Symbol']['name'];
        $name      = ucwords(strtolower($name));

        $_SESSION['title'] = "$name - price chart / graph";
        $this->pageTitle = "$name - price chart / graph";
        $parameter = $_SERVER['REQUEST_URI'];

        $code      = $shareInfo['Symbol']['dse_code'];
        $this->set('code', $code);

        $querystr="SELECT * FROM `corporate_action` WHERE `symbol` =$ticker and `active`=1 ORDER BY `datestamp` ASC";
        $corporateAction = $this->Symbol->query($querystr);

        //pr($corporateAction);
        if(isset($corporateAction[0]['corporate_action']['id'])) {
            $adjustedChart = 1;
        }else {
            $adjustedChart = 0;
        }
        /* Get Symbol List */
        $symbolList = $this->Symbol->find('all', array('conditions' => array(' Symbol.dse_code != \'\' ','Symbol.inactive=\'No\'','Symbol.otc_market=\'No\'', 'Symbol.id > 1'), 'fields' => array('Symbol.id', 'Symbol.dse_code'), 'order' => ' Symbol.dse_code ASC '));

        $prevSymbol = '';
        $nextSymbol = '';
        foreach($symbolList as $key => $eachcompany)
        {

            if($eachcompany['Symbol']['id'] == $ticker)
            {
                $prevSymbol = $key - 1;
                if(isset($symbolList[$prevSymbol]))
                {
                    $prevName   = $symbolList[$prevSymbol]['Symbol']['dse_code'];
                    $prevSymbol = $symbolList[$prevSymbol]['Symbol']['id'];
                }


                $nextSymbol = $key + 1;
                if(isset($symbolList[$nextSymbol])){
                    $nextName   = $symbolList[$nextSymbol]['Symbol']['dse_code'];
                    $nextSymbol = $symbolList[$nextSymbol]['Symbol']['id'];
                }
            }
        }

        if(isset($prevSymbol) && $prevSymbol !='' && isset($prevName))
        {
            $prevparameter=str_replace($ticker,$prevSymbol,$parameter);
            $prevparameter="http://www.stockbangladesh.com$prevparameter";
            $prevhrefcode='<a href='.$prevparameter.' title='.$prevName.'>Previous</a>';
            //$prevhrefcode = ' <a  href="'.$this->webroot.'symbols/viewchart?TickerSymbol='.$prevSymbol.'&TimeRange=150&ChartSize=H&Volume=on&VGrid=on&HGrid=on&ChartType=CandleStick&Band=BB&avgType1=SMA&movAvg1=10&avgType2=SMA&movAvg2=25&Indicator1=RSI&Indicator2=MACD&Indicator3=None&Indicator4=None&Button1=Show+Chart" title='.$prevName.'>Previous</a>';
            //$prevhrefcode = ' <a  href="'.$parameter." title='.$prevName.'>Previous</a>';
        }
        else
        {
            $prevhrefcode = "Previous";
        }
        $this->set('prevhrefcode', $prevhrefcode);

        if(isset($nextSymbol)  && $nextSymbol !='' && isset($nextName))
        {
            //$nexthrefcode = ' <a  href="'.$this->webroot.'symbols/viewchart?TickerSymbol='.$nextSymbol.'&TimeRange=150&ChartSize=H&Volume=on&VGrid=on&HGrid=on&ChartType=CandleStick&Band=BB&avgType1=SMA&movAvg1=10&avgType2=SMA&movAvg2=25&Indicator1=RSI&Indicator2=MACD&Indicator3=None&Indicator4=None&Button1=Show+Chart" title='.$nextName.'>Next</a>';

            $nextparameter=str_replace($ticker,$nextSymbol,$parameter);
            $nextparameter="http://www.stockbangladesh.com$nextparameter";
            $nexthrefcode='<a href='.$nextparameter.' title='.$nextName.'>Next</a>';
        }
        else
        {
            $nexthrefcode = "Next";
        }
        if($adjustedChart) {
            if(isset($_REQUEST['adjust'])){
                $adjust  = $_REQUEST['adjust'];
                if($adjust){
                    $adjustparameter=str_replace("adjust=1","adjust=0",$parameter);
                    $nexthrefcode.=' | <a href='.$adjustparameter.'>SEE ADJUSTED CHART</a>';
                }else {
                    $adjustparameter=str_replace("adjust=0","adjust=1",$parameter);
                    $nexthrefcode.=' | <a href='.$adjustparameter.'>SEE NON-ADJUSTED CHART</a>';
                }
            }else {
                $nexthrefcode.=' | <a href='.$parameter.'&adjust=1>SEE NON-ADJUSTED CHART</a>';
            }
        }

        $this->set('nexthrefcode', $nexthrefcode);
        $this->set('nexthrefcode', $nexthrefcode);
        $this->set('request_data', $_REQUEST);
        $login=$this->Session->check ( 'Auth.User' );
        $this->set('login', $login);


        // exit;
    }




    function viewchart_back()
    {








         Configure::write('debug',3);
         //error_reporting(E_ALL);
         $this->layout ='default-bodyonlychart';

         $this->pageTitle = 'Stock Bangladesh :: View Chart';
         $this->Session->write('Auth.gobackpage', 'symbols/viewchart');
         $this->set('myTimeRange',$_REQUEST['TimeRange']);

         # create the finance chart
         $this->timeStamps = null;
         $this->volData    = null;
         $this->highData   = null;
         $this->lowData    = null;
         $this->openData   = null;
         $this->closeData  = null;
         $this->timeadjust = 1970 * 365 * 24 * 60 * 60 + 112 * 24 * 60 * 60;




         $m = $this->__drawChart($_REQUEST);

         //print_r($m);

         $mm=get_object_vars($m);

         $counter=count($mm['m_highData']);
         //print_r($counter);
        //print_r($mm['m_highData']);

         for($i=0;$i<$counter;$i++)
         {
             /*$companyData[$i]['m_highData']=$mm['m_highData'][$i];
             $companyData[$i]['m_lowData']=$mm['m_lowData'][$i];
             $companyData[$i]['m_openData']=$mm['m_openData'][$i];
             $companyData[$i]['m_closeData']=$mm['m_closeData'][$i];
             $companyData[$i]['m_volData']= $mm['m_volData'][$i];*/
            // $date = strtotime($mm['m_timeStamps'][$i]);

             //$date =date("d-m-Y", $mm['m_timeStamps'][$i]);
             //$date =date('d/M/Y', $date);
            // date_timestamp_set($date, $mm['m_timeStamps'][$i]);
            //$date= date_format($date, 'U = Y-m-d H:i:s');


            // $ts = $mm['m_timeStamps'][$i];
            // $date = new DateTime("@$ts");
             //$date=$date->format('Y-m-d H:i:s');

             $date=gmdate("Y-m-d",  $mm['m_timeStamps'][$i]);

             $companyData[$i]=array($date,$mm['m_highData'][$i],$mm['m_lowData'][$i],$mm['m_openData'][$i],$mm['m_closeData'][$i],$mm['m_volData'][$i]);
         }



        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=data.csv');

       /* $list = array
        (
            "Peter,Griffin,Oslo,Norway",
            "Glenn,Quagmire,Oslo,Norway",
        );*/



        $file = fopen("php://output","w");

        fputcsv($file,array('Date', 'High', 'Low', 'Open', 'Close', 'Vol'));

        foreach ($companyData as $line)
        {
            fputcsv($file,$line);
        }

        fclose($file);

        exit;

        ////////////////////////////////////////////////////////////


         $chart1URL = $m->makeSession("chart1");
         $this->set('chart1URL', $chart1URL);
         $imageMap = $m->getHTMLImageMap("", "", "title='".$m->getToolTipDateFormat()." {value|G}'");
         $this->set('imageMap', $imageMap);
         $ticker    = $_REQUEST['TickerSymbol'];
         if(is_numeric($ticker))
             $shareInfo = $this->Symbol->find('id='.$ticker);
         else{
             $shareInfo['Symbol']['name']     = $ticker;
             $shareInfo['Symbol']['dse_code'] = $ticker;
         }

         $name      = $shareInfo['Symbol']['name'];
         $name      = ucwords(strtolower($name));

         $_SESSION['title'] = "$name - price chart / graph";
         $this->pageTitle = "$name - price chart / graph";
         $parameter = $_SERVER['REQUEST_URI'];

         $code      = $shareInfo['Symbol']['dse_code'];
         $this->set('code', $code);

         $querystr="SELECT * FROM `corporate_action` WHERE `symbol` =$ticker and `active`=1 ORDER BY `datestamp` ASC";
         $corporateAction = $this->Symbol->query($querystr);

         //pr($corporateAction);
         if(isset($corporateAction[0]['corporate_action']['id'])) {
             $adjustedChart = 1;
         }else {
             $adjustedChart = 0;
         }
         /* Get Symbol List */
       $symbolList = $this->Symbol->find('all', array('conditions' => array(' Symbol.dse_code != \'\' ','Symbol.inactive=\'No\'','Symbol.otc_market=\'No\'', 'Symbol.id > 1'), 'fields' => array('Symbol.id', 'Symbol.dse_code'), 'order' => ' Symbol.dse_code ASC '));

        $prevSymbol = '';
        $nextSymbol = '';
        foreach($symbolList as $key => $eachcompany)
        {

            if($eachcompany['Symbol']['id'] == $ticker)
            {
                $prevSymbol = $key - 1;
                if(isset($symbolList[$prevSymbol]))
                {
                    $prevName   = $symbolList[$prevSymbol]['Symbol']['dse_code'];
                    $prevSymbol = $symbolList[$prevSymbol]['Symbol']['id'];
                }


                $nextSymbol = $key + 1;
                if(isset($symbolList[$nextSymbol])){
                    $nextName   = $symbolList[$nextSymbol]['Symbol']['dse_code'];
                    $nextSymbol = $symbolList[$nextSymbol]['Symbol']['id'];
                }
            }
        }

        if(isset($prevSymbol) && $prevSymbol !='' && isset($prevName))
        {
            $prevparameter=str_replace($ticker,$prevSymbol,$parameter);
            $prevparameter="http://www.stockbangladesh.com$prevparameter";
            $prevhrefcode='<a href='.$prevparameter.' title='.$prevName.'>Previous</a>';
            //$prevhrefcode = ' <a  href="'.$this->webroot.'symbols/viewchart?TickerSymbol='.$prevSymbol.'&TimeRange=150&ChartSize=H&Volume=on&VGrid=on&HGrid=on&ChartType=CandleStick&Band=BB&avgType1=SMA&movAvg1=10&avgType2=SMA&movAvg2=25&Indicator1=RSI&Indicator2=MACD&Indicator3=None&Indicator4=None&Button1=Show+Chart" title='.$prevName.'>Previous</a>';
            //$prevhrefcode = ' <a  href="'.$parameter." title='.$prevName.'>Previous</a>';
        }
        else
        {
            $prevhrefcode = "Previous";
        }
        $this->set('prevhrefcode', $prevhrefcode);

        if(isset($nextSymbol)  && $nextSymbol !='' && isset($nextName))
        {
            //$nexthrefcode = ' <a  href="'.$this->webroot.'symbols/viewchart?TickerSymbol='.$nextSymbol.'&TimeRange=150&ChartSize=H&Volume=on&VGrid=on&HGrid=on&ChartType=CandleStick&Band=BB&avgType1=SMA&movAvg1=10&avgType2=SMA&movAvg2=25&Indicator1=RSI&Indicator2=MACD&Indicator3=None&Indicator4=None&Button1=Show+Chart" title='.$nextName.'>Next</a>';

            $nextparameter=str_replace($ticker,$nextSymbol,$parameter);
            $nextparameter="http://www.stockbangladesh.com$nextparameter";
            $nexthrefcode='<a href='.$nextparameter.' title='.$nextName.'>Next</a>';
        }
        else
        {
            $nexthrefcode = "Next";
        }
        if($adjustedChart) {
            if(isset($_REQUEST['adjust'])){
                $adjust  = $_REQUEST['adjust'];
                if($adjust){
                    $adjustparameter=str_replace("adjust=1","adjust=0",$parameter);
                    $nexthrefcode.=' | <a href='.$adjustparameter.'>SEE ADJUSTED CHART</a>';
                }else {
                    $adjustparameter=str_replace("adjust=0","adjust=1",$parameter);
                    $nexthrefcode.=' | <a href='.$adjustparameter.'>SEE NON-ADJUSTED CHART</a>';
                }
            }else {
                $nexthrefcode.=' | <a href='.$parameter.'&adjust=1>SEE NON-ADJUSTED CHART</a>';
            }
        }

        $this->set('nexthrefcode', $nexthrefcode);
        $this->set('nexthrefcode', $nexthrefcode);
        $this->set('request_data', $_REQUEST);
        $login=$this->Session->check ( 'Auth.User' );
        $this->set('login', $login);

         exit;
    }


    function makeCsv()
    {
        //print_r($companyData);
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=data.csv');

        $list = array
        (
            "Peter,Griffin,Oslo,Norway",
            "Glenn,Quagmire,Oslo,Norway",
        );



        $file = fopen("data.csv","w");

        foreach ($list as $line)
        {
            fputcsv($file,explode(',',$line));
        }

        fclose($file);



    }

    function genchart()
    {
        /*//session_cache_limiter("private_no_expire"); */
       // Configure::write('debug',3);
    //    pr($_SESSION);
    //    exit;
      //  pr("hhhhhhhhhhhhhhhhhhhhh");
       // exit;
        require_once(WWW_ROOT . DS . 'chart'. DS .'Image_Toolbox.class.php'); 
        
        if (isset($_GET))
        {   
            $chartData = $_SESSION[$_GET["img"]];    
            
            //$chartImagePath = WWW_ROOT . 'chart'. DS . 'stock_chart.png';     
           // $f = fopen($chartImagePath, "wb");
            //fwrite($f, $chartData);
           // fclose($f);
            
           // $img = new Image_Toolbox($chartImagePath);

           // $width = $img->_img['main']['width'];
          //  $height = $img->_img['main']['height'];
           // $height = $height - 10;
            //$img->addImage($width,12,'#FFFFFF');
            //$img->blendMask('left','bottom',IMAGE_TOOLBOX_BLEND_COPY,0, $height);
           // $img->output();

            print($chartData );
			exit();
        }
        else {            
            print $HTTP_SESSION_VARS[$HTTP_GET_VARS["img"]];
        }
    }
        
    # Utility to compute modulus for large positive numbers. Although PHP has a built-in fmod
    # function, it is only for PHP >= 4.2.0. So we need to define our own fmod function.
    function __fmod2($divisor, $dividend) 
    { 
        return $divisor - floor($divisor / $dividend) * $dividend; 
    }  
    
    #/ <summary>
    #/ Get 15 minutes data series for timeStamps, highData, lowData, openData, closeData
    #/ and volData.
    #/ </summary>
    #/ <param name="startDate">The starting date/time for the data series.</param>
    #/ <param name="endDate">The ending date/time for the data series.</param>
    function __get15MinData($ticker, $startDate, $endDate) 
    {
        #
        # In this demo, we use a random number generator to generate the data. In
        # practice, you may get the data from a database or by other means. If you do not
        # have 15 minute data, you may modify the "drawChart" method below to not using
        # 15 minute data.
        #
        $this->__generateRandomData($ticker, $startDate, $endDate, 900, 0);
    }
    
    #/ <summary>
    #/ Get daily data series for timeStamps, highData, lowData, openData, closeData
    #/ and volData.
    #/ </summary>
    #/ <param name="startDate">The starting date/time for the data series.</param>
    #/ <param name="endDate">The ending date/time for the data series.</param>
    function __getDailyData($ticker, $startDate, $endDate) 
    {
        #
        # In this demo, we use a random number generator to generate the data. In
        # practice, you may get the data from a database or by other means.
        #
        $intraday = 0;
        if($startDate==1)
        {            
            $intraday = (int)($_REQUEST["TimeRange"]);            
        }
        
        $adjust = (int)($_REQUEST["adjust"]);            
        
        
        $this->__generateRandomData($ticker, $startDate, $endDate, 86400, $intraday,$adjust);
    }
    
    #/ <summary>
    #/ Get weekly data series for timeStamps, highData, lowData, openData, closeData
    #/ and volData.
    #/ </summary>
    #/ <param name="startDate">The starting date/time for the data series.</param>
    #/ <param name="endDate">The ending date/time for the data series.</param>
    function __getWeeklyData($ticker, $startDate, $endDate) 
    {
        #
        # If you do not have weekly data, you may call "getDailyData(startDate, endDate)"
        # to get daily data, then call "convertDailyToWeeklyData()" to convert to weekly
        # data.
        #
        $this->__generateRandomData($ticker, $startDate, $endDate, 86400 * 7, 0);
    }
    #/ <summary>
    #/ Get monthly data series for timeStamps, highData, lowData, openData, closeData
    #/ and volData.
    #/ </summary>
    #/ <param name="startDate">The starting date/time for the data series.</param>
    #/ <param name="endDate">The ending date/time for the data series.</param>
    function __getMonthlyData($ticker, $startDate, $endDate) 
    {
        #
        # If you do not have weekly data, you may call "getDailyData(startDate, endDate)"
        # to get daily data, then call "convertDailyToMonthlyData()" to convert to
        # monthly data.
        #
        $this->__generateRandomData($ticker, $startDate, $endDate, 86400 * 30, 0);
    }
    
    #/ <summary>
    #/ A random number generator designed to generate realistic financial data.
    #/ </summary>
    #/ <param name="startDate">The starting date/time for the data series.</param>
    #/ <param name="endDate">The ending date/time for the data series.</param>
    #/ <param name="resolution">The period of the data series.</param>
    
    function querytest()
    {
        //$ticker = 12160;
//        $limit = 100;
//        $querystr = "SELECT c.id, c.dse_code, c.no_of_securities,c.business_segment,o.open,o.high, o.low,o.close,o.volume,UNIX_TIMESTAMP(str_to_date(date, '%d-%c-%Y')) as mydate
//    FROM symbols AS c, outputs AS o
//    WHERE c.dse_code != ''
//    AND c.business_segment like '%Bank%'
//    AND o.symbol = c.id
//    and UNIX_TIMESTAMP(str_to_date(date, '%d-%c-%Y'))>'03-01-2007'
//    ORDER BY o.id ASC";
//       $symbolList = $this->Symbol->find('all', array('conditions' => array(' Symbol.dse_code != \'\' '), 'fields' => array('Symbol.id', 'Symbol.dse_code'), 'order' => ' Symbol.dse_code ASC '));  
        //$allShares = $this->Symbol->query($querystr);    
        //$this->FrontsideMenu->symbolList
//        pr($symbolList); 
//        die;
    }
    
    function __generateRandomData($ticker, $startDate, $endDate, $resolution, $intraday = 0, $adjust = 0) 
    {   //  Configure::write('debug',3);
        $this->resolution = $resolution;
        
        if(is_numeric($ticker))
        {
            if($intraday)
            {                
                $minute    = $intraday%4000;
                $interval  = $minute*60;
                $limit     = $minute*100;
                $time      = time();
                $startDate = 1;

                $time      = $time - 2 * 24 * 60 * 60;
            
                $DBIntradaySQL = 'SELECT * FROM data_banks_intraday WHERE symbol_id ='.$ticker.' ORDER BY id DESC LIMIT 0, '.$limit;
                

                
                //echo $DBIntradaySQL;
                //exit;
                $shareData = $this->Symbol->query($DBIntradaySQL);
                
                $timeWiseArr = array();
                $timeKeyArr  = array();

                foreach ($shareData as $rowData)
                {
                    $currenttime                       = $rowData['data_banks_intraday']['currenttime'];
                    $mod                               = $currenttime%$interval;
                    $timeToBeAccounted                 = $currenttime - $mod + $interval;
                    $timeWiseArr[$timeToBeAccounted][] = $rowData;
                    $modtime                           = date('d M  h:ia', $timeToBeAccounted);
                }

                foreach ($timeWiseArr as $key => $arr)
                {
                    $timeKeyArr[] = $key;
                }
                
                $resultarr = array();
                foreach ($timeWiseArr as $time => $row)
                {                    
                    $ohlc = array();
                    $high = 0;
                    $open = 0;
                    $low  = $row[0]['data_banks_intraday']['close'];
                                        
                    foreach ($row as $trade)
                    {
                        $open = $trade['data_banks_intraday']['close'];
                        $vol  = $trade['data_banks_intraday']['volume'];

                        if($trade['data_banks_intraday']['close'] > $high)
                        {
                            $high = $trade['data_banks_intraday']['close'];
                        }
                        if($trade['data_banks_intraday']['close'] < $low)
                        {
                            $low = $trade['data_banks_intraday']['close'];
                        }
                    }
                    
                    $ohlc['open']   = $open;
                    $ohlc['high']   = $high;
                    $ohlc['low']    = $low;
                    $ohlc['close']  = $row[0]['data_banks_intraday']['close'];
                    $ohlc['volume'] = $row[0]['data_banks_intraday']['volume'] - $vol;
                    $ohlc['mydate'] = $time;

                    $resultarr[]    = $ohlc;                                        
                }
                            
                //echo count($resultarr); die;
            }
            else
            {                
                
                $today       = time()+ 6*60*60;
                $selectday   = 720*24*60*60;                
                $selectmonth = 3600*24*60*60;           
                                
                $cmpStartDay   = $today - $selectday;
                $cmpStartMonth = $today - $selectmonth;
                
                
                if($cmpStartDay < $startDate)
                {
                    $querystr = 'SELECT id, UNIX_TIMESTAMP(str_to_date(date, \'%d-%c-%Y\')) as mydate, high, low,open, close, volume FROM outputs WHERE symbol='.$ticker.' AND UNIX_TIMESTAMP(str_to_date(date, \'%d-%c-%Y\'))>'.$startDate.' ORDER BY id ASC';
                }
                else if(($startDate <= $cmpStartDay) AND ($startDate > $cmpStartMonth))
                {
                    $querystr = 'SELECT id, UNIX_TIMESTAMP(str_to_date(date, \'%d-%c-%Y\')) as mydate, high, low,open, close, volume FROM outputs_week as outputs WHERE symbol='.$ticker.' AND UNIX_TIMESTAMP(str_to_date(date, \'%d-%c-%Y\'))>'.$startDate.' ORDER BY id ASC';                    
                }
                else if($startDate <= $cmpStartMonth)
                {
                    $querystr = 'SELECT id, UNIX_TIMESTAMP(str_to_date(date, \'%d-%c-%Y\')) as mydate, high, low,open, close, volume FROM outputs_month as outputs WHERE symbol='.$ticker.' AND UNIX_TIMESTAMP(str_to_date(date, \'%d-%c-%Y\'))>'.$startDate.' ORDER BY id ASC';
                }
                
                //$querystr = 'SELECT id, UNIX_TIMESTAMP(str_to_date(date, \'%d-%c-%Y\')) as mydate, high, low,open, close, volume FROM outputs WHERE symbol='.$ticker.' AND UNIX_TIMESTAMP(str_to_date(date, \'%d-%c-%Y\'))>'.$startDate.' ORDER BY id ASC';
                //$querystr = 'SELECT id, daystamp as mydate, high, low,open, close, volume FROM outputs WHERE symbol='.$ticker.' AND  daystamp > '.$startDate.' ORDER BY id ASC';
            }
        
            if($startDate!=1)
            {
                $result = $this->Symbol->query($querystr);
                
                $resultarr = array();
                 
                if(empty($result)) {
                    //[outputs] => Array
//                (
//                    [id] => 500149
//                    [high] => 2220
//                    [low] => 2157
//                    [open] => 2171
//                    [close] => 2215.25
//                    [volume] => 35750
//                )

//            [0] => Array
//                (
//                    [mydate] => 1263837600
//                )

                      $resultarr = array(
                            0 =>array('outputs' => array('id' => 0, 'high' => 0, 'low' => 0, 'open' => 0, 'close' => 0, 'volume'=>0), 
                                          0 => array('mydate'=> mktime(0, 0, 0, date('m'), date('d')-1, date('Y')))),
                                          //0 => array('mydate'=> 1167868800)),
                            1 => array('outputs' => array('id' => 0, 'high' => 0, 'low' => 0, 'open' => 0, 'close' => 0, 'volume'=>0), 
                                          0 => array('mydate'=> mktime(0, 0, 0, date('m'), date('d'), date('Y'))))
                                          //0 => array('mydate'=> 1167868800))              
                      );
                      
                                          
                    //$this->Session->setFlash('Sorry for inconvenience.');
//                    $this->redirect(array( 'controller' => 'users', 'action' => 'login' ));
//                    $this->redirect($this->referer());
                     
                      //pr($resultarr); die;
                }
                else{
                    foreach($result as $row){
                        $resultarr[] = $row;
                    }                        
                }
            }    
            
            
            			$querystr="SELECT *
FROM `corporate_action`
WHERE `symbol` =$ticker and `active`=1
ORDER BY `datestamp` ASC";
			$corporateAction = $this->Symbol->query($querystr);
            
            $corporateActionArr = array();
            $corporateActionIdArr = array();
            $corporateActionDateArr = array();
            foreach($corporateAction AS $actionData)
            {
                $corporateActionArr[$actionData['corporate_action']['date']] .= $actionData['corporate_action']['action'].',';
                $corporateActionIdArr[$actionData['corporate_action']['date']] .= $actionData['corporate_action']['id'].',';
                $corporateActionDateArr[] = $actionData['corporate_action']['date'];
                
            }
            //echo $corporateActionArr[$corporateActionDateArr[count($corporateActionDateArr)-1]];
            $rest   = substr($corporateActionArr[$corporateActionDateArr[count($corporateActionDateArr)-1]], 0, -1);
            $restId = substr($corporateActionIdArr[$corporateActionDateArr[count($corporateActionDateArr)-1]], 0, -1);
            $this->set('corporate_action_id',$restId);
            $this->set('corporate_action_action',$rest);
            $this->set('corporate_action_date',$corporateActionDateArr[count($corporateActionDateArr)-1]);
            
            /*echo "<pre>";
            print_r($corporateActionArr);
			//print_r($result);
			die();*/

			$day=$corporateAction[0]['corporate_action']['datestamp'];
			// echo date('d-m-y H:i:s',$day);
			// $day=$corporateAction[0]['corporate_action']['date'];

			//echo date('d-m-y H:i:s');
			//  $dayst= strtotime($day);
			// echo date('d-m-y H:i:s',$dayst);
            if(!$adjust){
			    foreach ($corporateAction as $row)
			    {
				    $action=$row['corporate_action']['action'];
				    $adjustedArr=array();

				    if($action=='stockdiv')
				    {
					    $adjustmentFactor=(100+$row['corporate_action']['value'])/100;

					    $day=$row['corporate_action']['date'];
					    //$daystamp= strtotime($day)-24*60*60;
                        $daystamp= strtotime($day);

					    foreach ($resultarr as $data)
					    {
						    if($data[0]['mydate']<$daystamp)
						    {
							    $data['outputs']['open']=$data['outputs']['open']/$adjustmentFactor;
							    $data['outputs']['high']=$data['outputs']['high']/$adjustmentFactor;
							    $data['outputs']['low']=$data['outputs']['low']/$adjustmentFactor;
							    $data['outputs']['close']=$data['outputs']['close']/$adjustmentFactor;
						    }

						    $adjustedArr[]=$data;
					    }

					    $resultarr=array();
					    $resultarr=$adjustedArr;

				    }
				    elseif($action=='cashdiv')
				    {

					    $symbolSQL = "SELECT face_value FROM symbols WHERE id=$ticker";

					    $result = $this->Symbol->query($symbolSQL);

					    $facevalue  = $result[0]['symbols']['face_value'];




					    $adjustmentFactor=$facevalue*$row['corporate_action']['value']/100;

					    $day=$row['corporate_action']['date'];
					    //$daystamp= strtotime($day)-24*60*60;
                        $daystamp= strtotime($day);

					    foreach ($resultarr as $data)
					    {
						    if($data[0]['mydate']<$daystamp)
						    {
							    $data['outputs']['open']=$data['outputs']['open']-$adjustmentFactor;
							    $data['outputs']['high']=$data['outputs']['high']-$adjustmentFactor;
							    $data['outputs']['low']=$data['outputs']['low']-$adjustmentFactor;
							    $data['outputs']['close']=$data['outputs']['close']-$adjustmentFactor;
						    }

						    $adjustedArr[]=$data;
					    }

					    $resultarr=array();
					    $resultarr=$adjustedArr;

				    }
				    elseif($action=='rightshare')
				    {

					    $symbolSQL = "SELECT face_value FROM symbols WHERE id=$ticker";

					    $result = $this->Symbol->query($symbolSQL);

					    $facevalue  = $result[0]['symbols']['face_value'];

					    $adjustmentFactor=(100+$row['corporate_action']['value'])/100;
					    $premium=$row['corporate_action']['premium'];					
					    
					       $close_price_adjustment_factor=($premium+$facevalue)-(($premium+$facevalue)/$adjustmentFactor);
                        

					    $day=$row['corporate_action']['date'];
					    //$daystamp= strtotime($day)-24*60*60;
                        $daystamp= strtotime($day);

					    foreach ($resultarr as $data)
					    {
						    if($data[0]['mydate']<$daystamp)
						    {							    
                                $data['outputs']['open']=(($data['outputs']['open']*100)+(($premium+$facevalue)*$row['corporate_action']['value'])) / (100+$row['corporate_action']['value']);
                                $data['outputs']['high']=(($data['outputs']['high']*100)+(($premium+$facevalue)*$row['corporate_action']['value'])) / (100+$row['corporate_action']['value']);
                                $data['outputs']['low']=(($data['outputs']['low']*100)+(($premium+$facevalue)*$row['corporate_action']['value'])) / (100+$row['corporate_action']['value']);
                                $data['outputs']['close']=(($data['outputs']['close']*100)+(($premium+$facevalue)*$row['corporate_action']['value'])) / (100+$row['corporate_action']['value']);
                                
                                
                                /*$data['outputs']['open']=($data['outputs']['open']+$close_price_adjustment_factor)/$adjustmentFactor;
							    $data['outputs']['high']=($data['outputs']['high']+$close_price_adjustment_factor)/$adjustmentFactor;
							    $data['outputs']['low']=($data['outputs']['low']+$close_price_adjustment_factor)/$adjustmentFactor;
							    $data['outputs']['close']=($data['outputs']['close']+$close_price_adjustment_factor)/$adjustmentFactor;*/
                                
                                
                                
						    }

						    $adjustedArr[]=$data;
					    }

					    $resultarr=array();
					    $resultarr=$adjustedArr;

				    }


				    elseif ($action=='split')
				    {
					    $adjustmentFactor=$row['corporate_action']['value'];

					    $day=$row['corporate_action']['date'];
					    //$daystamp= strtotime($day)-24*60*60;
                        $daystamp= strtotime($day);

					    foreach ($resultarr as $data)
					    {
						    if($data[0]['mydate']<$daystamp)
						    {
							    $data['outputs']['open']=$data['outputs']['open']/$adjustmentFactor;
							    $data['outputs']['high']=$data['outputs']['high']/$adjustmentFactor;
							    $data['outputs']['low']=$data['outputs']['low']/$adjustmentFactor;
							    $data['outputs']['close']=$data['outputs']['close']/$adjustmentFactor;
							    $data['outputs']['volume']=$data['outputs']['volume']*$adjustmentFactor;
						    }

						    $adjustedArr[]=$data;
					    }
					    $resultarr=array();
					    $resultarr=$adjustedArr;

				    }


				    //print_r($adjustedArr);
			    }
            }

            
            

            $resultarrWithcode = array();
                        
            foreach ($resultarr as $key=>$row)
            {         
                //pr($row);          
                if($startDate==1)
                {                    
                    //$date[] = $row['mydate'];
                    $getMinute = $intraday % 4000;                    
                    $padMinute = 45*60;
                    switch($getMinute){
                        case 5:
                               $padMinute = 45*60;            
                               break; 
                        case 10:
                               $padMinute = 40*60;            
                               break; 
                        case 15:
                               $padMinute = 45*60;            
                               break; 
                        case 30:
                               $padMinute = 30*60;            
                               break;                      
                        case 60:
                               $padMinute = 0;            
                               break;                      
                    }
                    if($row['high']==$row['low']&&$row['open']==$row['close'])
                    {
                    continue;
                    }
                    else
                    {
                    $date[] = $row['mydate'] - 97200 + 1970*365*24*60*60 + 113*24*60*60 + 8*60*60 + $padMinute;
                    //$date[] = $row['outputs']['mydate']-97200+1970*365*24*60*60+113*24*60*60+3*60*60;
                    
                    $hdata[] = $row['high'];
                    $ldata[] = $row['low'];
                    $odata[] = $row['open'];
                    $cdata[] = $row['close'];
                    //echo abs($row['volume']);
                    //echo '-';
                    $vdata[] = abs($row['volume']);
                    }
                }
                else
                {                    
                    /*$date[] = $row[0]['mydate']+1970*365*24*60*60+113*24*60*60;
                    //$date[] = $row['outputs']['mydate']+1970*365*24*60*60+113*24*60*60;
                    
                    $hdata[] = $row['outputs']['high'];
                    $ldata[] = $row['outputs']['low'];
                    $odata[] = $row['outputs']['open'];
                    $cdata[] = $row['outputs']['close'];
                    $vdata[] = abs($row['outputs']['volume']);*/
                    
                    
                    $vol=abs($row['outputs']['volume']);
					if($vol)
					{
						$date[] = $row[0]['mydate']+1970*365*24*60*60+113*24*60*60;
						//$date[] = $row['outputs']['mydate']+1970*365*24*60*60+113*24*60*60;

						$hdata[] = $row['outputs']['high'];
						$ldata[] = $row['outputs']['low'];
						$odata[] = $row['outputs']['open'];
						$cdata[] = $row['outputs']['close'];
						$vdata[] = $vol;
					}
                    
                    
                }
                
            }

            if($startDate==1)
            {
                if(!empty($date))
                {
                    $date  = array_reverse($date);
                    $hdata = array_reverse($hdata);
                    $ldata = array_reverse($ldata);
                    $odata = array_reverse($odata);
                    $cdata = array_reverse($cdata);
                    $vdata = array_reverse($vdata);
                }
            }
        }
        else
        {
            $returnData = $this->__sectorData($ticker,$startDate);            
            
            //pr($returnData); die;
            
            foreach ($returnData as $row)
            {
                $date[]  = $row['date']+1970*365*24*60*60+112*24*60*60;
                $hdata[] = $row['sectorhigh'];
                $ldata[] = $row['sectorlow'];
                $odata[] = $row['sectoropen'];
                $cdata[] = $row['sectorclose'];
                $vdata[] = abs($row['sectorvolume']);
            }
        }
        
        $this->timeStamps = $date;
        $this->highData   = $hdata;
        $this->lowData    = $ldata;
        $this->openData   = $odata;
        $this->closeData  = $cdata;
        $this->volData    = $vdata;        
    }

    #/ <summary>
    #/ A utility to convert daily to weekly data.
    #/ </summary>
    function __convertDailyToWeeklyData() 
    {
        $tmpArrayMath1 = new ArrayMath($this->timeStamps);
        $this->__aggregateData($tmpArrayMath1->selectStartOfWeek());
    }

    #/ <summary>
    #/ A utility to convert daily to monthly data.
    #/ </summary>
    function __convertDailyToMonthlyData() 
    {
        $tmpArrayMath1 = new ArrayMath($this->timeStamps);
        $this->__aggregateData($tmpArrayMath1->selectStartOfMonth());
    }

    #/ <summary>
    #/ An internal method used to aggregate daily data.
    #/ </summary>
    function __aggregateData(&$aggregator) 
    {
        //global $timeStamps, $volData, $highData, $lowData, $openData, $closeData;
                
        $this->timeStamps = NTime($aggregator->aggregate(CTime($this->timeStamps), AggregateFirst));
        $this->highData   = $aggregator->aggregate($this->highData, AggregateMax);
        $this->lowData    = $aggregator->aggregate($this->lowData, AggregateMin);
        $this->openData   = $aggregator->aggregate($this->openData, AggregateFirst);
        $this->closeData  = $aggregator->aggregate($this->closeData, AggregateLast);
        $this->volData    = $aggregator->aggregate($this->volData, AggregateSum);        
    }

    #/ <summary>
    #/ Create a financial chart according to user selections. The user selections are
    #/ encoded in the query parameters.
    #/ </summary>
    function __drawChart($request) 
    {
        //pr($request); die;
        $durationInDays = (int)($request["TimeRange"]);
        if($durationInDays > 4000)
        {
            $durationInDays = 1;
        }
        /*if(($durationInDays >= 720) && ($durationInDays < 3600))
        {
            $durationInDays = $durationInDays*2;
        }*/
        
        # In this demo, we just assume we plot up to the latest time. So end date is now.
        
        $todayStamp = time() + 6 * 60 * 60;
        $startstamp = $todayStamp - $durationInDays* 24 * 60 * 60;

        # The data series we want to get.
        # The moving average periods selected by the user.
        $avgPeriod1 = 0;
        if(isset($request["movAvg1"]))
        {
            $avgPeriod1 = (int)($request["movAvg1"]);
        }
        else
        {
            $avgPeriod1=10;
        }
        $avgPeriod2 = 0;
        if(isset($request["movAvg2"]))
        {
            $avgPeriod2 = (int)($request["movAvg2"]);
        }
        else
        {
            $avgPeriod2=25;
        }
         
        $avgPeriod3 = 0;
        if(isset($request["movAvg3"]))
        {
            $avgPeriod3 = (int)($request["movAvg3"]);
        }
        else
        {
            $avgPeriod3=0;
        }
        if(isset($request["movAvg4"]))
        {
            $avgPeriod4 = (int)($request["movAvg4"]);
        }
        else
        {
            $avgPeriod4=0;
        }
        
        if ($avgPeriod1 < 0) {
            $avgPeriod1 = 0;
        } 
        else if ($avgPeriod1 > 300) {
            $avgPeriod1 = 300;
        }

        if ($avgPeriod2 < 0) {
            $avgPeriod2 = 0;
        } 
        else if ($avgPeriod2 > 300) {
            $avgPeriod2 = 300;
        }
        
        if ($avgPeriod3 < 0) {
            $avgPeriod3 = 0;
        } 
        else if ($avgPeriod3 > 300) {
            $avgPeriod3 = 300;
        }
        
        if ($avgPeriod4 < 0) {
            $avgPeriod4 = 0;
        } 
        else if ($avgPeriod4 > 300) {
            $avgPeriod4 = 300;
        }
         
        # We need extra leading data points in order to compute moving averages.
        $extraPoints = 20;
        if ($avgPeriod1 > $extraPoints) {
            $extraPoints = $avgPeriod1;
        }
        if ($avgPeriod2 > $extraPoints) {
            $extraPoints = $avgPeriod2;
        }
        if ($avgPeriod3 > $extraPoints) {
            $extraPoints = $avgPeriod3;
        }
        if ($avgPeriod4 > $extraPoints) {
            $extraPoints = $avgPeriod4;
        }
        $adjustedStartDate = $startstamp;
         
        if($durationInDays==1)
        {
            $adjustedStartDate=1;
        }

        $tickerKey = $request["TickerSymbol"];
        $endDate = '';
        $this->__getDailyData($tickerKey, $adjustedStartDate, $endDate);
        
        if(empty($this->timeStamps))
        {
            return -1;
        }
        
        $width = 780;
        $mainHeight = 250;
        $indicatorHeight = 80;
        
        $chartSize = $request["ChartSize"];
        if ($chartSize == "S") {
            # Small chart size
            $width = 450;
            $mainHeight = 160;
            $indicatorHeight = 60;
        } else if ($chartSize == "M") {
            # Medium chart size
            $width = 620;
            $mainHeight = 210;
            $indicatorHeight = 65;
        } else if ($chartSize == "H") {
            # Huge chart size
            $width = 950;
            $mainHeight = 320;
            $indicatorHeight = 90;
        }

            
        # Create the chart object using the selected size
        $m = new FinanceChart($width);        
        
        # Set the data into the chart object
        $m->setData($this->timeStamps, $this->highData, $this->lowData, $this->openData, $this->closeData, $this->volData, $extraPoints);

        #
        # We configure the title of the chart. In this demo chart design, we put the
        # company name as the top line of the title with left alignment.
        #
        if(is_numeric($tickerKey))
        {
            $symbolSQL = "SELECT DISTINCT id, name, category, no_of_securities, share_percentage_public, year_end, market_lot, q1, q2, q3, q4 FROM symbols WHERE id=$tickerKey";
            
            $result = $this->Symbol->query($symbolSQL);
            if(empty($result)) {
                die('here at __drawChart');
            }
            
            $name       = $result[0]['symbols']['name'];
            $category   = $result[0]['symbols']['category'];
            $market_lot = $result[0]['symbols']['market_lot'];
            $no_of_securities = $result[0]['symbols']['no_of_securities'];
            $share_percentage_public = $result[0]['symbols']['share_percentage_public'];
            $year_end = $result[0]['symbols']['year_end'];

            
            $qeps   = 0;
            $factor = 1;
            $querterNo = 1;
            if($result[0]['symbols']['q1'])
            {
                $qeps   = $result[0]['symbols']['q1'];
                $factor = 4;
                $querterNo = "Q1";
            }
            if($result[0]['symbols']['q2'])
            {
                $qeps   = $result[0]['symbols']['q2'];
                $factor = 2;
                $querterNo = "Q2";
            }
            if($result[0]['symbols']['q3'])
            {
                $qeps   = $result[0]['symbols']['q3'];
                $factor = 4/3;
                $querterNo = "Q3";
            }
            if($result[0]['symbols']['q4'])
            {
                $qeps   = $result[0]['symbols']['q4'];
                $factor = 1;
                $querterNo = "Annual";
            }
            
            $annualizedEPS    = $qeps*$factor;
            
            $financialPerformance = $this->Symbol->query('SELECT * FROM company_financial_performance as performance WHERE symbol_id='.$result[0]['symbols']['id'].' AND earning_per_share!=\'\' ORDER BY fin_year DESC LIMIT 1');
            //pr($financialPerformance);
            $companyFinPerfNav = $this->Symbol->query("SELECT * FROM `company_financial_performance` WHERE `symbol_id`='".$result[0]['symbols']['id']."' and asset_val_per_share!=''  ORDER BY  fin_year DESC LIMIT 1");
                    
            $lastTradingClose = $this->closeData[count($this->closeData)-1];
            
            $pe = 0;
            if($annualizedEPS != 0)
                $pe = $lastTradingClose/$annualizedEPS;
            $pe = round($pe,2);
            
            if($pe < 0)
            {
                $pe = "Negetive";
            }
            if(!empty($category))
            {
                $name .= '<*font=arial.ttf,size=9*> CAT:- '.$category.',';
            }

            if(!empty($market_lot))
            {
                $name .= ' LOT:- '.$market_lot.',';
            }
            
            if(!empty($qeps)){
                $name .= ' EPS('.$querterNo.'): '.$qeps.',';
            }
            
            if(!empty($pe))
            {
                $name .= ' P/E: '.$pe.'(DILUTED AND ANNUALIZED),';
            }
            
            if(!empty($companyFinPerfNav[0]['company_financial_performance']['asset_val_per_share'])){
                    $name .= ' NAV: '.$companyFinPerfNav[0]['company_financial_performance']['asset_val_per_share'].',';   
            }
            /*
            if(!empty($financialPerformance[0]['performance']['nav'])){
                if(!empty($financialPerformance[0]['performance']['nav_restat'])){
                    $name .= ' NAV: '.$financialPerformance[0]['performance']['nav_restat'].',';   
                }else{
                    $name .= ' NAV: '.$financialPerformance[0]['performance']['nav'].',';   
                }
            }
            */
            if(!empty($year_end)){
                $name .= ' YEAR END: '.$year_end;
            }
            
            

        }
        else
        {
            $name = "Sector Wise Analysis : $tickerKey";
        }
        
        $this->set('sector_name', $name);
        $textBoxObj = $m->addText(575, 350, "www.stockbangladesh.com", $timesbiPath, 20, 0xc09090, '', 0);
        $textBoxObj->setAlignment(TopRight);
        $m->addPlotAreaTitle(TopLeft, "$name");
        
        

        # We displays the current date as well as the data resolution on the next line.
        $resolutionText = "Daily";
        if ($this->resolution == 30 * 86400) {
            $resolutionText = "Monthly";
        } else if ($this->resolution == 7 * 86400) {
            $resolutionText = "Weekly";
        } else if ($this->resolution == 86400) {
            $resolutionText = "Daily";
        } else if ($this->resolution == 900) {
            $resolutionText = "15-min";
        }

        if($durationInDays == 1)
        {
            $lastTradingDay = $this->timeStamps[count($this->timeStamps)-1]+108000;
        }
        else
        {
            $lastTradingDay = $this->timeStamps[count($this->timeStamps)-1]-1970*365*24*60*60-113*24*60*60;
        }
        $lastTradingOpen  = $this->openData[count($this->openData)-1];
        $lastTradingHigh  = $this->highData[count($this->highData)-1];
        $lastTradingLow   = $this->lowData[count($this->lowData)-1];
        $lastTradingClose = $this->closeData[count($this->closeData)-1];
        $lastTradingVol   = $this->volData[count($this->volData)-1];
        $per="%";
        
        
        
        if($durationInDays == 1)
        {
            $m->addPlotAreaTitle(BottomLeft, sprintf(
            "<*font=arial.ttf,size=10*> Open: %s, High: %s, Low: %s, Close: %s, Volume: %s",$lastTradingOpen,$lastTradingHigh,$lastTradingLow,$lastTradingClose,$lastTradingVol));
        }
        else
        {
            
            $m->addPlotAreaTitle(BottomLeft, sprintf(
            "<*font=arial.ttf,size=9*>%s - Open: %s, High: %s, Low: %s, Close: %s, Volume: %s, NOS: %s, Public(%s".$strongpercentage."%s): %s", $m->formatValue(chartTime2($lastTradingDay),
            "mmm dd, yyyy"),$lastTradingOpen,$lastTradingHigh,$lastTradingLow,$lastTradingClose,$lastTradingVol,$no_of_securities,$share_percentage_public,$per,ceil(($no_of_securities*$share_percentage_public)/100)));

        }
        
        # A copyright message at the bottom left corner the title area
        $m->addPlotAreaTitle(BottomRight, "<*font=arial.ttf,size=8*>(c) StockBangladesh.com");

        #
        # Set the grid style according to user preference. In this simple demo user
        # interface, user can enable/disable grid lines. The code achieve this by setting
        # the grid color to dddddd (light grey) or Transparent. The plot area background
        # color is set to fffff0 (pale yellow).
        #
        $vGridColor = Transparent;
        if (isset($request["VGrid"]) && $request["VGrid"] == "on") {
            $vGridColor = 0xdddddd;
        }
        $hGridColor = Transparent;
        if (isset($request["HGrid"]) && $request["HGrid"] == "on") {
            $hGridColor = 0xdddddd;
        }

        
        
        $m->setPlotAreaStyle(0xF6F6F6, $hGridColor, $vGridColor, $hGridColor, $vGridColor);
        

        #
        # Set log or linear scale according to user preference
        #
        if (isset($request["LogScale"]) && $request["LogScale"] == "on") {
            $m->setLogScale(true);
        } else {
            $m->setLogScale(false);
        }

        #
        # Add the first techical indicator according. In this demo, we draw the first
        # indicator on top of the main chart.
        #
        if(isset($request["Indicator1"]))
        {
            $Indicator1 = $request["Indicator1"];
        }
        else
        {
            $Indicator1 = 'RSI';
        }
        $this->__addIndicator($m, $Indicator1, $indicatorHeight);

        #
        # Add the main chart
        #
        $m->addMainChart($mainHeight);

        #
        # Draw the main chart depending on the chart type the user has selected
        #

        if(isset($request["ChartType"]))
        {
            $chartType=$request["ChartType"];
        }
        else
        {
            $chartType='CandleStick';
        }

        if ($chartType == "Close") {
            $m->addCloseLine(0x000040);
        } else if ($chartType == "TP") {
            $m->addTypicalPrice(0x000040);
        } else if ($chartType == "WC") {
            $m->addWeightedClose(0x000040);
        } else if ($chartType == "Median") {
            $m->addMedianPrice(0x000040);
        }

        #
        # Add moving average lines.
        #
        if(isset($request["avgType1"]))
        {
            $avgType1=$request["avgType1"];
        }
        else
        {
            $avgType1='SMA';
        }

        $this->__addMovingAvg($m, $avgType1, $avgPeriod1, 0x663300);

        if(isset($request["avgType2"]))
        {
            $avgType2=$request["avgType2"];
        }
        else
        {
            $avgType2='SMA';
        }
        $this->__addMovingAvg($m, $avgType2, $avgPeriod2, 0x9900ff);
        
        if(isset($request["avgType3"]))
        {
            $avgType3=$request["avgType3"];
        }
        else
        {
            $avgType3='SMA';
        }
         $this->__addMovingAvg($m, $avgType3, $avgPeriod3, 0x2200ff);
        if(isset($request["avgType4"]))
        {
            $avgType4=$request["avgType4"];
        }
        else
        {
            $avgType4='SMA';
        }
        $this->__addMovingAvg($m, $avgType4, $avgPeriod4, 0x220f0f);

        #
        # Draw the main chart if the user has selected CandleStick or OHLC. We draw it
        # here to make sure it is drawn behind the moving average lines (that is, the
        # moving average lines stay on top.)
        #
        if ($chartType == "CandleStick") {
            $m->addCandleStick(0x33ff33, 0xff3333);
        } else if ($chartType == "OHLC") {
            $m->addHLOC(0x008800, 0xcc0000);
        }

        #
        # Add parabolic SAR if necessary
        #

        if (isset($request["ParabolicSAR"]) && $request["ParabolicSAR"] =="on") {

            $m->addParabolicSAR(0.02, 0.02, 0.2, DiamondShape, 5, 0x008800, 0x000000);
        }
        #
        # Add price band/channel/envelop to the chart according to user selection
        #

        if(isset($request["Band"]))
        {
            $band=$request["Band"];
        }
        else
        {
            $band='BB';
        }

        if ($band == "BB") {
            $m->addBollingerBand(20, 2, 0x9999ff, 0xc06666ff);
        } else if ($band == "DC") {
            $m->addDonchianChannel(20, 0x9999ff, 0xc06666ff);
        } else if ($band == "Envelop") {
            $m->addEnvelop(20, 0.1, 0x9999ff, 0xc06666ff);
        }

        #
        # Add volume bars to the main chart if necessary
        #
        if ($request["Volume"] == "on") {
            $m->addVolBars($indicatorHeight, 0x99ff99, 0xff9999, 0xc0c0c0);
        }

        #
        # Add additional indicators as according to user selection.
        #

        if(isset($request["Indicator2"]))
        {
            $Indicator2=$request["Indicator2"];
        }
        else
        {
            $Indicator2='MACD';
        }

        $this->__addIndicator($m, $Indicator2, $indicatorHeight);

        if(isset($request["Indicator3"]))
        {
            $Indicator3=$request["Indicator3"];
        }
        else
        {
            $Indicator3='None';
        }
        $this->__addIndicator($m, $Indicator3, $indicatorHeight);

        if(isset($request["Indicator4"]))
        {
            $Indicator4=$request["Indicator4"];
        }
        else
        {
            $Indicator4='None';
        }

        $this->__addIndicator($m, $Indicator4, $indicatorHeight);
        
        if(isset($request["Indicator5"]))
        {
            $Indicator5=$request["Indicator5"];
        }
        else
        {
            $Indicator5='None';
        }

        $this->__addIndicator($m, $Indicator5, $indicatorHeight);
        
        if(isset($request["Indicator6"]))
        {
            $Indicator6=$request["Indicator6"];
        }
        else
        {
            $Indicator6='None';
        }

        $this->__addIndicator($m, $Indicator6, $indicatorHeight);

        return $m;
    }

    #/ <summary>
    #/ Add a moving average line to the FinanceChart object.
    #/ </summary>
    #/ <param name="m">The FinanceChart object to add the line to.</param>
    #/ <param name="avgType">The moving average type (SMA/EMA/TMA/WMA).</param>
    #/ <param name="avgPeriod">The moving average period.</param>
    #/ <param name="color">The color of the line.</param>
    function __addMovingAvg(&$m, $avgType, $avgPeriod, $color) 
    {
        if ($avgPeriod > 1) {
            if ($avgType == "SMA") {
                $m->addSimpleMovingAvg($avgPeriod, $color);
            } else if ($avgType == "EMA") {
                $m->addExpMovingAvg($avgPeriod, $color);
            } else if ($avgType == "TMA") {
                $m->addTriMovingAvg($avgPeriod, $color);
            } else if ($avgType == "WMA") {
                $m->addWeightedMovingAvg($avgPeriod, $color);
            }
        }
    }


    #/ <summary>
    #/ Add an indicator chart to the FinanceChart object. In this demo example, the
    #/ indicator parameters (such as the period used to compute RSI, colors of the lines,
    #/ etc.) are hard coded to commonly used values. You are welcome to design a more
    #/ complex user interface to allow users to set the parameters.
    #/ </summary>
    #/ <param name="m">The FinanceChart object to add the line to.</param>
    #/ <param name="indicator">The selected indicator.</param>
    #/ <param name="height">Height of the chart in pixels</param>
    function __addIndicator(&$m, $indicator, $height) 
    {
        if ($indicator == "RSI") {
            $m->addRSI($height, 14, 0x800080, 20, 0xff6666, 0x6666ff);
        } else if ($indicator == "StochRSI") {
            $m->addStochRSI($height, 14, 0x800080, 30, 0xff6666, 0x6666ff);
        } else if ($indicator == "MACD") {
            $m->addMACD($height, 26, 12, 9, 0x0000ff, 0xff00ff, 0x008000);
        } else if ($indicator == "FStoch") {
            $m->addFastStochastic($height, 14, 3, 0x006060, 0x606000);
        } else if ($indicator == "SStoch") {
            $m->addSlowStochastic($height, 14, 3, 0x006060, 0x606000);
        } else if ($indicator == "ATR") {
            $m->addATR($height, 14, 0x808080, 0x0000ff);
        } else if ($indicator == "ADX") {
            $m->addADX($height, 14, 0x008000, 0x800000, 0x000080);
        } else if ($indicator == "DCW") {
            $m->addDonchianWidth($height, 20, 0x0000ff);
        } else if ($indicator == "BBW") {
            $m->addBollingerWidth($height, 20, 2, 0x0000ff);
        } else if ($indicator == "DPO") {
            $m->addDPO($height, 20, 0x0000ff);
        } else if ($indicator == "PVT") {
            $m->addPVT($height, 0x0000ff);
        } else if ($indicator == "Momentum") {
            $m->addMomentum($height, 12, 0x0000ff);
        } else if ($indicator == "Performance") {
            $m->addPerformance($height, 0x0000ff);
        } else if ($indicator == "ROC") {
            $m->addROC($height, 12, 0x0000ff);
        } else if ($indicator == "OBV") {
            $m->addOBV($height, 0x0000ff);
        } else if ($indicator == "AccDist") {
            $m->addAccDist($height, 0x0000ff);
        } else if ($indicator == "CLV") {
            $m->addCLV($height, 0x0000ff);
        } else if ($indicator == "WilliamR") {
            $m->addWilliamR($height, 14, 0x800080, 30, 0xff6666, 0x6666ff);
        } else if ($indicator == "Aroon") {
            $m->addAroon($height, 14, 0x339933, 0x333399);
        } else if ($indicator == "AroonOsc") {
            $m->addAroonOsc($height, 14, 0x0000ff);
        } else if ($indicator == "CCI") {
            $m->addCCI($height, 20, 0x800080, 100, 0xff6666, 0x6666ff);
        } else if ($indicator == "EMV") {
            $m->addEaseOfMovement($height, 9, 0x006060, 0x606000);
        } else if ($indicator == "MDX") {
            $m->addMassIndex($height, 0x800080, 0xff6666, 0x6666ff);
        } else if ($indicator == "CVolatility") {
            $m->addChaikinVolatility($height, 10, 10, 0x0000ff);
        } else if ($indicator == "COscillator") {
            $m->addChaikinOscillator($height, 0x0000ff);
        } else if ($indicator == "CMF") {
            $m->addChaikinMoneyFlow($height, 21, 0x008000);
        } else if ($indicator == "NVI") {
            $m->addNVI($height, 255, 0x0000ff, 0x883333);
        } else if ($indicator == "PVI") {
            $m->addPVI($height, 255, 0x0000ff, 0x883333);
        } else if ($indicator == "MFI") {
            $m->addMFI($height, 14, 0x800080, 30, 0xff6666, 0x6666ff);
        } else if ($indicator == "PVO") {
            $m->addPVO($height, 26, 12, 9, 0x0000ff, 0xff00ff, 0x008000);
        } else if ($indicator == "PPO") {
            $m->addPPO($height, 26, 12, 9, 0x0000ff, 0xff00ff, 0x008000);
        } else if ($indicator == "UO") {
            $m->addUltimateOscillator($height, 7, 14, 28, 0x800080, 20, 0xff6666,
            0x6666ff);
        } else if ($indicator == "Vol") {
            $m->addVolIndicator($height, 0x99ff99, 0xff9999, 0xc0c0c0);
        } else if ($indicator == "TRIX") {
            $m->addTRIX($height, 12, 0x0000ff);
        }
    }
    
    function __sectorData($business_segment, $startDate)
    {       
        switch ($business_segment)
        {
            case 'Bank':
                $business_segment='Bank';
                break;
            case 'Cement':
                $business_segment='Cement';
                break;
            case 'Ceramic':
                $business_segment='Ceramics Sector';
                break;

            case 'Corporate':
                $business_segment='Corporate Bond';
                break;
            case 'Debenture':
                $business_segment='Debenture';
                break;
            case 'Engineering':
                $business_segment='Engineering';
                break;
            case 'Financial':
                $business_segment='Financial Institutions';    
                break;
            case 'food':
                $business_segment='Food & Allied';
                break;
            case 'fuel':
                $business_segment='Fuel & Power';
                break;
            case 'Insurance':
                $business_segment='Insurance';
                break;
            case 'IT':
                $business_segment='IT Sector';
                break;
            case 'Jute':
                $business_segment='Jute';
                break;
            case 'Miscellaneous':
                $business_segment='Miscellaneous';
                break;
            case 'Paper':
                $business_segment='Paper & Printing';
                break;
            case 'Pharmaceutical':
                $business_segment='Pharmaceuticals & Chemicals';
                break;
            case 'Service':
                $business_segment='Services & Real Estate';
                break;
            case 'Tannery':
                $business_segment='Tannery Industries';
                break;
            case 'Textile':
                $business_segment='Textile';
                break;
             case 'Telecom':
                $business_segment='Telecommunication';
                break;
             case 'Travel':
                $business_segment='Travel & Leisure';
                break;      
            default:
                break;

        }

        /*$querystr = "SELECT c.id, c.dse_code, c.no_of_securities,c.business_segment,o.open,o.high, o.low,o.close,o.volume,UNIX_TIMESTAMP(str_to_date(date, '%d-%c-%Y')) as mydate
    FROM symbols AS c, outputs AS o
    WHERE c.dse_code != ''
    AND c.business_segment like '%$business_segment%'
    AND o.symbol = c.id
    and UNIX_TIMESTAMP(str_to_date(date, '%d-%c-%Y'))>$startDate
    ORDER BY o.id ASC"; */
        
        //$querystr = "SELECT c.id, c.dse_code, c.no_of_securities,c.business_segment,o.open,o.high, o.low,o.close,o.volume, daystamp  as mydate FROM symbols AS c, outputs AS o WHERE c.dse_code != '' AND c.business_segment like '%$business_segment%' AND o.symbol = c.id and daystamp > $startDate ORDER BY o.id ASC ";
        
        $querystr = "SELECT c.id, c.dse_code, c.no_of_securities,c.business_segment,o.open,o.high, o.low,o.close,o.volume,  UNIX_TIMESTAMP(str_to_date(date, '%d-%c-%Y')) as mydate FROM symbols AS c, outputs AS o WHERE c.dse_code != '' AND c.business_segment like '%$business_segment%' AND o.symbol = c.id and daystamp > $startDate ORDER BY o.daystamp ASC ";
        
        $allShares = $this->Symbol->query($querystr);
        
        //pr($allShares); die;
        
        $groupShares = array();
        $sectorWiseSorted = array();
        
        foreach ($allShares as $share)
        {            
            $business_seg                             = trim($share['c']['business_segment']);
            //$date                                     = $share['o']['mydate'];
            $date                                     = $share[0]['mydate'];
                        
            //if($startDate == 1)
//                $date = $date - 6 * 60 * 60;
//            else
//                $date = $date + 6 * 60 * 60;            
            
            $date = $date + 12 * 60 * 60;
            $sectorWiseSorted[$date][$business_seg][] = $share;            
        }
        
        $final = array();

        foreach ($sectorWiseSorted as $date => $allSector)
        {


            foreach ($allSector as $secotorname => $allshares)
            {
                $sectoropen   = 0;
                $sectorhigh   = 0;
                $sectorlow    = 0;
                $sectorclose  = 0;
                $sectorvolume = 0;


                foreach ($allshares as $share)
                {

                    $sectoropen   = $sectoropen   + $share['o']['open']  * $share['o']['volume'];
                    $sectorhigh   = $sectorhigh   + $share['o']['high']  * $share['o']['volume'];
                    $sectorlow    = $sectorlow    + $share['o']['low']   * $share['o']['volume'];
                    $sectorclose  = $sectorclose  + $share['o']['close'] * $share['o']['volume'];
                    $sectorvolume = $sectorvolume + $share['o']['volume'];
                }

                $final[$secotorname][$date]['secotorname']  = $secotorname;
                $final[$secotorname][$date]['date']         = $date;
                $final[$secotorname][$date]['sectoropen']   = $sectoropen;
                $final[$secotorname][$date]['sectorhigh']   = $sectorhigh;
                $final[$secotorname][$date]['sectorlow']    = $sectorlow;
                $final[$secotorname][$date]['sectorclose']  = $sectorclose;
                $final[$secotorname][$date]['sectorvolume'] = $sectorvolume;

            }
        }
        
        return ($final[$secotorname]);
    }
    
    
    function html2txt($document){
        $text=ereg_replace("[^0-9.-]", "", trim($document));
        return $text;
    }
    
    
    function updatenow($symbolId)
    {
        $this->redirect(array( 'action' => 'details/'.$symbolId )); 
        die();
        set_time_limit(180);
        require_once(WWW_ROOT . DS . 'chart'. DS .'class_http.php');
        
        $isClose = $this->Symbol->query('SELECT value FROM configuration where name=\'isclose\' ');
        $isClose = $isClose[0]['configuration']['value'];
        
        $success = 0;
        
        $code = $this->Symbol->find('first', array('conditions' => array('id='.$symbolId), 'fields' => array('dse_code')));
        $code = $code['Symbol']['dse_code'];
        
        $i = 0;

        if(!empty($symbolId))
        {
            $h = new http();
            
            $filePath = WWW_ROOT . 'temp' . DS; 
            $h->dir   = $filePath;
            
            $url = 'http://dsebd.org/displayCompany.php?name='.$code;
            
            if (!$h->fetch($url, 3600)) {
                echo "<h2>There is a problem with the http request!</h2>";
                echo $h->log;
                exit();
            }
            
            $basicInfo = http::table_into_array($h->body, 'Authorized Capital in BDT', 1, null);
            
            $outstandingCapital=trim($basicInfo[3][1]);
            $weekrange52=trim($basicInfo[3][3]);

            $faceValue=trim($basicInfo[5][1]);
            $marketLot=trim($basicInfo[5][3]);

            $totalNoOfSecurities=trim($basicInfo[7][1]);
            $businessSegment=trim($basicInfo[7][3]);

            $lastAGMData = http::table_into_array($h->body, 'Last AGM Held', 1, null);
            
            $lastAgmHeld=explode(':',$lastAGMData[0][0]);
            $lastAgmHeld=trim($lastAgmHeld[1]);

            $bonusIssue=trim($lastAGMData[1][1]);
            $rightIssue=trim($lastAGMData[3][1]);
            $yearEnd=trim($lastAGMData[5][1]);
            $reservensurplus=trim($lastAGMData[7][1]);

            $halfYearlyData = http::table_into_array($h->body, 'Half Year', 1, null);
            
            $halfYearlyEnd=explode(':',$halfYearlyData[0][0]);
            $halfYearlyEnd=trim($halfYearlyEnd[1]);

            $netTurnOver=trim($halfYearlyData[1][1]);
            $netProfitAfterTex=trim($halfYearlyData[3][1]);
            $eps=trim($halfYearlyData[5][1]);

            $otherInformationOfCompanyData = http::table_into_array($h->body, 'Other Information of the Company', 1, null);
            
            $listingYear=trim($otherInformationOfCompanyData[1][1]);
            $marketCategory=trim($otherInformationOfCompanyData[3][1]);
            $electronicShare=trim($otherInformationOfCompanyData[5][1]);
            
            if($electronicShare == 'Y')
                $electronicShare = 'Yes';
            else if($electronicShare == 'N')
                $electronicShare = 'No'; 
            
            $sharePercentageSponsor=ereg_replace("[^0-9.-]", "", trim($otherInformationOfCompanyData[7][1]));

            $govtData=$otherInformationOfCompanyData[7][2];
            $govtData=str_replace('Govt.','',$govtData);
            $sharePercentageGovt=ereg_replace("[^0-9.-]", "", trim($govtData));

            $sharePercentageInstitute=ereg_replace("[^0-9.-]", "", trim($otherInformationOfCompanyData[7][3]));
            $sharePercentageForeign =ereg_replace("[^0-9.-]", "", trim($otherInformationOfCompanyData[7][4]));
            $sharePercentagePublic =ereg_replace("[^0-9.-]", "", trim($otherInformationOfCompanyData[7][5]));

            $companyAddressData = http::table_into_array($h->body, 'Email/Web', 1, null);
            
            $address=trim($companyAddressData[0][1]);
            $address=addslashes($address);
            $contactPhone=trim($companyAddressData[2][1]);
            $fax=trim($companyAddressData[4][1]);
            $emailWebAddress=trim($companyAddressData[6][1]);

            $finance_update_time=time();

            if($symbolId)
            {
                $str = "UPDATE `symbols` SET `outstanding_capital` = '$outstandingCapital', `face_value` = '$faceValue', `category` = '$marketCategory', `market_lot` = '$marketLot', `no_of_securities` = '$totalNoOfSecurities', `business_segment` = '$businessSegment',  `listing_year` = '$listingYear', `electronic_share` = '$electronicShare', `share_percentage_director` = '$sharePercentageSponsor', `share_percentage_govt` = '$sharePercentageGovt', `share_percentage_institute` = '$sharePercentageInstitute', `share_percentage_foreign` = '$sharePercentageForeign', `share_percentage_public` = '$sharePercentagePublic', `remarks` = ' ', `address` = '$address', `contact_info` = '$contactPhone', `email_webaddress` = '$emailWebAddress', `last_agm_held` = '$lastAgmHeld',
        `bonus_issue` = '$bonusIssue', `right_issue` = '$rightIssue', `year_end` = '$yearEnd', `reserve_and_surplus` = '$reservensurplus', `half_year_end` = '$halfYearlyEnd', `net_turn_over` = '$netTurnOver', `net_profit_after_tax` = '$netProfitAfterTex', `finance_update_time` = '$finance_update_time', `eps_in_bd` = '$eps' WHERE `id` =$symbolId ;";
            }

            $financialPerformanceData = http::table_into_array($h->body, 'Net Asset Value Per Share', 1, null);

            unset($financialPerformanceData[0]);
            unset($financialPerformanceData[1]);
            unset($financialPerformanceData[2]);

            $fundamental_data=array();

            foreach ($financialPerformanceData as $year)
            {
                $fin_year=trim($year[0]);
                $temp=array();
                $temp['symbol_id'] = $symbolId;
                $temp['code']=$code;
                $temp['fin_year'] = $this->html2txt(trim($year[0]));
                $temp['earning_per_share'] = $this->html2txt(trim($year[1]));
                $temp['eps_extra_inc']=$this->html2txt($year[2]);
                $temp['diluted_earning_per_share'] = $this->html2txt($year[3]);
                $temp['eps_extra_inc_restat']=$this->html2txt($year[4]);
                $temp['asset_val_per_share'] = $this->html2txt($year[5]);
                $temp['restated_net_asset_value_per_share'] = $this->html2txt($year[6]);

                $net_profit_cont_op = $year[7];
                $temp['profit_after_tax'] = $this->html2txt($net_profit_cont_op);
                $temp['net_profit_extra_inc']=$this->html2txt($year[8]);
                $fundamental_data[$fin_year]=$temp;
            }

            $financialPerformanceData2 = http::table_into_array($h->body, 'Year End P/E ', 1, null);
            unset($financialPerformanceData2[0]);
            unset($financialPerformanceData2[1]);
            unset($financialPerformanceData2[2]);

            foreach ($financialPerformanceData2 as $year)
            {
                $fin_year=$this->html2txt($year[0]);
                $fundamental_data[$fin_year]['price_earning_ratio']=$this->html2txt($year[1]);
                $fundamental_data[$fin_year]['year_end_pe_extra_inc']=$this->html2txt($year[2]);
                $fundamental_data[$fin_year]['dividend']=$this->html2txt($year[3]);
                $fundamental_data[$fin_year]['dividend_yield']=$this->html2txt($year[4]);
            }

            $financialPerformanceData3 = http::table_into_array($h->body, 'Particulars', 1, null);
            $fin_year=trim($financialPerformanceData3[2][0]);
            $fin_year=substr($fin_year, 0, 4);
            //pr($financialPerformanceData3);
                                    
            unset($financialPerformanceData3[0]);
            unset($financialPerformanceData3[1]);
            unset($financialPerformanceData3[2]);
            
            $yearList = array_keys($fundamental_data);
            if (!in_array($fin_year, $yearList)){
                $fundamental_data[$fin_year]['symbol_id'] = $symbolId;
                $fundamental_data[$fin_year]['code'] = $code;
                $fundamental_data[$fin_year]['fin_year'] = $fin_year;    
            }
            
            $fundamental_data[$fin_year]['q1_turn_over']=$this->html2txt($financialPerformanceData3[3][1]);
            $fundamental_data[$fin_year]['q2_turn_over']=$this->html2txt($financialPerformanceData3[3][2]);
            $fundamental_data[$fin_year]['q3_turn_over']=$this->html2txt($financialPerformanceData3[3][3]);
            $fundamental_data[$fin_year]['q4_turn_over']=$this->html2txt($financialPerformanceData3[3][4]);

            $fundamental_data[$fin_year]['q1_net_prft_aft_tx_cont_op']=$this->html2txt($financialPerformanceData3[4][1]);
            $fundamental_data[$fin_year]['q2_net_prft_aft_tx_cont_op']=$this->html2txt($financialPerformanceData3[4][2]);
            $fundamental_data[$fin_year]['q3_net_prft_aft_tx_cont_op']=$this->html2txt($financialPerformanceData3[4][3]);
            $fundamental_data[$fin_year]['q4_net_prft_aft_tx_cont_op']=$this->html2txt($financialPerformanceData3[4][4]);

            $fundamental_data[$fin_year]['q1_net_prft_aft_tx_extra_inc']=$this->html2txt($financialPerformanceData3[5][1]);
            $fundamental_data[$fin_year]['q2_net_prft_aft_tx_extra_inc']=$this->html2txt($financialPerformanceData3[5][2]);
            $fundamental_data[$fin_year]['q3_net_prft_aft_tx_extra_inc']=$this->html2txt($financialPerformanceData3[5][3]);
            $fundamental_data[$fin_year]['q4_net_prft_aft_tx_extra_inc']=$this->html2txt($financialPerformanceData3[5][4]);

            $fundamental_data[$fin_year]['q1_eps_cont_op']=$this->html2txt($financialPerformanceData3[6][1]);
            $fundamental_data[$fin_year]['q2_eps_cont_op']=$this->html2txt($financialPerformanceData3[6][2]);
            $fundamental_data[$fin_year]['q3_eps_cont_op']=$this->html2txt($financialPerformanceData3[6][3]);
            $fundamental_data[$fin_year]['q4_eps_cont_op']=$this->html2txt($financialPerformanceData3[6][4]);

            $fundamental_data[$fin_year]['q1_eps_extra_inc']=$this->html2txt($financialPerformanceData3[7][1]);
            $fundamental_data[$fin_year]['q2_eps_extra_inc']=$this->html2txt($financialPerformanceData3[7][2]);
            $fundamental_data[$fin_year]['q3_eps_extra_inc']=$this->html2txt($financialPerformanceData3[7][3]);
            $fundamental_data[$fin_year]['q4_eps_extra_inc']=$this->html2txt($financialPerformanceData3[7][4]);    
                           
            $result = $this->Symbol->query($str);
            
            //pr($fundamental_data); die;
            foreach ($fundamental_data as $eachYear)
            {
                //pr($eachYear);
                $symbol   = $eachYear['symbol_id'];
                $fin_year = $eachYear['fin_year'];
                $result   = $this->Symbol->query("select id from  company_financial_performance where symbol_id like '$symbolId' and fin_year='$fin_year' ");
                
                $query='';
                
                $id = $result[0]['company_financial_performance']['id'];
                if($id)
                {
                    $query.="UPDATE `company_financial_performance` SET `symbol_id`='$symbolId'";
                }
                else
                {
                    $query.="INSERT INTO `company_financial_performance` ( ";
                }

                $fieldPart="`id`";
                $valuePart=' VALUES (NULL';
                foreach ($eachYear as $field=>$value)
                {
                    if($id)
                    {
                        if($field!='symbol_id')
                        {
                            $query.=",`$field` = '$value' ";
                        }
                    }
                    else
                    {
                        $fieldPart.=",`$field`";
                        $valuePart.=",'$value'";
                    }
                }
                
                if(!$id)
                {
                    $query.=$fieldPart.")".$valuePart.");";
                }
                else
                {
                    $query.="where id=$id;";
                }                
                $doUpdate = $this->Symbol->query($query);    
                
                if($fundamental_data[$fin_year]['q1_eps_cont_op']=='n/a') {
                    $fundamental_data[$fin_year]['q1_eps_cont_op'] = '';
                }
                if($fundamental_data[$fin_year]['q2_eps_cont_op']=='n/a') {
                    $fundamental_data[$fin_year]['q2_eps_cont_op'] = '';
                }
                if($fundamental_data[$fin_year]['q3_eps_cont_op']=='n/a') {
                    $fundamental_data[$fin_year]['q3_eps_cont_op'] = '';
                }
                if($fundamental_data[$fin_year]['q4_eps_cont_op']=='n/a') {
                    $fundamental_data[$fin_year]['q4_eps_cont_op'] = '';
                }
                
                $companyEpsUpdateQuery="UPDATE `symbols` SET `q1`='".$fundamental_data[$fin_year]['q1_eps_cont_op']."',`q2`='".$fundamental_data[$fin_year]['q2_eps_cont_op']."',`q3`='".$fundamental_data[$fin_year]['q3_eps_cont_op']."',`q4`='".$fundamental_data[$fin_year]['q4_eps_cont_op']."' WHERE id=$symbolId";
                $doUpdateSymbolEps = $this->Symbol->query($companyEpsUpdateQuery);    
                            
            }
        }
        
        $this->redirect(array( 'action' => 'details/'.$symbolId )); 
    }
    
    
    function detail_feedback($company_name = '')
    {
        //Configure::write('debug',3);
        $this->layout = 'default-one';
        
        $feedback_type = array('suggestion'=>'Suggestion','need to update'=>'Need to update','others'=>'Others');
        $this->set('feedback_type',$feedback_type);
        $this->set('company_name',$company_name);
        
        if(!empty($this->data))
        {
            if($this->data['Symbol']['email'] == '')
            {
                $this->Session->setFlash('Please Enter your email address');
                $this->redirect(array('action' => 'detail_feedback'));
            }
            
            $name         = $this->data['Symbol']['name'];            
            $company_name = $this->data['Symbol']['company_name'];
            $email        = $this->data['Symbol']['email'];
            $subject      = $this->data['Symbol']['subject'];
            $body         = $this->data['Symbol']['body'];
            
            $str = "SELECT id FROM symbols WHERE dse_code='$company_name'";
            $result = $this->Symbol->query($str);
            $id = $result[0]['symbols']['id'];
            // SET EMAIL DATA
            $userInfo['name']         = $name;
            $userInfo['email']        = $email;            
            $userInfo['subject']      = $subject;
            $userInfo['body']         = $body;
            $userInfo['company_name'] = $company_name;
            
            
            // SET ACTIVATION CODE TO ADDRESS2 - FOR TEMPORARY USAGE
            
            $this->Session->setFlash('Thanks for your suggestion.');
            $this->testmail($userInfo);
            $this->redirect(array('controller' => 'symbols', 'action' => 'details/'.$id));
            
        }
    }
    
    
    function testmail($userData = array())
    {
        //Configure::write('debug',3);        
         //$toUser = $this->User->find(array('User.id'=>$id)); 
         $this->Email->from =$userData['email']; 
         
         $this->Email->to = 'bug@stockbangladesh.com';
         $this->Email->bcc = array('saiham_052@yahoo.com');
         
         $this->Email->template = 'empty_email';
         $this->Email->sendAs = 'both';
         $this->Email->subject = $userData['subject'];
         
         $textBody = '<br /><br />';
         $textBody .= 'Company Name:<b>'.$userData['company_name'].'</b><br /><br />';
         $textBody .= $userData['body'];
         $textBody .= '<br /><br />Sincerely,<br /><br />'.$userData['name'];

         $this->set('text_body', $textBody);
         $this->Email->send();          
    }
    
    function sectorwisename()
    {
        //$this->layout ='second';        
        $this->pageTitle = 'Stock Bangladesh :: Company List - Sector Wise'; 
                
        $companyList = $this->Symbol->find('all', 
        array('conditions' => array('Symbol.dse_code != \'\' '), 'fields' => array('Symbol.id', 'Symbol.dse_code', 'Symbol.name', 'Symbol.business_segment'), 'order' => array('Symbol.business_segment ASC')));        
        //echo "<pre>";
        //print_r($companyList);
        $tempList = array();
        $tempListForNumericCode = array();
        
        $tempHeader  = '';
        $firstHeader = true;
        $sectorArr = array();
        
        if(!empty($companyList)) {
            foreach($companyList as $company) {                
                if($company['Symbol']['business_segment'] != '') {
                    $sectorArr[$company['Symbol']['business_segment']] = $company['Symbol']['business_segment'];
                }                                 
            }
        }
        
        return $sectorArr;
        /*echo "<pre>";
        print_r($sectorArr);
        die;*/
    }
    
    function eventcalender()
    {
        $companyList = $this->Symboladjustment->find('all',array('conditions' => array('Symboladjustment.date != 28-05-2011 AND Symboladjustment.active=1'), 'order' => array('Symboladjustment.datestamp DESC')));
        
        $dataArr = array();
        foreach($companyList AS $data)
        {        
            $dataArr[$data['Symboladjustment']['date']][]= $data['Symboladjustment'];
        }
        
        //if(isset($this->params['requested']))
         return $dataArr;
        
    }
    
    function eventsearch($company = '')
    {
        $this->layout ='default-one';
        $eventdata = $this->eventcalender();
        
        /*echo "<pre>";
        print_r($eventdata);
        echo "</pre>";*/
        if(isset($_REQUEST['company']))
        {
            $company_name = mysql_escape_string($_REQUEST['company']);
            $companyList = $this->Symboladjustment->find('all', array('conditions' => array('Symboladjustment.code ="'.$company_name.'" '), 'order' => array('Symboladjustment.datestamp DESC')));
            if(count($companyList))
                $this->set('companydata',$companyList);
            else
            {                
                $companyList = $this->Symbol->find('all', array('conditions' => array('Symbol.dse_code LIKE "'.substr($company_name,0,1).'%" '),'fields' => array('Symbol.id', 'Symbol.dse_code', 'Symbol.name', 'Symbol.business_segment'), 'order' => array('Symbol.dse_code ASC')));
                                
                $this->set('companyList',$companyList);
            }
        }
        else if(isset($company) AND $company != 'seeall')
        {
            $companyList = $this->Symboladjustment->find('all', array('conditions' => array('Symboladjustment.code ="'.$company.'" '), 'order' => array('Symboladjustment.datestamp DESC')));
            if(count($companyList))
                $this->set('companydata',$companyList);
        }
        else if(isset($company) AND $company == 'seeall')
        {
            $this->set('eventall',$eventdata);
        }
    }
    function companyquote($company = '')
    {
        //Configure::write('debug',3);
        $this->layout ='default-one';
        if(isset($_REQUEST['company']))
        {
            $company_name = mysql_escape_string($_REQUEST['company']);
            $companyList = $this->Symbol->find('first', array('conditions' => array('dse_code ="'.$company_name.'" ')));
            if(!empty($companyList))
            {
                $this->redirect('details/'.$companyList['Symbol']['id']);
            }
            else
            {                
            $companyList = $this->Symbol->find('all', array('conditions' => array('Symbol.dse_code LIKE "'.$company_name.'%" '),'fields' => array('Symbol.id', 'Symbol.dse_code', 'Symbol.name', 'Symbol.business_segment'), 'order' => array('Symbol.dse_code ASC')));
                if(count($companyList)==1)
                {
                    $this->redirect('details/'.$companyList[0]['Symbol']['id']);
                }else{
                    $this->set('companyList',$companyList);
                }
            }
            
        }
      
        
    }
    function memcacheClear()
    {
        //$this->layout ='second';        
        $memcache = new Memcache;
        $memcache->connect('localhost', 11211) or die ("Could not connect");
        $memKey  = md5('symbolListDOTORG');
        $memData = $this->Symbol->find('list', array('conditions' => array(' Symbol.dse_code != \'\' ','Symbol.inactive=\'No\'','Symbol.otc_market=\'No\''), 'fields' => array('Symbol.dse_code'), 'order' => ' Symbol.dse_code ASC '));
        /*echo '<pre>';
        print_r($memData);*/
        
        $memcache->set($memKey, $memData, MEMCACHE_COMPRESSED, 86400);
        
        echo "memcache has been cleared successfully.";
        die;
    }
    
   function __calculate_peg($symbol = '') 
   {
     //Configure::write('debug',3);
     //$this->layout = 'default-one';
     $symbolArr = $this->Symbol->find('first', array ('conditions' => array ('id='.$symbol ), 'fields' => array ('id','dse_code','lasttradeprice','face_value','yclose','bonus_issue','right_issue','q1','q2','q3','q4'), 'order'=>'id ASC'));
     
     $performanceSql = "SELECT fin_year, symbol_id,code,earning_per_share FROM company_financial_performance WHERE earning_per_share!='' AND fin_year >=2008 AND symbol_id = $symbol ORDER BY symbol_id ASC";
     $performanceArr = $this->Symbol->query($performanceSql);
     
     foreach($performanceArr as $arr)
     {
        $symbol_id = $arr['company_financial_performance']['code'];
        $performance[$symbol_id][] = $arr;
     }
     
     $outerloopcount = 0;
     foreach($performance as $symbol=>$newArr)
     {
         $total_diff = 0;
         $outerloopcount++;
         arsort($newArr); ///sorted by financial year DESC
         $prevEPS = 0;
         $count =0;
         foreach($newArr as $arr)
         {
             //$outerloopcount++;
             if($prevEPS == 0)
             {
                 $EPSforPE[$symbol] = (float)$arr['company_financial_performance']['earning_per_share'];
                 $EPS = (float)$arr['company_financial_performance']['earning_per_share'];
             }
             if($prevEPS!=0)
             {
                $count++;
                $total_year[$symbol] = $count;
                $year = $arr['company_financial_performance']['fin_year'];
                $EPS = (float)$arr['company_financial_performance']['earning_per_share'];
                
                if($EPS > (5*$prevEPS))
                {
                   $EPS = $EPS/10;
                }
                $diff[$symbol] = (($prevEPS - $EPS)/$EPS)*100; 
             }
             $prevEPS = $EPS;
             if($count == 1)
             break;
         }
         
     }
     
       if(!empty($diff[$symbol]))
       {
           
           if($EPSforPE[$symbol] ==0)
           $pe[$symbol] = 0;
           else
           $pe[$symbol] = $symbolArr['Symbol']['lasttradeprice'] / $EPSforPE[$symbol];
           if (isset($_GET['alphsort']) && $_GET['alphsort']!='')
           {
              $PEGratio[$symbol]['name']     =  $symbol;
              $PEGratio[$symbol]['pegratio'] =  $pe[$symbol]/$diff[$symbol];
           }
           if (isset($_GET['paysort']) && $_GET['paysort']!='')
           {
              $PEGratio[$symbol]['pegratio'] =  $pe[$symbol]/$diff[$symbol];
              $PEGratio[$symbol]['name']     =  $symbol;
           }
           $PEGratio[$symbol]['pegratio'] =  $pe[$symbol]/$diff[$symbol];
           $PEGratio[$symbol]['name']     =  $symbol;
           
       }
     
     return $PEGratio[$symbol]['pegratio'];
     
   }
   
   function __calculate_sector_pe($category = '') {
       set_time_limit(0);
       //Configure::write('debug',3);
       //pr($category);
       $SymbolArr = $this->Symbol->find( 'all', array ('conditions' => array ('inactive=\'No\' AND otc_market=\'No\'  AND corporate_declaration_restriction=0  AND category!=\'Z\' AND business_segment LIKE \'%'.$category.'%\' ' ), 'fields' => array ('id','dse_code','lasttradeprice','no_of_securities','business_segment','q1','q2','q3','q4','category' ) ) );//'business_segment ="'.$sector.'" AND 
        $dataArray=array();
        $eps=0;
        $market_cap=0;
        $market_eps=0;
        
        if($category!="Mutual Funds" && $category!="Corporate Bond" ){
        $dataArray[$category]["price_share"]=0;
        $dataArray[$category]["eps_share"]=0;
            foreach($SymbolArr as $symbol){
                if($symbol["Symbol"]["q4"]!=0)$eps=(float)$symbol["Symbol"]["q4"];
                else if($symbol["Symbol"]["q3"]!=0)$eps=(float)$symbol["Symbol"]["q3"]*(4/3);
                else if($symbol["Symbol"]["q2"]!=0)$eps=(float)$symbol["Symbol"]["q2"]*2;
                else if($symbol["Symbol"]["q1"]!=0)$eps=(float)$symbol["Symbol"]["q1"]*4;
                $dataArray[$category]["price_share"]+=$symbol["Symbol"]["lasttradeprice"]*$symbol["Symbol"]["no_of_securities"];
                $dataArray[$category]["eps_share"]+=$symbol["Symbol"]["no_of_securities"]*$eps;
                $market_cap+=$symbol["Symbol"]["lasttradeprice"]*$symbol["Symbol"]["no_of_securities"];
                $market_eps+=$symbol["Symbol"]["no_of_securities"]*$eps;
            }
        }
        return $dataArray[$category]['price_share']/$dataArray[$category]['eps_share'];
       
    }
    
    function __calculate_sector_beta($sector = '')
    {
        //Configure::write('debug',3);
        
        $SymbolArr = $this->Symbol->find( 'all', array ('conditions' => array ('business_segment LIKE"%'.$sector.'%" AND inactive=\'No\' AND otc_market=\'No\'' ), 'fields' => array ('id','dse_code','lasttradeprice','no_of_securities' ) ) );
        $total_info = array();
        $sectorwise_marketCap = array();
        $mcapSector =0;
        foreach($SymbolArr as $symbol)
        {
            $sym = $symbol['Symbol']['id'] ;
            $individual_mcap[$sym] =  $symbol['Symbol']['lasttradeprice']*$symbol['Symbol']['no_of_securities'];
            $mcap = $symbol['Symbol']['lasttradeprice']*$symbol['Symbol']['no_of_securities'];     
            $beta_info = $this->__betacoefficient($sym);
            $individual_beta[$sym] = $beta_info[$sym]['beta'];
            $mcapSector += $mcap;
            $sectorwise_marketCap = $mcapSector; 
        }
        
        $individual_weight_beta = 0;
        foreach($individual_mcap as $symbol=>$mcapital)
        {
           $individual_weight_beta += ($mcapital/$sectorwise_marketCap)*$individual_beta[$symbol] ;
        }
        $sectoral_beta = $individual_weight_beta ;
        return $sectoral_beta;
        
    }
    
   function trading_details($symbolId = '') 
    {
        //Configure::write('debug',3);
        $this->layout ='default-bodyonly'; 
        $this->pageTitle = 'Stock Bangladesh :: Company Details'; 
        
        $this->set('key',$symbolId);
        $this->Symbol->id = $symbolId;
        $shareInfo = $this->Symbol->read();
        $face_value = $shareInfo['Symbol']['face_value'];
        
        
        if($shareInfo['Symbol']['q1']){
            $shareInfo['Symbol']['eps_in_bd'] = $shareInfo['Symbol']['q1'];
            $shareInfo['Symbol']['quarter'] = "Q1";
        }
        if($shareInfo['Symbol']['q2']){
            $shareInfo['Symbol']['eps_in_bd'] = $shareInfo['Symbol']['q2'];
            $shareInfo['Symbol']['quarter'] = "Q2";
        }
        if($shareInfo['Symbol']['q3']){
            $shareInfo['Symbol']['eps_in_bd'] = $shareInfo['Symbol']['q3'];
            $shareInfo['Symbol']['quarter'] = "Q3";
        }
        if($shareInfo['Symbol']['q4']){
            $shareInfo['Symbol']['eps_in_bd'] = $shareInfo['Symbol']['q4'];  
            $shareInfo['Symbol']['quarter'] = "Q4";
        }
        
        $this->set('share_info', $shareInfo);
        $this->set('symbol_id', $symbolId);
        
        // get Last trade price
        $this->DataBank->recursive = -1;
        
        
        $dseBank = $this->Symbol->query('SELECT dgen,dsi, issuetraded, totalvolume FROM market_summeries ORDER BY id DESC LIMIT 2');
        $dseBank = $dseBank[1];
        $this->set('dse_info', $dseBank);
        
        $dataBank = $this->Symbol->query('SELECT open, high, low, close, volume, date FROM outputs WHERE symbol=\''.$symbolId.'\' ORDER BY id DESC LIMIT 50');
        $dataBankLast = $dataBank[0];
        $this->set('databank_info', $dataBankLast);
        
        $total50dayVolume = 0;
        foreach($dataBank as $arr)
        {
           $total50dayVolume+= $arr['outputs']['volume'];
        }
        
        $avg50dayVolume = $total50dayVolume/50;
        $this->set('avg50dayVolume',$avg50dayVolume);
        //die;
                 
        $lastTradePrice = $shareInfo['Symbol']['lasttradeprice'];        
        $yClose         = $shareInfo['Symbol']['yclose'];
        
        if($yClose == 0) {
            $todayChange    = 0;
            $todayChangePer = 0;
        } else {
            $todayChange    = $lastTradePrice - $yClose;
            $todayChangePer = ( $todayChange / $yClose ) * 100; 
        }
        $this->set('today_change', $todayChange);
        $this->set('today_change_per', $todayChangePer);
                 
        $corporate_info = $this->Symbol->query('SELECT * FROM corporate_action WHERE symbol ='.$symbolId.' AND active=1 ORDER BY datestamp ASC');
        $corporate_arr = array();
        //pr($corporate_info);
        foreach($corporate_info as $corporate)
        {
            if($corporate['corporate_action']['action'] == 'cashdiv')
                {
                    $corporate_arr['cashdiv'] = $corporate;
                    $value = $corporate['corporate_action']['value'];
                    $actiondate = $corporate['corporate_action']['datestamp'];
                    $adjustmentFactor=$face_value*$value/100;
                    
                    $max52 = $this->Symbol->query('select MAX(high) as high52, daystamp as highDate from outputs WHERE symbol=\''.$symbolId.'\' AND (TO_DAYS(NOW()) - TO_DAYS(FROM_UNIXTIME(daystamp)) <=365) GROUP BY symbol');
                    if($max52[0]['outputs']['highDate']<$actiondate)
                    $this->set('max52', $max52[0][0]['high52']-$adjustmentFactor);
                    else 
                    $this->set('max52', $max52[0][0]['high52']);
                    
                    $min52 = $this->Symbol->query('select MIN(low) as low52, daystamp as lowDate from outputs  WHERE symbol=\''.$symbolId.'\' AND (TO_DAYS(NOW()) - TO_DAYS(FROM_UNIXTIME(daystamp)) <=365) GROUP BY symbol');
                    /*if($min52[0]['outputs']['lowDate']<$actiondate)
                    $this->set('min52', $min52[0][0]['low52']-$adjustmentFactor);
                    else */
                    $this->set('min52', $min52[0][0]['low52']);
                }
            if($corporate['corporate_action']['action'] == 'stockdiv')
            {
                $corporate_arr['stockdiv'] = $corporate;
                $value = $corporate['corporate_action']['value'];
                $actiondate = $corporate['corporate_action']['datestamp'];
                $adjustmentFactor=(100+$value)/100;
                
                $max52 = $this->Symbol->query('select MAX(high) as high52, daystamp as highDate from outputs WHERE symbol=\''.$symbolId.'\' AND (TO_DAYS(NOW()) - TO_DAYS(FROM_UNIXTIME(daystamp)) <=365) GROUP BY symbol');
                if($max52[0]['outputs']['highDate']<$actiondate)
                $this->set('max52', $max52[0][0]['high52']/$adjustmentFactor);
                else 
                $this->set('max52', $max52[0][0]['high52']);
                
                $min52 = $this->Symbol->query('select MIN(low) as low52, daystamp as lowDate from outputs  WHERE symbol=\''.$symbolId.'\' AND (TO_DAYS(NOW()) - TO_DAYS(FROM_UNIXTIME(daystamp)) <=365) GROUP BY symbol');
                /*if($min52[0]['outputs']['lowDate']<$actiondate)
                $this->set('min52', $min52[0][0]['low52']/$adjustmentFactor);
                else */
                $this->set('min52', $min52[0][0]['low52']);
            }
            if($corporate['corporate_action']['action'] == 'rightshare')
            {
                $corporate_arr['rightshare'] = $corporate;
                $value = $corporate['corporate_action']['value'];
                $premium = $corporate['corporate_action']['premium'];
                $actiondate = $corporate['corporate_action']['datestamp'];
                
                $adjustmentFactor1=(100+$value)/100;
                $adjustmentFactor=($premium+$face_value)-(($premium+$face_value)/$adjustmentFactor1);
                
                $max52 = $this->Symbol->query('select MAX(high) as high52, daystamp as highDate from outputs WHERE symbol=\''.$symbolId.'\' AND (TO_DAYS(NOW()) - TO_DAYS(FROM_UNIXTIME(daystamp)) <=365) GROUP BY symbol');
                if($max52[0]['outputs']['highDate']<$actiondate)
                $this->set('max52', ($max52[0][0]['high52']+$adjustmentFactor1)/$adjustmentFactor);
                else 
                $this->set('max52', $max52[0][0]['high52']);
                
                $min52 = $this->Symbol->query('select MIN(low) as low52, daystamp as lowDate from outputs  WHERE symbol=\''.$symbolId.'\' AND (TO_DAYS(NOW()) - TO_DAYS(FROM_UNIXTIME(daystamp)) <=365) GROUP BY symbol');
                /*if($min52[0]['outputs']['lowDate']<$actiondate)
                $this->set('min52', ($min52[0][0]['low52']+$adjustmentFactor1)/$adjustmentFactor);
                else */
                $this->set('min52', $min52[0][0]['low52']);
                
            }
            if($corporate['corporate_action']['action'] == 'split')
            {
                $corporate_arr['split'] = $corporate;
                $value = $corporate['corporate_action']['value'];
                $actiondate = $corporate['corporate_action']['datestamp'];
                $adjustmentFactor = $value;
                
                $max52 = $this->Symbol->query('select MAX(high) as high52, daystamp as highDate from outputs WHERE symbol=\''.$symbolId.'\' AND (TO_DAYS(NOW()) - TO_DAYS(FROM_UNIXTIME(daystamp)) <=365) GROUP BY symbol');
                if($max52[0]['outputs']['highDate']<$actiondate)
                $this->set('max52', ($max52[0][0]['high52']/$adjustmentFactor));
                else 
                $this->set('max52', $max52[0][0]['high52']);
                
                $min52 = $this->Symbol->query('select MIN(low) as low52, daystamp as lowDate from outputs  WHERE symbol=\''.$symbolId.'\' AND (TO_DAYS(NOW()) - TO_DAYS(FROM_UNIXTIME(daystamp)) <=365) GROUP BY symbol');
                /*if($min52[0]['outputs']['lowDate']<$actiondate)
                $this->set('min52', ($min52[0][0]['low52']/$adjustmentFactor));
                else */
                $this->set('min52', $min52[0][0]['low52']);
            }
        }
        /*pr($corporate_arr);
        die;*/
        $this->set('corporate_info',$corporate_arr);
        /*pr($corporate_arr);
        die;*/
        
        $sector = $shareInfo['Symbol']['business_segment'];
        $this->set('sector',$sector);
        //pr($sector);
        $dse_code = $shareInfo['Symbol']['dse_code'];
        
        if(($sector == 'Bank')||($sector == 'Financial Institutions'))  ///bank
        {
            $companyPerformance = $this->Symbol->query('SELECT year, profit_after_tax as net_income,interest_income as revenue, total_operating_income as operating_income, net_operating_income as net_operating_income, profit_before_tax as earning_before_tax,net_interest_income as net_revenue, statutory_reserve as free_reserve FROM bank_income_statements as income_statement WHERE organization_name =\''.$dse_code.'\' ORDER BY year DESC');
            $this->set('companyPerformance', $companyPerformance);
            
            $companyBalance = $this->Symbol->query('SELECT year, total_assets ,total_liabilities, total_shareholders_equity as total_equity, (borrowing_from_other_banks_financial_institutes+0) as total_debt FROM bank_balance_sheets as balance_sheet WHERE organization_name =\''.$dse_code.'\' ORDER BY year DESC');
            $this->set('companyBalance', $companyBalance);
            
            $companyCashFlow = $this->Symbol->query('SELECT year, net_change_in_cash_and_cash_equivalents as net_cash_flow, net_cash_flows_from_operating_activities as operating_cash_flow, dividend_paid as dividend_paid FROM bank_cashflows as cash_flow WHERE organization_name =\''.$dse_code.'\' ORDER BY year DESC');
            $this->set('companyCashFlow', $companyCashFlow);
            
        }
        else if(($sector == 'Insurance')) ////insurance
        {
            $companyPerformance = $this->Symbol->query('SELECT year, (balance_for_the_year_carried_forward - provision_for_the_income_tax) as net_income,total_income as revenue, total_income as operating_income, balance_for_the_year_carried_forward as net_operating_income, balance_for_the_year_carried_forward as earning_before_tax,t_profit_loss_transferred as net_revenue, general_reserve_fund as free_reserve FROM general_insurance_income_statements as income_statement WHERE company_name =\''.$dse_code.'\' ORDER BY year DESC');
            $this->set('companyPerformance', $companyPerformance);
            
            $companyBalance = $this->Symbol->query('SELECT year, total_assets ,(deferred_liability_for_gratuity+premium_deposit_cover_notes+total_other_liabilities_and_provisions)as total_liabilities, (total_capital+total_reserve_or_contingency_accounts+total_balance_of_funds_and_accounts) as total_equity, (loans_from_bank+loans_and_advances+bank_overdraft) as total_debt FROM general_insurance_balance_sheets as balance_sheet WHERE company_name =\''.$dse_code.'\' ORDER BY year DESC');
            $this->set('companyBalance', $companyBalance);
            
            $companyCashFlow = $this->Symbol->query('SELECT year, increase_decrease_in_cash_cash_equivallent as net_cash_flow, net_cash_flows_from_operating_activities as operating_cash_flow, dividend_paid as dividend_paid FROM general_insurance_direct_cashflows as cash_flow WHERE company_name =\''.$dse_code.'\' ORDER BY year DESC');
            $this->set('companyCashFlow', $companyCashFlow);
            //pr($companyPerformance);
            //die;
        }
        /*else if(($sector == 'Financial Institutions')) ////finance
        {
            $companyPerformance = $this->Symbol->query('SELECT year, t_profit_after_tax as net_income,t_interest_income as revenue, (t_interest_income+interest_expense+income_from_loans_and_advances+interest_income_on_house_financing+other_operating_income+income_from_merchant_banking+gain_on_sale_of_share+t_lease_income+total_income_from_others+others_opt1+others_opt2+others_opt3 ) as operating_income, net_operating_income as net_operating_income, t_profit_before_tax as earning_before_tax,t_interest_income as net_revenue, statutory_reserve as free_reserve FROM finance_income_statement as income_statement WHERE company_name =\''.$dse_code.'\' ORDER BY year DESC');
            $this->set('companyPerformance', $companyPerformance);
            pr($companyPerformance);
            
            $companyBalance = $this->Symbol->query('SELECT year, total_assets ,total_liabilities, total_equity as total_equity, (t_short_term_loans_and_bank_overdraft+long_term_loan_current_portion) as total_debt FROM finance_balance_sheet as balance_sheet WHERE company_name =\''.$dse_code.'\' ORDER BY year DESC');
            $this->set('companyBalance', $companyBalance);
            
            $companyCashFlow = $this->Symbol->query('SELECT year, net_change_in_cash_and_cash_equivalents as net_cash_flow, net_cashflow_from_operating_activities as operating_cash_flow FROM finance_cashflow as cash_flow WHERE company_name =\''.$dse_code.'\' ORDER BY year DESC');
            $this->set('companyCashFlow', $companyCashFlow);
        }*/
        else{              //////other company
            $companyPerformance = $this->Symbol->query('SELECT year, profit_after_tax as net_income,net_sales as revenue, total_operating_profit as operating_income, net_profit_before_wppf as net_operating_income, net_profit_before_tax as earning_before_tax,gross_profit as net_revenue, general_reserve as free_reserve FROM company_income_statements as income_statement WHERE company_name =\''.$dse_code.'\' ORDER BY year DESC');
            $this->set('companyPerformance', $companyPerformance);
            $companyBalance = $this->Symbol->query('SELECT year, total_assets ,total_liabilities, total_equity, (t_short_term_loans_and_bank_overdraft + t_long_term_loans) as total_debt FROM company_balance_sheets as balance_sheet WHERE company_name =\''.$dse_code.'\' ORDER BY year DESC');
            $this->set('companyBalance', $companyBalance);
            $companyCashFlow = $this->Symbol->query('SELECT year, net_cash_flow_for_the_year as net_cash_flow, net_cash_flows_from_operating_activities as operating_cash_flow, dividend_paid as dividend_paid FROM company_cashflows as cash_flow WHERE company_name =\''.$dse_code.'\' ORDER BY year DESC');
            $this->set('companyCashFlow', $companyCashFlow);
        }
        
        $beta = $this->__betacoefficient($symbolId);
        $this->set('beta',$beta[$symbolId]['beta']);
        $pegRatio = $this->__calculate_peg($symbolId);
        $this->set('peg',$pegRatio);
        $sector_pe = $this->__calculate_sector_pe($sector);
        $this->set('sector_pe',$sector_pe);
        $sector_beta = $this->__calculate_sector_beta($sector);
        $this->set('sector_beta',$sector_beta);
        
        
    }
    function comparison_chart($symbol_id = '')
    {
        //Configure::write('debug',3);
        $daystamp = time()-180*24*3600;
        $symbol_list = $this->FrontsideMenu->symbolList;
        $dseSQL = "SELECT * FROM `outputs` WHERE `symbol` = 1 AND daystamp >= $daystamp order by daystamp asc" ;
        $dseData = $this->Symbol->query($dseSQL);
        
        $companySql = "SELECT * FROM `outputs` WHERE `symbol` = $symbol_id AND daystamp >= $daystamp order by daystamp asc" ;
        $companyData = $this->Symbol->query($companySql);
        
        $ticker = $symbol_id;
        $querystr="SELECT * FROM `corporate_action` WHERE `symbol` =$ticker and `active`=1 ORDER BY `datestamp` ASC";                                     
        $corporateAction = $this->Symbol->query($querystr);
        
        $dsiLabel = array();
        $companyArr = array();
        $dgenArr = array();
        
        foreach($dseData as $dseArr)
        {
          $dgenArr [] = $dseArr['outputs']['close'];
          $dsiLabel[] = $dseArr['outputs']['date'];
        }
        
        foreach($corporateAction as $row)
        {
                 if($row['corporate_action']['action']=='stockdiv')
                    {
                        $adjustmentFactor=(100+$row['corporate_action']['value'])/100;

                        $day=$row['corporate_action']['date'];
                        //$daystamp= strtotime($day)-24*60*60;
                        $daystamp=$row['corporate_action']['datestamp'];
                        $adjustedArr = '';
                        foreach ($companyData as $arr)
                        {
                            if($arr['outputs']['daystamp']<$daystamp)
                            {                                
                                $arr['outputs']['close']=($arr['outputs']['close']/$adjustmentFactor);
                            }

                            $adjustedArr[]=$arr['outputs']['close'];
                        }

                        $companyArr=array();
                        $companyArr=$adjustedArr;

                    }
                 elseif($row['corporate_action']['action']=='cashdiv')
                    {

                        $symbolSQL = "SELECT face_value FROM symbols WHERE id=$ticker";
                        $result = $this->Symbol->query($symbolSQL);
                        $facevalue  = $result[0]['symbols']['face_value'];

                        $adjustmentFactor=$facevalue*$row['corporate_action']['value']/100;
                        $day=$row['corporate_action']['date'];
                        //$daystamp= strtotime($day)-24*60*60;
                        $daystamp=$row['corporate_action']['datestamp'];
                        $adjustedArr = '';
                        foreach ($companyData as $arr)
                        {
                            if($arr['outputs']['daystamp']<$daystamp)
                            {                                
                                $arr['outputs']['close']=($arr['outputs']['close']-$adjustmentFactor);
                            }

                            $adjustedArr[]=$arr['outputs']['close'];
                        }

                        $companyArr=array();
                        $companyArr=$adjustedArr;

                    }
                 elseif($row['corporate_action']['action']=='rightshare')
                    {

                        $symbolSQL = "SELECT face_value FROM symbols WHERE id=$ticker";
                        $result = $this->Symbol->query($symbolSQL);
                        $facevalue  = $result[0]['symbols']['face_value'];
                        
                        $adjustmentFactor1=(100+$value)/100;
                        $adjustmentFactor=($premium+$facevalue)-(($premium+$facevalue)/$adjustmentFactor1);
                        
                        $daystamp=$row['corporate_action']['datestamp'];
                        //$daystamp= strtotime($day)-24*60*60;
                        //$daystamp= strtotime($day);
                        $adjustedArr = '';
                        foreach ($companyData as $arr)
                        {
                            if($arr['outputs']['daystamp']<$daystamp)
                            {                                
                                $arr['outputs']['close']=($arr['outputs']['close']+$adjustmentFactor1)/$adjustmentFactor;
                            }

                            $adjustedArr[]=$arr['outputs']['close'];
                        }

                        $companyArr=array();
                        $companyArr=$adjustedArr;

                    }


                 elseif ($row['corporate_action']['action']=='split')
                    {
                        $adjustmentFactor=$row['corporate_action']['value'];

                        $day=$row['corporate_action']['date'];
                        //$daystamp= strtotime($day)-24*60*60;
                        $daystamp=$row['corporate_action']['datestamp'];
                        $adjustedArr = '';
                        foreach ($companyData as $arr)
                        {
                            if($arr['outputs']['daystamp']<$daystamp)
                            {
                                $arr['outputs']['close']=$arr['outputs']['close']/$adjustmentFactor;
                            }

                            $adjustedArr[]=$arr['outputs']['close'];
                        }
                        $companyArr=array();
                        $companyArr=$adjustedArr;
                    }
          }
        
        
        $company_name = $companyData[0]['outputs']['name'];
        $company_code =  $companyData[0]['outputs']['code'];
        require_once(WWW_ROOT . DS . 'chart'. DS .'phpchartdir.php');
        require_once(WWW_ROOT . DS . 'chart'. DS .'Image_Toolbox.class.php');
           
        $c = new XYChart(550, 300);
        $c->setBackground ( $c->linearGradientColor ( 400, 0, 100, 400, 0xDCD6D3, 0xF6F6F6 ), 0xC8C3C0 ); 
        $c->setRoundedFrame ( 0xff0000, 0 );
        $c->setPlotArea(60, 25, 420, 190);
        //$c->SetDrawPlotAreaBackground(0xE0E0E0);

        $legendObj = $c->addLegend(50, 5, false, "", 8);
        $legendObj->setBackground(Transparent);
        
        $textBoxObj = $c->addText ( 100, 30, "www.stockbangladesh.com", "timesbi.ttf", 9, 0xc09090 );
        $textBoxObj->setAlignment ( TopLeft );

        # Add a title to the x axis
        $c->xAxis->setTitle("Date");
        
        # Add a title to the y axis
        $c->yAxis->setTitle("INDEX");
        
        $c->xAxis->setLabelStyle ( "Arial", 8, TextColor, 90 );
        # Set the labels on the x axis.
        $c->xAxis->setLabels($dsiLabel);      
        
        /*$c->yAxis2->setTitle ( "VOLUME" );*/
        # set the axis, label and title colors for the primary y axis to green (0x008000) to
        # match the second data set
        
        //$c->yAxis2->setColors ( 0x008000);
        /*$c->yAxis2->setLabels($trdvolumeArr);
        $c->yAxis2->setLabelStep(5, 1);*/
        
        # Display 1 out of 2 labels on the x-axis. Show minor ticks for remaining labels.
        $c->xAxis->setLabelStep(10, 1);
        $c->yAxis->setAutoScale(200,100,0.5);
        
        //$c->addLineLayer($dgenArr, 0x80EB0000, "DSE Index");
        //$c->addLineLayer($companyArr, 0x8000EB00, $company_name." Index");
        $layer = $c->addLineLayer($dgenArr, 0x80EB0000, "DSEGEN");
        $layer->setLineWidth(2);
        
        $layer2 = $c->addLineLayer ($companyArr,0x8000EB00, $symbol_list[$symbol_id]);
        $layer2->setLineWidth(2);
        $layer2->setUseYAxis2 ();
        
        
        # Output the chart
        /*header("Content-type: image/png");
        print($c->makeChart2(PNG));
        exit;*/
        $chartData=$c->makeChart2(PNG);
        
        $chartImagePath = WWW_ROOT . 'chart'. DS . 'fundamental_comparison.png';
        $f = fopen($chartImagePath, "wb");
        fwrite($f, $chartData);
        fclose($f);
        $img = new Image_Toolbox($chartImagePath);
        /*$width=$img->_img['main']['width'];
        $img->addImage($width,10,'#ffffff');
        $img->blendMask('left','bottom',IMAGE_TOOLBOX_BLEND_COPY, 0, 290);*/
        $img->output();
        //die;
    }
    
    function recent_chart($symbol_id = '')
    {
        //Configure::write('debug',3);
        $daystamp = time()-35*24*3600;
        $symbol_list = $this->FrontsideMenu->symbolList;
        /*$dseSQL = "SELECT * FROM `outputs` WHERE `symbol` = 1 AND daystamp >= $daystamp order by daystamp asc" ;
        $dseData = $this->Symbol->query($dseSQL);*/
        
        $companySql = "SELECT * FROM `outputs` WHERE `symbol` = $symbol_id AND daystamp >= $daystamp order by daystamp ASC" ;
        $companyData = $this->Symbol->query($companySql);
        
        $querystr="SELECT * FROM `corporate_action` WHERE `symbol` =$symbol_id and `active`=1 ORDER BY `datestamp` ASC";                                     
        $corporateAction = $this->Symbol->query($querystr);
        
        $dsiLabel = array();
        $companyArr = array();
        $volArr = array();
        
        foreach($corporateAction as $row) 
        {
                 if($row['corporate_action']['action']=='stockdiv')
                    {
                        $adjustmentFactor=(100+$row['corporate_action']['value'])/100;

                        $day=$row['corporate_action']['date'];
                        //$daystamp= strtotime($day)-24*60*60;
                        $daystamp=$row['corporate_action']['datestamp'];
                        $adjustedArr = '';
                        foreach ($companyData as $arr)
                        {
                            if($arr['outputs']['daystamp']<$daystamp)
                            {                                
                                $arr['outputs']['close']=($arr['outputs']['close']/$adjustmentFactor);
                            }

                            $adjustedArr[]=$arr;
                        }

                        $companyArr=array();
                        $companyArr=$adjustedArr;

                    }
                 elseif($row['corporate_action']['action']=='cashdiv')
                    {

                        $symbolSQL = "SELECT face_value FROM symbols WHERE id=$symbol_id";
                        $result = $this->Symbol->query($symbolSQL);
                        $facevalue  = $result[0]['symbols']['face_value'];

                        $adjustmentFactor=$facevalue*$row['corporate_action']['value']/100;
                        $day=$row['corporate_action']['date'];
                        //$daystamp= strtotime($day)-24*60*60;
                        $daystamp=$row['corporate_action']['datestamp'];
                        $adjustedArr = '';
                        foreach ($companyData as $arr)
                        {
                            if($arr['outputs']['daystamp']<$daystamp)
                            {                                
                                $arr['outputs']['close']=($arr['outputs']['close']-$adjustmentFactor);
                            }

                            $adjustedArr[]=$arr;
                        }

                        $companyArr=array();
                        $companyArr=$adjustedArr;

                    }
                 elseif($row['corporate_action']['action']=='rightshare')
                    {

                        $symbolSQL = "SELECT face_value FROM symbols WHERE id=$symbol_id";
                        $result = $this->Symbol->query($symbolSQL);
                        $facevalue  = $result[0]['symbols']['face_value'];
                        
                        $adjustmentFactor1=(100+$value)/100;
                        $adjustmentFactor=($premium+$facevalue)-(($premium+$facevalue)/$adjustmentFactor1);
                        
                        $daystamp=$row['corporate_action']['datestamp'];
                        //$daystamp= strtotime($day)-24*60*60;
                        //$daystamp= strtotime($day);
                        $adjustedArr = '';
                        foreach ($companyData as $arr)
                        {
                            if($arr['outputs']['daystamp']<$daystamp)
                            {                                
                                $arr['outputs']['close']=($arr['outputs']['close']+$adjustmentFactor1)/$adjustmentFactor;
                            }

                            $adjustedArr[]=$arr;
                        }

                        $companyArr=array();
                        $companyArr=$adjustedArr;

                    }


                 elseif ($row['corporate_action']['action']=='split')
                    {
                        $adjustmentFactor=$row['corporate_action']['value'];

                        $day=$row['corporate_action']['date'];
                        //$daystamp= strtotime($day)-24*60*60;
                        $daystamp=$row['corporate_action']['datestamp'];
                        $adjustedArr = '';
                        foreach ($companyData as $arr)
                        {
                            if($arr['outputs']['daystamp']<$daystamp)
                            {
                                $arr['outputs']['close']=$arr['outputs']['close']/$adjustmentFactor;
                                $arr['outputs']['volume']=$arr['outputs']['volume']*$adjustmentFactor;
                                
                            }

                            $adjustedArr[]=$arr;
                        }
                        $companyArr=array();
                        $companyArr=$adjustedArr;

                    }
            
        }
        
        
        
        $dsiLabel = array();
        $volArr = array();
        $compArr = array();
        foreach($companyArr as $arr)
        {
          $compArr [] = $arr['outputs']['close'];
          $volArr[] = $arr['outputs']['volume'];
          $dsiLabel[] = $arr['outputs']['date'];
        }
        $company_name = $companyData[0]['outputs']['name'];
        //$company_code =  $companyData[0]['outputs']['code'];
        require_once(WWW_ROOT . DS . 'chart'. DS .'phpchartdir.php');
        require_once(WWW_ROOT . DS . 'chart'. DS .'Image_Toolbox.class.php');
           
        $c = new XYChart(550, 300);
        $c->setBackground ( $c->linearGradientColor ( 400, 0, 100, 400, 0xDCD6D3, 0xF6F6F6 ), 0xC8C3C0 ); 
        $c->setRoundedFrame ( 0xff0000, 0 );
        $c->setPlotArea(60, 25, 420, 190);
        //$c->SetDrawPlotAreaBackground(0xE0E0E0);

        $legendObj = $c->addLegend(50, 5, false, "", 8);
        $legendObj->setBackground(Transparent);
        
        $textBoxObj = $c->addText ( 100, 30, "www.stockbangladesh.com", "timesbi.ttf", 9, 0xc09090 );
        $textBoxObj->setAlignment ( TopLeft );

        # Add a title to the x axis
        $c->xAxis->setTitle("Date");
        
        # Add a title to the y axis
        $c->yAxis->setTitle("PRICE");
        
        $c->xAxis->setLabelStyle ( "Arial", 8, TextColor, 90 );
        # Set the labels on the x axis.
        $c->xAxis->setLabels($dsiLabel);      
        
        /*$c->yAxis2->setTitle ( "VOLUME" );*/
        # set the axis, label and title colors for the primary y axis to green (0x008000) to
        # match the second data set
        
        //$c->yAxis2->setColors ( 0x008000);
        /*$c->yAxis2->setLabels($trdvolumeArr);
        $c->yAxis2->setLabelStep(5, 1);*/
        
        # Display 1 out of 2 labels on the x-axis. Show minor ticks for remaining labels.
        $c->xAxis->setLabelStep(1, 1);
        $c->yAxis->setAutoScale(200,100,0.5);
        
        //$c->addLineLayer($dgenArr, 0x80EB0000, "DSE Index");
        //$c->addLineLayer($companyArr, 0x8000EB00, $company_name." Index");
        $layer = $c->addLineLayer($compArr, 0x80EB0000, $company_name);
        $layer->setLineWidth(2);
       
       
       $c->yAxis2->setTitle ( "VOLUME" );
        # set the axis, label and title colors for the primary y axis to green (0x008000) to
        # match the second data set
        $c->yAxis2->setColors ( 0x682809, 0x682809, 0x682809 );
        $barLayerObj = $c->addBarLayer3 ( $volArr );
        $barLayerObj->setBarShape ( CircleShape );
        $barLayerObj->setUseYAxis2 ();
        
        /*$layer2 = $c->addLineLayer ($companyArr,0x8000EB00, $symbol_list[$symbol_id]);
        $layer2->setLineWidth(2);
        $layer2->setUseYAxis2 ();*/
        
        
        # Output the chart
        /*header("Content-type: image/png");
        print($c->makeChart2(PNG));
        exit;*/
        $chartData=$c->makeChart2(PNG);
        
        $chartImagePath = WWW_ROOT . 'chart'. DS . 'fundamental_comparison.png';
        $f = fopen($chartImagePath, "wb");
        fwrite($f, $chartData);
        fclose($f);
        $img = new Image_Toolbox($chartImagePath);
        /*$width=$img->_img['main']['width'];
        $img->addImage($width,10,'#ffffff');
        $img->blendMask('left','bottom',IMAGE_TOOLBOX_BLEND_COPY, 0, 290);*/
        $img->output();
        //die;
    }
    
    function minutechart_newspaper($symbol = '') {
        
        //$this->layout = 'blank';
        require_once (WWW_ROOT . DS . 'chart' . DS . 'phpchartdir.php');
        require_once (WWW_ROOT . DS . 'chart' . DS . 'Image_Toolbox.class.php');
        $inv = 60;
        $_REQUEST ['TickerSymbol'] = $symbol;
        //$_REQUEST ['inv'] = $inv;
        
        if (isset ( $_REQUEST ['TickerSymbol'] )) {
            
            //$inv = $_REQUEST ['inv'];
            //echo $inv;
            //echo $symbol;
            $symbolInfo = $this->Symbol->find ( 'first', array ('conditions' => array ('id=' . $symbol ), 'fields' => array ('Symbol.dse_code', 'Symbol.name' ) ) );
            $name = $symbolInfo ['Symbol'] ['name'];
            $name = ucwords ( strtolower ( $name ) );
            //$this->pageTitle = "$name :: Minute Chart";
            //$this->set ( 'sym', $_REQUEST ['TickerSymbol'] );
            //$symbol = $_REQUEST ['TickerSymbol'];
            //echo $symbol;
            $symbol = trim ( $symbol );
            $interval = $inv;
            $code = $symbolInfo ['Symbol'] ['dse_code'];
            $name = $symbolInfo ['Symbol'] ['name'];
            $minute = $interval / 60;
            if ($minute > 1) {
                $minute = $minute . ' Minutes Chart';
            } else {
                $minute = $minute . ' Minutes Chart';
            }
            $nameOfTheDay = date ( 'l' );
            if ($nameOfTheDay == 'Friday')
            $todayTimeStamp = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ) - 1, date ( 'Y' ) );
            else if ($nameOfTheDay == 'Saturday')
            $todayTimeStamp = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ) - 2, date ( 'Y' ) );
            else
            $todayTimeStamp = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ), date ( 'Y' ) );
            /*$todayTimeStamp = mktime(0, 0, 0, date('m'), date('d'), date('Y'));*/
            $getLastIntradayId = $this->Symbol->query ( 'SELECT value from configuration WHERE name=\'data_bank_intraday_lid\' ' );
            $getLastIntradayId = $getLastIntradayId [0] ['configuration'] ['value'];
           
            $shareData = $this->Symbol->query ( 'select * from data_banks_intraday where symbol_id =' . $symbol . ' AND id > ' . $getLastIntradayId . ' ORDER BY id DESC' );
            
            $timeWiseArr = array ();
            $timeKeyArr  = array ();
            //echo '<pre>';
            //echo 'sharedata is';
            //print_r($shareData);
            foreach ( $shareData as $row ) {
                $currenttime = $row ['data_banks_intraday'] ['date'];
                //$currenttime = $currenttime + (8*60*60);
                $mod = $currenttime % $interval;
                $timeToBeAccounted = $currenttime - $mod + $interval;
                //echo date('h:i A', $timeToBeAccounted).'<br><br>';
                $timeWiseArr [$timeToBeAccounted] [] = $row;
                $modtime = date ( 'd M  h:ia', $timeToBeAccounted );
            }

            //pr($timeWiseArr);
            $rowDataVolumeStart = 0;
            $rowDataVolumeEnd = 0;
            $currentDataVolume = 0;
            $tempVolumeCounter = 0;
            $totalArrayCount = count($timeWiseArr);
            $myDefinedCounter = 1;
            foreach ( $timeWiseArr as $key => $arr ) {
                $timeKeyArr [] = $key;
            }

            //pr($tempVolumeCounter);
            $finalArr = array ();
            $totalvolume = $shareData [0] ['data_banks_intraday'] ['volume'];
            $tradetimestamp = $shareData [0] ['data_banks_intraday'] ['date'];
            $dayhigh = $shareData [0] ['data_banks_intraday'] ['high'];
            $daylow = $shareData [0] ['data_banks_intraday'] ['low'];
            $dayclose = $shareData [0] ['data_banks_intraday'] ['close'];
            $dayopen = $shareData [0] ['data_banks_intraday'] ['open'];
            $totaltrade = $shareData [0] ['data_banks_intraday'] ['trade'];
            
            if($symbol == 1)
            {
                $market_summeriesSQL = mysql_fetch_assoc(mysql_query("SELECT * FROM market_summeries ORDER BY id DESC LIMIT 1"));
                $totaltrade = $market_summeriesSQL['totaltrade'];
            }
            
            
            
            $yclose=$shareData [0] ['data_banks_intraday'] ['yclose'];

            $tradeDate = date ( 'd M y h:ia', $tradetimestamp );
            $i = 0;
            $singleCount = 0;
            $finalPrice = 0;
            //pr($timeWiseArr);
            $startPrice = 0;
            $endPrice = 0;
            foreach ( $timeWiseArr as $key => $arr ) {
                $datetime = date ( 'h:i A', $key );
                $temp = array ();
                $startArr = array ();
                $endArr = array ();
                $ind = count ( $arr );
                $counterArr = count($arr);
                $finalPrice = $arr[0]['data_banks_intraday']['close'];


                if(!$rowDataVolumeStart) {
                    $rowDataVolumeStart = $arr[0]['data_banks_intraday']['volume'];
                    $startPrice = $arr[0]['data_banks_intraday']['close'];
                }

                if($myDefinedCounter==$totalArrayCount){
                    $rowDataVolumeEnd  =0;
                    $endPrice = $arr[0]['data_banks_intraday']['yclose'];
                }else {
                    $rowDataVolumeEnd = $arr[$counterArr-1]['data_banks_intraday']['volume'];
                    $endPrice = $arr[0]['data_banks_intraday']['close'];
                }

                //$endArr ['data_banks_intraday'] ['lastprice'];
                if ($ind == 1) {
                    $startArr = $arr [$ind - 1];
                    $endArr = $arr [$ind - 1];

                    if (isset ( $timeKeyArr [$i + 1] )) {
                        $time = $timeKeyArr [$i + 1];
                        $endvolume = $timeWiseArr [$time] [0] ['data_banks_intraday'] ['volume'];
                    } else {
                        $endvolume = 0;
                    }
                    $startvolume = $startArr ['data_banks_intraday'] ['volume'];
                } else {

                    //$startArr = $arr [0];
                    if (isset ( $timeKeyArr [$i] )) {
                        $time = $timeKeyArr [$i];

                        $preArrInd = count ($timeWiseArr [$time] );

                        $startvolume = $timeWiseArr [$time] [0] ['data_banks_intraday'] ['volume'];
                        //pr("found");
                    } else {
                        $startvolume = 0;
                        //pr('NO');
                    }
                    $endArr = $arr [$ind - 1];
                    if (isset ( $endArr )) {
                        $endvolume = $endArr ['data_banks_intraday'] ['volume'];
                    } else {
                        $endvolume = 0;
                    }
                }
                //pr($startvolume);
                //$temp ['ltp'] = $endArr ['data_banks_intraday'] ['lastprice'];
                $temp ['ltp'] = $finalPrice;
                $finalPrice = $arr[$counterArr-1]['data_banks_intraday']['lastprice'];
                //$temp['open']      = $endArr['data_banks_intraday']['open'];
                $temp ['high'] = $endArr ['data_banks_intraday'] ['high'];
                $temp ['low'] = $endArr ['data_banks_intraday'] ['low'];
                $temp ['close'] = $endArr ['data_banks_intraday'] ['close'];
                $temp ['yclose'] = $endArr ['data_banks_intraday'] ['yclose'];
                $temp ['trade'] = $endArr ['data_banks_intraday'] ['trade'];
                //$tempVolumeCounter += $rowDataVolumeStart - $rowDataVolumeEnd;
                //$temp ['volume'] = $finalVolume;
                //$finalVolume =  $rowDataVolumeStart - $rowDataVolumeEnd;
                $temp ['volume'] = $rowDataVolumeStart - $rowDataVolumeEnd;
                //$temp ['volume'] = $startvolume - $endvolume;
                if($startPrice > $endPrice){
                    $myPositiveCounter += $temp ['volume'];

                }else {
                    $myNegativeCounter += $temp ['volume'];
                }

                $rowDataVolumeStart = $rowDataVolumeEnd;
                $startPrice = $endPrice;
                $myDefinedCounter++;

                //$totalVolumeCompared+= $temp ['volume'];
                $temp ['value'] = $endArr ['data_banks_intraday'] ['value'];
                $temp ['datetime'] = $datetime;
                $temp ['idatetime'] = $key;
                if($temp ['volume'] != 0)
                    $finalArr [] = $temp;

                ++ $i;
            }

            /*echo "<pre>";
            print_r($finalArr);
            die;*/
            //pr("Positive".$myPositiveCounter);
            //pr("Negative".$myNegativeCounter);
            $xdata = array ();
            $ydata = array ();
            $vdata = array ();
            $totalbar = count ( $finalArr );
            foreach ( $finalArr as $mykey => $row ) {
                $volumetemp = $row ['volume'];

                if ($volumetemp < 0) {
                    continue;
                }

                $xdata [] = $row ['ltp'];
                $vdata [] = $finalArr [$mykey +1] =$row ['volume'];

                if ($interval < 120 && $totalbar > 80) {

                    if ($interval == 60) {
                        $yint = 600;
                    } else {
                        $yint = 300;
                    }
                    $currenttime = $row ['idatetime'];

                    $mod = $currenttime % $yint;

                    if ($mod == 0) {
                        $ydata [] = $row ['datetime'];
                    } else {
                        $ydata [] = "-";
                    }
                } else {
                    $ydata [] = $row ['datetime'];
                }

            }



            $xdata = array_reverse ( $xdata );
            $ydata = array_reverse ( $ydata );
            $vdata = array_reverse ( $vdata );
            //array_shift
            $max = 50;

            $lastprice = $xdata [count ( $xdata ) - 1];
            $lasttime = $ydata [count ( $ydata ) - 1];
            $lastvolume = $vdata [count ( $vdata ) - 1];

            array_unshift($vdata, 0);
            array_pop($vdata);
            //pr($vdata);
            # The data for the chart
            $myPositiveCounter=0;
            $myNegativeCounter=0;
            $myEqualCounter=0;

            if($yclose<$xdata[0])
            {
                $myPositiveCounter=$vdata[0];
            }
            if($yclose>$xdata[0])
            {
                $myNegativeCounter=$vdata[0];
            }
            /* echo "<pre >";
            echo "xdata";
            print_r($xdata);
            echo "vdata";
            print_r($vdata);
            exit;
            */
            for($i=0;$i<count($vdata);$i++)
            {
                if($xdata[$i]>$xdata[$i-1])
                {

                    $myPositiveCounter+=$vdata[$i];
                    //echo $myPositiveCounter."myPositiveCounter[".$vdata[$i]."]".$xdata[$i-1].">".$xdata[$i]."<br />";
                }
                if ($xdata[$i]<$xdata[$i-1])
                {
                    $myNegativeCounter+=$vdata[$i];
                    //echo $myNegativeCounter."myNegativeCounter[".$vdata[$i]."]".$xdata[$i-1]."<=".$xdata[$i]."<br />";
                }
                if ($xdata[$i]==$xdata[$i-1])
                {
                    $myEqualCounter+=$vdata[$i];

                }


            }
            //exit;
            $data0 = $xdata;
            $data1 = $vdata;
            $labels = $ydata;

            $myPositivePer=($myPositiveCounter/$totalvolume)*100;
            $myPositivePer=round($myPositivePer,2);

            $myNegativePer=($myNegativeCounter/$totalvolume)*100;
            $myNegativePer=round($myNegativePer,2);

            $myEqualPer=($myEqualCounter/$totalvolume)*100;
            $myEqualPer=round($myEqualPer,2);


            # Create a XYChart object of size 300 x 180 pixels
            $c = new XYChart ( 580, 420 );
            $c->setBackground ( $c->linearGradientColor ( 400, 0, 100, 400, 0xDCD6D3, 0xF6F6F6 ), 0xC8C3C0 ); 
            $c->setRoundedFrame ( 0xff0000, 0 );

            //$c->setBackground($c->linearGradientColor(0, 0, 0, 400, 0xffffbb, 0xffffff), 0x888888);
            //$c->setRoundedFrame(0xffffff, 0);

            # Set the plot area at (50, 20) and of size 200 x 130 pixels
            $c->setPlotArea ( 70, 70, 410, 280, 0xF6F6F6 );
            # Add a title to the chart using 8 pts Arial Bold font
            $arialbdPath = WWW_ROOT . 'font' . DS . 'arialbd.ttf';

            $c->addTitle ("$code-$tradeDate  open: $dayopen  high : $dayhigh low : $daylow close: $dayclose Hawla : $totaltrade", $arialbdPath, 8, 0x02536C, 0xDDD7D4 );
            $textBoxObj = $c->addText ( 08, 15, "Total Volume : $totalvolume Probable { Bull Vol: $myPositiveCounter($myPositivePer%) Neutral Vol: $myEqualCounter($myEqualPer%)  Bear Vol: $myNegativeCounter ($myNegativePer%) }", $arialbdPath, 8, 0x02536C );
            //$c->addTitle ( "$code-$tradeDate          Last price : $lastprice   high : $dayhigh low : $daylow trade : $totaltrade   Total Volume - $totalvolume Positive: Negative: ", $arialbdPath, 14, 0x333333, 0xE7FFDF );

            # Set the labels on the x axis.
            $c->xAxis->setLabels ( $labels );

            $c->xAxis->setLabelStyle ( "tahoma", 8, 0x683014, 90 );

            # Add a title to the primary (left) y axis
            $c->yAxis->setTitle ( "PRICE" );

            # Set the axis, label and title colors for the primary y axis to red (0xc00000) to
            # match the first data set
            $c->yAxis->setColors ( 0x682809, 0x682809, 0x682809 );

            # Add a title to the secondary (right) y axis
            $c->yAxis2->setTitle ( "VOLUME" );
            # set the axis, label and title colors for the primary y axis to green (0x008000) to
            # match the second data set
            $c->yAxis2->setColors ( 0x682809, 0x682809, 0x682809 );

            $textBoxObj = $c->addText ( 300, 50, "www.stockbangladesh.com", "timesbi.ttf", 11, 0xc09090 );
            $textBoxObj->setAlignment ( TopLeft );

            # Add a line layer to the chart
            $layer = $c->addLineLayer ();

            # Add the first line. Plot the points with a 7 pixel square symbol
            $dataSetObj = $layer->addDataSet ( $data0, 0xcf4040, "Price" );
            $dataSetObj->setDataSymbol ( SquareSymbol, 5 );

            $trendLayerObj = $c->addTrendLayer ( $data0, 0x0B578F, "Trend Line" );
            $trendLayerObj->setLineWidth ( 1 );
            $trendLayerObj->addPredictionBand ( 0.95, 0x80D9D7D7 );
            
            $barLayerObj = $c->addBarLayer3 ( $data1 );
            $barLayerObj->setBarShape ( CircleShape );
            $barLayerObj->setUseYAxis2 ();

            //    $c->addAreaLayer($data1, $c->yZoneColor(60, 0x8033ff33, 0x80ff3333));
            //$chart1URL = $c->makeSession("chart1");
            # Create an image map for the chart
            header("Content-type: image/png");
            print($c->makeChart2(PNG));
            exit;

            
        }
        
    }
    
    function latest_pe()
    {
        $this->layout ='default-bodyonly'; 
        $this->pageTitle = 'Stock Bangladesh :: Latest P/E Information';
        
        $ip          = $_SERVER['REMOTE_ADDR'];
        $ipcheckSql  = "SELECT ip FROM user_ip WHERE is_active =1 AND ip='ipcheck'";
        $ipenable    = mysql_query($ipcheckSql);
        /*echo '<pre>';
   
        print_r($ipenable );
        die;*/
        
        
        if(mysql_num_rows($ipenable))  
        {
            $brokerIPSql = "SELECT ip FROM user_ip WHERE is_active =1 AND ip='".$ip."'";
            $access = mysql_query($brokerIPSql);
            if(!mysql_num_rows($access))
            {
                $this->Session->setFlash ( 'You are not authorized to access this location' );
                $this->redirect ( array ('controller' => 'users', 'action' => 'index' ) );
                //die("You are not authorized to access this location.");
            }
        }
       //echo '<pre>';
        $symbolSQl = "SELECT DISTINCT(business_segment),business_segment_bangla FROM symbols WHERE inactive='No' AND otc_market='No' AND id>4 AND business_segment!=''";
        $sectorInfo = $this->Symbol->query($symbolSQl);
        
        $sectorArr = array();
        foreach($sectorInfo as $sectors)
        {
            $sector_name = $sectors['symbols']['business_segment'];
            $sector_name_bangla = $sectors['symbols']['business_segment_bangla'];
            $sectorArr[$sector_name] = $sector_name_bangla;
            
        } 
        //echo '<pre>';
        //print_r($sectorArr);
        $dateSql = $this->Symbol->query("SELECT date FROM market_summeries ORDER BY id desc");
        $last_date = date('d-m-Y',strtotime($dateSql[0]['market_summeries']['date']));
        $this->set('last_date',$last_date);
        //echo $last_date;
        $sql = "SELECT * FROM pe_data WHERE date='$last_date'";
        $peInfo = $this->Symbol->query($sql);
        
        $PEarr = array();
        foreach($peInfo as $latestPe)
        {
            $sector = $latestPe['pe_data']['sector'];
            $PEarr[$sector][] = $latestPe;
            
        }
        //print_r($PEarr);
        $this->set('peratio',$PEarr);
        $this->set('sectorArr',$sectorArr);
       // die;
    }
    
    function newspaper_category()
    {        
        $this->layout ='default-bodyonly'; 
        $this->pageTitle = 'Stock Bangladesh :: Categorywise Chart';
        //echo "<pre>";
        //App::import ( 'Vendor', 'Phpchartdir', array ('file' => 'phpchartdir.php'));
        $dateSql   = mysql_query("SELECT date FROM market_summeries ORDER BY id desc LIMIT 2");
        $dateArr = array();
        while($date = mysql_fetch_assoc($dateSql))
        {
            $dateArr[] = $date['date'];
        }
        
        $last_date = $dateArr[0];
        $prev_date = $dateArr[1];
        list($y,$m,$d) = explode("-",$last_date);
        list($y2,$m2,$d2) = explode("-",$prev_date);
        
        $symbolSQl  = "SELECT * FROM symbols WHERE id>4 AND otc_market='No' AND inactive='No'";
        $symbolQRY  = mysql_query($symbolSQl);
        $symbolDataArr = array();
        while($data = mysql_fetch_assoc($symbolQRY))
        {
            $category = $data['category'];            
            $symbolDataArr[$category][$data['id']] = $data['dse_code'];
        }
        
        
        
        $dataChartArr = array();
        $dataChartArrPrev = array();
        $totalTradeValue  = 0;
        $totalTradeValueY = 0;
        foreach($symbolDataArr AS $category => $dataArr)
        {
            $tadeVal = 0;
            $tadeVal2 = 0;
            foreach($dataArr AS $symbol => $data)
            {
                $outputSQL  = "SELECT * FROM outputs WHERE symbol=".$symbol." AND date='".($d.'-'.$m.'-'.$y)."'";
                $outputQRY  = mysql_query($outputSQL);
                
                while($outputData = mysql_fetch_assoc($outputQRY))
                {
                    $tadeVal += $outputData['tradevalues'];                                        
                }
                $outputSQL  = "SELECT * FROM outputs WHERE symbol=".$symbol." AND date='".($d2.'-'.$m2.'-'.$y2)."'";
                $outputQRY  = mysql_query($outputSQL);
                
                while($outputData = mysql_fetch_assoc($outputQRY))
                {
                    $tadeVal2 += $outputData['tradevalues'];
                    
                }
                
            }
            $totalTradeValue += $tadeVal;
            $totalTradeValueY += $tadeVal2;
            $dataChartArr[$category][] = $tadeVal;
            $dataChartArr2[$category][] = $tadeVal2;
        }
      
        foreach($dataChartArr AS $category => $value)
        {
            $dataChartArr[$category][0] = number_format(($value[0]*100/$totalTradeValue),2,'.','');
        }
        foreach($dataChartArr2 AS $category => $value)
        {
            $dataChartArr2[$category][0] = number_format(($value[0]*100/$totalTradeValueY),2,'.','');
        }
        
      
     /* 
        $dataChartArrTemp=array();
         foreach($dataChartArr AS $category => $value)
        {
            $per=number_format(($value[0]*100/$totalTradeValue),2,'.','');
            $dataChartArrTemp[$per][0] = $category;
        }
        ksort($dataChartArrTemp);
        $dataChartArrTemp=array_reverse($dataChartArrTemp);
       
        
       echo "<pre>";
        echo $totalTradeValue."+".$totalTradeValueY."<br>";
        print_r($dataChartArr);
        
         $data1=array();
         $data3=array();
        $labels=array();
        foreach($dataChartArrTemp as $per=>$valArr)
        {
         $cat=$valArr[0];
         $data1[]   =$per;
         $data3[]= $dataChartArr2[$cat][0];
         $labels[]=$cat;
        }
        */
        
        
        # The data for the bar chart 
       
      
        $data1 = array($dataChartArr['A'][0], $dataChartArr['B'][0], $dataChartArr['Z'][0],$dataChartArr['N'][0]);        
        $data3 = array($dataChartArr2['A'][0], $dataChartArr2['B'][0], $dataChartArr2['Z'][0],$dataChartArr2['N'][0]);             $labels = array("A", "B", "Z", "N"); 
        
        
        # Create a XYChart object of size 600 x 350 pixels, using 0xe0e0ff as the background 
        # color, 0xccccff as the border color, with 1 pixel 3D border effect. 
        //$c = new XYChart(600, 350, 0x0B578F, 0x60B8F8, 1); 
       // $c = new XYChart(600, 350, 0xE9FFE2, 0x0B578F, 1); 
       $c = new XYChart(820, 580, 0xFFFFFF, 0x0B578F, 1);  
        #Set directory for loading images to current script directory 
        #Need when running under Microsoft IIS 
        $c->setSearchPath(dirname(__FILE__)); 
        # Add a title to the chart using 14 points Times Bold Itatic font and light blue 
        # (0x9999ff) as the background color 
        //$textBoxObj = $c->addTitle("CATEGORYWISE CHART", "timesbi.ttf", 14); 
        //$textBoxObj->setBackground(0x838F7F);
        // $textBoxObj->setBackground(0xFFFFFF);  
        # Set the plotarea at (60, 45) and of size 500 x 210 pixels, using white (0xffffff) 
        # as the background 
        //$c->setPlotArea(60, 45, 500, 210, 0xffffff); 
        $c->setPlotArea(80, 45, 700, 460, 0xFFFFFF);
        # Swap the x and y axes to create a horizontal bar chart 
        $c->swapXY(); 
        # Add a title to the y axis using 11 pt Times Bold Italic as font 
        //$c->yAxis->setTitle("Trade Value (%)", "timesbi.ttf", 11); 
        $c->yAxis->setTitle("CATEGORY BASED TRADE COMPARISON", "timesbi.ttf", 12); 
        # Set the labels on the x axis 
        $c->xAxis->setLabels($labels); 
        $c->xAxis->setLabelStyle ( "arialbi.ttf", 20, TextColor, 0 ); 
        # Disable x-axis ticks by setting the tick length to 0 
        $c->xAxis->setTickLength(0); 
        # Add a stacked bar layer to the chart 
        $layer = $c->addBarLayer2(Stack); 
        # Add the first two data sets to the chart as a stacked bar group 
        $layer->addDataGroup("2001"); 
        //$layer->addDataSet($data0, 0xaaaaff, "Local"); 
        
        $layer->addDataSet($data1, 0x3D6FBA, $last_date);
        # Add the remaining data sets to the chart as another stacked bar group 
        $layer->addDataGroup("2002"); 
        //$layer->addDataSet($data2, 0xffaaaa, "Local"); 
       // $layer->addDataSet($data3, 0xA52C2C, $prev_date); 
      // $layer->addDataSet($data3, 0x626466, $prev_date); 
       $layer->addDataSet($data3, 0xF36910, $prev_date); 
        
        
       /* $layer->addDataSet($data1, 0x2D8F0A, $last_date); 
        //$layer->setBarShape(CircleShape);
        # Add the remaining data sets to the chart as another stacked bar group 
        $layer->addDataGroup("2002"); 
        //$layer->addDataSet($data2, 0xffaaaa, "Local"); 
        $layer->addDataSet($data3, 0xA52C2C, $prev_date);         */
        
        # Set the sub-bar gap to 0, so there is no gap between stacked bars with a group 
        $layer->setBarGap(0.05, 0); 
        # Set the bar border to transparent 
        $layer->setBorderColor(Transparent); 
        # Set the aggregate label format 
        $layer->setAggregateLabelFormat("{value}%"); 
        # Set the aggregate label font to 8 point Arial Bold Italic 
        $layer->setAggregateLabelStyle("arialbi.ttf", 20); 
        # Reverse 20% space at the right during auto-scaling to allow space for the aggregate 
        # bar labels 
        $c->yAxis->setAutoScale(0.2); 
        # Add a legend box at (310, 300) using TopCenter alignment, with 2 column grid 
        # layout, and use 8 pts Arial Bold Italic as font 
        //$legendBox = $c->addLegend2(310, 300, 2, "arialbi.ttf", 8); 
      //  $legendBox = $c->addLegend2(500, 100, 2, "arialbi.ttf", 8); 
       // $legendBox->setAlignment(TopCenter); 
        # Set the format of the text displayed in the legend box 
      //  $legendBox->setText("{dataSetName} Trade Value"); 
        # Set the background and border of the legend box to transparent 
      //  $legendBox->setBackground(Transparent, Transparent); 
        # Output the chart 
        header("Content-type: image/png"); 
        print($c->makeChart2(PNG));
        
    }
    
    function newspaper_weeklycategory()
    {
        $this->layout ='default-bodyonly'; 
        $this->pageTitle = 'Stock Bangladesh :: Categorywise Weekly Chart';
        //echo "<pre>";
        //App::import ( 'Vendor', 'Phpchartdir', array ('file' => 'phpchartdir.php'));
        
        $symbolSQl  = "SELECT * FROM symbols WHERE id>4 AND otc_market='No' AND inactive='No'";
        $symbolQRY  = mysql_query($symbolSQl);
        $symbolDataArr = array();
        while($data = mysql_fetch_assoc($symbolQRY))
        {
            $faceVal = $data['category'];            
            $symbolDataArr[$faceVal][$data['id']] = $data['dse_code'];
        }
        
        
        $dataChartArr = array();
        $dataChartArrPrev = array();
        $totalTradeValue  = 0;
        $totalTradeValueY  = 0;
        foreach($symbolDataArr AS $faceVal => $dataArr)
        {
            $tadeVal = 0;
            $tadeVal2 = 0;
            
            foreach($dataArr AS $symbol => $data)
            {
                $outputSQL  = "SELECT * FROM weekly_data WHERE symbol=".$symbol." ORDER BY id DESC LIMIT 2";
                $outputQRY  = mysql_query($outputSQL);
                $temp = array();
                $count = 0;
                while($outputData = mysql_fetch_assoc($outputQRY))
                {
                    $count++;
                    if($count == 1)
                    {
                        $tadeVal += $outputData['tradevalues'];
                        $last_date = $outputData['date'];
                    }
                    else if($count == 2)
                    {
                        $tadeVal2 += $outputData['tradevalues'];
                        $prev_date = $outputData['date'];
                    }
                    else
                        echo "error<br>";
                    
                }
                
            }
            $totalTradeValue  += $tadeVal;
            $totalTradeValueY += $tadeVal2;
            $dataChartArr[$faceVal][] = $tadeVal;
            $dataChartArr2[$faceVal][] = $tadeVal2;
        }
        foreach($dataChartArr AS $face => $value)
        {
            $dataChartArr[$face][0] = number_format(($value[0]*100/$totalTradeValue),2,'.','');
        }
        foreach($dataChartArr2 AS $face => $value)
        {
            $dataChartArr2[$face][0] = number_format(($value[0]*100/$totalTradeValueY),2,'.','');
        }
        
        /*echo "<pre>";
        echo $totalTradeValue."+".$totalTradeValueY."<br>";
        print_r($dataChartArr);
        print_r($dataChartArr2);

        die;*/
        
        
        
        # The data for the bar chart 
        
        $data1 = array($dataChartArr['A'][0], $dataChartArr['B'][0], $dataChartArr['Z'][0],$dataChartArr['N'][0]);        
        $data3 = array($dataChartArr2['A'][0], $dataChartArr2['B'][0], $dataChartArr2['Z'][0],$dataChartArr2['N'][0]);        
        
        # The labels for the bar chart. The labels contains embedded images as icons. 
        
        $labels = array("A", "B", "Z", "N"); 
        # Create a XYChart object of size 600 x 350 pixels, using 0xe0e0ff as the background 
        # color, 0xccccff as the border color, with 1 pixel 3D border effect. 
        $c = new XYChart(600, 350, 0xE9FFE2, 0x0B578F, 1); 
        #Set directory for loading images to current script directory 
        #Need when running under Microsoft IIS 
        $c->setSearchPath(dirname(__FILE__)); 
        # Add a title to the chart using 14 points Times Bold Itatic font and light blue 
        # (0x9999ff) as the background color 
        $textBoxObj = $c->addTitle("Categorywise Weekly CHART", "timesbi.ttf", 14); 
        $textBoxObj->setBackground(0x838F7F); 
        # Set the plotarea at (60, 45) and of size 500 x 210 pixels, using white (0xffffff) 
        # as the background 
        $c->setPlotArea(60, 45, 500, 210, 0xffffff); 
        # Swap the x and y axes to create a horizontal bar chart 
        $c->swapXY(); 
        # Add a title to the y axis using 11 pt Times Bold Italic as font 
        $c->yAxis->setTitle("Trade Value (%)", "timesbi.ttf", 11); 
        # Set the labels on the x axis 
        $c->xAxis->setLabels($labels); 
        # Disable x-axis ticks by setting the tick length to 0 
        $c->xAxis->setTickLength(0); 
        # Add a stacked bar layer to the chart 
        $layer = $c->addBarLayer2(Stack); 
        # Add the first two data sets to the chart as a stacked bar group 
        $layer->addDataGroup("2001"); 
        //$layer->addDataSet($data0, 0xaaaaff, "Local"); 
        $layer->addDataSet($data1, 0x2D8F0A, "This Week"); 
        # Add the remaining data sets to the chart as another stacked bar group 
        $layer->addDataGroup("2002"); 
        //$layer->addDataSet($data2, 0xffaaaa, "Local"); 
        $layer->addDataSet($data3, 0xA52C2C, "Prev Week"); 
        # Set the sub-bar gap to 0, so there is no gap between stacked bars with a group 
        $layer->setBarGap(0.2, 0); 
        # Set the bar border to transparent 
        $layer->setBorderColor(Transparent); 
        # Set the aggregate label format 
        $layer->setAggregateLabelFormat("{value}%"); 
        # Set the aggregate label font to 8 point Arial Bold Italic 
        $layer->setAggregateLabelStyle("arialbi.ttf", 8); 
        # Reverse 20% space at the right during auto-scaling to allow space for the aggregate 
        # bar labels 
        $c->yAxis->setAutoScale(0.2); 
        # Add a legend box at (310, 300) using TopCenter alignment, with 2 column grid 
        # layout, and use 8 pts Arial Bold Italic as font 
        $legendBox = $c->addLegend2(310, 300, 2, "arialbi.ttf", 8); 
        $legendBox->setAlignment(TopCenter); 
        # Set the format of the text displayed in the legend box 
        $legendBox->setText("{dataSetName} Trade Value"); 
        # Set the background and border of the legend box to transparent 
        $legendBox->setBackground(Transparent, Transparent); 
        # Output the chart 
        header("Content-type: image/png"); 
        print($c->makeChart2(PNG));
        
    }
    
    
    function newspaper_facevalue()
    {
        $this->layout ='default-bodyonly'; 
        $this->pageTitle = 'Stock Bangladesh :: Face Value Chart';
        //echo "<pre>";
        //App::import ( 'Vendor', 'Phpchartdir', array ('file' => 'phpchartdir.php'));
        $dateSql   = mysql_query("SELECT date FROM market_summeries ORDER BY id desc LIMIT 2");
        $dateArr = array();
        while($date = mysql_fetch_assoc($dateSql))
        {
            $dateArr[] = $date['date'];
        }
        
        $last_date = $dateArr[0];
        $prev_date = $dateArr[1];
        list($y,$m,$d) = explode("-",$last_date);
        list($y2,$m2,$d2) = explode("-",$prev_date);
        
        $symbolSQl  = "SELECT * FROM symbols WHERE id>4 AND otc_market='No' AND inactive='No'";
        $symbolQRY  = mysql_query($symbolSQl);
        $symbolDataArr = array();
        while($data = mysql_fetch_assoc($symbolQRY))
        {
            $faceVal = $data['face_value'];
            settype($faceVal,"integer");
            $symbolDataArr[$faceVal][$data['id']] = $data['dse_code'];
        }
        
        
        
        $dataChartArr = array();
        $dataChartArrPrev = array();
        $totalTradeValue  = 0;
        $totalTradeValueY = 0;
        foreach($symbolDataArr AS $faceVal => $dataArr)
        {
            $tadeVal = 0;
            $tadeVal2 = 0;
            foreach($dataArr AS $symbol => $data)
            {
                $outputSQL  = "SELECT * FROM outputs WHERE symbol=".$symbol." AND date='".($d.'-'.$m.'-'.$y)."'";
                $outputQRY  = mysql_query($outputSQL);
                
                while($outputData = mysql_fetch_assoc($outputQRY))
                {
                    $tadeVal += $outputData['tradevalues'];                                        
                }
                $outputSQL  = "SELECT * FROM outputs WHERE symbol=".$symbol." AND date='".($d2.'-'.$m2.'-'.$y2)."'";
                $outputQRY  = mysql_query($outputSQL);
                
                while($outputData = mysql_fetch_assoc($outputQRY))
                {
                    $tadeVal2 += $outputData['tradevalues'];
                    
                }
                
            }
            $totalTradeValue += $tadeVal;
            $totalTradeValueY += $tadeVal2;
            $dataChartArr[$faceVal][] = $tadeVal;
            $dataChartArr2[$faceVal][] = $tadeVal2;
        }
        
        foreach($dataChartArr AS $face => $value)
        {
            $dataChartArr[$face][0] = number_format(($value[0]*100/$totalTradeValue),2,'.','');
        }
        foreach($dataChartArr2 AS $face => $value)
        {
            $dataChartArr2[$face][0] = number_format(($value[0]*100/$totalTradeValueY),2,'.','');
        }
        
        /*echo "<pre>";
        echo $totalTradeValue."+".$totalTradeValueY."<br>";
        print_r($dataChartArr);
        print_r($dataChartArr2);       
        
        die;*/
        
        
        
        # The data for the bar chart 
        
        $data1 = array($dataChartArr[1000][0], $dataChartArr[100][0], $dataChartArr[10][0],$dataChartArr[1][0]);        
        $data3 = array($dataChartArr2[1000][0], $dataChartArr2[100][0], $dataChartArr2[10][0],$dataChartArr2[1][0]);        
        
        # The labels for the bar chart. The labels contains embedded images as icons. 
        
        $labels = array("1000Tk", "100Tk", "10Tk", "1Tk"); 
        # Create a XYChart object of size 600 x 350 pixels, using 0xe0e0ff as the background 
        # color, 0xccccff as the border color, with 1 pixel 3D border effect. 
        //$c = new XYChart(600, 350, 0x0B578F, 0x60B8F8, 1); 
        $c = new XYChart(600, 350, 0xE9FFE2, 0x0B578F, 1); 
        #Set directory for loading images to current script directory 
        #Need when running under Microsoft IIS 
        $c->setSearchPath(dirname(__FILE__)); 
        # Add a title to the chart using 14 points Times Bold Itatic font and light blue 
        # (0x9999ff) as the background color 
        $textBoxObj = $c->addTitle("FACE VALUE CHART", "timesbi.ttf", 14); 
        $textBoxObj->setBackground(0x838F7F); 
        # Set the plotarea at (60, 45) and of size 500 x 210 pixels, using white (0xffffff) 
        # as the background 
        $c->setPlotArea(60, 45, 500, 210, 0xffffff); 
        # Swap the x and y axes to create a horizontal bar chart 
        $c->swapXY(); 
        # Add a title to the y axis using 11 pt Times Bold Italic as font 
        $c->yAxis->setTitle("Trade Value (%)", "timesbi.ttf", 11); 
        # Set the labels on the x axis 
        $c->xAxis->setLabels($labels); 
        # Disable x-axis ticks by setting the tick length to 0 
        $c->xAxis->setTickLength(0); 
        # Add a stacked bar layer to the chart 
        $layer = $c->addBarLayer2(Stack); 
        # Add the first two data sets to the chart as a stacked bar group 
        $layer->addDataGroup("2001"); 
        //$layer->addDataSet($data0, 0xaaaaff, "Local"); 
        $layer->addDataSet($data1, 0x2D8F0A, $last_date); 
        //$layer->setBarShape(CircleShape);
        # Add the remaining data sets to the chart as another stacked bar group 
        $layer->addDataGroup("2002"); 
        //$layer->addDataSet($data2, 0xffaaaa, "Local"); 
        $layer->addDataSet($data3, 0xA52C2C, $prev_date); 
        
        # Set the sub-bar gap to 0, so there is no gap between stacked bars with a group 
        $layer->setBarGap(0.05, 0); 
        # Set the bar border to transparent 
        $layer->setBorderColor(Transparent); 
        # Set the aggregate label format 
        $layer->setAggregateLabelFormat("{value}%"); 
        # Set the aggregate label font to 8 point Arial Bold Italic 
        $layer->setAggregateLabelStyle("arialbi.ttf", 8); 
        # Reverse 20% space at the right during auto-scaling to allow space for the aggregate 
        # bar labels 
        $c->yAxis->setAutoScale(0.2); 
        # Add a legend box at (310, 300) using TopCenter alignment, with 2 column grid 
        # layout, and use 8 pts Arial Bold Italic as font 
        $legendBox = $c->addLegend2(310, 300, 2, "arialbi.ttf", 8); 
        $legendBox->setAlignment(TopCenter); 
        # Set the format of the text displayed in the legend box 
        $legendBox->setText("{dataSetName} Trade Value"); 
        # Set the background and border of the legend box to transparent 
        $legendBox->setBackground(Transparent, Transparent); 
        # Output the chart 
        header("Content-type: image/png"); 
        print($c->makeChart2(PNG));
        
    }
    
    function newspaper_weeklyfacevalue()
    {
        $this->layout ='default-bodyonly'; 
        $this->pageTitle = 'Stock Bangladesh :: Face Value Chart';
        //echo "<pre>";
        //App::import ( 'Vendor', 'Phpchartdir', array ('file' => 'phpchartdir.php'));
        
        $symbolSQl  = "SELECT * FROM symbols WHERE id>4 AND otc_market='No' AND inactive='No'";
        $symbolQRY  = mysql_query($symbolSQl);
        $symbolDataArr = array();
        while($data = mysql_fetch_assoc($symbolQRY))
        {
            $faceVal = $data['face_value'];
            settype($faceVal,"integer");
            $symbolDataArr[$faceVal][$data['id']] = $data['dse_code'];
        }
        
        
        $dataChartArr = array();
        $dataChartArrPrev = array();
        $totalTradeValue  = 0;
        $totalTradeValueY  = 0;
        foreach($symbolDataArr AS $faceVal => $dataArr)
        {
            $tadeVal = 0;
            $tadeVal2 = 0;
            
            foreach($dataArr AS $symbol => $data)
            {
                $outputSQL  = "SELECT * FROM weekly_data WHERE symbol=".$symbol." ORDER BY id DESC LIMIT 2";
                $outputQRY  = mysql_query($outputSQL);
                $temp = array();
                $count = 0;
                while($outputData = mysql_fetch_assoc($outputQRY))
                {
                    $count++;
                    if($count == 1)
                    {
                        $tadeVal += $outputData['tradevalues'];
                        $last_date = $outputData['date'];
                    }
                    else if($count == 2)
                    {
                        $tadeVal2 += $outputData['tradevalues'];
                        $prev_date = $outputData['date'];
                    }
                    else
                        echo "error<br>";
                    
                }
                
            }
            $totalTradeValue  += $tadeVal;
            $totalTradeValueY += $tadeVal2;
            $dataChartArr[$faceVal][] = $tadeVal;
            $dataChartArr2[$faceVal][] = $tadeVal2;
        }
        foreach($dataChartArr AS $face => $value)
        {
            $dataChartArr[$face][0] = number_format(($value[0]*100/$totalTradeValue),2,'.','');
        }
        foreach($dataChartArr2 AS $face => $value)
        {
            $dataChartArr2[$face][0] = number_format(($value[0]*100/$totalTradeValueY),2,'.','');
        }
        
        /*echo "<pre>";
        echo $totalTradeValue."+".$totalTradeValueY."<br>";
        print_r($dataChartArr);
        print_r($dataChartArr2);

        die;*/
        
        
        
        # The data for the bar chart 
        
        $data1 = array($dataChartArr[1000][0], $dataChartArr[100][0], $dataChartArr[10][0],$dataChartArr[1][0]);        
        $data3 = array($dataChartArr2[1000][0], $dataChartArr2[100][0], $dataChartArr2[10][0],$dataChartArr2[1][0]);        
        
        # The labels for the bar chart. The labels contains embedded images as icons. 
        
        $labels = array("1000Tk", "100Tk", "10Tk", "1Tk"); 
        # Create a XYChart object of size 600 x 350 pixels, using 0xe0e0ff as the background 
        # color, 0xccccff as the border color, with 1 pixel 3D border effect. 
        $c = new XYChart(600, 350, 0xE9FFE2, 0x0B578F, 1); 
        #Set directory for loading images to current script directory 
        #Need when running under Microsoft IIS 
        $c->setSearchPath(dirname(__FILE__)); 
        # Add a title to the chart using 14 points Times Bold Itatic font and light blue 
        # (0x9999ff) as the background color 
        $textBoxObj = $c->addTitle("FACE VALUE WEEKLY CHART", "timesbi.ttf", 14); 
        $textBoxObj->setBackground(0x838F7F); 
        # Set the plotarea at (60, 45) and of size 500 x 210 pixels, using white (0xffffff) 
        # as the background 
        $c->setPlotArea(60, 45, 500, 210, 0xffffff); 
        # Swap the x and y axes to create a horizontal bar chart 
        $c->swapXY(); 
        # Add a title to the y axis using 11 pt Times Bold Italic as font 
        $c->yAxis->setTitle("Trade Value (%)", "timesbi.ttf", 11); 
        # Set the labels on the x axis 
        $c->xAxis->setLabels($labels); 
        # Disable x-axis ticks by setting the tick length to 0 
        $c->xAxis->setTickLength(0); 
        # Add a stacked bar layer to the chart 
        $layer = $c->addBarLayer2(Stack); 
        # Add the first two data sets to the chart as a stacked bar group 
        $layer->addDataGroup("2001"); 
        //$layer->addDataSet($data0, 0xaaaaff, "Local"); 
        $layer->addDataSet($data1, 0x2D8F0A, "This Week"); 
        # Add the remaining data sets to the chart as another stacked bar group 
        $layer->addDataGroup("2002"); 
        //$layer->addDataSet($data2, 0xffaaaa, "Local"); 
        $layer->addDataSet($data3, 0xA52C2C, "Prev Week"); 
        # Set the sub-bar gap to 0, so there is no gap between stacked bars with a group 
        $layer->setBarGap(0.2, 0); 
        # Set the bar border to transparent 
        $layer->setBorderColor(Transparent); 
        # Set the aggregate label format 
        $layer->setAggregateLabelFormat("{value}%"); 
        # Set the aggregate label font to 8 point Arial Bold Italic 
        $layer->setAggregateLabelStyle("arialbi.ttf", 8); 
        # Reverse 20% space at the right during auto-scaling to allow space for the aggregate 
        # bar labels 
        $c->yAxis->setAutoScale(0.2); 
        # Add a legend box at (310, 300) using TopCenter alignment, with 2 column grid 
        # layout, and use 8 pts Arial Bold Italic as font 
        $legendBox = $c->addLegend2(310, 300, 2, "arialbi.ttf", 8); 
        $legendBox->setAlignment(TopCenter); 
        # Set the format of the text displayed in the legend box 
        $legendBox->setText("{dataSetName} Trade Value"); 
        # Set the background and border of the legend box to transparent 
        $legendBox->setBackground(Transparent, Transparent); 
        # Output the chart 
        header("Content-type: image/png"); 
        print($c->makeChart2(PNG));
        
    }
    
    
    
    function newspaper_paidup()
    {
        $this->layout ='default-bodyonly'; 
        $this->pageTitle = 'Stock Bangladesh :: Paid Up Cap Chart';
        //echo "<pre>";
        //App::import ( 'Vendor', 'Phpchartdir', array ('file' => 'phpchartdir.php'));
        $dateSql   = mysql_query("SELECT date FROM market_summeries ORDER BY id desc LIMIT 2");
        $dateArr = array();
        while($date = mysql_fetch_assoc($dateSql))
        {
            $dateArr[] = $date['date'];
        }
        
        $last_date = $dateArr[0];
        $prev_date = $dateArr[1];
        list($y,$m,$d) = explode("-",$last_date);
        list($y2,$m2,$d2) = explode("-",$prev_date);
        
        $symbolSQl  = "SELECT * FROM symbols WHERE id>4 AND otc_market='No' AND inactive='No'";
        $symbolQRY  = mysql_query($symbolSQl);
        $symbolDataArr = array();
        while($data = mysql_fetch_assoc($symbolQRY))
        {
            $outstanding_capitalVal = $data['outstanding_capital'];
            settype($outstanding_capitalVal,"double");
            $outstanding_capitalVal = $outstanding_capitalVal * 1000000;
            if($outstanding_capitalVal>0 AND $outstanding_capitalVal<=200000000)
                $symbolDataArr[0][$data['id']] = $data['dse_code'];
            else if($outstanding_capitalVal>200000000 AND $outstanding_capitalVal<=500000000)
                $symbolDataArr[1][$data['id']] = $data['dse_code'];
            else if($outstanding_capitalVal>500000000 AND $outstanding_capitalVal<=1000000000)
                $symbolDataArr[2][$data['id']] = $data['dse_code'];
            else if($outstanding_capitalVal>1000000000 AND $outstanding_capitalVal<=3000000000)
                $symbolDataArr[3][$data['id']] = $data['dse_code'];
            else if($outstanding_capitalVal>3000000000)
                $symbolDataArr[4][$data['id']] = $data['dse_code'];
            
        }
        
        //print_r($symbolDataArr);die;
        
        $dataChartArr = array();
        $dataChartArrPrev = array();
        $totalTradeValue  = 0;
        $totalTradeValueY = 0;
        foreach($symbolDataArr AS $rangeVal => $dataArr)
        {
            $tadeVal = 0;
            $tadeVal2 = 0;
            foreach($dataArr AS $symbol => $data)
            {
                $outputSQL  = "SELECT * FROM outputs WHERE symbol=".$symbol." AND date='".($d.'-'.$m.'-'.$y)."'";
                $outputQRY  = mysql_query($outputSQL);
                
                while($outputData = mysql_fetch_assoc($outputQRY))
                {
                    $tadeVal += $outputData['tradevalues'];
                    //$dataChartArr[$faceVal][]
                }
                $outputSQL  = "SELECT * FROM outputs WHERE symbol=".$symbol." AND date='".($d2.'-'.$m2.'-'.$y2)."'";
                $outputQRY  = mysql_query($outputSQL);
                
                while($outputData = mysql_fetch_assoc($outputQRY))
                {
                    $tadeVal2 += $outputData['tradevalues'];
                    //$dataChartArr[$faceVal][]
                }
                
            }
            $dataChartArr[$rangeVal][] = $tadeVal;
            $dataChartArr2[$rangeVal][] = $tadeVal2;
            $totalTradeValue  += $tadeVal;
            $totalTradeValueY += $tadeVal2;
            
        }
        foreach($dataChartArr AS $face => $value)
        {
            $dataChartArr[$face][0] = number_format(($value[0]*100/$totalTradeValue),2,'.','');
        }
        foreach($dataChartArr2 AS $face => $value)
        {
            $dataChartArr2[$face][0] = number_format(($value[0]*100/$totalTradeValueY),2,'.','');
        }
        /*echo "<pre>";
        echo $totalTradeValue."+".$totalTradeValueY."<br>";
        print_r($dataChartArr);
        print_r($dataChartArr2);  
        
        die;*/
        
        
        
        # The data for the bar chart 
        
        $data1 = array($dataChartArr[0][0], $dataChartArr[1][0], $dataChartArr[2][0], $dataChartArr[3][0],$dataChartArr[4][0]);        
        $data3 = array($dataChartArr2[0][0], $dataChartArr2[1][0], $dataChartArr2[2][0], $dataChartArr2[3][0],$dataChartArr2[4][0]);        
        
        
        # The labels for the bar chart. The labels contains embedded images as icons. 
        
        $labels = array("0-20", "20-50", "50-100", "100-300", ">300" ); 
        # Create a XYChart object of size 600 x 350 pixels, using 0xe0e0ff as the background 
        # color, 0xccccff as the border color, with 1 pixel 3D border effect. 
        //$c = new XYChart(620, 380, 0xE9FFE2, 0x0B578F, 1); 
        $c = new XYChart(820, 580, 0xECECEC, 0x0B578F, 1);  
        #Set directory for loading images to current script directory 
        #Need when running under Microsoft IIS 
        $c->setSearchPath(dirname(__FILE__)); 
        # Add a title to the chart using 14 points Times Bold Itatic font and light blue 
        # (0x9999ff) as the background color 
        //$textBoxObj = $c->addTitle("Paid-up Capital CHART", "timesbi.ttf", 14); 
       // $textBoxObj->setBackground(0xECECEC); 
        # Set the plotarea at (60, 45) and of size 500 x 210 pixels, using white (0xffffff) 
        # as the background 
        $c->setPlotArea(80, 45, 700, 460, 0xECECEC); 
        # Swap the x and y axes to create a horizontal bar chart 
        $c->swapXY(); 
        # Add a title to the y axis using 11 pt Times Bold Italic as font 
       // $c->yAxis->setTitle("Trade Value (%)", "timesbi.ttf", 11); 
        $c->yAxis->setTitle("PAIDUP CAPITAL COMPARISON", "timesbi.ttf", 13); 
        # Set the labels on the x axis 
        $c->xAxis->setLabels($labels); 
        $c->xAxis->setLabelStyle ( "arialbi.ttf", 16, TextColor, 45 ); 
        # Disable x-axis ticks by setting the tick length to 0 
        $c->xAxis->setTickLength(0); 
        # Add a stacked bar layer to the chart 
        $layer = $c->addBarLayer2(Stack); 
        # Add the first two data sets to the chart as a stacked bar group 
        $layer->addDataGroup("2001"); 
        //$layer->addDataSet($data0, 0xaaaaff, "Local"); 
        $layer->addDataSet($data1, 0x3D6FBA, $last_date); 
        # Add the remaining data sets to the chart as another stacked bar group 
        $layer->addDataGroup("2002"); 
        //$layer->addDataSet($data2, 0xffaaaa, "Local"); 
        $layer->addDataSet($data3, 0xF36910, $prev_date); 
        # Set the sub-bar gap to 0, so there is no gap between stacked bars with a group 
        $layer->setBarGap(0.2, 0); 
        # Set the bar border to transparent 
        $layer->setBorderColor(Transparent); 
        # Set the aggregate label format 
        $layer->setAggregateLabelFormat("{value}%"); 
        # Set the aggregate label font to 8 point Arial Bold Italic 
        $layer->setAggregateLabelStyle("arialbi.ttf", 20); 
        # Reverse 20% space at the right during auto-scaling to allow space for the aggregate 
        # bar labels 
        $c->yAxis->setAutoScale(0.2); 
        # Add a legend box at (310, 300) using TopCenter alignment, with 2 column grid 
        # layout, and use 8 pts Arial Bold Italic as font 
       // $legendBox = $c->addLegend2(510, 445, 2, "arialbi.ttf", 8); 
       // $legendBox->setAlignment(TopCenter); 
        # Set the format of the text displayed in the legend box 
       // $legendBox->setText("{dataSetName} Trade Value"); 
        # Set the background and border of the legend box to transparent 
        //$legendBox->setBackground(Transparent, Transparent); 
        # Output the chart 
        header("Content-type: image/png"); 
        print($c->makeChart2(PNG));
       
    }
    function newspaper_weeklypaidup()
    {
        $this->layout ='default-bodyonly'; 
        $this->pageTitle = 'Stock Bangladesh :: Weekly Paid Up Cap Chart';
        //echo "<pre>";
        //App::import ( 'Vendor', 'Phpchartdir', array ('file' => 'phpchartdir.php'));
        $dateSql   = mysql_query("SELECT date FROM market_summeries ORDER BY id desc LIMIT 2");
        $dateArr = array();
        while($date = mysql_fetch_assoc($dateSql))
        {
            $dateArr[] = $date['date'];
        }
        
        $last_date = $dateArr[0];
        $prev_date = $dateArr[1];
        list($y,$m,$d) = explode("-",$last_date);
        list($y2,$m2,$d2) = explode("-",$prev_date);
        
        $symbolSQl  = "SELECT * FROM symbols WHERE id>4 AND otc_market='No' AND inactive='No'";
        $symbolQRY  = mysql_query($symbolSQl);
        $symbolDataArr = array();
        while($data = mysql_fetch_assoc($symbolQRY))
        {
            $outstanding_capitalVal = $data['outstanding_capital'];
            settype($outstanding_capitalVal,"double");
            $outstanding_capitalVal = $outstanding_capitalVal * 1000000;
            if($outstanding_capitalVal>0 AND $outstanding_capitalVal<=200000000)
                $symbolDataArr[0][$data['id']] = $data['dse_code'];
            else if($outstanding_capitalVal>200000000 AND $outstanding_capitalVal<=500000000)
                $symbolDataArr[1][$data['id']] = $data['dse_code'];
            else if($outstanding_capitalVal>500000000 AND $outstanding_capitalVal<=1000000000)
                $symbolDataArr[2][$data['id']] = $data['dse_code'];
            else if($outstanding_capitalVal>1000000000 AND $outstanding_capitalVal<=3000000000)
                $symbolDataArr[3][$data['id']] = $data['dse_code'];
            else if($outstanding_capitalVal>3000000000)
                $symbolDataArr[4][$data['id']] = $data['dse_code'];
            
        }
        
        //print_r($symbolDataArr);die;
        
        $dataChartArr = array();
        $dataChartArrPrev = array();
        $totalTradeValue  = 0;
        $totalTradeValueY = 0;
        foreach($symbolDataArr AS $rangeVal => $dataArr)
        {
            $tadeVal = 0;
            $tadeVal2 = 0;
            foreach($dataArr AS $symbol => $data)
            {
                $outputSQL  = "SELECT * FROM weekly_data WHERE symbol=".$symbol." ORDER BY id DESC LIMIT 2";
                $outputQRY  = mysql_query($outputSQL);
                $temp = array();
                $count = 0;
                while($outputData = mysql_fetch_assoc($outputQRY))
                {
                    $count++;
                    if($count == 1)
                    {
                        $tadeVal += $outputData['tradevalues'];
                        $last_date = $outputData['date'];
                    }
                    else if($count == 2)
                    {
                        $tadeVal2 += $outputData['tradevalues'];
                        $prev_date = $outputData['date'];
                    }
                    else
                        echo "error<br>";
                    
                }
                
            }
            $dataChartArr[$rangeVal][] = $tadeVal;
            $dataChartArr2[$rangeVal][] = $tadeVal2;            
            $totalTradeValue  += $tadeVal;
            $totalTradeValueY += $tadeVal2;
            
        }
        foreach($dataChartArr AS $face => $value)
        {
            $dataChartArr[$face][0] = number_format(($value[0]*100/$totalTradeValue),2,'.','');
        }
        foreach($dataChartArr2 AS $face => $value)
        {
            $dataChartArr2[$face][0] = number_format(($value[0]*100/$totalTradeValueY),2,'.','');
        }
        
        /*echo "<pre>";
        //print_r($symbolDataArr);
        print_r($dataChartArr);
        print_r($dataChartArr2);  
        
        die;*/
        
        
        
        # The data for the bar chart 
        
        $data1 = array($dataChartArr[0][0], $dataChartArr[1][0], $dataChartArr[2][0], $dataChartArr[3][0],$dataChartArr[4][0]);        
        $data3 = array($dataChartArr2[0][0], $dataChartArr2[1][0], $dataChartArr2[2][0], $dataChartArr2[3][0],$dataChartArr2[4][0]);        
        
        
        # The labels for the bar chart. The labels contains embedded images as icons. 
        
        $labels = array("0-20 CORE", "20-50 CORE", "50-100 CORE", "100-300 CORE", ">300 CORE " ); 
        # Create a XYChart object of size 600 x 350 pixels, using 0xe0e0ff as the background 
        # color, 0xccccff as the border color, with 1 pixel 3D border effect. 
        $c = new XYChart(620, 380, 0xE9FFE2, 0x0B578F, 1); 
        #Set directory for loading images to current script directory 
        #Need when running under Microsoft IIS 
        $c->setSearchPath(dirname(__FILE__)); 
        # Add a title to the chart using 14 points Times Bold Itatic font and light blue 
        # (0x9999ff) as the background color 
        $textBoxObj = $c->addTitle("Paid-up Capital Weekly CHART", "timesbi.ttf", 14); 
        $textBoxObj->setBackground(0x838F7F); 
        # Set the plotarea at (60, 45) and of size 500 x 210 pixels, using white (0xffffff) 
        # as the background 
        $c->setPlotArea(80, 45, 500, 240, 0xffffff); 
        # Swap the x and y axes to create a horizontal bar chart 
        $c->swapXY(); 
        # Add a title to the y axis using 11 pt Times Bold Italic as font 
        $c->yAxis->setTitle("Trade Value (%)", "timesbi.ttf", 11); 
        # Set the labels on the x axis 
        $c->xAxis->setLabels($labels); 
        # Disable x-axis ticks by setting the tick length to 0 
        $c->xAxis->setTickLength(0); 
        # Add a stacked bar layer to the chart 
        $layer = $c->addBarLayer2(Stack); 
        # Add the first two data sets to the chart as a stacked bar group 
        $layer->addDataGroup("2001"); 
        //$layer->addDataSet($data0, 0xaaaaff, "Local"); 
        $layer->addDataSet($data1, 0x2D8F0A, "This Week"); 
        # Add the remaining data sets to the chart as another stacked bar group 
        $layer->addDataGroup("2002"); 
        //$layer->addDataSet($data2, 0xffaaaa, "Local"); 
        $layer->addDataSet($data3, 0xA52C2C, "Prev Week"); 
        # Set the sub-bar gap to 0, so there is no gap between stacked bars with a group 
        $layer->setBarGap(0.2, 0); 
        # Set the bar border to transparent 
        $layer->setBorderColor(Transparent); 
        # Set the aggregate label format 
        $layer->setAggregateLabelFormat("{value}%"); 
        # Set the aggregate label font to 8 point Arial Bold Italic 
        $layer->setAggregateLabelStyle("arialbi.ttf", 8); 
        # Reverse 20% space at the right during auto-scaling to allow space for the aggregate 
        # bar labels 
        $c->yAxis->setAutoScale(0.2); 
        # Add a legend box at (310, 300) using TopCenter alignment, with 2 column grid 
        # layout, and use 8 pts Arial Bold Italic as font 
        $legendBox = $c->addLegend2(310, 330, 2, "arialbi.ttf", 8); 
        $legendBox->setAlignment(TopCenter); 
        # Set the format of the text displayed in the legend box 
        $legendBox->setText("{dataSetName} Trade Value"); 
        # Set the background and border of the legend box to transparent 
        $legendBox->setBackground(Transparent, Transparent); 
        # Output the chart 
        header("Content-type: image/png"); 
        print($c->makeChart2(PNG));
       
    }
    
    
    function newspaper_pe()
    {
        $this->layout ='default-bodyonly'; 
        $this->pageTitle = 'Stock Bangladesh :: Paid Up Cap Chart';
        //echo "<pre>";
        //App::import ( 'Vendor', 'Phpchartdir', array ('file' => 'phpchartdir.php'));
        $dateSql   = mysql_query("SELECT date FROM market_summeries ORDER BY id desc LIMIT 2");
        $dateArr = array();
        while($date = mysql_fetch_assoc($dateSql))
        {
            $dateArr[] = $date['date'];
        }
        
        $last_date = $dateArr[0];
        $prev_date = $dateArr[1];
        list($y,$m,$d) = explode("-",$last_date);
        list($y2,$m2,$d2) = explode("-",$prev_date);
        
        $symbolSQl  = "SELECT * FROM symbols WHERE id>4 AND otc_market='No' AND inactive='No'";
        $symbolQRY  = mysql_query($symbolSQl);
        $symbolDataArr = array();
        while($code = mysql_fetch_assoc($symbolQRY))
        {            
            $annualizeEPS = 0;
            if($code['q4'])
                $annualizeEPS = $code['q4'] * 1;
            else if($code['q3'])
                $annualizeEPS = $code['q3'] * 4/3;
            else if($code['q2'])
                $annualizeEPS = $code['q2'] * 2;
            else if($code['q1'])
                $annualizeEPS = $code['q1'] * 4;
            
            if(!empty($code['lasttradeprice']) AND !empty($annualizeEPS))
                $PE = $code['lasttradeprice'] / $annualizeEPS;
            else
                $PE = 0;
            
            if($PE>0 AND $PE<=20)
                $symbolDataArr[0][$code['id']] = $code['dse_code'];
            else if($PE>20 AND $PE<=40)
                $symbolDataArr[1][$code['id']] = $code['dse_code'];
            else if($PE>40 OR $PE<0)
                $symbolDataArr[2][$code['id']] = $code['dse_code'];            
            
        }
        
        //print_r($symbolDataArr);die;
        
        $dataChartArr = array();
        $dataChartArrPrev = array();
        $totalTradeValue  = 0;
        $totalTradeValueY = 0;
        foreach($symbolDataArr AS $rangeVal => $dataArr)
        {
            $tadeVal = 0;
            $tadeVal2 = 0;
            foreach($dataArr AS $symbol => $data)
            {
                $outputSQL  = "SELECT * FROM outputs WHERE symbol=".$symbol." AND date='".($d.'-'.$m.'-'.$y)."'";
                $outputQRY  = mysql_query($outputSQL);
                
                while($outputData = mysql_fetch_assoc($outputQRY))
                {
                    $tadeVal += $outputData['tradevalues'];
                    //$dataChartArr[$faceVal][]
                }
                $outputSQL  = "SELECT * FROM outputs WHERE symbol=".$symbol." AND date='".($d2.'-'.$m2.'-'.$y2)."'";
                $outputQRY  = mysql_query($outputSQL);
                
                while($outputData = mysql_fetch_assoc($outputQRY))
                {
                    $tadeVal2 += $outputData['tradevalues'];
                    //$dataChartArr[$faceVal][]
                }
                
            }
            $dataChartArr[$rangeVal][] = $tadeVal;
            $dataChartArr2[$rangeVal][] = $tadeVal2;
            $totalTradeValue  += $tadeVal;
            $totalTradeValueY += $tadeVal2;
            
        }
        foreach($dataChartArr AS $face => $value)
        {
            $dataChartArr[$face][0] = number_format(($value[0]*100/$totalTradeValue),2,'.','');
        }
        foreach($dataChartArr2 AS $face => $value)
        {
            $dataChartArr2[$face][0] = number_format(($value[0]*100/$totalTradeValueY),2,'.','');
        }
        
        /*echo "<pre>";
        //print_r($symbolDataArr);
        print_r($dataChartArr);
        print_r($dataChartArr2);  
        
        die;*/
        
        
        
        # The data for the bar chart 
        
        $data1 = array($dataChartArr[0][0], $dataChartArr[1][0], $dataChartArr[2][0]);
        $data3 = array($dataChartArr2[0][0], $dataChartArr2[1][0], $dataChartArr2[2][0]);
        
        
        # The labels for the bar chart. The labels contains embedded images as icons. 
        
        $labels = array("0-20", "20-40", ">41"); 
        # Create a XYChart object of size 600 x 350 pixels, using 0xe0e0ff as the background 
        # color, 0xccccff as the border color, with 1 pixel 3D border effect. 
        //$c = new XYChart(620, 350, 0xE9FFE2, 0x0B578F, 1); 
        $c = new XYChart(820, 580, 0xFFFFFF, 0x0B578F, 1);  
        #Set directory for loading images to current script directory 
        #Need when running under Microsoft IIS 
        $c->setSearchPath(dirname(__FILE__)); 
        # Add a title to the chart using 14 points Times Bold Itatic font and light blue 
        # (0x9999ff) as the background color 
       // $textBoxObj = $c->addTitle("P/E CHART", "timesbi.ttf", 14); 
        //$textBoxObj->setBackground(0x838F7F); 
        //$textBoxObj->setBackground(0xFFFFFF); 
        # Set the plotarea at (60, 45) and of size 500 x 210 pixels, using white (0xffffff) 
        # as the background 
        //$c->setPlotArea(80, 45, 500, 210, 0xffffff); 
         $c->setPlotArea(80, 45, 700, 460, 0xFFFFFF);
        # Swap the x and y axes to create a horizontal bar chart 
        $c->swapXY(); 
        # Add a title to the y axis using 11 pt Times Bold Italic as font 
       // $c->yAxis->setTitle("Trade Value (%)", "timesbi.ttf", 11); 
        $c->yAxis->setTitle("P/E BASED TRADE COMPARISON", "timesbi.ttf", 13); 
        # Set the labels on the x axis 
        $c->xAxis->setLabels($labels);
         $c->xAxis->setLabelStyle ( "arialbi.ttf", 20, TextColor, 0 );
        //$c->xAxis->setLabelsStyle("arialbi.ttf", 14); 
        # Disable x-axis ticks by setting the tick length to 0 
        $c->xAxis->setTickLength(0); 
        # Add a stacked bar layer to the chart 
        $layer = $c->addBarLayer2(Stack); 
        # Add the first two data sets to the chart as a stacked bar group 
        $layer->addDataGroup("2001"); 
        //$layer->addDataSet($data0, 0xaaaaff, "Local"); 
                
        //$layer->addDataSet($data1, 0x2D8F0A, $last_date); 
        $layer->addDataSet($data1, 0x3D6FBA, $last_date);
        # Add the remaining data sets to the chart as another stacked bar group 
        $layer->addDataGroup("2002"); 
        //$layer->addDataSet($data2, 0xffaaaa, "Local"); 
       // $layer->addDataSet($data3, 0xA52C2C, $prev_date); 
       //$layer->addDataSet($data3, 0x626466, $prev_date); 
       $layer->addDataSet($data3, 0xF36910, $prev_date); 
       
        # Set the sub-bar gap to 0, so there is no gap between stacked bars with a group 
        $layer->setBarGap(0.2, 0); 
        # Set the bar border to transparent 
        $layer->setBorderColor(Transparent); 
        # Set the aggregate label format 
        $layer->setAggregateLabelFormat("{value}%"); 
        # Set the aggregate label font to 8 point Arial Bold Italic 
        $layer->setAggregateLabelStyle("arialbi.ttf", 20); 
        # Reverse 20% space at the right during auto-scaling to allow space for the aggregate 
        # bar labels 
        $c->yAxis->setAutoScale(0.2); 
        # Add a legend box at (310, 300) using TopCenter alignment, with 2 column grid 
        # layout, and use 8 pts Arial Bold Italic as font 
       // $legendBox = $c->addLegend2(500, 100, 2, "arialbi.ttf", 8); 
       // $legendBox->setAlignment(TopCenter); 
        # Set the format of the text displayed in the legend box 
       // $legendBox->setText("{dataSetName} Trade Value"); 
        # Set the background and border of the legend box to transparent 
       // $legendBox->setBackground(Transparent, Transparent); 
        # Output the chart 
        header("Content-type: image/png"); 
        print($c->makeChart2(PNG));        
        
    }
    
    function newspaper_weeklype()
    {
        $this->layout ='default-bodyonly'; 
        $this->pageTitle = 'Stock Bangladesh :: Paid Up Cap Chart';
        //echo "<pre>";
        //App::import ( 'Vendor', 'Phpchartdir', array ('file' => 'phpchartdir.php'));
        $dateSql   = mysql_query("SELECT date FROM market_summeries ORDER BY id desc LIMIT 2");
        $dateArr = array();
        while($date = mysql_fetch_assoc($dateSql))
        {
            $dateArr[] = $date['date'];
        }
        
        $last_date = $dateArr[0];
        $prev_date = $dateArr[1];
        list($y,$m,$d) = explode("-",$last_date);
        list($y2,$m2,$d2) = explode("-",$prev_date);
        
        $symbolSQl  = "SELECT * FROM symbols WHERE id>4 AND otc_market='No' AND inactive='No'";
        $symbolQRY  = mysql_query($symbolSQl);
        $symbolDataArr = array();
        while($code = mysql_fetch_assoc($symbolQRY))
        {            
            $annualizeEPS = 0;
            if($code['q4'])
                $annualizeEPS = $code['q4'] * 1;
            else if($code['q3'])
                $annualizeEPS = $code['q3'] * 4/3;
            else if($code['q2'])
                $annualizeEPS = $code['q2'] * 2;
            else if($code['q1'])
                $annualizeEPS = $code['q1'] * 4;
            
            if(!empty($code['lasttradeprice']) AND !empty($annualizeEPS))
                $PE = $code['lasttradeprice'] / $annualizeEPS;
            else
                $PE = 0;
            
            if($PE>0 AND $PE<=20)
                $symbolDataArr[0][$code['id']] = $code['dse_code'];
            else if($PE>20 AND $PE<=40)
                $symbolDataArr[1][$code['id']] = $code['dse_code'];
            else if($PE>40 OR $PE<0)
                $symbolDataArr[2][$code['id']] = $code['dse_code'];            
            
        }
        
        //print_r($symbolDataArr);die;
        
        $dataChartArr = array();
        $dataChartArrPrev = array();
        $totalTradeValue  = 0;
        $totalTradeValueY = 0;
        foreach($symbolDataArr AS $rangeVal => $dataArr)
        {
            $tadeVal = 0;
            $tadeVal2 = 0;
            foreach($dataArr AS $symbol => $data)
            {
                $outputSQL  = "SELECT * FROM weekly_data WHERE symbol=".$symbol." ORDER BY id DESC LIMIT 2";
                $outputQRY  = mysql_query($outputSQL);
                $temp = array();
                $count = 0;
                while($outputData = mysql_fetch_assoc($outputQRY))
                {
                    $count++;
                    if($count == 1)
                    {
                        $tadeVal += $outputData['tradevalues'];
                        $last_date = $outputData['date'];
                    }
                    else if($count == 2)
                    {
                        $tadeVal2 += $outputData['tradevalues'];
                        $prev_date = $outputData['date'];
                    }
                    else
                        echo "error<br>";
                    
                }
               
            }
            $dataChartArr[$rangeVal][] = $tadeVal;
            $dataChartArr2[$rangeVal][] = $tadeVal2;
            $totalTradeValue  += $tadeVal;
            $totalTradeValueY += $tadeVal2;
            
        }
        foreach($dataChartArr AS $face => $value)
        {
            $dataChartArr[$face][0] = number_format(($value[0]*100/$totalTradeValue),2,'.','');
        }
        foreach($dataChartArr2 AS $face => $value)
        {
            $dataChartArr2[$face][0] = number_format(($value[0]*100/$totalTradeValueY),2,'.','');
        }
        
        /*echo "<pre>";        
        print_r($dataChartArr);
        print_r($dataChartArr2);  
        
        die;*/
        
        
        
        # The data for the bar chart 
        
        $data1 = array($dataChartArr[0][0], $dataChartArr[1][0], $dataChartArr[2][0]);
        $data3 = array($dataChartArr2[0][0], $dataChartArr2[1][0], $dataChartArr2[2][0]);
        
        
        # The labels for the bar chart. The labels contains embedded images as icons. 
        
        $labels = array("0-20", "20-40", ">41"); 
        # Create a XYChart object of size 600 x 350 pixels, using 0xe0e0ff as the background 
        # color, 0xccccff as the border color, with 1 pixel 3D border effect. 
        $c = new XYChart(620, 350, 0xE9FFE2, 0x0B578F, 1); 
        #Set directory for loading images to current script directory 
        #Need when running under Microsoft IIS 
        $c->setSearchPath(dirname(__FILE__)); 
        # Add a title to the chart using 14 points Times Bold Itatic font and light blue 
        # (0x9999ff) as the background color 
        $textBoxObj = $c->addTitle("P/E Weekly CHART", "timesbi.ttf", 14); 
        $textBoxObj->setBackground(0x838F7F); 
        # Set the plotarea at (60, 45) and of size 500 x 210 pixels, using white (0xffffff) 
        # as the background 
        $c->setPlotArea(80, 45, 500, 210, 0xffffff); 
        # Swap the x and y axes to create a horizontal bar chart 
        $c->swapXY(); 
        # Add a title to the y axis using 11 pt Times Bold Italic as font 
        $c->yAxis->setTitle("Trade Value (%)", "timesbi.ttf", 11); 
        # Set the labels on the x axis 
        $c->xAxis->setLabels($labels); 
        # Disable x-axis ticks by setting the tick length to 0 
        $c->xAxis->setTickLength(0); 
        # Add a stacked bar layer to the chart 
        $layer = $c->addBarLayer2(Stack); 
        # Add the first two data sets to the chart as a stacked bar group 
        $layer->addDataGroup("2001"); 
        //$layer->addDataSet($data0, 0xaaaaff, "Local"); 
        $layer->addDataSet($data1, 0x2D8F0A, "This Week"); 
        # Add the remaining data sets to the chart as another stacked bar group 
        $layer->addDataGroup("2002"); 
        //$layer->addDataSet($data2, 0xffaaaa, "Local"); 
        $layer->addDataSet($data3, 0xA52C2C, "Prev Week"); 
        # Set the sub-bar gap to 0, so there is no gap between stacked bars with a group 
        $layer->setBarGap(0.2, 0); 
        # Set the bar border to transparent 
        $layer->setBorderColor(Transparent); 
        # Set the aggregate label format 
        $layer->setAggregateLabelFormat("{value}%"); 
        # Set the aggregate label font to 8 point Arial Bold Italic 
        $layer->setAggregateLabelStyle("arialbi.ttf", 8); 
        # Reverse 20% space at the right during auto-scaling to allow space for the aggregate 
        # bar labels 
        $c->yAxis->setAutoScale(0.2); 
        # Add a legend box at (310, 300) using TopCenter alignment, with 2 column grid 
        # layout, and use 8 pts Arial Bold Italic as font 
        $legendBox = $c->addLegend2(310, 300, 2, "arialbi.ttf", 8); 
        $legendBox->setAlignment(TopCenter); 
        # Set the format of the text displayed in the legend box 
        $legendBox->setText("{dataSetName} Trade Value"); 
        # Set the background and border of the legend box to transparent 
        $legendBox->setBackground(Transparent, Transparent); 
        # Output the chart 
        header("Content-type: image/png"); 
        print($c->makeChart2(PNG));
        
        
        
    }
    
    function newspaper_report()
    {
        //Configure::write('debug',3);
        $this->layout ='default-bodyonly'; 
        $this->pageTitle = 'Stock Bangladesh :: Newspaper Report';
        $ip          = $_SERVER['REMOTE_ADDR'];
        $ipcheckSql  = "SELECT ip FROM user_ip WHERE is_active =1 AND ip='ipcheck'";
        $ipenable    = mysql_query($ipcheckSql);
        if(mysql_num_rows($ipenable))
        {
            $brokerIPSql = "SELECT ip FROM user_ip WHERE is_active =1 AND ip='".$ip."'";
            $access = mysql_query($brokerIPSql);
            if(!mysql_num_rows($access))
            {
                $this->Session->setFlash ( 'You are not authorized to access this location' );
                $this->redirect ( array ('controller' => 'users', 'action' => 'index' ) );
                //die("You are not authorized to access this location.");
            }
        }
        
        $dateSql   = mysql_query("SELECT date FROM market_summeries ORDER BY id desc LIMIT 2");
        $dateArr = array();
        while($date = mysql_fetch_assoc($dateSql))
        {
            $dateArr[] = $date['date'];
        }
        $this->set('date',$dateArr);
        
        $last_date = $dateArr[0];
        $prev_date = $dateArr[1];
        list($y,$m,$d) = explode("-",$last_date);
        list($y2,$m2,$d2) = explode("-",$prev_date);
        
        $symbolSQl  = "SELECT * FROM symbols WHERE id>4 AND otc_market='No' AND inactive='No'";
        $symbolQRY  = mysql_query($symbolSQl);
        $symbolDataArr = array();
        while($data = mysql_fetch_assoc($symbolQRY))
        {
            $faceVal = $data['face_value'];
            settype($faceVal,"integer");
            $symbolDataArr[$faceVal][$data['id']] = $data['dse_code'];
        }
        
        $dataChartArr = array();
        $dataChartArrPrev = array();
        $totalTradeValue  = 0;
        $totalTradeValueY = 0;
        foreach($symbolDataArr AS $faceVal => $dataArr)
        {
            $tadeVal = 0;
            $tadeVal2 = 0;
            foreach($dataArr AS $symbol => $data)
            {
                $outputSQL  = "SELECT * FROM outputs WHERE symbol=".$symbol." AND date='".($d.'-'.$m.'-'.$y)."'";
                $outputQRY  = mysql_query($outputSQL);
                
                while($outputData = mysql_fetch_assoc($outputQRY))
                {
                    $tadeVal += $outputData['tradevalues'];                                        
                }
                $outputSQL  = "SELECT * FROM outputs WHERE symbol=".$symbol." AND date='".($d2.'-'.$m2.'-'.$y2)."'";
                $outputQRY  = mysql_query($outputSQL);
                
                while($outputData = mysql_fetch_assoc($outputQRY))
                {
                    $tadeVal2 += $outputData['tradevalues'];
                    
                }
                
            }
            $totalTradeValue += $tadeVal;
            $totalTradeValueY += $tadeVal2;
            $dataChartArr[$faceVal][] = $tadeVal;
            $dataChartArr2[$faceVal][] = $tadeVal2;
        }
        
        foreach($dataChartArr AS $face => $value)
        {
            $dataChartArr[$face][0] = number_format(($value[0]*100/$totalTradeValue),2,'.','');
            $dataChartArr[$face][1] = number_format(($value[0]),2,'.','');
        }
        foreach($dataChartArr2 AS $face => $value)
        {
            $dataChartArr2[$face][0] = number_format(($value[0]*100/$totalTradeValueY),2,'.','');
            $dataChartArr2[$face][1] = number_format(($value[0]),2,'.','');
        }
        
        /*echo "<pre>";
        echo $totalTradeValue."+".$totalTradeValueY."<br>";
        print_r($dataChartArr);
        print_r($dataChartArr2);       
        
        die;*/
        
        $data1 = array($dataChartArr[1000][0], $dataChartArr[100][0], $dataChartArr[10][0],$dataChartArr[1][0]);        
        $data1_val = array($dataChartArr[1000][1], $dataChartArr[100][1], $dataChartArr[10][1],$dataChartArr[1][1]);        
        $data3 = array($dataChartArr2[1000][0], $dataChartArr2[100][0], $dataChartArr2[10][0],$dataChartArr2[1][0]);        
        $data3_val = array($dataChartArr2[1000][1], $dataChartArr2[100][1], $dataChartArr2[10][1],$dataChartArr2[1][1]);        
        $labels = array("1000Tk", "100Tk", "10Tk", "1Tk");
        $this->set('today',$data1);
        $this->set('yday',$data3);
        $this->set('today_val',$data1_val);
        $this->set('yday_val',$data3_val);
        $this->set('labels',$labels);
        $this->set('todaytotal',$totalTradeValue);
        $this->set('ytotal',$totalTradeValueY);
        
        $symbolSQl  = "SELECT * FROM symbols WHERE id>4 AND otc_market='No' AND inactive='No'";
        $symbolQRY  = mysql_query($symbolSQl);
        $symbolPaidArr = array();
        while($datapaid = mysql_fetch_assoc($symbolQRY))
        {
            $outstanding_capitalVal = $datapaid['outstanding_capital'];
            settype($outstanding_capitalVal,"double");
            $outstanding_capitalVal = $outstanding_capitalVal * 1000000;
            if($outstanding_capitalVal>0 AND $outstanding_capitalVal<=200000000)
                $symbolPaidArr[0][$datapaid['id']] = $datapaid['dse_code'];
            else if($outstanding_capitalVal>200000000 AND $outstanding_capitalVal<=500000000)
                $symbolPaidArr[1][$datapaid['id']] = $datapaid['dse_code'];
            else if($outstanding_capitalVal>500000000 AND $outstanding_capitalVal<=1000000000)
                $symbolPaidArr[2][$datapaid['id']] = $datapaid['dse_code'];
            else if($outstanding_capitalVal>1000000000 AND $outstanding_capitalVal<=3000000000)
                $symbolPaidArr[3][$datapaid['id']] = $datapaid['dse_code'];
            else if($outstanding_capitalVal>3000000000)
                $symbolPaidArr[4][$datapaid['id']] = $datapaid['dse_code'];
            
        }
        
        $dataPaidChartArr = array();
        $dataPaidChartArrPrev = array();
        $totalPaidTradeValue  = 0;
        $totalPaidTradeValueY = 0;
        foreach($symbolPaidArr AS $rangeVal => $paidArr)
        {
            $tadeVal = 0;
            $tadeVal2 = 0;
            foreach($paidArr AS $symbol => $paiddata)
            {
                $outputSQL  = "SELECT * FROM outputs WHERE symbol=".$symbol." AND date='".($d.'-'.$m.'-'.$y)."'";
                $outputQRY  = mysql_query($outputSQL);
                
                while($outputData = mysql_fetch_assoc($outputQRY))
                {
                    $tadeVal += $outputData['tradevalues'];
                    //$dataChartArr[$faceVal][]
                }
                $outputSQL  = "SELECT * FROM outputs WHERE symbol=".$symbol." AND date='".($d2.'-'.$m2.'-'.$y2)."'";
                $outputQRY  = mysql_query($outputSQL);
                
                while($outputData = mysql_fetch_assoc($outputQRY))
                {
                    $tadeVal2 += $outputData['tradevalues'];
                    //$dataChartArr[$faceVal][]
                }
                
            }
            $dataPaidChartArr[$rangeVal][] = $tadeVal;
            $dataPaidChartArr2[$rangeVal][] = $tadeVal2;
            $totalPaidTradeValue  += $tadeVal;
            $totalPaidTradeValueY += $tadeVal2;
            
        }
        foreach($dataPaidChartArr AS $paid => $value)
        {
            $dataPaidChartArr[$paid][0] = number_format(($value[0]*100/$totalPaidTradeValue),2,'.','');
            $dataPaidChartArr[$paid][1] = number_format(($value[0]),2,'.','');
        }
        foreach($dataPaidChartArr2 AS $paid => $value)
        {
            $dataPaidChartArr2[$paid][0] = number_format(($value[0]*100/$totalPaidTradeValueY),2,'.','');
            $dataPaidChartArr2[$paid][1] = number_format(($value[0]),2,'.','');
        }
        
        $paidlabels = array("0-20 CORE", "20-50 CORE", "50-100 CORE", "100-300 CORE", ">300 CORE " ); 
        
        $paiddata1 = array($dataPaidChartArr[0][0], $dataPaidChartArr[1][0], $dataPaidChartArr[2][0], $dataPaidChartArr[3][0],$dataPaidChartArr[4][0]);        
        $paiddata1_val = array($dataPaidChartArr[0][1], $dataPaidChartArr[1][1], $dataPaidChartArr[2][1], $dataPaidChartArr[3][1],$dataPaidChartArr[4][1]);       
         
        $paiddata3 = array($dataPaidChartArr2[0][0], $dataPaidChartArr2[1][0], $dataPaidChartArr2[2][0], $dataPaidChartArr2[3][0],$dataPaidChartArr2[4][0]); 
        $paiddata3_val =  array($dataPaidChartArr2[0][1], $dataPaidChartArr2[1][1], $dataPaidChartArr2[2][1], $dataPaidChartArr2[3][1],$dataPaidChartArr2[4][1]); 
        
        $this->set('todaypaid',$paiddata1);
        $this->set('ydaypaid',$paiddata3);
        $this->set('today_valpaid',$paiddata1_val);
        $this->set('yday_valpaid',$paiddata3_val);
        $this->set('labelspaid',$paidlabels);
        $this->set('todaytotalpaid',$totalPaidTradeValue);
        $this->set('ytotalpaid',$totalPaidTradeValueY);
        
        
        
        
        $symbolSQl  = "SELECT * FROM symbols WHERE id>4 AND otc_market='No' AND inactive='No'";
        $symbolQRY  = mysql_query($symbolSQl);
        $symbolDataArr = array();
        while($code = mysql_fetch_assoc($symbolQRY))
        {            
            $annualizeEPS = 0;
            if($code['q4'])
                $annualizeEPS = $code['q4'] * 1;
            else if($code['q3'])
                $annualizeEPS = $code['q3'] * 4/3;
            else if($code['q2'])
                $annualizeEPS = $code['q2'] * 2;
            else if($code['q1'])
                $annualizeEPS = $code['q1'] * 4;
            
            if(!empty($code['lasttradeprice']) AND !empty($annualizeEPS))
                $PE = $code['lasttradeprice'] / $annualizeEPS;
            else
                $PE = 0;
            
            if($PE>0 AND $PE<=20)
                $symbolDataArr[0][$code['id']] = $code['dse_code'];
            else if($PE>20 AND $PE<=40)
                $symbolDataArr[1][$code['id']] = $code['dse_code'];
            else if($PE>40 OR $PE<0)
                $symbolDataArr[2][$code['id']] = $code['dse_code'];            
            
        }
        
        //print_r($symbolDataArr);die;
        
        $dataChartArr = array();
        $dataChartArr2 = array();
        $totalPeTradeValue  = 0;
        $totalPeTradeValueY = 0;
        foreach($symbolDataArr AS $rangeVal => $dataArr)
        {
            $tadeVal = 0;
            $tadeVal2 = 0;
            foreach($dataArr AS $symbol => $data)
            {
                $outputSQL  = "SELECT * FROM outputs WHERE symbol=".$symbol." AND date='".($d.'-'.$m.'-'.$y)."'";
                $outputQRY  = mysql_query($outputSQL);
                
                while($outputData = mysql_fetch_assoc($outputQRY))
                {
                    $tadeVal += $outputData['tradevalues'];
                    //$dataChartArr[$faceVal][]
                }
                $outputSQL  = "SELECT * FROM outputs WHERE symbol=".$symbol." AND date='".($d2.'-'.$m2.'-'.$y2)."'";
                $outputQRY  = mysql_query($outputSQL);
                
                while($outputData = mysql_fetch_assoc($outputQRY))
                {
                    $tadeVal2 += $outputData['tradevalues'];
                    //$dataChartArr[$faceVal][]
                }
                
            }
            $dataChartArr[$rangeVal][] = $tadeVal;
            $dataChartArr2[$rangeVal][] = $tadeVal2;
            $totalPeTradeValue  += $tadeVal;
            $totalPeTradeValueY += $tadeVal2;
            
        }
        foreach($dataChartArr AS $face => $value)
        {
            $dataChartArr[$face][0] = number_format(($value[0]*100/$totalPeTradeValue),2,'.','');
            $dataChartArr[$face][1] = number_format(($value[0]),2,'.','');
            
        }
        foreach($dataChartArr2 AS $face => $value)
        {
            $dataChartArr2[$face][0] = number_format(($value[0]*100/$totalPeTradeValueY),2,'.','');
            $dataChartArr2[$face][1] = number_format(($value[0]),2,'.','');
        }
        
        /*echo "<pre>";
        //print_r($symbolDataArr);
        print_r($dataChartArr);
        print_r($dataChartArr2);  
        
        die;*/
        
        $pedata1 = array($dataChartArr[0][0], $dataChartArr[1][0], $dataChartArr[2][0]);
        $pedata1_val = array($dataChartArr[0][1], $dataChartArr[1][1], $dataChartArr[2][1]);
        
        $pedata3 = array($dataChartArr2[0][0], $dataChartArr2[1][0], $dataChartArr2[2][0]);
        $pedata3_val = array($dataChartArr2[0][1], $dataChartArr2[1][1], $dataChartArr2[2][1]);
        
        $pelabels = array("0-20", "20-40", ">41"); 
        
        $this->set('todaype',$pedata1);
        $this->set('ydaype',$pedata3);
        $this->set('today_valpe',$pedata1_val);
        $this->set('yday_valpe',$pedata3_val);
        $this->set('labelspe',$pelabels);
        $this->set('todaytotalpe',$totalPeTradeValue);
        $this->set('ytotalpe',$totalPeTradeValueY);
        
        
        $symbolSQl  = "SELECT * FROM symbols WHERE id>4 AND otc_market='No' AND inactive='No'";
        $symbolQRY  = mysql_query($symbolSQl);
        $symbolDataArr = array();
        while($data = mysql_fetch_assoc($symbolQRY))
        {
            $category = $data['category'];            
            $symbolDataArr[$category][$data['id']] = $data['dse_code'];
        }
        
        
        
        $dataChartArr = array();
        $dataChartArr2 = array();
        $totalTradeValue  = 0;
        $totalTradeValueY = 0;
        foreach($symbolDataArr AS $category => $dataArr)
        {
            $tadeVal = 0;
            $tadeVal2 = 0;
            foreach($dataArr AS $symbol => $data)
            {
                $outputSQL  = "SELECT * FROM outputs WHERE symbol=".$symbol." AND date='".($d.'-'.$m.'-'.$y)."'";
                $outputQRY  = mysql_query($outputSQL);
                
                while($outputData = mysql_fetch_assoc($outputQRY))
                {
                    $tadeVal += $outputData['tradevalues'];                                        
                }
                $outputSQL  = "SELECT * FROM outputs WHERE symbol=".$symbol." AND date='".($d2.'-'.$m2.'-'.$y2)."'";
                $outputQRY  = mysql_query($outputSQL);
                
                while($outputData = mysql_fetch_assoc($outputQRY))
                {
                    $tadeVal2 += $outputData['tradevalues'];
                    
                }
                
            }
            $totalTradeValue += $tadeVal;
            $totalTradeValueY += $tadeVal2;
            $dataChartArr[$category][] = $tadeVal;
            $dataChartArr2[$category][] = $tadeVal2;
        }
        
        foreach($dataChartArr AS $category => $value)
        {
            $dataChartArr[$category][0] = number_format(($value[0]*100/$totalTradeValue),2,'.','');
            $dataChartArr[$category][1] = number_format(($value[0]),2,'.','');
        }
        foreach($dataChartArr2 AS $category => $value)
        {
            $dataChartArr2[$category][0] = number_format(($value[0]*100/$totalTradeValueY),2,'.','');
            $dataChartArr2[$category][1] = number_format(($value[0]),2,'.','');
        }
        
        /*echo "<pre>";
        echo $totalTradeValue."+".$totalTradeValueY."<br>";
        print_r($dataChartArr);
        print_r($dataChartArr2);       
        
        die;*/
        
        
        
        # The data for the bar chart 
        
        $data1 = array($dataChartArr['A'][0], $dataChartArr['B'][0], $dataChartArr['Z'][0],$dataChartArr['N'][0]);        
        $data1_val = array($dataChartArr['A'][1], $dataChartArr['B'][1], $dataChartArr['Z'][1],$dataChartArr['N'][1]);        
        
        $data3 = array($dataChartArr2['A'][0], $dataChartArr2['B'][0], $dataChartArr2['Z'][0],$dataChartArr2['N'][0]);        
        $data3_val = array($dataChartArr2['A'][1], $dataChartArr2['B'][1], $dataChartArr2['Z'][1],$dataChartArr2['N'][1]);        
        
        # The labels for the bar chart. The labels contains embedded images as icons. 
        
        $labelscat = array("A", "B", "Z", "N");
        
        $this->set('todaycat',$data1);
        $this->set('ydaycat',$data3);
        $this->set('today_valcat',$data1_val);
        $this->set('yday_valcat',$data3_val);
        $this->set('labelscat',$labelscat);
        $this->set('todaytotalcat',$totalTradeValue);
        $this->set('ytotalcat',$totalTradeValueY);
        
    }
    function newspaper_reportweekly()
    {
        $this->layout ='default-bodyonly'; 
        $this->pageTitle = 'Stock Bangladesh :: Newspaper Report Weekly';
        
        $ip          = $_SERVER['REMOTE_ADDR'];
        $ipcheckSql  = "SELECT ip FROM user_ip WHERE is_active =1 AND ip='ipcheck'";
        $ipenable    = mysql_query($ipcheckSql);
        if(mysql_num_rows($ipenable))
        {
            $brokerIPSql = "SELECT ip FROM user_ip WHERE is_active =1 AND ip='".$ip."'";
            $access = mysql_query($brokerIPSql);
            if(!mysql_num_rows($access))
            {
                $this->Session->setFlash ( 'You are not authorized to access this location' );
                $this->redirect ( array ('controller' => 'users', 'action' => 'index' ) );
                //die("You are not authorized to access this location.");
            }
        }
    }
    
    
    function lastdaydata() {

        $this->layout = 'default-one';
        $this->pageTitle = 'Stock Bangladesh :: Download Daily Data';
        if (isset ( $_POST ['Download'] )) {

            $format = $_POST ['DataFormat'];

            $targetDate = $_POST ['TargetDate'];



            if ($targetDate == '') {

                $this->redirect ( array ('action' => 'lastdaydata' ) );

            }



            $tradingDateSQL = 'select Output.id, date_format(str_to_date(date, \'%d-%c-%Y\'), \'%Y-%m-%d\') as date from symbols as Symbol, outputs as Output  where Symbol.id=Output.symbol and date=\'' . $targetDate . '\' order by Output.id asc';

            $tradingDataList = $this->Symbol->query ( $tradingDateSQL );



            if (count ( $tradingDataList ) > 0) {

                if ($format == 'csv') {

                    $filePath = WWW_ROOT . 'csvall' . DS . $targetDate . '.csv';

                    $_fp = @fopen ( $filePath, 'w' );

                    @fwrite ( $_fp, $_csv_data );



                    $csvSQL = 'select c.id,c.dse_code,c.face_value, Output.id, date_format(str_to_date(date, \'%d-%c-%Y\'), \'%Y-%m-%d\') as date, Output.daystamp as daystamp,Output.open as open, Output.high as high, Output.low as low, Output.close as close, Output.volume as volume from symbols as c, outputs as Output  where c.id=Output.symbol and c.id!=4 and date =\'' . $targetDate . '\' order by Output.id asc';



                    $dataList = $this->Symbol->query ( $csvSQL );

                    $_csv_dataArr = array();

                    if (! empty ( $dataList )) {

                        foreach ( $dataList as $dATA ) {
                            
                            
                            
                            $querystr="SELECT *
                                        FROM `corporate_action`
                                        WHERE `symbol` =".$dATA ['c']['id']." and `active`=1
                                        ORDER BY `datestamp` ASC";
                            $corporateAction = $this->Symbol->query($querystr);
                            
                            $day = $corporateAction[0]['corporate_action']['datestamp'];
                            // echo date('d-m-y H:i:s',$day);
                            // $day=$corporateAction[0]['corporate_action']['date'];

                            //echo date('d-m-y H:i:s');
                            //  $dayst= strtotime($day);
                            // echo date('d-m-y H:i:s',$dayst);
                            
                            foreach ($corporateAction as $row)
                            {
                                $action      = $row['corporate_action']['action'];
                                $adjustedArr = array();

                                if($action == 'stockdiv')
                                {
                                    $adjustmentFactor = (100+$row['corporate_action']['value'])/100;

                                    $day      = $row['corporate_action']['date'];                                    
                                    $daystamp = strtotime($day);

                                    
                                    if($dATA ['Output']['daystamp'] < $daystamp)
                                    {
                                        $dATA['Output']['open']=$dATA['Output']['open']/$adjustmentFactor;
                                        $dATA['Output']['high']=$dATA['Output']['high']/$adjustmentFactor;
                                        $dATA['Output']['low']=$dATA['Output']['low']/$adjustmentFactor;
                                        $dATA['Output']['close']=$dATA['Output']['close']/$adjustmentFactor;
                                    }

                                    $adjustedArr[]=$dATA;   
                                }
                                elseif($action=='cashdiv')
                                {
                                    $facevalue = $dATA ['c']['face_value'];
                                    $adjustmentFactor = $facevalue*$row['corporate_action']['value']/100;

                                    $day      = $row['corporate_action']['date'];                                    
                                    $daystamp = strtotime($day);

                                    if($dATA ['Output']['daystamp'] < $daystamp)
                                    {
                                        $dATA['Output']['open']  = $dATA['Output']['open']-$adjustmentFactor;
                                        $dATA['Output']['high']  = $dATA['Output']['high']-$adjustmentFactor;
                                        $dATA['Output']['low']   = $dATA['Output']['low']-$adjustmentFactor;
                                        $dATA['Output']['close'] = $dATA['Output']['close']-$adjustmentFactor;
                                    }
                                    $adjustedArr[] = $dATA;
                                    
                                }
                                elseif($action=='rightshare')
                                {
                                    $facevalue = $dATA ['c']['face_value'];

                                    $adjustmentFactor = (100+$row['corporate_action']['value'])/100;
                                    $premium          = $row['corporate_action']['premium'];                    
                                    
                                    $close_price_adjustment_factor=($premium+$facevalue)-(($premium+$facevalue)/$adjustmentFactor);
                                    

                                    $day      = $row['corporate_action']['date'];                                    
                                    $daystamp = strtotime($day);

                                    
                                    if($dATA ['Output']['daystamp'] < $daystamp)
                                    {
                                        $dATA['Output']['open']=(($dATA['Output']['open']*100)+(($premium+$facevalue)*$row['corporate_action']['value'])) / (100+$row['corporate_action']['value']);
                                        $dATA['Output']['high']=(($dATA['Output']['high']*100)+(($premium+$facevalue)*$row['corporate_action']['value'])) / (100+$row['corporate_action']['value']);
                                        $dATA['Output']['low']=(($dATA['Output']['low']*100)+(($premium+$facevalue)*$row['corporate_action']['value'])) / (100+$row['corporate_action']['value']);
                                        $dATA['Output']['close']=(($dATA['Output']['close']*100)+(($premium+$facevalue)*$row['corporate_action']['value'])) / (100+$row['corporate_action']['value']);
                                        
                                        /*$dATA['Output']['open']=($dATA['Output']['open']+$close_price_adjustment_factor)/$adjustmentFactor;
                                        $dATA['Output']['high']=($dATA['Output']['high']+$close_price_adjustment_factor)/$adjustmentFactor;
                                        $dATA['Output']['low']=($dATA['Output']['low']+$close_price_adjustment_factor)/$adjustmentFactor;
                                        $dATA['Output']['close']=($dATA['Output']['close']+$close_price_adjustment_factor)/$adjustmentFactor;*/
                                        
                                        
                                    }

                                    $adjustedArr[]=$dATA;                                    

                                }


                                elseif ($action=='split')
                                {
                                    $adjustmentFactor = $row['corporate_action']['value'];

                                    $day      = $row['corporate_action']['date'];                                    
                                    $daystamp = strtotime($day);

                                    
                                    if($dATA ['Output']['daystamp'] < $daystamp)
                                    {
                                        $dATA['Output']['open']   = $dATA['Output']['open']/$adjustmentFactor;
                                        $dATA['Output']['high']   = $dATA['Output']['high']/$adjustmentFactor;
                                        $dATA['Output']['low']    = $dATA['Output']['low']/$adjustmentFactor;
                                        $dATA['Output']['close']  = $dATA['Output']['close']/$adjustmentFactor;
                                        $dATA['Output']['volume'] = $dATA['Output']['volume']*$adjustmentFactor;
                                    }

                                    $adjustedArr[] = $dATA;
                                }
                               
                            }
                            /*echo "<pre>";
                            print_r($adjustedArr);*/
                            
                            $dATA ['Output'] ['volume'] = $dATA ['Output'] ['volume'] + 0;

                            $_csv_data = $dATA ['c'] ['dse_code'] . ',' . ucfirst ( $dATA [0] ['date'] ) . ',' . ucfirst ( $dATA ['Output'] ['open'] ) . ',' . ucfirst ( $dATA ['Output'] ['high'] ) . ',' . $dATA ['Output'] ['low'] . ',' . $dATA ['Output'] ['close'] . ',' . $dATA ['Output'] ['volume'] . ',' . "\n";
                            //$_csv_dataArr[] = $dATA ['c'] ['dse_code'] . ',' . ucfirst ( $dATA [0] ['date'] ) . ',' . ucfirst ( $dATA ['Output'] ['open'] ) . ',' . ucfirst ( $dATA ['Output'] ['high'] ) . ',' . $dATA ['Output'] ['low'] . ',' . $dATA ['Output'] ['close'] . ',' . $dATA ['Output'] ['volume'] . ',' . "\n";

                            @fwrite ( $_fp, $_csv_data );

                        }

                    }

                    /*echo "<pre>";
                    print_r($dataList);
                    
                    die;*/
                    /*foreach ( $_csv_dataArr as $_csv_data ) {
                        @fwrite ( $_fp, $_csv_data );

                    }*/

                    



                    $fileName = 'stockbangladesh.com_' . $targetDate . '.csv';



                    header ( "Content-Disposition: attachment; filename=" . $fileName );

                    readfile ( $filePath );

                    exit ();

                }



                if ($format == 'xls') {

                    $filePath = WWW_ROOT . 'csvall' . DS . $code . '.xls';

                    $this->csvHeader ( $code . '.xls' );

                    $this->BOF ();



                    $this->writeLabel ( 0, 0, "Date" );

                    $this->writeLabel ( 0, 1, "Open" );

                    $this->writeLabel ( 0, 2, "High" );

                    $this->writeLabel ( 0, 3, "Low" );

                    $this->writeLabel ( 0, 4, "Close" );

                    $this->writeLabel ( 0, 5, "Volume" );



                    $xlsSQL = 'select c.dse_code, Output.id, date_format(str_to_date(date, \'%d-%c-%Y\'), \'%Y-%m-%d\') as date, Output.open as open, Output.high as high, Output.low as low, Output.close as close, Output.volume as volume from symbols as c, outputs as Output  where c.id=Output.symbol and date =\'' . $targetDate . '\' order by Output.id asc';



                    $dataList = $this->Symbol->query ( $xlsSQL );



                    if (! empty ( $dataList )) {

                        $count = 1;

                        foreach ( $dataList as $dATA ) {

                            $this->writeLabel ( $count, 0, $dATA ['c'] ['dse_code'] );

                            $this->writeLabel ( $count, 1, ucfirst ( $dATA [0] ['date'] ) );

                            $this->writeLabel ( $count, 2, ucfirst ( $dATA ['Output'] ['open'] ) );

                            $this->writeLabel ( $count, 3, ucfirst ( $dATA ['Output'] ['high'] ) );

                            $this->writeLabel ( $count, 4, ucfirst ( $dATA ['Output'] ['low'] ) );

                            $this->writeLabel ( $count, 5, ucfirst ( $dATA ['Output'] ['close'] ) );

                            $this->writeLabel ( $count, 6, ucfirst ( $dATA ['Output'] ['volume'] ) );

                            $count ++;

                        }

                    }



                    $this->EOF ();

                    exit ();

                }



                if ($format == 'txt') {

                    $filePath = WWW_ROOT . 'csvall' . DS . $code . '.txt';

                    $_fp = @fopen ( $filePath, 'w' );

                    $_csv_data = "Date" . ',' . "Open" . ',' . "High" . ',' . "Low" . ',' . "Close" . ',' . "Volume" . "\n";



                    @fwrite ( $_fp, $_csv_data );



                    $txtSQL = 'select c.dse_code, Output.id, date_format(str_to_date(date, \'%d-%c-%Y\'), \'%Y-%m-%d\') as date, Output.open as open, Output.high as high, Output.low as low, Output.close as close, Output.volume as volume from symbols as c, outputs as Output  where c.id=Output.symbol and date =\'' . $targetDate . '\' order by Output.id asc';



                    $dataList = $this->Symbol->query ( $txtSQL );



                    if (! empty ( $dataList )) {

                        foreach ( $dataList as $dATA ) {

                            $dATA ['Output'] ['volume'] = $dATA ['Output'] ['volume'] + 0;

                            $_csv_data = $dATA ['c'] ['dse_code'] . ',' . ucfirst ( $dATA [0] ['date'] ) . ',' . ucfirst ( $dATA ['Output'] ['open'] ) . ',' . ucfirst ( $dATA ['Output'] ['high'] ) . ',' . $dATA ['Output'] ['low'] . ',' . $dATA ['Output'] ['close'] . ',' . $dATA ['Output'] ['volume'] . ',' . "\n";

                            @fwrite ( $_fp, $_csv_data );

                        }

                    }



                    $fileName = $code . '.txt';



                    header ( "Content-Disposition: attachment; filename=" . $fileName );

                    readfile ( $filePath );

                    exit ();

                }

            }



            else {

                $this->Session->setFlash ( 'No data available.' );

                $this->redirect ( array ('action' => 'lastdaydata' ) );

            }

        }
    }
    
    
    function sectorwise_comparison_month($sector = '')
 {
        //Configure::write('debug',3); 
        set_time_limit(0)  ;
        
        $this->layout = 'default-bodyonly';
        $this->pageTitle = 'Stock Bangladesh :: Weekly Sector Comparison';
        
        $ip          = $_SERVER['REMOTE_ADDR'];
        $ipcheckSql  = "SELECT ip FROM user_ip WHERE is_active =1 AND ip='ipcheck'";
        $ipenable    = mysql_query($ipcheckSql);
        if(mysql_num_rows($ipenable))
        {
            $brokerIPSql = "SELECT ip FROM user_ip WHERE is_active =1 AND ip='".$ip."'";
            $access = mysql_query($brokerIPSql);
            if(!mysql_num_rows($access))
            {
                $this->Session->setFlash ( 'You are not authorized to access this location' );
                $this->redirect ( array ('controller' => 'users', 'action' => 'index' ) );
                //die("You are not authorized to access this location.");
            }
        }
        if($sector=='')
         {
           $sector='Bank';
         }
         
        
       $sectorArr = $this->Symbol->find ('all', array ('conditions' => array ('inactive= \'No\' AND otc_market= \'No\' AND business_segment!=\'\''), 'fields' => array ('DISTINCT Symbol.business_segment')));
        
        foreach($sectorArr as $arr)
        {
            $sec_name = $arr['Symbol']['business_segment'];
            $sec_name = str_replace("&","and",$sec_name);
            $sectors[]['business_segment'] = $sec_name;
        }
        
        $this->set('sectors',$sectors);
        
        $this->set('key',$sector);
        $sector = str_replace("and","&",$sector);
        
        $sqlStr="SELECT * FROM symbols WHERE business_segment = '$sector' AND inactive='No' AND otc_market='No'  ORDER BY business_segment ASC ";
        $dataSymbol=$this->Symbol->query($sqlStr);
        foreach($dataSymbol as $symbol_info)
        {
            $symbolArr[$symbol_info['symbols']['id']] = $symbol_info['symbols']['id'];
            $BanglasymbolArr[$symbol_info['symbols']['id']] = $symbol_info['symbols']['name_bangla'];
        }
        
        $present_date = date('Y-m-d',strtotime('-1 month'));
        $this_sunday = date('Y-m-d', strtotime($present_date.'last sunday'));
        $laststamp = strtotime($this_sunday);
        
        $marketSql     = 'SELECT date FROM market_summeries WHERE UNIX_TIMESTAMP(date) >='.$laststamp.' ORDER BY id DESC;';
        $tradedays     = $this->Symbol->query($marketSql);
        $this_thursday = $tradedays[0]['market_summeries']['date'];
        $this_thursday = '2011-08-25';
        $this_thursdaystamp = strtotime($this_thursday)+24*3600;
        
        $this_sunday = $tradedays[count($tradedays)-1]['market_summeries']['date'];
        $this_sunday = '2011-08-01';
        $this_sundaystamp = strtotime($this_sunday)-6*3600;
        
        //echo $this_sunday.' to '.$this_thursday;
        $this->set('this_sunday',$this_sunday);
        $this->set('this_thursday',$this_thursday);
        //die;
        
      
        
     /////////////****************for this month****************/////////////////////////////////////////
        $sql = "SELECT SUM(value) as total_marketCap FROM market_summeries where UNIX_TIMESTAMP(date) between $this_sundaystamp AND $this_thursdaystamp";
       // pr($sql);
        $thisweekTotalmcap = $this->Symbol->query($sql);
        $thisweekmarketcap = $thisweekTotalmcap[0][0]['total_marketCap'] /1000000;
        //pr($thisweekmarketcap);
        
        $dataSqlPresent = "SELECT * FROM sbsector_summeries where datestamp between $this_sundaystamp AND $this_thursdaystamp AND sector LIKE '%$sector%' order by datestamp ASC ";
        
        $sectorinfoPresent = $this->Symbol->query($dataSqlPresent);
       // pr($sectorinfoPresent);
        //die;
        $thisvweektradevalues = 0;
        $thisvweektrade = 0;
        $thisweekvolume = 0;
        $thisweekcapital = 0;
        $thisweekearning = 0;
        $thisweekindexchange = 0;
        $thisweekPE = 0;
        $this_count = 0;
        $thisweekbeta = 0;
        foreach($sectorinfoPresent as $presentarr)
        {
            $this_count++;
            $thisweekindexchange += $presentarr['sbsector_summeries']['index_change'];
            $thisvweektradevalues += $presentarr['sbsector_summeries']['sector_tradevalues'];
            $thisvweektrade += $presentarr['sbsector_summeries']['sector_trade'];
            $thisweekvolume += $presentarr['sbsector_summeries']['volume'];
            $thisweekcapital = $presentarr['sbsector_summeries']['sector_cap'];
            $thisweekearning = $presentarr['sbsector_summeries']['sector_earning'];
            $thisweekPE = $presentarr['sbsector_summeries']['sector_pe'];
            $thisweekbeta = $presentarr['sbsector_summeries']['sector_beta'];
            $this_last_date = date('d-m-Y',$presentarr['sbsector_summeries']['datestamp']);
        }
        $thisweekcontribution = ($thisvweektradevalues/$thisweekmarketcap)*100;
        
 /////////////****************End for this week****************/////////////////////////////////
    //$oneweekprevdate = $this->Symbol->query("SELECT date FROM `outputs_week` WHERE `symbol` =1 ORDER by id DESC");
    //$oneweekprev_last_date = $oneweekprevdate[4]['outputs_week']['date'];
    $prev_last_date = '31-07-2011';
    //$this_last_date = '04-08-2011';
    $outputweekDataSQl = "SELECT * FROM outputs_week WHERE date='$prev_last_date' OR date='$this_last_date'";  
    $outputweekData = $this->Symbol->query($outputweekDataSQl);
    //pr($outputweekData);
    //echo '<pre>';
    
    $outputweekDataArr = array();
    foreach($outputweekData as $weekData)
        {
           $date = $weekData['outputs_week']['date'];
           $symbol_id = $weekData['outputs_week']['symbol'];
           if($symbol_id == $symbolArr[$symbol_id])
           { 
                $outputweekDataArr[$symbol_id][] = $weekData;
           }
        }
        //pr($outputweekDataArr);
       // die;
    $gainerLooserData= array();
    $gainer=0;
    $looser=0;
    $nochange =0;
    $ltmintwo = 0;
    $gttwo = 0;
    $bttwozero = 0;
    $btmintwozero = 0;
    
    $gainerPrev=0;
    $looserPrev=0;
    $nochangePrev =0;
    $ltmintwoPrev = 0;
    $gttwoPrev = 0;
    $bttwozeroPrev = 0;
    $btmintwozeroPrev = 0;
    
    $high_value = -9999;
    $low_value = 9999;
    foreach($outputweekDataArr as $symbol=>$gainerLooser)
    {
        $gainerLooserData[$symbol]['pchange']   = $gainerLooser[1]['outputs_week']['close'] - $gainerLooser[0]['outputs_week']['close'];
        $gainerLooserData[$symbol]['changeper'] = (($gainerLooser[1]['outputs_week']['close'] - $gainerLooser[0]['outputs_week']['close'])/$gainerLooser[0]['outputs_week']['close'])*100;
        
        if($gainerLooserData[$symbol]['changeper'] > $high_value)
                    {
                       $high_company = $BanglasymbolArr[$symbol];
                       $high_value = $gainerLooserData[$symbol]['changeper'];
                    }
                    
        if($gainerLooserData[$symbol]['changeper'] < $low_value)
                    {
                       $low_company = $BanglasymbolArr[$symbol];
                       $low_value = $gainerLooserData[$symbol]['changeper'];
                    }
        
        if($gainerLooserData[$symbol]['pchange']>0) $gainer++;
        if($gainerLooserData[$symbol]['pchange']<0) $looser++;
        if($gainerLooserData[$symbol]['pchange']==0) $nochange++;
        if($gainerLooserData[$symbol]['changeper']>=2)$gttwo++;
        if($gainerLooserData[$symbol]['changeper']<=-2)$ltmintwo++;
        if($gainerLooserData[$symbol]['changeper']>-2 AND $gainerLooserData[$symbol]['changeper']<0)$btmintwozero++;
        if($gainerLooserData[$symbol]['changeper']>=0 AND  $gainerLooserData[$symbol]['changeper']<2)$bttwozero++;
        
        
    }
    $total_company =$gainer + $looser + $nochange;
    
    $this->set('total_company',$total_company);
    $this->set('high_company',$high_company);
    $this->set('low_company',$low_company);
    
    $total_information = array();
    $total_information['thismonth']['tradevalues'] = $thisvweektradevalues;
    $total_information['thismonth']['trade'] = $thisvweektrade;
    $total_information['thismonth']['volume'] = $thisweekvolume;
    $total_information['thismonth']['capital'] = $thisweekcapital;
    $total_information['thismonth']['earning'] = $thisweekearning;
    $total_information['thismonth']['contribution'] = $thisweekcontribution;
    $total_information['thismonth']['index_contribution'] = $thisweekindexchange;
    $total_information['thismonth']['beta'] = $thisweekbeta;
    $total_information['thismonth']['pe'] = $thisweekPE;///$this_count;
    $total_information['thismonth']['gainer'] = $gainer;
    $total_information['thismonth']['looser'] = $looser;
    $total_information['thismonth']['nochange'] = $nochange;
    $total_information['thismonth']['gttwo'] = ($gttwo/$total_company)*100;
    $total_information['thismonth']['ltmintwo'] = ($ltmintwo/$total_company)*100;
    $total_information['thismonth']['bttwozero'] = ($bttwozero/$total_company)*100;
    $total_information['thismonth']['btmintwozero'] = ($btmintwozero/$total_company)*100;
    //pr($total_information);
    //die;
    
    $_SESSION['all_info'] = $total_information;
    $this->set('total_info',$total_information);
    
 }
 
 function sectorwise_gainer_compare_month($sector = '')
    {
        //Configure::write('debug',3);
        require_once (WWW_ROOT . DS . 'chart' . DS . 'phpchartdir.php');
        require_once (WWW_ROOT . DS . 'chart' . DS . 'Image_Toolbox.class.php');
        
        $gainer0   = $_SESSION['all_info']['thismonth']['gainer'];
        $looser0   = $_SESSION['all_info']['thismonth']['looser'];
        $nochange0 = $_SESSION['all_info']['thismonth']['nochange'];
        
        
        /*$sector = $_SESSION['sector'];
        $today = $_SESSION['today'];
        $yesterday = $_SESSION['yesterday'];*/
        /*pr($sector);
        die;*/
        /*if($gainer0 >= $gainer1){ $yesterdaycolor = 0xff0000; $todaycolor = 0x00ff00;}
        else { $todaycolor = 0xff0000; $yesterdaycolor = 0x00ff00;}*/
        
        
        $c = new XYChart(830, 280, 0xe9ffe2, 0x000000, 1);
        $c->setPlotArea(160, 45, 550, 150, 0xffffff);
        $textBoxObj = $c->addTitle(" ", "timesbi.ttf", 10);
        $textBoxObj->setBackground(0xe9ffe2);
        $c->swapXY();
        $c->xAxis->setLabels("Sectorwise Gainer/Looser");
        $c->xAxis->setTickLength(2);
        $layer = $c->addBarLayer2(Stack);
        $textBoxObj = $c->addText ( 130, 20, " ", "times.ttf", 9, 0xc09090 );
        $textBoxObj->setAlignment ( TopLeft );
        $layer->addDataGroup("Gainer");
        $layer->addDataSet($gainer0, 0xc2d76e, " ");
        $layer->addDataGroup("Looser");
        $layer->addDataSet($looser0, 0xf58220, " ");
        $layer->addDataGroup("No Change");
        $layer->addDataSet($nochange0, 0xd4e6ae, " ");        
        
        $layer->setBarGap(0.2, 0);
        $layer->setBorderColor(Transparent);
        $layer->setAggregateLabelStyle("times.ttf", 20);
        $c->yAxis->setAutoScale(0,0,1);      
        $c->yAxis->setLabelStyle("arial.ttf", 14);
        $legendBox = $c->addLegend2(300, 10, 2, "arialbi.ttf", 9);
        $legendBox->setAlignment(TopCenter);
        $legendBox->setText(" {dataGroupName} {dataSetName} ");
        $legendBox->setBackground(Transparent, Transparent); 
        /*header("Content-type: image/png");
        print($c->makeChart2(PNG));*/
        $chartData=$c->makeChart2(PNG);
        $chartImagePath = WWW_ROOT . 'chart'. DS . 'sectorwise_gainer_compare_month.png';
        $f = fopen($chartImagePath, "wb");
        fwrite($f, $chartData);
        fclose($f);
        $img = new Image_Toolbox($chartImagePath);
        /*$width=$img->_img['main']['width'];
        $img->addImage($width,10,'#ffffff');
        $img->blendMask('left','bottom',IMAGE_TOOLBOX_BLEND_COPY, 0, 260);*/
        $img->output();
        
    }
    
    function sectorwise_gainer_depth_compare_month($sector ='')
    {
        require_once (WWW_ROOT . DS . 'chart' . DS . 'phpchartdir.php');
        require_once (WWW_ROOT . DS . 'chart' . DS . 'Image_Toolbox.class.php');
        Configure::write('debug',3);
        $gainertotal   = $_SESSION['all_info']['thismonth']['gttwo'];
        $losertotal    = $_SESSION['all_info']['thismonth']['ltmintwo'];
        $unchangetotal = $_SESSION['all_info']['thismonth']['btmintwozero'];
        $un_ch         = $_SESSION['all_info']['thismonth']['bttwozero'];
        
         
        /*$sector = $_SESSION['sector'];
        $today = $_SESSION['today'];*/
        //pr($today);die;
        //$dat_format = date('d-m-Y',strtotime($today));
         
        
        # Create a XYChart object of size 500 x 320 pixels. Use a vertical gradient color
        # from pale blue (e8f0f8) to sky blue (aaccff) spanning half the chart height as
        # background. Set border to blue (88aaee). Use rounded corners. Enable soft drop
        # shadow.
        $c = new XYChart(850, 250, 0xe9ffe2, 0x000000, 1);
        $c->setPlotArea(190, 45, 550, 130, 0xffffff);
        //$c->setBackground($c->linearGradientColor(0, 0, 0, $c->getHeight() / 2, 0xffffff,0xffffff), 0x88aaee);
        //$c->setRoundedFrame();
        //$c->setDropShadow();

        #Set directory for loading images to current script directory
        #Need when running under Microsoft IIS
        $c->setSearchPath(dirname(__FILE__));

        # Add a title to the chart using 15 points Arial Italic. Set top/bottom margins to 15
        # pixels.
        $title = $c->addTitle("This Month", "arial.ttf", 16);
        $title->setMargin2(0, 0, 15, 15);

        # Tentatively set the plotarea to 50 pixels from the left edge, and to just under the
        # title. Set the width to 60% of the chart width, and the height to 50 pixels from
        # the bottom edge. Use pale blue (e8f0f8) background, transparent border, and grey
        # (aaaaaa) grid lines.
        //$c->setPlotArea(50, $title->getHeight(), $c->getWidth() * 6 / 10, $c->getHeight() -$title->getHeight() - 50, 0xe8f0f8, -1, Transparent, 0xaaaaaa);

        # Add a legend box where the top-right corner is anchored at 10 pixels from the right
        # edge, and just under the title. Use vertical layout and 8 points Arial font.
        $legendBox = $c->addLegend($c->getWidth(), $title->getHeight()-20, true, "arial.ttf", 8);
        /*$legendBox = $c->addLegend2(400, 10, 2, "arialbi.ttf", 9);*/
        $legendBox->setAlignment(TopRight);

        # Set the legend box background and border to transparent
        $legendBox->setBackground(Transparent, Transparent);

        # Set the legend box icon size to 16 x 32 pixels to match with custom icon size
        //$legendBox->setKeySize(16, 32);

        # Set axes to transparent
        $c->xAxis->setColors(Transparent);
        $c->yAxis->setColors(Transparent);

        # Set the labels on the x axis
        $c->xAxis->setLabels("Sectorwise Gainer Looser in-depth");
        $c->yAxis->setLabelStyle("arial.ttf", 14);
        
        # Add a percentage bar layer
        $layer = $c->addBarLayer2(Percentage);

        $c->swapXY();
        # Add the three data sets to the bar layer, using icons images with labels as data
        # set names
        $textBoxObj = $c->addText ( 200, 10, " ", "times.ttf", 9, 0xc09090 );
        $textBoxObj->setAlignment ( TopLeft );

        $layer->addDataSet($losertotal, 0xf9ccdf,"-2%");
        $layer->addDataSet($unchangetotal, 0xf58220,"+(0 to -2)%");
        $layer->addDataSet($un_ch, 0xd4e6ae,"(2 to 0)%");
        $layer->addDataSet($gainertotal, 0xc2d76e,"+2%");
        # Use soft lighting effect with light direction from top
        //$layer->setBorderColor(Transparent, softLighting(Top));

        # Enable data label at the middle of the the bar
        $textBoxObj = $layer->setDataLabelStyle();
        $textBoxObj->setAlignment(Center);

        # For a vertical stacked chart with positive data only, the last data set is always
        # on top. However, in a vertical legend box, the last data set is at the bottom. This
        # can be reversed by using the setLegend method.
        $layer->setLegend(ReverseLegend);

        # Output the chart
        header("Content-type: image/png");
        print($c->makeChart2(PNG));
    }
 
 function sector_monthly( $sector = '')
    {
        //Configure::write('debug',3);
        
        $this->layout = 'default-bodyonly';
        $this->pageTitle = 'Stock Bangladesh :: Sector Index';
        
        $ip          = $_SERVER['REMOTE_ADDR'];
        $ipcheckSql  = "SELECT ip FROM user_ip WHERE is_active =1 AND ip='ipcheck'";
        $ipenable    = mysql_query($ipcheckSql);
        if(mysql_num_rows($ipenable))
        {
            $brokerIPSql = "SELECT ip FROM user_ip WHERE is_active =1 AND ip='".$ip."'";
            $access = mysql_query($brokerIPSql);
            if(!mysql_num_rows($access))
            {
                $this->Session->setFlash ( 'You are not authorized to access this location' );
                $this->redirect ( array ('controller' => 'users', 'action' => 'index' ) );
                //die("You are not authorized to access this location.");
            }
        }
        $sectorArr = $this->Symbol->find ( 'all', array ('conditions' => array ('inactive= \'No\' AND otc_market= \'No\' AND business_segment!=\'\' AND business_segment!=\'Mutual Funds\' AND business_segment!=\'Corporate Bond\''), 'fields' => array ('DISTINCT Symbol.business_segment'),'order'=> array('business_segment ASC') ) );
        foreach($sectorArr as $arr)
        {
            $sec_name = $arr['Symbol']['business_segment'];
            if($sec_name == 'Food & Allied' )
            {
             $sec_name = 'Food and Allied'; 
            }
            elseif($sec_name == 'Fuel & Power' )
            {
             $sec_name = 'Fuel and Power';
             
            }
            elseif($sec_name == 'Pharmaceuticals & Chemicals' )
            {
             $sec_name = 'Pharmaceuticals and Chemicals';
             
            }
            elseif($sec_name == 'Services & Real Estate' )
            {
             $sec_name = 'Services and Real Estate';
             
            }
            elseif($sec_name == 'Paper & Printing' )
            {
             $sec_name = 'Paper and Printing';
             
            }
            elseif($sec_name == 'Travel & Leisure' )
            {
             $sec_name = 'Travel and Leisure';
             
            }
            $sectors[] = $sec_name;
        }
        if($sector=='')
         {
           $sector='Bank';
         }
        $this->set('sector_name',$sectors);
        $this->set('key',$sector);
        
    }
    
    function sectormonthlychart() {

        $this->layout = 'default-three';

        $this->pageTitle = 'Stock Bangladesh :: Watch the price movement of selected share';

        App::import ( 'Vendor', 'json', array ('file' => 'JSON.php' ) );

        if (isset ( $_POST ) && ! empty ( $_POST )) {

            $TickerSymbol1 = $_POST ['TickerSymbol1'];

            $TickerSymbol2 = $_POST ['TickerSymbol2'];

            $TickerSymbol3 = $_POST ['TickerSymbol3'];

            $TickerSymbol4 = $_POST ['TickerSymbol4'];

            $TickerSymbol5 = $_POST ['TickerSymbol5'];

            $TickerSymbol6 = $_POST ['TickerSymbol6'];

            $TickerSymbol7 = $_POST ['TickerSymbol7'];

            $TickerSymbol8 = $_POST ['TickerSymbol8'];

            $TickerSymbol9 = $_POST ['TickerSymbol9'];
            
            $TickerSymbol10 = $_POST ['TickerSymbol10'];
            
            $TickerSymbol11 = $_POST ['TickerSymbol11'];
            
            $TickerSymbol12 = $_POST ['TickerSymbol12'];
            
            $TickerSymbol13 = $_POST ['TickerSymbol13'];
            
            $TickerSymbol14 = $_POST ['TickerSymbol14'];
            
            $TickerSymbol15 = $_POST ['TickerSymbol15'];
            
            $TickerSymbol16 = $_POST ['TickerSymbol16'];
            
            $TickerSymbol17 = $_POST ['TickerSymbol17'];
            
            $TickerSymbol18 = $_POST ['TickerSymbol18'];
            
            $TickerSymbol19 = $_POST ['TickerSymbol19'];
            
            $TickerSymbol20 = $_POST ['TickerSymbol20'];



            /*if (isset ( $_POST ['inv'] )) {

                $inv = $_POST ['inv'];

            } else {

                $inv = 300;

            }*/



            $this->set ( 'TickerSymbol1', $TickerSymbol1 );

            $this->set ( 'TickerSymbol2', $TickerSymbol2 );

            $this->set ( 'TickerSymbol3', $TickerSymbol3 );

            $this->set ( 'TickerSymbol4', $TickerSymbol4 );

            $this->set ( 'TickerSymbol5', $TickerSymbol5 );

            $this->set ( 'TickerSymbol6', $TickerSymbol6 );

            $this->set ( 'TickerSymbol7', $TickerSymbol7 );

            $this->set ( 'TickerSymbol8', $TickerSymbol8 );

            $this->set ( 'TickerSymbol9', $TickerSymbol9 );
            
            $this->set ( 'TickerSymbol10', $TickerSymbol10 );
            
            $this->set ( 'TickerSymbol11', $TickerSymbol11 );
            
            $this->set ( 'TickerSymbol12', $TickerSymbol12 );
            
            $this->set ( 'TickerSymbol13', $TickerSymbol13 );
            
            $this->set ( 'TickerSymbol14', $TickerSymbol14 );
            
            $this->set ( 'TickerSymbol15', $TickerSymbol15 );
                                                         
            $this->set ( 'TickerSymbol16', $TickerSymbol16 );
            
            $this->set ( 'TickerSymbol17', $TickerSymbol17 );
            
            $this->set ( 'TickerSymbol18', $TickerSymbol18 );
            
            $this->set ( 'TickerSymbol19', $TickerSymbol19 );
            
            $this->set ( 'TickerSymbol20', $TickerSymbol20 );

        }

        //$this->set ( 'inv', $inv );

    }
 
 function mmSectorChartMonthly($chart = '')//($sector = '')//
    {
        //Configure::write('debug',3);
        require_once (WWW_ROOT . DS . 'chart' . DS . 'phpchartdir.php');
        require_once (WWW_ROOT . DS . 'chart' . DS . 'Image_Toolbox.class.php');
        $sector = $_GET ['sym'];
        $sector = trim ( $sector );
        
        if(!empty($sector))
        {
            if($sector == 'Food and Allied' )
            {
             $sector_is = 'Food & Allied'; 
            }
            elseif($sector == 'Fuel and Power' )
            {
              
             $sector_is = 'Fuel & Power';
             
            }
            elseif($sector == 'Pharmaceuticals and Chemicals' )
            {
            
             $sector_is = 'Pharmaceuticals & Chemicals';
            }
            elseif($sector == 'Services and Real Estate' )
            {
             $sector_is = 'Services & Real Estate';
             
            }
            elseif($sector == 'Paper and Printing' )
            {
             $sector_is = 'Paper & Printing';
             
            }
            elseif($sector == 'Travel and Leisure' )
            {
             $sector_is = 'Travel & Leisure';
            }
            else
            $sector_is = $sector;
            
        $this->set('key',$sector);
        
        $date = date('Y-m-d',time());
        $last_sunday = date('Y-m-d', strtotime($date.'last sunday'));
        $laststamp = strtotime($last_sunday)-6*60*60;
        $todaystamp = time();
        
        /*$sql = 'SELECT * FROM market_summeries WHERE UNIX_TIMESTAMP(date) BETWEEN '.$laststamp.' AND '.$todaystamp.' ORDER BY ID DESC;';
        $dateinfo = $this->Symbol->query($sql);*/
        
        /*$prevdate = date('Y-m-d',strtotime('-1 week'));
        $prev_sunday = date('Y-m-d', strtotime($prevdate.'last sunday'));
        pr($prev_sunday);*/
        
        /*$total_day = count($dateinfo);
        $startdate = $dateinfo [$total_day-1] ['market_summeries'] ['date'];
        $lastdate = $dateinfo [0] ['market_summeries'] ['date'];*/
        
        $startstamp = strtotime($startdate);
        //pr($startstamp);
        $dataSql = "SELECT * FROM sbsector_summeries where sector = '$sector_is' AND volume!=0 order by datestamp DESC LIMIT 17 ";
        $dataInfo = $this->Symbol->query($dataSql);
        
        asort($dataInfo);
        
        
        $diff = 0;
        foreach($dataInfo as $count=>$arr)
        {
            
                $data[] = $arr['sbsector_summeries']['index_change'];
                $xlabel[] = date('d-M',$arr['sbsector_summeries']['datestamp']);
                $cont[] = $arr['sbsector_summeries']['contribution'];
                $vol[] = $arr['sbsector_summeries']['volume']/1000000;
                
        } 
        /*pr($data);
        pr($vol);
        die;*/
        
        
        $contCount = count($cont);
        //$c = new XYChart(700, 400);
        $c = new XYChart ( 305, 290 );
        //$c->setPlotArea(50, 25, 600, 250);
        $c->setPlotArea(50, 40, 200, 160);

        $legendObj = $c->addLegend(55, 5, false, "", 8);
        $legendObj->setBackground(Transparent);
        
        //$textBoxObj = $c->addText ( 100, 10, "www.stockbangladesh.com", "timesbi.ttf", 9, 0xc09090 );
        $textBoxObj = $c->addText ( 145, 10, $sector, "times.ttf", 16, 0x000000 );
        $textBoxObj->setAlignment ( TopCenter );
        #set the background color
        //$titleObj->setBackground($c->patternColor(array(0x4000, 0x8000), 2));

        # Add a title to the x axis
        $c->xAxis->setTitle("Time", "arial.ttf", 10);
        
        # Add a title to the y axis
        $c->yAxis->setTitle("Index Change", "arial.ttf", 10);
        $c->yAxis2->setTitle("Volume", "arial.ttf", 10);

        
        $c->xAxis->setLabelStyle ( "Arial", 8, TextColor, 90 );
        # Set the labels on the x axis.
        $c->xAxis->setLabels($xlabel);      
        
        # set the axis, label and title colors for the primary y axis to green (0x008000) to
        # match the second data set
        
        # Display 1 out of 2 labels on the x-axis. Show minor ticks for remaining labels.
        $c->xAxis->setLabelStep(1, 1);
        
        # Add three area layers, each representing one data set. The areas are drawn in
        # semi-transparent colors.
        
        //$c->addLineLayer($data, 0x8000EB00, $sector." Index Change  ".$lastdate);
        
        //$c->addLineLayer(array(), Transparent, "Title AAA BBB");
        $layer = $c->addLineLayer($data, 0x80FF0000);
        $ds = $layer->getDataSet(0);
        $ds->setDataSymbol(DiamondSymbol, 5);
        $layer->setLineWidth(2);
        
        //$colors = array(0x00FFFF, 0xFF00FF,0x000000, 0x00FFFF, 0xFF00FF,0x000000, 0x00FFFF, 0xFF00FF,0x000000, 0x00FFFF, 0xFF00FF,0x000000, 0x00FFFF, 0xFF00FF,0x000000,0x00FFFF, 0xFF00FF,0x000000, 0x00FFFF, 0xFF00FF,0x000000, 0x00FFFF, 0xFF00FF,0x000000, 0x00FFFF, 0xFF00FF,0x000000, 0x00FFFF, 0xFF00FF,0x000000, 0x00FFFF, 0xFF00FF,0x000000, 0x00FFFF, 0xFF00FF,0x000000, 0x00FFFF, 0xFF00FF,0x000000,0x00FFFF, 0xFF00FF,0x000000, 0x00FFFF, 0xFF00FF,0x000000, 0x00FFFF, 0xFF00FF,0x000000);
        
        //$colors = array(0xf9ccdf, 0xf58220, 0xd4e6ae, 0xc2d76e, 0xf9ccdf,0xf58220,0xd4e6ae,0xc2d76e,0xf9ccdf,0xf58220,0xd4e6ae,0xc2d76e,0xf9ccdf,0xf58220,0xd4e6ae,0xc2d76e,0xf9ccdf,0xf58220,0xd4e6ae,0xc2d76e,0xf9ccdf,0xf58220,0xd4e6ae,0xc2d76e,0xf9ccdf, 0xf58220, 0xd4e6ae, 0xc2d76e, 0xf9ccdf,0xf58220,0xd4e6ae,0xc2d76e,0xf9ccdf,0xf58220,0xd4e6ae,0xc2d76e,0xf9ccdf,0xf58220,0xd4e6ae,0xc2d76e,0xf9ccdf,0xf58220,0xd4e6ae,0xc2d76e,0xf9ccdf,0xf58220,0xd4e6ae,0xc2d76e);
        $colors = array(0xff0000, 0x00ff00, 0xff0000, 0x00ff00, 0xff0000, 0x00ff00,0xff0000, 0x00ff00,0xff0000, 0x00ff00,0xff0000, 0x00ff00,0xff0000, 0x00ff00,0xff0000, 0x00ff00,0xff0000, 0x00ff00,0xff0000, 0x00ff00,0xff0000, 0x00ff00,0xff0000, 0x00ff00,0xff0000, 0x00ff00, 0xff0000, 0x00ff00, 0xff0000, 0x00ff00,0xff0000, 0x00ff00,0xff0000, 0x00ff00,0xff0000, 0x00ff00,0xff0000, 0x00ff00,0xff0000, 0x00ff00,0xff0000, 0x00ff00,0xff0000, 0x00ff00,0xff0000, 0x00ff00,0xff0000, 0x00ff00);
        $barLayerObj = $c->addBarLayer3 ($vol,$colors);
        $barLayerObj->setBorderColor(-1, 1);
        //$barLayerObj->setBarShape (CircleShape );
        
        $barLayerObj->setUseYAxis2 ();
        
        $chartData = $c->makeChart2 ( PNG );
        print($chartData);
        } 
        
    }
    
     function evaluation()
   {
       //Configure::write('debug',3);
       $this->layout = 'default-one';
       
       if(!empty($this->data))
       {
           //pr($this->data);
           //die;
           $symbol     = $this->data['Symbol']['company'];
           $fair_value = $this->data['Symbol']['fair_value'];
           $from_date  = $this->data['Symbol']['start_date'];
           $to_date    = $this->data['Symbol']['end_date'];
           if(empty($from_date))
           {
              //$this->set('daterange',$date_range);
              $pricesql =" SELECT date,open,high,low,close,volume,trade,tradevalues FROM outputs as outputs WHERE `symbol` ='$symbol' ORDER BY daystamp ASC";
              $pricedata = $this->Symbol->query($pricesql);
              $_SESSION['info'] = $pricedata;
              $_SESSION['fair_value'] = $fair_value;
              $this->set('indexdata',$pricedata);
           }
           else
           {
              $start_stamp = strtotime($from_date) ;
              if(!empty($to_date))
              {
                $end_stamp   = strtotime($to_date)+12*3600;
              }
              else
              $end_stamp   = time()+12*3600;
              $indexsql    =" SELECT date,open,high,low,close,ycp,volume,trade,tradevalues FROM `outputs` WHERE `symbol` ='$symbol' AND daystamp >= $start_stamp and daystamp <=$end_stamp ORDER BY daystamp ASC" ;
              $indexdata   = $this->Symbol->query($indexsql);
              $this->set('indexdata',$indexdata);
              $_SESSION['info'] = $indexdata;
              $_SESSION['fair_value'] = $fair_value;
              //pr(count($indexdata));
                  
           }
       }
       
   }
   
   function evaluation_chart()
    {
       // Configure::write('debug',3);
        require_once (WWW_ROOT . DS . 'chart' . DS . 'phpchartdir.php');
        require_once (WWW_ROOT . DS . 'chart' . DS . 'Image_Toolbox.class.php');
        
        
       $indexdata  = $_SESSION['info'];
       $fair_value = $_SESSION['fair_value'];
       //pr($indexdata);
       //$limit = $_SESSION['limit'];
       //$totalrow = $_SESSION['row'];
       //pr($indexdata);
       
       $ydata = array();
       $xdata = array();
       $avg = array();
       $count = 0;
       $weekcount = 0;
       $count = 0;
       $indexcount = 0; 
          foreach($indexdata as $data) {
                    $count++;
                    $ydata[] = $data['outputs']['close'];
                    $xdata[] = $data['outputs']['date'];
                    $avg[]   = $fair_value;
                }
               
             
        $c = new XYChart(600, 600);
        $c->setPlotArea(50, 25, 500, 500);
        //$c->SetDrawPlotAreaBackground(0xE0E0E0);

        $legendObj = $c->addLegend(55, 5, false, "", 8);
        $legendObj->setBackground(Transparent);
        
        $textBoxObj = $c->addText ( 100, 30, "www.stockbangladesh.com", "timesbi.ttf", 9, 0xc09090 );
        $textBoxObj->setAlignment ( TopLeft );

        # Add a title to the x axis
        $c->xAxis->setTitle("Date");
        
        # Add a title to the y axis
        $c->yAxis->setTitle("Price");
        //$c->yAxis2->setTitle("Volume", "arial.ttf", 10);
        
        $c->xAxis->setLabelStyle ( "Arial", 8, TextColor, 90 );
        # Set the labels on the x axis.
        $c->xAxis->setLabels($xdata);      
        
        /*$c->yAxis2->setTitle ( "VOLUME" );*/
        # set the axis, label and title colors for the primary y axis to green (0x008000) to
        # match the second data set
        
        //$c->yAxis2->setColors ( 0x008000);
        /*$c->yAxis2->setLabels($trdvolumeArr);
        $c->yAxis2->setLabelStep(5, 1);*/
        
        # Display 1 out of 2 labels on the x-axis. Show minor ticks for remaining labels.
        $c->xAxis->setLabelStep(1, 1);
        if(count($xdata)>100)
        $c->xAxis->setLabelStep(5, 1);
        if(count($xdata)>300)
        $c->xAxis->setLabelStep(10, 1);
        if(count($xdata)>500)
        $c->xAxis->setLabelStep(15, 1);
        
        
        //$c->addLineLayer($sb71Arr, 0x80EB0000, "SB71 Index");
        $layer = $c->addLineLayer();
        $layer->setLineWidth(2);
        $layer->addDataSet($ydata, 0x80FF0000, "Price");
        $layer->addDataSet($avg, 0x8000ff00, "Fair Value");
        
        
        /*$layer = $c->addLineLayer($change, 0x80FF0000, "Index Change%");
        $layer->addLineLayer($avg, 0x8000ff00, "Avg PE");
        $ds = $layer->getDataSet(0);
        $ds->setDataSymbol(DiamondSymbol, 5);
        $layer->setLineWidth(2);*/
        
        //$c->addLineLayer($change, 0x8000EB00);
        //$colors = array(0x2D8F0A, 0xA52C2C, 0x2D8F0A, 0xA52C2C, 0x2D8F0A, 0xA52C2C,0x2D8F0A, 0xA52C2C,0x2D8F0A, 0xA52C2C,0x2D8F0A, 0xA52C2C,0x2D8F0A, 0xA52C2C,0x2D8F0A, 0xA52C2C,0x2D8F0A, 0xA52C2C,0x2D8F0A, 0xA52C2C,0x2D8F0A, 0xA52C2C,0x2D8F0A, 0xA52C2C,0x2D8F0A, 0xA52C2C, 0x2D8F0A, 0xA52C2C, 0x2D8F0A, 0xA52C2C,0x2D8F0A, 0xA52C2C,0x2D8F0A, 0xA52C2C,0x2D8F0A, 0xA52C2C,0x2D8F0A, 0xA52C2C,0x2D8F0A, 0xA52C2C,0x2D8F0A, 0xA52C2C,0x2D8F0A, 0xA52C2C,0x2D8F0A, 0xA52C2C,0x2D8F0A, 0xA52C2C);
        //$barLayerObj = $c->addBarLayer3 ($vol);
        //$barLayerObj->setBorderColor(-1, 1);
        //$barLayerObj->setBarShape (CircleShape );
        
        //$barLayerObj->setUseYAxis2 ();
        # Output the chart
        /*header("Content-type: image/png");
        print($c->makeChart2(PNG));
        exit;*/
        $chartData=$c->makeChart2(PNG);
        
        $chartImagePath = WWW_ROOT . 'chart'. DS . 'evaluation_chart.png';
        $f = fopen($chartImagePath, "wb");
        fwrite($f, $chartData);
        fclose($f);
        $img = new Image_Toolbox($chartImagePath);
        //$width=$img->_img['main']['width'];
        //$img->addImage($width,10,'#ffffff');
        //$img->blendMask('left','bottom',IMAGE_TOOLBOX_BLEND_COPY, 0, 390);
        $img->output();
        
    }
     function dsechartnew($chartType = '')
     {   
        if(strtolower($chartType)=='dsi') {
			$chartType = 'dsex';
		}
		if(strtolower($chartType)=='ds20') {
			$chartType = 'ds30';
		}
		
        //ob_start();
        /*require_once(WWW_ROOT . DS . 'chart'. DS .'phpchartdir.php');
        require_once(WWW_ROOT . DS . 'chart'. DS .'Image_Toolbox.class.php');
        */
        $getLastIndex = $this->Symbol->query("select value from configuration WHERE `configuration`.`name` like 'index_last_id'");        
        $getLastIndex = $getLastIndex[0]['configuration']['value'];
                     
        $querySQL  = ' SELECT id, IDX_DATE_TIME, IDX_CAPITAL_VALUE, IDX_GROSS_VALUE, IDX_INDEX_ID, IDX_DEVIATION FROM `index` WHERE IDX_INDEX_ID="'.$chartType.'" AND `id` > \''.$getLastIndex.'\' ';
        
        $graphData = $this->Symbol->query($querySQL);
        //print_r($graphData);
        $dArr    = array();
        
        $dsiArr    = array();
        $dsiLabel  = array();
        $ds20Arr   = array();
        $ds20Label = array();
        $dgenArr   = array();
        $dgenLabel = array();
        
		$index_counter = 0;
        $index=0;
        foreach ($graphData as $data)
        {
            //$datetime   = $data['index']['IDX_DATE_TIME'];
			$datetime   = (!$index_counter) ? str_replace('09:30','10:30',$data['index']['IDX_DATE_TIME']) : $data['index']['IDX_DATE_TIME'];
            $datetime   = strtotime($datetime);
            $grossValue = $data['index']['IDX_CAPITAL_VALUE'];
            $indexId    = trim($data['index']['IDX_INDEX_ID']);
                        
            //if($data['index']['IDX_DEVIATION'])
			if($data['index']['IDX_DEVIATION'] || !$index_counter)
			//if($previous_datetime!=$data['index']['IDX_DEVIATION'])
            {
               if($indexId=='DSEX')
                {
                    /*$dsiArr[$index.'_x']    = $grossValue;
                    $ctime       = $datetime;//date('H:i',$datetime) ;
                    $dsiLabel[$index]  = $ctime;
                    */$data_json[]=array('x'=>$datetime,'y'=>(float)$grossValue);
                }
                if($indexId=='DS30')
                {
                    /*$ds20Arr[$index]   = $grossValue;
                    $ctime       = $datetime;//date('H:i',$datetime) ;
                    $ds20Label[$index] =$ctime;
                    */$data_json[]=array('x'=>$datetime,'y'=>(float)$grossValue);
                }
                if($indexId=='DGEN')
                {
                    /*$dgenArr[$index]   = $grossValue;
                    $ctime       = $datetime;//date('H:i',$datetime) ;
                    $dgenLabel[$index] = $ctime;
                    */$data_json[]=array('x'=>$datetime,'y'=>(float)$grossValue);
                }
                
                
            }
            $previous_datetime = $datetime;
			$index_counter++;
        }
         
        $labels = $dsiLabel;
        
        $setTitle = '';
        $setColour = '0x80ff0000';
        $setImage = '';
        
        if(!empty($graphData) && $chartType !='' ){
            switch($chartType){
                case 'dsex':  
                           $dArr = $dsiArr;             
                           $setTitle  = 'DSEX';
                           $setImage  = 'dsi.png';
                           $setColour = 0x80ff0000;
                           
                           break; 
                case 'ds30':       
                           $dArr = $ds20Arr;                    
                           $setTitle  = 'DS30';
                           $setImage  = 'dse20.png';
                           $setColour = 0x808080ff;
                           
                           break; 
                case 'dgen':
                           $dArr = $dgenArr;
                           $setTitle  = 'Dse General';
                           $setImage  = 'dgen.png';
                           $setColour = 0x8000ff00;
                           
                           break;                       
            }
        }
        //print_r($dsiArr); 
        /*$arr['data']=$dsiArr;
        $arr['label']=$labels;*/
        echo '{"data":'. $this->__JEncode ( $data_json ).'}';
        die;
        
    }   
         function __JEncode($arr) {



        if (version_compare ( PHP_VERSION, "5.2", "<" )) {



            //App::import('Vendor', 'json', array('file' => 'JSON.php'));
            require_once (WWW_ROOT . DS . 'json' . DS . 'JSON.php');

            //require_once("./JSON.php"); //if php<5.2 need JSON class
            $json = new Services_JSON ( ); //instantiate new json object
            $data = $json->encode ( $arr ); //encode the data in json format
        } else {

            $data = json_encode ( $arr ); //encode the data in json format
        }

        return $data;

    }


    
    
      
}
?>