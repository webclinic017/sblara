<?php
	/*
	mysql_connect("localhost", "root", "") or die("Error: Couldn't to MySQL Server!");
	mysql_select_db("sbcake") or die("Error: Database not found!");
	*/
	include_once "../ez_sql.php";
	function getSelectedSymbol()
	{
		$ticker	=	1;
		if(isset($_REQUEST['TickerSymbol']) && $_REQUEST['TickerSymbol'] != '')
		$ticker	=	$_REQUEST['TickerSymbol'];
		$query	=	"SELECT symbols.dse_code AS symbol FROM symbols WHERE id	=	$ticker";
		$result	=	mysql_query($query);
		$data	=	mysql_fetch_assoc($result);
		$symbol	=	$data['symbol'];
		return $symbol;
	}
	
	function getAllSymbols()
	{
		$query		=	"SELECT dse_code AS 'symbol' FROM symbols WHERE id >0 ORDER BY dse_code";
		$result		=	mysql_query($query);
		$symbols	=	null;
		while($querydata		=	mysql_fetch_array($result))
		{
			if($symbols==null)
				$symbols	=	$querydata['symbol'];
			else
				$symbols	.=	",".$querydata['symbol'];
		}
		return $symbols;
	}
?>