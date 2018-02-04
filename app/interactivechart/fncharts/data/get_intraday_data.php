<?php
	header("Content-Type: text;");
	/*
	mysql_connect("localhost", "root", "") or die("Error: Couldn't to MySQL Server!");
	mysql_select_db("sbcake") or die("Error: Database not found!");
	*/
	include_once "../../../ez_sql.php";
	/*
	$myvar = '';
		foreach($_REQUEST as $key=>$req) {
			$myvar.=$key.'='.$req.',';
		}
	//echo $myvar;
	mysql_query("INSERT INTO TEMP_APPLET_TEST (REQUEST_VAR) VALUES ('".mysql_escape_string($myvar)."')")or die(mysql_error());
	*/
		
	
	$curdatetime		=	date('Y-m-d H:i:s');
	$last_timestamp		=	strtotime($curdatetime);
	//echo $last_timestamp."-";
	$prevdatetime		=	date('Y-m-d H:i:s', strtotime($curdatetime.'-8 day'));
	$first_timestamp	=	strtotime($prevdatetime);
	//echo $first_timestamp;
	/*
	if(isset($_REQUEST['last_timestamp']))
	$last_timestamp	=	$_REQUEST['last_timestamp'];
	if(isset($_REQUEST['first_timestamp']))
	$first_timestamp	=	$_REQUEST['first_timestamp'];
	*/
	//if(!isset($_GET['first_timestamp']) && !isset($_GET['last_timestamp']))
	//$query	=	"SELECT data_banks_intraday.date, data_banks_intraday.currenttime, data_banks_intraday.open, data_banks_intraday.high, data_banks_intraday.low, data_banks_intraday.close, data_banks_intraday.volume FROM symbols, data_banks_intraday WHERE data_banks_intraday.symbol_id = symbols.id AND symbols.dse_code='".$_GET['symbol']."' AND data_banks_intraday.id > (SELECT configuration.value FROM configuration WHERE configuration.id=2)";
	//else
	//$query	=	"SELECT data_banks_intraday.date, data_banks_intraday.open, data_banks_intraday.high, data_banks_intraday.low, data_banks_intraday.close, data_banks_intraday.volume FROM symbols, data_banks_intraday WHERE data_banks_intraday.symbol_id = symbols.id AND symbols.dse_code='".$_GET['symbol']."' AND data_banks_intraday.id > (SELECT configuration.value FROM configuration WHERE configuration.id=2) AND data_banks_intraday.currenttime BETWEEN ".$_GET['first_timestamp']." AND ".$_GET['last_timestamp'];
	//$query	=	"SELECT data_banks_intraday.date, data_banks_intraday.open, data_banks_intraday.high, data_banks_intraday.low, data_banks_intraday.close, data_banks_intraday.volume FROM symbols, data_banks_intraday WHERE data_banks_intraday.symbol_id = symbols.id AND symbols.dse_code='".$_GET['symbol']."' AND data_banks_intraday.id > (SELECT configuration.value FROM configuration WHERE configuration.id=2) AND data_banks_intraday.currenttime BETWEEN ".$first_timestamp." AND ".$last_timestamp;
	//$query		=	"SELECT DATE_FORMAT(FROM_UNIXTIME(data_banks_intraday.date), '%Y%m%d') AS date, DATE_FORMAT(FROM_UNIXTIME(data_banks_intraday.date), '%H%i%s') AS time, data_banks_intraday.close AS close, data_banks_intraday.volume AS volume FROM symbols, data_banks_intraday WHERE data_banks_intraday.symbol_id = symbols.id AND symbols.dse_code='".$_GET['symbol']."' AND data_banks_intraday.id > (SELECT configuration.value FROM configuration WHERE configuration.id=2) AND data_banks_intraday.currenttime BETWEEN ".$first_timestamp." AND ".$last_timestamp;
	
		$link_plugin = mysql_connect('localhost', 'shareban_plug', 'sTmS115^~!plug');
		mysql_select_db("shareban_plugin");
		$query		=	"SELECT DATE_FORMAT(FROM_UNIXTIME(data_banks_intraday.datestamp), '%Y%m%d') AS date, DATE_FORMAT(FROM_UNIXTIME(data_banks_intraday.datestamp), '%H%i%s') AS time, data_banks_intraday.close AS close, data_banks_intraday.volume AS volume FROM data_banks_intraday WHERE data_banks_intraday.code ='".$_GET['symbol']."' AND data_banks_intraday.currenttime BETWEEN ".$first_timestamp." AND ".$last_timestamp." ORDER BY data_banks_intraday.id ASC";
		
		$result	=	mysql_query($query) or die(mysql_error());
		// echo "<pre>";
		// print_r($plugin_query);
	
	 /*
		$query		=	"SELECT DATE_FORMAT(FROM_UNIXTIME(data_banks_intraday.date), '%Y%m%d') AS date, DATE_FORMAT(FROM_UNIXTIME(data_banks_intraday.date), '%H%i%s') AS time, data_banks_intraday.close AS close, data_banks_intraday.volume AS volume FROM symbols, data_banks_intraday WHERE data_banks_intraday.symbol_id = symbols.id AND symbols.dse_code='".$_GET['symbol']."' AND data_banks_intraday.currenttime BETWEEN ".$first_timestamp." AND ".$last_timestamp." ORDER BY data_banks_intraday.id ASC";
		//echo $query;die;
		$result	=	mysql_query($query) or die(mysql_error());
		*/
	
	$str	=	null;
	$vis_str	=	null;
	echo $str	=	"<DTYYYYMMDD>,<TIME>,<CLOSE>,<VOL>\n";
	//$vis_str	.=	"&lt;DTYYYYMMDD&gt;,&lt;OPEN&gt;,&lt;HIGH&gt;,&lt;LOW&gt;,&lt;CLOSE&gt;,&lt;VOL&gt;<br/>";
	if(mysql_num_rows($result))
	{
		$swap_volume	=	0;
		while($sdata	=	mysql_fetch_array($result))
		{
			//echo $str	= date('Ymd', $sdata["date"]).",".date('His', $sdata["time"]).",".$sdata["close"].",".$sdata["volume"]."\n";
			//$vis_str	.= date('Ymd', strtotime($sdata["date"])).",".$sdata["open"].",".$sdata["high"].",".$sdata["low"].",".$sdata["close"].",".$sdata["volume"]."<br/>";
			//echo $str	= $sdata["date"].",".$sdata["time"].",".$sdata["close"].",".$sdata["volume"]."\n";
			
			
			if(!isset($_GET['symbol']) || $_GET['symbol']=='' || $_GET['symbol']=='DSEGEN') {
				$volume	=	($volume/1000000);
			}
			$volume	=	$sdata["volume"];//	-	$swap_volume;
			if($volume<0){$volume=0;}
			echo $sdata["date"].",".$sdata["time"].",".$sdata["close"].",".$volume."\n";
			$swap_volume	=	$volume;
		}
		
		//echo "<textarea cols='80' rows='20'>".$str."</textarea>";
		//echo "<h2>Formatted Txt</h2>".$vis_str;
		//echo $str;
	}
	else{die(date('Ymd', strtotime(date('Y-m-d H:i:s'))).",".date('His', strtotime(date('Y-m-d H:i:s'))).",00,00");}
?>
<?php
die(); 
header("Content-Type: text;"); 
mysql_connect("localhost", "root", "") or die("Error: Couldn't to MySQL Server!");
	mysql_select_db("sbcake") or die("Error: Database not found!");
	
	$myvar = '';
		foreach($_REQUEST as $key=>$req) {
			$myvar.=$key.'='.$req.',';
		}
	//echo $myvar;
	mysql_query("INSERT INTO TEMP_APPLET_TEST (REQUEST_VAR) VALUES ('".mysql_escape_string($myvar)."')")or die(mysql_error());
?>