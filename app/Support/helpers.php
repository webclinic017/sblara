<?php
function sbdd($var,$user_email)
{

    $user = Auth::user();

    if(!is_null($user))
    {
        if ($user->email == $user_email) {
            dd($var);
        }
    }

}

function sbdump($var, $user_email)
{

    $user = Auth::user();

    if (!is_null($user)) {
        if ($user->email == $user_email) {
            dump($var);
        }
    }

}


function cpOrLtp($last_trade_data_of_this_instrument)
{
    $ltp = $last_trade_data_of_this_instrument->close_price != 0 ? $last_trade_data_of_this_instrument->close_price : ($last_trade_data_of_this_instrument->pub_last_traded_price != 0 ? $last_trade_data_of_this_instrument->pub_last_traded_price : $last_trade_data_of_this_instrument->spot_last_traded_price);
    return $ltp;
}

function category($last_trade_data_of_this_instrument)
{
    $explode_arr=explode('-', $last_trade_data_of_this_instrument->quote_bases);
    $category= $explode_arr[0];
    return $category;
}

function addOrdinalNumberSuffix($num) {
    if (!in_array(($num % 100),array(11,12,13))){
        switch ($num % 10) {
            // Handle 1st, 2nd, 3rd
            case 1:  return $num.'st';
            case 2:  return $num.'nd';
            case 3:  return $num.'rd';
        }
    }
    return $num.'th';
}

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

function calculateDifference($data, $field = 'total_volume')
{
    // writing the new property name to add in object.
    $new_property = $field . "_difference";

    // copy total separate obj

    $data1 = clone $data;
    //removing 1st element from the obj
    $data1->shift();

    $data2 = $data;


    $collection = $data2->each(function ($item, $key) use ($data1, $field, $new_property) {

        // checking if key exist in shifted data ($data1). It will miss last element normally

        if (isset($data1[$key])) {
            $change = $item->$field - $data1[$key]->$field;
            $item->$new_property = (float)number_format($change, 2, '.', '');
        } else
            // very 1st data (10.30) has no previous data. so we are subtracting 0
            $change = $item->$field - 0;
        $item->$new_property = (float)number_format($change, 2, '.', '');


    });

    return $collection;
}

/*
     * This is to calculate the difference between 2 object data
     *
     * */

function growthCalculate($lastMinuteData, $prevMinuteData, $field = 'price_change', $limit = 10)
{
    // writing the new property name to add in object.
    $new_property = $field . "_growth";
    $collection = $lastMinuteData->each(function ($item, $key) use ($prevMinuteData, $field, $new_property) {

        // checking if it has traded previous minute
        if (isset($prevMinuteData[$key])) {
            $change = $item->$field - $prevMinuteData[$key]->$field;
            $item->$new_property = (float)number_format($change, 2, '.', '');
        }
    });
    $collection = $collection->sortByDesc($new_property)->take($limit);
    return $collection;
}

function growthCalculatePer($lastMinuteData, $prevMinuteData, $field = 'price_change', $limit = 10)
{
    // writing the new property name to add in object.
    $new_property = $field . "_growth_per";
    $collection = $lastMinuteData->each(function ($item, $key) use ($prevMinuteData, $field, $new_property) {

        // checking if it has traded previous minute
        if (isset($prevMinuteData[$key])) {
            $change = ($item->$field - $prevMinuteData[$key]->$field) / $prevMinuteData[$key]->$field * 100;
            $item->$new_property = (float)number_format($change, 2, '.', '');
        }

    });
    $collection = $collection->sortByDesc($new_property)->take($limit);
    return $collection;
}

function mailCss($val)
{

    /*<span style="color:red">Today's Gain **1.25%**</span>*/
    $css = ($val < 0) ? 'style="color:red"' : 'style="color:green"';

    return $css;
}
function fontCss($val)
{

    $css = ($val < 0) ? "font-red-haze" : "font-green-jungle";
    return $css;
}

function barCss($val)
{
    $css = ($val < 0) ? "red-haze" : "green-jungle";
    return $css;
}

function sparkLineBarColor($val)
{
    $css = ($val < 0) ? "#EF4836" : "#26C281";
    return $css;
}
function sparkLineLineColor($val)
{
    $css = ($val < 0) ? "#ff5656" : "#96ea96";
    return $css;
}

function sparkLineFillColor($val)
{
    $css = ($val < 0) ? "#ffaaaa" : "#96ea96";
    return $css;
}


function r_collect($array)
{
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            $value = r_collect($value);
            $array[$key] = $value;
        }
    }

    return collect($array);
}

if (!function_exists('words')) {
    /**
     * Limit the number of words in a string.
     *
     * @param  string $value
     * @param  int $words
     * @param  string $end
     * @return string
     */
    function words($value, $words = 100, $end = '...')
    {
        return \Illuminate\Support\Str::words($value, $words, $end);
    }
}
/*se functions*/
function yearsAsOption($start = 1994)
{
    $html = "";
    $startYear = $start;
    $endYear = date('Y');
    while ($endYear >= $startYear) {
        $html .= "<option value=".$endYear.">".$endYear."</option>";
        $endYear--;
    }
    return $html;
}

function uploader($name, $type = 'file')
{
    return view('partials.file-uploader')->with(compact('name', 'type'));
}

function fileUploader($name = 'file')
{
    return uploader($name);
}
function imageUploader($name = 'image')
{
    return uploader($name, 'image');
}   

 function user()
{
    return Auth::user();
}
/*se functions*/

function rutime($ru, $rus, $index)
{
    return ($ru["ru_$index.tv_sec"] * 1000 + intval($ru["ru_$index.tv_usec"] / 1000))
    - ($rus["ru_$index.tv_sec"] * 1000 + intval($rus["ru_$index.tv_usec"] / 1000));
}