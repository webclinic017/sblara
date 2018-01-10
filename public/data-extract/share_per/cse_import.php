<?php
//mysql_connect("localhost","root","");
//mysql_select_db("sbcake");
ob_start();
include_once "ez_sql.php";

$sqlStr="SELECT dse_code FROM symbols WHERE otc_market='no' AND inactive='No' ORDER BY dse_code";
$sqlQuery=mysql_query($sqlStr);

while($data=mysql_fetch_assoc($sqlQuery)){
	$selSql="SELECT cse_code FROM cse_codes WHERE cse_code LIKE '%".$data["dse_code"]."%' ORDER BY cse_code";
	$sqlInfo=mysql_fetch_row(mysql_query($selSql));
	
	if(!isset($sqlInfo[0])){
		$insStr="INSERT INTO cse_codes (cse_code,update_date) VALUES('".$data["dse_code"]."','0')";
		mysql_query($insStr);
	}
	$dataArray[]=$data["dse_code"];
}

$counter=0;
$date=date("Y-m-d");
$sqlStr="SELECT id,cse_code FROM cse_codes WHERE (update_date ='0' OR update_date !='$date') LIMIT 1";
$sqlQuery=mysql_query($sqlStr);

$itemInfo=mysql_fetch_assoc($sqlQuery);


if(isset($itemInfo["id"])) {
	$item = $itemInfo["cse_code"];



	$url = "http://www.cse.com.bd/companyDetails.php?scriptCode=".$item;    //;
	$fp = fopen($url, 'r');
	$content = "";
	while (!feof($fp)) {
		$buffer = trim(fgets($fp, 4096));
		$content .= $buffer;
	}
//print_r($content);
	preg_match("/Current Market Information(.*)Last updated on/", $content, $nav);
	//print_r($nav);
/*
preg_match( '/Contact Information and Basic Information(As Per Last Audited Accounts)(.*)Remarks/', $nav[0], $nav0 );
require_once('class_http.php');
print_r($nav0);
exit;
$tableData = http::table_into_array($nav0[1], '', 1, null);


echo "<pre>";
print_r($tableData);
echo "<pre>";*/

/*
    for($i=0;$i<count($tableData);$i++){
        $sub_str=trim(str_replace("&nbsp;","",$tableData[$i][5]));
        if($sub_str && $sub_str!="n/a")
            $nav_value[]=(float)$tableData[$i][5];
    }

//print_r($nav_value);


    $item_nav=$nav_value[count($nav_value)-1];
    if($item_nav==NULL)$item_nav=0;
*/
	//print_r($content);
	preg_match( "/Net Asset(.*)First Trade Date /", $content, $item_nav );


	preg_match( "/Total no. of Securities(.*)52 Week's Range/", $content, $total );

    preg_match( "/Paid-up Capital in BDT(.*)Business Segment/", $content, $paid_up);
    preg_match( "/Authorized Capital in BDT(.*)Total no. of Securities/", $content, $auth_capital);
    preg_match( "/Market Lot(.*)Face Value/", $content, $market_lot );
    preg_match( "/Market Category(.*)Authorized Capital in BDT/", $content, $category);
    preg_match( "/Year End(.*)Reserve/", $content, $year_end);
    preg_match( "/AGM Date(.*)Record Date/", $content, $last_agm);
    preg_match( "/Surplus\(mn\)(.*)Remarks/",$content,$rserve_surplus);



	preg_match( "/Share Holding Percentage(.*)Last updated on/", $content, $match );
    $subject = $match[0];
	preg_match( '/<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="80%">(.*)<\/table>/', $subject, $nav);
	require_once('class_http.php');

	$matches = http::table_into_array($nav[1], '', 1, null);


    $paid_up = str_replace('in BDT* (mn)','',$paid_up[1]);
    //print_r($paid_up);
    $paid_up = str_replace(',','',$paid_up);
    $paid_up = (float)strip_tags($paid_up);

    //print_r($paid_up);
    //die();*/
    $auth_capital = str_replace('* (mn)','',$auth_capital[1]);
    $auth_capital = str_replace(',','',$auth_capital);
    $auth_capital = (float)strip_tags($auth_capital);

    $market_lot = (int)strip_tags($market_lot[1]);
    $category = strip_tags(rtrim(ltrim($category[1])));
    //$category = str_replace('&nbsp;','',$category);
    //$year_end = ltrim(rtrim($year_end[1]));
    $last_agm = trim(strip_tags(str_replace(':','',$last_agm[1])));
    if ($last_agm=='')
    $last_agm = 0;

    $total[1] = str_replace(",", "", $total[1]);

    $total_securities=(int)strip_tags($total[1]);

    $sponsor_share=(float)strip_tags($matches[1][0]);
    $govt_share=(float)strip_tags($matches[1][1]);
    $institute_share=(float)strip_tags($matches[1][2]);
    $f_share=(float)strip_tags($matches[1][3]);
    $public_share=(float)strip_tags($matches[1][4]);
    $netAsset=(float)strip_tags($item_nav[1]);

    $rserve_surplus = str_replace('Surplus(mn)</td><td height="40">','',$rserve_surplus[1]);
    $rserve_surplus = str_replace('</td><td height="40">','',$rserve_surplus);
    $rserve_surplus = str_replace('</td></tr><tr bgcolor="#FFFFFF"><td>&nbsp;</td><td>&nbsp;</td></tr></table></td></tr><tr><td colspan="3" valign="top"><table width="100%"  border="0" cellspacing="2" cellpadding="0"><tr bgcolor="#F1F1F1" height="30"><td width="14%" valign="top">','',$rserve_surplus);
    // rserve_surplus = '$rserve_surplus[1]'

/*
    echo "<pre>";
    print_r($rserve_surplus);
    die();*/


    echo $sqlStr="UPDATE cse_codes
            SET
            total=$total_securities,
            sponsor=$sponsor_share,
            govt=$govt_share,
            institute=$institute_share,
            public_share=$public_share,
            f_share=$f_share ,
            nav=$netAsset,
            update_date ='$date',
            paid_up = $paid_up,
            authorized = $auth_capital,
            market_lot = $market_lot,
            category =  '$category',
            last_agm = '$last_agm',
            paid_up =  '$paid_up',
            rserve_surplus='$rserve_surplus'
            WHERE cse_code ='".$item."'";
    //WHERE cse_code ='1JANATAMF'";

   mysql_query($sqlStr)or die(mysql_error());

   // echo count($dataArray);
        for($i=0;$i<count($dataArray);$i++){
            header("Refresh: .6; url=cse_import.php");
        }
    }
    else{
    echo "All done";
    }



?>