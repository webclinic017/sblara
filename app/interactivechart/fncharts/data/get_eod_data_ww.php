<?php
	header("Content-Type: text;");
	/*
	mysql_connect("localhost", "root", "") or die("Error: Couldn't to MySQL Server!");
	mysql_select_db("sbcake") or die("Error: Database not found!");
	*/
	include_once "../../../ez_sql.php";
	
	    $str	=	null;
		$vis_str	=	null;
		echo $str	=	"<DTYYYYMMDD>,<OPEN>,<HIGH>,<LOW>,<CLOSE>,<VOL>\n";
		$vis_str	.=	"&lt;DTYYYYMMDD&gt;,&lt;OPEN&gt;,&lt;HIGH&gt;,&lt;LOW&gt;,&lt;CLOSE&gt;,&lt;VOL&gt;<br/>";
		
		
	if($_REQUEST['adjusted']=='n') {
		$query	=	"SELECT symbols.dse_code, outputs.date, outputs.open, outputs.high, outputs.low, outputs.close, outputs.volume FROM symbols, outputs WHERE symbols.id=outputs.symbol AND symbols.dse_code = '".$_GET['symbol']."'";
		$result	=	mysql_query($query) or die(mysql_error());
		
		
		if(mysql_num_rows($result))
		{
			while($sdata	=	mysql_fetch_array($result))
			{
				echo $str	= date('Ymd', strtotime($sdata["date"])).",".$sdata["open"].",".$sdata["high"].",".$sdata["low"].",".$sdata["close"].",".$sdata["volume"]."\n";
				$vis_str	.= date('Ymd', strtotime($sdata["date"])).",".$sdata["open"].",".$sdata["high"].",".$sdata["low"].",".$sdata["close"].",".$sdata["volume"]."<br/>";
			}
			
			//echo "<textarea cols='80' rows='20'>".$str."</textarea>";
			//echo "<h2>Formatted Txt</h2>".$vis_str;
			//echo $str;
		}
		else{die("<h1>NO SYMBOL FOUND</h1>");}
		
	}else {
		$querystr = 'SELECT UNIX_TIMESTAMP(str_to_date(date, \'%d-%c-%Y\')) as mydate,outputs.id,outputs.symbol,symbols.dse_code, outputs.date, outputs.open, outputs.high, outputs.low, outputs.close, outputs.volume FROM symbols, outputs WHERE symbols.id=outputs.symbol AND symbols.dse_code = \''.$_GET['symbol'].'\' ORDER BY outputs.id ASC';
		$query_company_raw_data = mysql_query($querystr)or die(mysql_error());
		
		$companyDataArray = array();
		$resultarr = array();
		while($rs_row_data = mysql_fetch_array($query_company_raw_data)) {
			$companyDataArray[] = $rs_row_data;
			$resultarr[] = $rs_row_data;
		}
		//print_r($resultarr);
		$queryCorporate=mysql_query("SELECT * FROM `corporate_action` WHERE `code` ='".$_GET['symbol']."' and `active`=1 ORDER BY `datestamp` ASC");
		$actionDataArray = array();
		while($rs_row_action = mysql_fetch_array($queryCorporate)) {
			$actionDataArray[] = $rs_row_action;
		}
		
					foreach ($actionDataArray as $row)
					{
						$action=$row['action'];
						$adjustedArr=array();
	
						if($action=='stockdiv')
						{
							$adjustmentFactor=(100+$row['value'])/100;
	
							$day=$row['date'];
							//$daystamp= strtotime($day)-24*60*60;
							$daystamp= strtotime($day);
	
							foreach ($resultarr as $data)
							{
								if($data['mydate']<$daystamp)
								{
									$data['open']=$data['open']/$adjustmentFactor;
									$data['high']=$data['high']/$adjustmentFactor;
									$data['low']=$data['low']/$adjustmentFactor;
									$data['close']=$data['close']/$adjustmentFactor;
								}
	
								$adjustedArr[]=$data;
							}
	
							$resultarr=array();
							$resultarr=$adjustedArr;
	
						}
						elseif($action=='cashdiv')
						{
	
							$symbolSQL = "SELECT face_value FROM symbols WHERE id=$ticker";
	
							$result = mysql_fetch_array(mysql_query($symbolSQL));
	
							$facevalue  = $result['face_value'];
	
	
	
	
							$adjustmentFactor=$facevalue*$row['value']/100;
	
							$day=$row['date'];
							//$daystamp= strtotime($day)-24*60*60;
							$daystamp= strtotime($day);
	
							foreach ($resultarr as $data)
							{
								if($data['mydate']<$daystamp)
								{
									$data['open']=$data['open']-$adjustmentFactor;
									$data['high']=$data['high']-$adjustmentFactor;
									$data['low']=$data['low']-$adjustmentFactor;
									$data['close']=$data['close']-$adjustmentFactor;
								}
	
								$adjustedArr[]=$data;
							}
	
							$resultarr=array();
							$resultarr=$adjustedArr;
	
						}
						elseif($action=='rightshare')
						{
	
							$symbolSQL = "SELECT face_value FROM symbols WHERE id=$ticker";
	
							$result = mysql_fetch_array(mysql_query($symbolSQL));
	
							$facevalue  = $result['face_value'];
	
							$adjustmentFactor=(100+$row['value'])/100;
							$premium=$row['premium'];					
							
							   $close_price_adjustment_factor=($premium+$facevalue)-(($premium+$facevalue)/$adjustmentFactor);
							
	
							$day=$row['date'];
							//$daystamp= strtotime($day)-24*60*60;
							$daystamp= strtotime($day);
	
							foreach ($resultarr as $data)
							{
								if($data['mydate']<$daystamp)
								{							    
									$data['open']=(($data['open']*100)+(($premium+$facevalue)*$row['value'])) / (100+$row['value']);
									$data['high']=(($data['high']*100)+(($premium+$facevalue)*$row['value'])) / (100+$row['value']);
									$data['low']=(($data['low']*100)+(($premium+$facevalue)*$row['value'])) / (100+$row['value']);
									$data['close']=(($data['close']*100)+(($premium+$facevalue)*$row['value'])) / (100+$row['value']);
									
									
								}
	
								$adjustedArr[]=$data;
							}
	
							$resultarr=array();
							$resultarr=$adjustedArr;
	
						}
	
	
						elseif ($action=='split')
						{
							$adjustmentFactor=$row['value'];
	
							$day=$row['date'];
							//$daystamp= strtotime($day)-24*60*60;
							$daystamp= strtotime($day);
	
							foreach ($resultarr as $data)
							{
								if($data['mydate']<$daystamp)
								{
									$data['open']=$data['open']/$adjustmentFactor;
									$data['high']=$data['high']/$adjustmentFactor;
									$data['low']=$data['low']/$adjustmentFactor;
									$data['close']=$data['close']/$adjustmentFactor;
									$data['volume']=$data['volume']*$adjustmentFactor;
								}
	
								$adjustedArr[]=$data;
							}
							$resultarr=array();
							$resultarr=$adjustedArr;
						}
					}
					
					foreach($adjustedArr as $sdata) {
						echo $str	= date('Ymd', strtotime($sdata["date"])).",".$sdata["open"].",".$sdata["high"].",".$sdata["low"].",".$sdata["close"].",".$sdata["volume"]."\n";
			$vis_str	.= date('Ymd', strtotime($sdata["date"])).",".$sdata["open"].",".$sdata["high"].",".$sdata["low"].",".$sdata["close"].",".$sdata["volume"]."<br/>";
					}
		
		//$query	=	"SELECT symbols.dse_code, outputs.date, outputs.open, outputs.high, outputs.low, outputs.close, outputs.volume FROM symbols, outputs_adjusted as outputs WHERE symbols.id=outputs.symbol AND symbols.dse_code = '".$_GET['symbol']."'";
		           //SELECT symbols.dse_code, outputs.date, outputs.open, outputs.high, outputs.low, outputs.close, outputs.volume FROM symbols, outputs_adjusted AS outputs WHERE symbols.id = outputs.symbol AND symbols.dse_code = 'ABBANK'
	}
	//$query	=	"SELECT symbols.dse_code, outputs.date, outputs.open, outputs.high, outputs.low, outputs.close, outputs.volume FROM symbols, outputs WHERE symbols.id=outputs.symbol AND symbols.dse_code = '".$_GET['symbol']."'";
	//echo $query."<br/>";
	/*
	$str	=	null;
	$vis_str	=	null;
	echo $str	=	"<DTYYYYMMDD>,<OPEN>,<HIGH>,<LOW>,<CLOSE>,<VOL>\n";
	$vis_str	.=	"&lt;DTYYYYMMDD&gt;,&lt;OPEN&gt;,&lt;HIGH&gt;,&lt;LOW&gt;,&lt;CLOSE&gt;,&lt;VOL&gt;<br/>";
	if(mysql_num_rows($result))
	{
		while($sdata	=	mysql_fetch_array($result))
		{
			echo $str	= date('Ymd', strtotime($sdata["date"])).",".$sdata["open"].",".$sdata["high"].",".$sdata["low"].",".$sdata["close"].",".$sdata["volume"]."\n";
			$vis_str	.= date('Ymd', strtotime($sdata["date"])).",".$sdata["open"].",".$sdata["high"].",".$sdata["low"].",".$sdata["close"].",".$sdata["volume"]."<br/>";
		}
		
		//echo "<textarea cols='80' rows='20'>".$str."</textarea>";
		//echo "<h2>Formatted Txt</h2>".$vis_str;
		//echo $str;
	}
	else{die("<h1>NO SYMBOL FOUND</h1>");}*/
?>