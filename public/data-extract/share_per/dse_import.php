<?php

ob_start();
include_once "ez_sql.php";
include_once "simplehtmldom/simple_html_dom.php";


$sqlStr="SELECT dse_code FROM symbols WHERE otc_market='no' AND inactive='No' ORDER BY dse_code";
$sqlQuery=mysql_query($sqlStr);

while($data=mysql_fetch_assoc($sqlQuery)){

	$selSql="SELECT dse_code FROM dse_codes WHERE dse_code='".$data['dse_code']."'";

	$sqlInfo=mysql_fetch_row(mysql_query($selSql));



	if(!isset($sqlInfo[0])){
		$insStr="INSERT INTO dse_codes (dse_code,update_date) VALUES('".$data['dse_code']."','0')";
		mysql_query($insStr);
	}
	$dataArray[]=$data['dse_code'];
}


$counter=0;
$date=date("Y-m-d");
$sqlStr="SELECT id,dse_code FROM dse_codes WHERE (update_date ='0' OR update_date !='$date') LIMIT 1";
$sqlQuery=mysql_query($sqlStr);

$itemInfo=mysql_fetch_assoc($sqlQuery);



function startsWith($haystack, $needle) {
	// search backwards starting from haystack length characters from the end
	return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
}

function array_search_partial($arr, $keyword) {


	foreach($arr as $index => $string) {
		if (startsWith($string, $keyword) !== FALSE)
			return $index;
	}
}

if(isset($itemInfo['id']))
{
	$item=$itemInfo["dse_code"];
	//$item='ABBANK';

	$url = "http://dsebd.org/displayCompany.php?name=".$item;





    $context = stream_context_create(array('http' => array('header' => 'User-Agent: Mozilla compatible')));
    $response = file_get_contents($url, false, $context);
    $html = str_get_html($response);


/*    $html = file_get_html($url);

    echo $item;*/
    
    // Find all element which id=company
    //$ret = $html->find('#company');
    $share_holdings=array();
    foreach($html->find('td[style=border:hidden;"]') as $e)
    {
        $temp=explode(':',$e->plaintext);

        $share_holdings[trim($temp[0])]=floatval(trim($temp[1]));
    }
        //echo $e->plaintext . '<br>';



	$htmlContent = file_get_contents($url);


	$DOM = new DOMDocument();
	$DOM->loadHTML($htmlContent);

	$Detail = $DOM->getElementsByTagName('td');

	foreach($Detail as $NodeDetail)
	{
		$dataTableDetailHTML[] = trim($NodeDetail->textContent);
	}


	/*echo '<pre>';
	print_r($dataTableDetailHTML);
	exit;*/

	$codeKey =array_search_partial($dataTableDetailHTML, 'Scrip Code') ;
	$code=explode("Scrip Code:",trim($dataTableDetailHTML[$codeKey]));
	$code=trim($code[1]);


	print_r($code);
	echo"<br>";

	if($code!="") {
		$navKey = array_search('Financial Performance... (Continued)', $dataTableDetailHTML);
		$item_nav = trim($dataTableDetailHTML[$navKey - 6]);
		if(is_numeric($item_nav)==FALSE)$item_nav=0;


		$totalKey = array_search('Total No. of Outstanding Securities', $dataTableDetailHTML);
		$total_securities = str_replace(',', '', trim($dataTableDetailHTML[$totalKey + 1]));

		$paid_upKey = array_search('Paid-up Capital (mn)', $dataTableDetailHTML);
		$paid_up = str_replace(',', '', trim($dataTableDetailHTML[$paid_upKey + 1]));

		$auth_capitalKey = array_search('Authorized Capital (mn)', $dataTableDetailHTML);
		$auth_capital = str_replace(',', '', trim($dataTableDetailHTML[$auth_capitalKey + 1]));

		$market_lotKey = array_search('Market Lot', $dataTableDetailHTML);
		$market_lot =str_replace(',', '', trim($dataTableDetailHTML[$market_lotKey + 1]));

		$categoryKey = array_search('Market Category', $dataTableDetailHTML);
		$category = trim($dataTableDetailHTML[$categoryKey + 1]);

		$last_agmKey = array_search_partial($dataTableDetailHTML,'Last AGM held on');
		$last_agm =explode(':',trim($dataTableDetailHTML[$last_agmKey]));
		$last_agm =explode('For',trim($last_agm[1]));
		$last_agm =trim($last_agm[0]);
		if ($last_agm == '')$last_agm = 0;

		$rserve_surplusKey = array_search('Reserve & Surplus without OCI (mn)', $dataTableDetailHTML);
		$rserve_surplus = str_replace(',', '',trim($dataTableDetailHTML[$rserve_surplusKey + 1]));

		//$percentageKey = array_search('Remark', $dataTableDetailHTML);
		$percentageKey = array_search('Share Holding Percentage', $dataTableDetailHTML);



	/*	$spnsor = trim($dataTableDetailHTML[$percentageKey - 5]);
		$spnsor = explode("Sponsor/Director:", $spnsor);
		$sponsor_share = trim($spnsor[1]);

		$govt = trim($dataTableDetailHTML[$percentageKey - 4]);
		$govt = explode("Govt:", $govt);
		$govt_share = str_replace(',', '', trim($govt[1]));

		$institute = trim($dataTableDetailHTML[$percentageKey - 3]);
		$institute = explode("Institute:", $institute);
		$institute_share =  str_replace(',', '',trim($institute[1]));

		$foreign = trim($dataTableDetailHTML[$percentageKey - 2]);
		$foreign = explode("Foreign:", $foreign);
		$f_share = str_replace(',', '', trim($foreign[1]));

		$public = trim($dataTableDetailHTML[$percentageKey - 1]);
		$public = explode("Public:", $public);
		$public_share =str_replace(',', '',trim($public[1]));
		$public_share = 100 - ($sponsor_share + $govt_share + $institute_share + $f_share);*/

        $sponsor_share =$share_holdings['Sponsor/Director'];
        $govt_share =$share_holdings['Govt'];
        $institute_share =$share_holdings['Institute'];
        $f_share =$share_holdings['Foreign'];
        $public_share =$share_holdings['Public'];


		echo $sqlStr = "UPDATE dse_codes
		SET 
		total=$total_securities,
		sponsor=$sponsor_share,
		govt=$govt_share,
		institute=$institute_share,
		public_share=$public_share,		
		f_share=$f_share ,
		nav=$item_nav,
		update_date ='$date',
        paid_up = $paid_up,
        authorized = $auth_capital,
        market_lot = $market_lot,
        category =  '$category',
        last_agm = '$last_agm',
		rserve_surplus = '$rserve_surplus'
        
        WHERE dse_code ='" . $item . "'";
		mysql_query($sqlStr)or die('<pre>'.mysql_error());
	}
	else
	{
		echo $sqlStr = "UPDATE dse_codes
		SET
		total=0,
		sponsor=0,
		govt=0,
		institute=0,
		public_share=0,
		f_share=0 ,
		nav=0,
		update_date ='$date',
        paid_up = 0,
        authorized = 0,
        market_lot = 0,
        category =  '0',
        last_agm = '0',
		rserve_surplus = '0'

        WHERE dse_code ='" . $item . "'";
		mysql_query($sqlStr) or die('<pre>'.mysql_error());
	}

	for($i=0;$i<count($dataArray);$i++){

		header("Refresh: .6; url=dse_import.php");
	}
}
else
{
echo "All done";
}
?>