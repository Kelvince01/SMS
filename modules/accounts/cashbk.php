<?php
session_start();
include('../../connection/connect.php');

//get user who is logged in

//generate receipt no
$possible = '123456789BCDEFGHJKMNPQRSTVWXYZ';
		$code = '';
		$i = 0;
		
		while ($i < 5) { 
			$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
			$i++;
		}
		$date=date('m');
		$date_qu="SELECT DATE_FORMAT(LAST_DAY(DATE_SUB(CURDATE(),INTERVAL 1 MONTH)),'%d-%m-%Y')AS last_date";
		$date_re=mysqli_query($con1,$date_qu);
		$date_ro=mysqli_fetch_assoc($date_re);
		extract($date_ro);
		$query="SELECT SUM(trans_amount)AS Totaldr FROM TRANSACTION WHERE MONTH(trans_date)=MONTH( DATE_SUB(CURDATE(), INTERVAL 1 MONTH)) AND trans_type='income'";
		$reQ=mysqli_query($con1,$query);
		$rowQ=mysqli_fetch_assoc($reQ);
		extract($rowQ);
		$query="SELECT SUM(trans_amount)AS Totalcr FROM TRANSACTION WHERE MONTH(trans_date)=MONTH( DATE_SUB(CURDATE(), INTERVAL 1 MONTH)) AND trans_type='expense'";
		$reQ=mysqli_query($con1,$query);
		$rowQ=mysqli_fetch_assoc($reQ);
		extract($rowQ);
		$balance_bd=$Totaldr-$Totalcr;
$sql = "SELECT trans_id,DATE_FORMAT(trans_date,'%d-%m-%Y') AS trans_date,trans_details,account_id,trans_amount,trans_type FROM transaction  WHERE MONTH(trans_date)='$date'";
$result = mysqli_query($con1,$sql) or die('Cannot get Info.');

?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML Basic 1.1//EN" "http://www.w3.org/TR/xhtml-basic/xhtml-basic11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title> Alpha:: Cash Book </title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="Keywords" content="mobile applications">
<meta name="Description" content="categories.">
<link rel="stylesheet" type="text/css" href="styles.css" media="screen" />
<link rel="stylesheet" type="text/css" href="print.css" media="print" />
<script language="Javascript">
  <!--
  function printpage() {
  window.print();
  //window.location='receipt_process.php';
  }
  //-->
</script>
</head>
<body>
<p>&nbsp;</p>
 <table width="75%" border="0" align="center" cellpadding="0">
 <tr><td align="center" id="content"><b><img src='/alpha/images/pic2.jpg'/></td></tr>
 <tr><td align="center" id="content"><b>Cash Book for the month of  <?php echo date('M Y'); ?></td></tr>
<tr><td align="center" id="content"><b>As At  <?php  echo date('d M Y'); ?></td></tr>

<tr></tr>
<tr></tr>

<br>

 <tr><td><table align="center" border="1" cellspacing="0" cellpadding="0" class="entryTable" width="100%">
 <tr><p align="center">Cash Book</p></tr>
  <tr id="content2" class="content" align="left"> 
   <th width="20%" align="center">Date</th>
   <th width="60%" align="center">Details</th>
   <th width="10%" align="center">Dr</th>
   <th width="10%" align="center">Cr</th>
   
 </tr>
 <tr id="content" align="center"> 
   <td class="content" width="20%" align="right"><?php echo $last_date; ?></td>
   <td class="content" width="40%" align="right"><?php echo 'Balance b/d'; ?></td>
   <td class="content" width="20%" align="right"><?php  if($balance_bd>0){echo $balance_bd; } else { echo ' ';} ?></td>
    <td class="content" width="20%" align="right"><?php if($balance_bd<0){echo $balance_bd; } else { echo ' '; } ?></td>
   </tr>
  <?php
$parentId = 0;
if (mysqli_num_rows($result) > 0) {
	$i = 0;
	
	while($row = mysqli_fetch_assoc($result)) {
		extract($row);
		$i += 1;
		//get the payment
?>
  <tr id="content" align="center"> 
	 <td class="content" width="20%" align="right"><?php echo $trans_date; ?></td>
  <td class="content" width="40%" align="right"><?php echo $trans_details; ?></td>
   <td class="content" width="20%" align="right"><?php if($trans_type=='income'){ echo $trans_amount; } else { echo ' ';}?></td>
    <td class="content" width="20%" align="right"><?php if($trans_type=='expense'){ echo $trans_amount; } else { echo ' ';} ?></td> 
	 </tr>
  <?php

	} // end while
   }else {
?>
  <tr> 
   <td colspan="5" align="center">No Transactions for this month</td>
  </tr>
  <?php
  
}
$sql = "SELECT sum(trans_amount) as Total_dr FROM transaction WHERE MONTH(trans_date)='$date' AND trans_type='income'";
$result = mysqli_query($con1,$sql) or die('Cannot get Info7.');
$row13    = mysqli_fetch_assoc($result);
extract($row13);
//put together important details for saving into the db
$sql = "SELECT sum(trans_amount) as Total_cr FROM transaction WHERE MONTH(trans_date)='$date' AND trans_type='expense'";
$result = mysqli_query($con1,$sql) or die('Cannot get Info7.');
$row13    = mysqli_fetch_assoc($result);
extract($row13);
if($balance_bd<0){
$Total_cr=$Total_cr+$balance_bd;
}
else{
$Total_dr=$Total_dr+$balance_bd;
}
?>
 <tr id="content" align="center"> 
   <td class="content" align="right" colspan="2"><b>Balance c/d </b></td>
   <?php $balance=$Total_dr-$Total_cr; 
   ?>
   <td class="content" align="right"><?php if($balance<0) {echo ($balance*-1);} else { echo ' ';} ?></td>
   <td class="content" align="right"><?php if($balance>0) {echo $balance;} else { echo ' ';} ?></td>
   
  </tr>
<tr id="content" align="center"> 
    
   <td class="content" colspan="2" align="right"><b>Total </b></td>
 <td class="content" align="right"><?php if($Total_dr>$Total_cr){echo $Total_dr; } else { echo $Total_cr;}?></td>
 <td class="content" align="right"><?php if($Total_dr>$Total_cr){echo $Total_dr; } else { echo $Total_cr;} ?></td>
 </tr>  

 </table></td></tr>
 <tr> </tr>

<tr></tr>
<tr><td height="10"></td></tr>
<tr><td height="10"></td></tr>
<tr><td align="center" id="noprint">
		<p> 
        <input name="save" type="button" id="save" value="Print" onclick="printpage();">
		
    </p>
	</td></tr>
</table>


</body>
</html>