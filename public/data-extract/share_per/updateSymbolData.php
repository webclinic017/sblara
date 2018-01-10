<?php

include_once "ez_sql.php";

$sqlStr="SELECT id,dse_code FROM symbols WHERE inactive='No' AND otc_market='No' AND id!=1 ORDER BY dse_code";
$sqlQuery=mysql_query($sqlStr);

while($share_info=mysql_fetch_assoc($sqlQuery))
    $dataArray[$share_info["dse_code"]]=$share_info;

$sqlStr="SELECT dse_code,total,sponsor,govt,institute,f_share,public_share as p_share,nav,paid_up,authorized,market_lot,last_agm,category,rserve_surplus FROM dse_codes";

$sqlQuery=mysql_query($sqlStr);
while($dse_share_info=mysql_fetch_assoc($sqlQuery))
    $dseShareInfo[$dse_share_info["dse_code"]]=$dse_share_info;


//echo "<pre>";
//print_r($dseShareInfo);

foreach($dseShareInfo as $shareName=>$shareInfo)
{

    if(isset($dataArray[$shareName]))
    {
        $updateCodeSQL  = "UPDATE `symbols` SET `category` ='".mysql_real_escape_string($shareInfo['category'])."'";
        $updateCodeSQL  .=", `reserve_and_surplus`= '".mysql_real_escape_string($shareInfo['rserve_surplus'])."'";
        $updateCodeSQL  .=", `share_percentage_director`= '".mysql_real_escape_string($shareInfo['sponsor'])."'";
        $updateCodeSQL  .=", `share_percentage_govt`= '".mysql_real_escape_string($shareInfo['govt'])."'";
        $updateCodeSQL  .=",`share_percentage_institute`='".mysql_real_escape_string($shareInfo['institute'])."' ";
        $updateCodeSQL  .=",`share_percentage_foreign`='".mysql_real_escape_string($shareInfo['f_share'])."' ";
        $updateCodeSQL  .=",`share_percentage_public`= '".mysql_real_escape_string($shareInfo['p_share'])."'";
        $updateCodeSQL  .=",`last_agm_held`= '".mysql_real_escape_string($shareInfo['last_agm'])."'";
        $updateCodeSQL  .=",`outstanding_capital`= '".mysql_real_escape_string($shareInfo['paid_up'])."'";
        $updateCodeSQL  .="WHERE `id`=".mysql_real_escape_string($dataArray[$shareName]['id']);


        echo $updateCodeSQL."<br>";
        mysql_query($updateCodeSQL) or die(mysql_error().$updateCodeSQL);


    }
}

?>