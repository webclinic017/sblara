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

/*
     * This is to calculate the difference between 2 consecutive row of same object data
     *
     * If we dont take whole day data. 1st difference (last value of the obj) will be incorrect. So we have to discard this
     * For example. If we pass 35 minutes data from 1.55 PM. It will assume 1.54 data 0 (which is not true). As a result
     * It will return (all data i.e: volume -0 ). In this case we can discard 1st va;ue and start using from next
     * */

function calculateDifference($data, $field = 'total_volume') {
    // writing the new property name to add in object.
    $new_property = $field . "_difference";

    // copy total separate obj

    $data1=clone $data;
    //removing 1st element from the obj
    $data1->shift();

    $data2=$data;


    $collection = $data2->each(function ($item, $key) use($data1, $field, $new_property) {

        // checking if key exist in shifted data ($data1). It will miss last element normally

        if(isset($data1[$key])) {
            $change=$item->$field-$data1[$key]->$field;
            $item->$new_property=(float) number_format($change, 2, '.', '');
        }else
            // very 1st data (10.30) has no previous data. so we are subtracting 0
            $change=$item->$field-0;
        $item->$new_property=(float) number_format($change, 2, '.', '');


    });

    return $collection;
}