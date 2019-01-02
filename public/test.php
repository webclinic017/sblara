<?php 
echo "<pre>";
print_r($_SERVER);
$headers = apache_request_headers();

foreach ($headers as $header => $value) {
    echo "$header: $value <br />\n";
}
die();
