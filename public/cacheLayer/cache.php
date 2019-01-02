<?php 
$hash = md5($_SERVER['REQUEST_URI']);
function callback($html)
{
	global $hash;
	file_put_contents(__DIR__.'/store/'.$hash.'/d', $html);
	//cache completed 
	return $html;
	// return $html;
}
//started caching

//check if dir exist or create the directory
if (!file_exists(__DIR__.'/store/'.$hash)) {
    mkdir(__DIR__.'/store/'.$hash, 0777, true);
}else{
	// folder exist/even file may exist 
	//check if file expired
	$timeago = time() - filemtime(__DIR__.'/store/'.$hash.'/d');
	if($timeago < 60){
		echo file_get_contents(__DIR__.'/store/'.$hash.'/d');
		exit;
	}else{
		 ob_start("callback");	
	}
}

//put the status, to know another request updating file;
// file_put_contents(__DIR__.'/store/'.$hash.'/status', $html);


