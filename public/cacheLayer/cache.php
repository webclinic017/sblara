<?php 
$hash = md5($uri);
function callback($html)
{
	global $hash;
	file_put_contents(__DIR__.'/store/'.$hash.'/d', $html);
	unlink(__DIR__.'/store/'.$hash.'/cst');
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

	$cacheTime = 60;
	if(strpos($uri, 'history/')){
		$cacheTime = 120;
	}

	if($timeago < $cacheTime){
		echo file_get_contents(__DIR__.'/store/'.$hash.'/d');
		exit;
	}else{
		//check if another request is caching
		//cst = cache started

		if(!file_exists(__DIR__.'/store/'.$hash.'/cst') || ((time() - filemtime(__DIR__.'/store/'.$hash.'/cst')) > $cacheTime) ){ 
			file_put_contents(__DIR__.'/store/'.$hash.'/cst', "0");
			 ob_start("callback");	
		}else{

			echo file_get_contents(__DIR__.'/store/'.$hash.'/d');
			exit;
		}

	}
}

//put the status, to know another request updating file;
// file_put_contents(__DIR__.'/store/'.$hash.'/status', $html);


