<?php
	//mysql_connect("localhost","root","");
	//mysql_select_db("sbcake");
    include_once "ez_sql.php";
    
	$sqlStr="SELECT id,dse_code,total_no_securities,share_percentage_director as sponsor,share_percentage_govt as govt,share_percentage_institute as institute,share_percentage_foreign as fr,share_percentage_public as p_share FROM symbols WHERE inactive='No' AND otc_market='No' AND id!=1 ORDER BY dse_code";
	$sqlQuery=mysql_query($sqlStr);
	while($share_info=mysql_fetch_assoc($sqlQuery)){
		$dataArray[$share_info["dse_code"]]=$share_info;
		
		$sqlNav="SELECT asset_val_per_share FROM company_financial_performance WHERE symbol_id ='".$share_info["id"]."' AND asset_val_per_share!='' ORDER BY fin_year DESC";
		$navSqlQuery=mysql_query($sqlNav);
		$navInfo=mysql_fetch_row($navSqlQuery);
		
		$navValue=$navInfo[0];
		$dataArray[$share_info["dse_code"]]["nav"]=$navValue;
	}
	$sqlStr="SELECT dse_code,total,sponsor,govt,institute,f_share,public_share as p_share,nav FROM dse_codes";
	$sqlQuery=mysql_query($sqlStr);
	while($dse_share_info=mysql_fetch_assoc($sqlQuery)){
		$dseShareInfo[$dse_share_info["dse_code"]]=$dse_share_info;
	}
if(isset($_POST["reset"])){
	mysql_query("UPDATE dse_codes SET update_date='0'");
}	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Stock Bangladesh.com Share compare</title>
<link href="css/styles.css" rel="stylesheet" type="text/css">
<style>
.mismatch{
color:#FF0000;}
</style>
</head>

<body>
<form action="" method="post">
<table width="500" border="0">
  <tr>
    <td><input type="submit" name="reset" value="Reset" /></td>
    <td><a href="compare.php"><button type="button" value="Refresh">Refresh</button></a></td>
    <td><a href="dse_import.php" target="_blank"><button type="button" value="Refresh">Start Update</button></a></td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
<table id="mytable" summary="The technical oddifications of the Apple PowerMac G5 series" cellspacing="0">
<caption>&nbsp;</caption>
  <tbody><tr>
    <th width="9%" scope="col" abbr="Configurations">No#</th>
    <th width="10%" scope="col" abbr="Configurations">SCRIPT </th>
    <th width="14%" scope="col" abbr="Dual 1.8">STOCKBANGLADESH/DSE</th>
    <th width="11%" scope="col" abbr="Dual 1.8">SpoNSOR(SB/DSE)</th>
    <th width="13%" scope="col" abbr="Dual 2">GOVERNMENT(SB/DSE)</th>
    <th width="11%" scope="col" abbr="Dual 2">INSTITUTE(SB/DSE)</th>
    <th width="12%" scope="col" abbr="Dual 2">FOREIGN(SB/DSE/)</th>
	<th width="12%" scope="col" abbr="Dual 2.5">PUBLIC(SB/DSE)</th>
	<th width="8%" scope="col" abbr="Dual 2.5">Nav(SB/DSE)</th>
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
	<?php if((int)$share["total_no_securities"]!=(int)$dseShareInfo[$key]["total"]){?><span class="mismatch"><?php echo (int)$share["total_no_securities"]-(int)$dseShareInfo[$key]["total"];}?>
	<?php echo $share["total_no_securities"];?>/<?php echo $dseShareInfo[$key]["total"];?>
	<?php if(($share["total_no_securities"]-$dseShareInfo[$key]["total"])!=0){?></span><?php }?>	</td>
    <td>
	<?php if(($share["sponsor"]-$dseShareInfo[$key]["sponsor"])!=0){?><span class="mismatch"><?php }?>
	<?php echo $share["sponsor"];?>/<?php echo $dseShareInfo[$key]["sponsor"];?>
	<?php if(($share["sponsor"]-$dseShareInfo[$key]["sponsor"])!=0){?></span><?php }?></td>
    <td>
	<?php if(($share["govt"]-$dseShareInfo[$key]["govt"])!=0){?><span class="mismatch"><?php }?>
	<?php echo $share["govt"];?>/<?php echo $dseShareInfo[$key]["govt"];?>
	<?php if(($share["govt"]-$dseShareInfo[$key]["govt"])!=0){?></span><?php }?>	</td>
    <td>
	<?php if(($share["institute"]-$dseShareInfo[$key]["institute"])!=0){?><span class="mismatch"><?php }?>
	<?php echo $share["institute"];?>/<?php echo $dseShareInfo[$key]["institute"];?>
	<?php if(($share["institute"]-$dseShareInfo[$key]["institute"])!=0){?></span><?php }?>	</td>
    <td>
	<?php if(($share["fr"]-$dseShareInfo[$key]["f_share"])!=0){?><span class="mismatch"><?php }?>
	<?php echo $share["fr"];?>/<?php echo $dseShareInfo[$key]["f_share"];?>
	<?php if(($share["fr"]-$dseShareInfo[$key]["f_share"])!=0){?></span><?php }?>	</td>
    <td>
	<?php if(($share["p_share"]-$dseShareInfo[$key]["p_share"])!=0){?><span class="mismatch"><?php }?>
	<?php echo $share["p_share"];?>/<?php echo $dseShareInfo[$key]["p_share"];?>
	<?php if(($share["p_share"]-$dseShareInfo[$key]["p_share"])!=0){?></span><?php }?></td>
    <td><?php if(($share["nav"]-$dseShareInfo[$key]["nav"])!=0){?><span class="mismatch"><?php }?>
	<?php echo $share["nav"];?>/<?php echo $dseShareInfo[$key]["nav"];?>
	<?php if(($share["nav"]-$dseShareInfo[$key]["nav"])!=0){?></span><?php }?></td>
  </tr>
<?php $count++;}?>  
</tbody></table>

</body></html>