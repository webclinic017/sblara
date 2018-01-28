<?php
	//mysql_connect("localhost","root","");
	//mysql_select_db("sbcake");
    include_once "ez_sql.php";
    
	$sqlStr="SELECT id,cse_code,total_no_securities,share_percentage_director as sponsor,share_percentage_govt as govt,share_percentage_institute as institute,share_percentage_foreign as fr,share_percentage_public as p_share,outstanding_capital as paid_up,face_value,market_lot,category,last_agm_held,reserve_and_surplus
	FROM symbols WHERE inactive='No' AND otc_market='No' AND id!=1 ORDER BY cse_code";
	$sqlQuery=mysql_query($sqlStr);


	while($share_info=mysql_fetch_assoc($sqlQuery)){
		$dataArray[$share_info["cse_code"]]=$share_info;

		//$sqlNav="SELECT asset_val_per_share FROM company_financial_performance WHERE symbol_id ='".$share_info["id"]."' AND asset_val_per_share!='' ORDER BY id DESC";
        $sqlNav="SELECT asset_val_per_share FROM company_financial_performance WHERE symbol_id ='".$share_info["id"]."' AND asset_val_per_share!='' ORDER BY fin_year DESC";

		$navSqlQuery=mysql_query($sqlNav);
		$navInfo=mysql_fetch_row($navSqlQuery);

		$navValue=$navInfo[0];
		$dataArray[$share_info["cse_code"]]["nav"]=$navValue;

        $sqlAuthorized="SELECT authorized_capital,reserve_and_surp AS reserve_and_surplus FROM company_financial_performance WHERE symbol_id ='".$share_info["id"]."' AND authorized_capital!='' ORDER BY id DESC";
        $authorizedSqlQuery=mysql_query($sqlAuthorized);
        $authInfo=mysql_fetch_row($authorizedSqlQuery);

        $authValue=$authInfo[0];
	 //$reserve=$authInfo[1];
        $dataArray[$share_info["cse_code"]]["authorized"]=$authValue;
        //$dataArray[$share_info["cse_code"]]["reserve_and_surplus"]=$reserve;

	/*$sqlAuthorized2="SELECT reserve_and_surp AS reserve_and_surplus FROM company_financial_performance WHERE symbol_id ='".$share_info["id"]."' ORDER BY id DESC";
        $authorizedSqlQuery2=mysql_query($sqlAuthorized2);
        $authInfo2=mysql_fetch_row($authorizedSqlQuery2);

	 $reserve=$authInfo2[0];
        $dataArray[$share_info["cse_code"]]["reserve_and_surplus"]=$reserve;*/

	}

    while($share_info=mysql_fetch_assoc($sqlQuery)){
            $dataArray[$share_info["cse_code"]]=$share_info;
    }
/*echo"<pre>";
print_r($dataArray);
exit;*/

	//$sqlStr="SELECT dse_code,total,sponsor,govt,institute,f_share,public_share as p_share,nav FROM dse_codes";
    $sqlStr="SELECT cse_code,total,sponsor,govt,institute,f_share,public_share as p_share,nav,paid_up,authorized,market_lot,last_agm,category,rserve_surplus
	FROM cse_codes";
	$sqlQuery=mysql_query($sqlStr);
	while($cse_share_info=mysql_fetch_assoc($sqlQuery)){
		$cseShareInfo[$cse_share_info["cse_code"]]=$cse_share_info;
	}
	
if(isset($_POST["reset"])){
	mysql_query("UPDATE cse_codes SET update_date='0'");
}	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Stock Bangladesh.com Share compare</title>
<link href="css/styles.css" rel="stylesheet" type="text/css">
<!--<script type="text/javascript" src="js/calendar.js"></script>-->

