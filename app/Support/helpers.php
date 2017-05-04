<?php

function getWebPage($url)
{
    $options = array(
        CURLOPT_RETURNTRANSFER => true, // return web page
        CURLOPT_HEADER => false, // don't return headers
        CURLOPT_FOLLOWLOCATION => true, // follow redirects
        CURLOPT_ENCODING => "", // handle all encodings
        CURLOPT_USERAGENT => "spider", // who am i
        CURLOPT_AUTOREFERER => true, // set referer on redirect
        CURLOPT_REFERER => "http://www.dsebd.org/mkt_depth_3.php", // set referer on redirect
        CURLOPT_CONNECTTIMEOUT => 5, // timeout on connect
        CURLOPT_TIMEOUT => 6, // timeout on response
        CURLOPT_MAXREDIRS => 10, // stop after 10 redirects
        //  CURLOPT_HTTPPROXYTUNNEL  => 1,
        //  CURLOPT_PROXY          => '202.84.39.39:80'
    );


    $ch = curl_init($url);
    curl_setopt_array($ch, $options);
    $content = curl_exec($ch);
    $err = curl_errno($ch);
    $errmsg = curl_error($ch);
    $header = curl_getinfo($ch);
    curl_close($ch);

    $header['errno'] = $err;
    $header['errmsg'] = $errmsg;
    $header['content'] = $content;

    return $content; //$header;
}