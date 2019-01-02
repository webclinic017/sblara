<?php 
function dd($data)
{
	echo "<pre>";
	print_r($data);
	die();
}
$uri = $_SERVER['REQUEST_URI'];
if(strpos($uri, 'ajax/load_block') || $uri == '/'){
	require __DIR__."/cache.php";
}