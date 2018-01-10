<?php
set_time_limit(0);
 include_once public_path()."/data-extract/share_per/simplehtmldom/simple_html_dom.php";
$instruments =\App\Instrument::with('dseSharePercentage')->orderBy('instrument_code', 'asc')->where('active', '=', '1')->get();

function _startsWith($haystack, $needle) {
	// search backwards starting from haystack length characters from the end
	return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
}
function array_search_partial($arr, $keyword) {

	foreach($arr as $index => $string) {
		if (_startsWith($string, $keyword) !== FALSE)
			return $index;
	}
}
try
{
$counter=0;
$date=date("Y-m-d");

foreach ($instruments as $instrument) {
	if($instrument->dseSharePercentage != null )
	{
		if( $instrument->dseSharePercentage->update_date == $date || $instrument->dseSharePercentage->update_date == 0)
		continue;
	}

	 $url = "http://dsebd.org/displayCompany.php?name=".$instrument->instrument_code;
    $context = stream_context_create(array('http' => array('header' => 'User-Agent: Mozilla compatible')));
    $response = file_get_contents($url, false, $context);
     $html = str_get_html($response);	 
    
    $share_holdings=array();

    foreach($html->find('td[style=border:hidden;"]') as $e)
    {
        $temp=explode(':',$e->plaintext);

        $share_holdings[trim($temp[0])]=floatval(trim($temp[1]));
    }
        //echo $e->plaintext . '<br>';



	$htmlContent = file_get_contents($url);


	$DOM = new DOMDocument();
	@$DOM->loadHTML($htmlContent);

	
	$Detail = $DOM->getElementsByTagName('td');

	foreach($Detail as $NodeDetail)
	{
		$dataTableDetailHTML[] = trim($NodeDetail->textContent);
	}

	$codeKey =array_search_partial($dataTableDetailHTML, 'Scrip Code') ;

	$code=explode("Scrip Code:",trim($dataTableDetailHTML[$codeKey]));
	$code=trim($code[1]);


	     $item = $instrument->dseSharePercentage;
        if($item == NULL)
        {
        	$item = new \App\DseSharePercentage();
        	$item->instrument_id = $instrument->id;
        }
	if($code!="") {
	echo "Please wait...<br>";
	echo "Fetching <strong>$instrument->instrument_code</strong>";

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


        $sponsor_share =$share_holdings['Sponsor/Director'];
        $govt_share =$share_holdings['Govt'];
        $institute_share =$share_holdings['Institute'];
        $f_share =$share_holdings['Foreign'];
        $public_share =$share_holdings['Public'];

		$item->total=$total_securities;
		$item->sponsor=$sponsor_share;
		$item->govt=$govt_share;
		$item->institute=$institute_share;
		$item->public_share=$public_share;
		$item->f_share=$f_share ;
		$item->nav=$item_nav;
        $item->paid_up = $paid_up;
        $item->authorized = $auth_capital;
        $item->market_lot = $market_lot;
        $item->category =  $category;
        $item->last_agm = $last_agm;
		$item->rserve_surplus = $rserve_surplus;
		$item->update_date =$date;
		$item->save();
	}else{
		$item->update_date =$date;
		$item->save();

	}
	header("Refresh: .6; url=/admin/data-extractors/share-percentage-dse-import");
	die();
}
}catch(\Exception $e)
{
	redirect('/admin/data-extractors/share-percentage-dse-import');
}
?>
<br>
All Done