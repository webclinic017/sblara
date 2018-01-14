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
    while ($endYear > $startYear) {
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
/*se functions*/