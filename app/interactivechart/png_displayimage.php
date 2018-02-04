<?php
    	if(isset($_POST['imagedata']) && $_POST['imagedata'] != ""){
    		$imagedata = base64_decode($_POST['imagedata']);
    		header("Content-Type: image/png");
    		$date = gmdate("D, d M Y H:i:s") . " GMT";
    		header("Last-Modified: " . $date);
    		header("Expires: " . $date);
    		header("Cache-Control: max-age=0");
    		header("Content-Disposition: attachment; filename=\"fncharts_export.png\"");
    		header("Content-Length: " . strlen($imagedata)); 
    		echo $imagedata;
    	} else {
    		header("Content-Type: text/plain");
    		echo "Image not available!";
    	}
?>