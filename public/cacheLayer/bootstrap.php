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
	
		if($_GET['to'] < (time() - 2*24*60*60)){
			echo json_encode(['s'=> 'no_data']);
			exit;
		}
		$uri = "/history/".$_GET['symbol']."/".$_GET['resolution'];
	}

//for trading view end
if(strpos($uri, 'ajax/load_block') || strpos($uri, 'history/')  || strpos($uri, 'search?limit') || strpos($uri, 'symbols?symbol') || strpos($uri, 'price-board') || strpos($uri, '/technical-analysis') ||  strpos($uri, 'tv/tab/filter') || strpos($uri, 'tv/tab/topList') ||  in_array($uri, $cacheUri)){
	// not filter
	require __DIR__."/cache.php";
}