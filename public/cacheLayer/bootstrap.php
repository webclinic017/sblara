<?php 
function dd($data)
{
	echo "<pre>";
	print_r($data);
	die();
}
$cacheUri = [
	'/',
	'monitor',
];

$uri = $_SERVER['REQUEST_URI'];
//for trading view

	if(strpos($uri, 'history?')){
		// dd($uri);
		// dd('under construction');
		$uri = "/history/".$_GET['symbol']."/".$_GET['resolution'];
	}

//for trading view end
if(strpos($uri, 'ajax/load_block') || strpos($uri, 'history/')  || strpos($uri, 'search?limit') || strpos($uri, 'symbols?symbol') || strpos($uri, 'price-board') || strpos($uri, 'technical-analysis') ||  strpos($uri, 'tv/tab') ||  in_array($uri, $cacheUri)){
	require __DIR__."/cache.php";
}