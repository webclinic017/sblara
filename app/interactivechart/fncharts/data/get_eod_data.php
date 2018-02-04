<?php
	header("Content-Type: text;");
	/*
	mysql_connect("localhost", "root", "") or die("Error: Couldn't to MySQL Server!");
	mysql_select_db("sbcake") or die("Error: Database not found!");
	*/
	
	/*
	$filename = __DIR__.'/a.txt';
	$somecontent = var_dump($_SERVER);
	if (!$handle = fopen($filename, 'a')) {
         echo "Cannot open file ($filename)";
         exit;
    }
	if (fwrite($handle, $somecontent) === FALSE) {
        echo "Cannot write to file ($filename)";
        exit;
    }
	fclose($handle);
*/
	
	include_once "../../../ez_sql.php";
	if($_REQUEST['adjusted']=='n') {
		$query	=	"SELECT symbols.dse_code, outputs.date, outputs.open, outputs.high, outputs.low, outputs.close, outputs.volume FROM symbols, outputs WHERE symbols.id=outputs.symbol AND symbols.dse_code = '".$_GET['symbol']."'";
		die($query);
	}else {
		$query	=	"SELECT symbols.dse_code, outputs.date, outputs.open, outputs.high, outputs.low, outputs.close, outputs.volume FROM symbols, outputs_adjusted as outputs WHERE symbols.id=outputs.symbol AND symbols.dse_code = '".$_GET['symbol']."'";
		           //SELECT symbols.dse_code, outputs.date, outputs.open, outputs.high, outputs.low, outputs.close, outputs.volume FROM symbols, outputs_adjusted AS outputs WHERE symbols.id = outputs.symbol AND symbols.dse_code = 'ABBANK'
		// get real time data during trade time
		$query_trade_time	=	"SELECT symbols.dse_code, outputs.date, outputs.open, outputs.high, outputs.low, outputs.close, outputs.volume FROM symbols, outputs WHERE symbols.id=outputs.symbol AND symbols.dse_code = '".$_GET['symbol']."' ORDER BY outputs.id DESC LIMIT 1";		   
		$result_trade_time	=	mysql_fetch_array(mysql_query($query_trade_time));
	}
	$query	=	"SELECT symbols.dse_code, outputs.date, outputs.open, outputs.high, outputs.low, outputs.close, outputs.volume FROM symbols, outputs WHERE symbols.id=outputs.symbol AND symbols.dse_code = '".$_GET['symbol']."'";
	//echo $query."<br/>";
	$result	=	mysql_query($query) or die(mysql_error());
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
		
		if($sdata["date"]!=$result_trade_time['date']) {
			echo $str	= date('Ymd', strtotime($result_trade_time["date"])).",".$result_trade_time["open"].",".$result_trade_time["high"].",".$result_trade_time["low"].",".$result_trade_time["close"].",".$result_trade_time["volume"]."\n";
		}
		//echo "<textarea cols='80' rows='20'>".$str."</textarea>";
		//echo "<h2>Formatted Txt</h2>".$vis_str;
		//echo $str;
	}
	else{die("<h1>NO SYMBOL FOUND</h1>");}
?>