<!--<link type="text/css" href="css/Style.css" rel="stylesheet" />-->
<!--<script type="text/javascript" src="js/Script.js"></script>-->
<style>
.mismatch{
color:#FF0000;}
/*#outerDiv
   {
       position: relative;
   }
   #innerDiv
   {
       overflow: auto;
   }
   #innerDiv th
   {
       white-space: nowrap;
   }*/
</style>
</head>

<body>
<form action="" method="post">
<table width="500" border="0">
  <tr>
    <td><input type="submit" name="reset" value="Reset" /></td>
    <td><a href="compare.php"><button type="button" value="Refresh">Refresh</button></a></td>
    <td><a href="cse_import.php" target="_blank"><button type="button" value="Refresh">Start Update</button></a></td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
<div id="outerDiv">
  <div id="innerDiv">
      <table id="mytable" summary="The technical oddifications of the Apple PowerMac G5 series" cellspacing="0">
            <caption>&nbsp;</caption>
         <tbody>
          <tr>
            <th width="9%" scope="col" abbr="Configurations">No#</th>
            <th width="10%" scope="col" abbr="Configurations">SCRIPT </th>
            <th width="14%" scope="col" abbr="Dual 1.8">TOTAL(SB/CSE)</th>
            <th width="11%" scope="col" abbr="Dual 1.8">SPONSOR(SB/CSE)</th>
            <th width="13%" scope="col" abbr="Dual 2">GOVERNMENT(SB/CSE)</th>
            <th width="11%" scope="col" abbr="Dual 2">INSTITUTE(SB/CSE)</th>
            <th width="12%" scope="col" abbr="Dual 2">FOREIGN(SB/CSE/)</th>
	        <th width="12%" scope="col" abbr="Dual 2.5">PUBLIC(SB/CSE)</th>
	        <th width="12%" scope="col" abbr="Dual 2.5">Nav(SB/CSE)</th>
            <th width="12%" scope="col" abbr="Dual 2.5">Paid Up(SB/CSE)mn</th>
            <th width="12%" scope="col" abbr="Dual 2.5">Authorized(SB/CSE)mn</th>
            <th width="12%" scope="col" abbr="Dual 2.5">Mrket Lot(SB/CSE)</th>
            <th width="12%" scope="col" abbr="Dual 2.5">Category(SB/CSE)</th>
            <th width="12%" scope="col" abbr="Dual 2.5">Last AGM(SB/CSE)</th>
            <!--<th width="8%" scope="col" abbr="Dual 2.5">Facevalue(SB/DSE)</th>-->
            <!--<th width="8%" scope="col" abbr="Dual 2.5">Year End(SB/DSE)</th>-->
            <th width="12%" scope="col" abbr="Dual 2.5">Reserve &amp; Surplus</th>

          </tr>
          <?php
          $count=0;
          foreach($dataArray as $key=>$share){
          if($count%2==0)$class="odd"; else $class="even";
          ?>
          <tr>
            <th scope="row" abbr="Model" class="<?php echo $class;?>"><?php echo ++$count;?></th>
            <th scope="row" abbr="Model" class="<?php echo $class;?>"><?php echo $key;?></th>
            <td>
	        <?php if((int)$share["total_no_securities"]!=(int)$cseShareInfo[$key]["total"]){?><span class="mismatch"><?php echo (int)$share["total_no_securities"]-(int)$cseShareInfo[$key]["total"];}?>
	        <?php echo $share["total_no_securities"];?>/<?php echo $cseShareInfo[$key]["total"];?>
	        <?php if(($share["total_no_securities"]-$cseShareInfo[$key]["total"])!=0){?></span><?php }?>	</td>
            <td>
	        <?php if(($share["sponsor"]-$cseShareInfo[$key]["sponsor"])!=0){?><span class="mismatch"><?php }?>
	        <?php echo $share["sponsor"];?>/<?php echo $cseShareInfo[$key]["sponsor"];?>
	        <?php if(($share["sponsor"]-$cseShareInfo[$key]["sponsor"])!=0){?></span><?php }?></td>
            <td>
	        <?php if(($share["govt"]-$cseShareInfo[$key]["govt"])!=0){?><span class="mismatch"><?php }?>
	        <?php echo $share["govt"];?>/<?php echo $cseShareInfo[$key]["govt"];?>
	        <?php if(($share["govt"]-$cseShareInfo[$key]["govt"])!=0){?></span><?php }?>	</td>
            <td>
	        <?php if(($share["institute"]-$cseShareInfo[$key]["institute"])!=0){?><span class="mismatch"><?php }?>
	        <?php echo $share["institute"];?>/<?php echo $cseShareInfo[$key]["institute"];?>
	        <?php if(($share["institute"]-$cseShareInfo[$key]["institute"])!=0){?></span><?php }?>	</td>
            <td>
	        <?php if(($share["fr"]-$cseShareInfo[$key]["f_share"])!=0){?><span class="mismatch"><?php }?>
	        <?php echo $share["fr"];?>/<?php echo $cseShareInfo[$key]["f_share"];?>
	        <?php if(($share["fr"]-$cseShareInfo[$key]["f_share"])!=0){?></span><?php }?>	</td>
            <td>
	        <?php if(($share["p_share"]-$cseShareInfo[$key]["p_share"])!=0){?><span class="mismatch"><?php }?>
	        <?php echo $share["p_share"];?>/<?php echo $cseShareInfo[$key]["p_share"];?>
	        <?php if(($share["p_share"]-$cseShareInfo[$key]["p_share"])!=0){?></span><?php }?></td>
            <td><?php if(($share["nav"]-$cseShareInfo[$key]["nav"])!=0){?><span class="mismatch"><?php }?>
	        <?php echo $share["nav"];?>/<?php echo $cseShareInfo[$key]["nav"];?>
	        <?php if(($share["nav"]-$cseShareInfo[$key]["nav"])!=0){?></span><?php }?></td>
            
            <td><?php if(($share["paid_up"]-$cseShareInfo[$key]["paid_up"])!=0){?><span class="mismatch"><?php }?>
            <?php echo $share["paid_up"];?>/<?php echo $cseShareInfo[$key]["paid_up"];?>
            <?php if(($share["paid_up"]-$cseShareInfo[$key]["paid_up"])!=0){?></span><?php }?></td>
            
            <td><?php if(($share["authorized"]-$cseShareInfo[$key]["authorized"])!=0){?><span class="mismatch"><?php }?>
            <?php echo $share["authorized"];?>/<?php echo $cseShareInfo[$key]["authorized"];?>
            <?php if(($share["authorized"]-$cseShareInfo[$key]["authorized"])!=0){?></span><?php }?></td>
            
            <td><?php if(($share["market_lot"]-$cseShareInfo[$key]["market_lot"])!=0){?><span class="mismatch"><?php }?>
            <?php echo $share["market_lot"];?>/<?php echo $cseShareInfo[$key]["market_lot"];?>
            <?php if(($share["market_lot"]-$cseShareInfo[$key]["market_lot"])!=0){?></span><?php }?></td>
            
            <td><?php if(($share["category"]-$cseShareInfo[$key]["category"])!=0){?><span class="mismatch"><?php }?>
            <?php echo $share["category"];?>/<?php echo $cseShareInfo[$key]["category"];?>
            <?php if(($share["category"]-$cseShareInfo[$key]["category"])!=0){?></span><?php }?></td>
            
            <td><?php if(($share["last_agm_held"]-$cseShareInfo[$key]["last_agm"])!=0){?><span class="mismatch"><?php }?>
            <?php echo $share["last_agm_held"];?>/<?php echo $cseShareInfo[$key]["last_agm"];?>
            <?php if(($share["last_agm_held"]-$cseShareInfo[$key]["last_agm"])!=0){?></span><?php }?></td>

		<td><?php if(($share["reserve_and_surplus"]-$cseShareInfo[$key]["rserve_surplus"])!=0){?><span class="mismatch"><?php }?>
            <?php echo $share["reserve_and_surplus"];?>/<?php echo $cseShareInfo[$key]["rserve_surplus"];?>
            <?php if(($share["reserve_and_surplus"]-$cseShareInfo[$key]["rserve_surplus"])!=0){?></span><?php }?></td>
          </tr>
        <?php $count++;}?>  
        </tbody>
   </table>

    </div>
</div>

</body></html>