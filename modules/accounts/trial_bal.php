<?php
session_start();
include('../../connection/connect.php');
include('../../common/functions.php');
isLoggedIn();
$myterm =getActiveTerm (); //get active term
$activeterm = $myterm['key3'];
$credit= new credential();
//generate receipt no
$possible = '123456789BCDEFGHJKMNPQRSTVWXYZ';
		$code = '';
		$i = 0;
		
		while ($i < 5) { 
			$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
			$i++;
		}
$sql = "SELECT * FROM tblaccount a inner join tbltransactions t on a.id=t.account_id WHERE term_id=".$activeterm." order by t.date asc";
$result = mysqli_query($con1,$sql) or die('Cannot get Info.');

?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML Basic 1.1//EN" "http://www.w3.org/TR/xhtml-basic/xhtml-basic11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Skulsys|Trial Balance </title>
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
 <table width="70%" border="0" align="center" cellpadding="0">
 <tr><td align="center" id="content"><div style="padding:4px; background-color:#95B9C7;"><img src="/sms/school_logo.jpg" alt="logo" width="70" height="70" ></div></td></tr>
<tr><td align="center" id="content"><?php $nam = $credit->creds(); echo  nl2br(stripslashes($nam['key1']));?></td></tr>
<tr><td align="center" id="content"><b>Trial Balance As At  <?php  echo date('d M Y'); ?></td></tr>

<tr></tr>
<tr></tr>

<br>

 <tr><td><table align="center" border="1" cellspacing="0" cellpadding="0" class="entryTable" width="100%">
 <tr><p align="center">Trial Balance</p></tr>
  <tr id="content2" class="content" align="left"> 
   <th width="20%" align="center">Account Name</th>
   <th width="10%" align="center">Dr</th>
   <th width="10%" align="center">Cr</th>
   
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
	 <td class="content" width="20%" align="right"><?php echo $account_name; ?></td>
   <td class="content" width="20%" align="right"><?php if($dr!=0){ echo $dr;} else { echo '';} ?></td>
    <td class="content" width="20%" align="right"><?php  if($cr!=0){ echo $cr;} else { echo '';} ?></td> 
	 </tr>
  <?php

	} // end while
   }else {
?>
  <tr> 
   <td colspan="5" align="center">No Accounts yet</td>
  </tr>
  <?php
  
}
$sql = "SELECT sum(dr) as Total_dr FROM tbltransactions WHERE term_id=".$activeterm."";
$result = mysqli_query($con1,$sql) or die('Cannot get Info7.');
$row13    = mysqli_fetch_assoc($result);
extract($row13);
//put together important details for saving into the db
$sql = "SELECT sum(cr) as Total_cr FROM tbltransactions WHERE term_id=".$activeterm."";
$result = mysqli_query($con1,$sql) or die('Cannot get Info7.');
$row13    = mysqli_fetch_assoc($result);
extract($row13);

?>
 
<tr id="content" align="center"> 
    
   <td class="content" colspan="1" align="right"><b>Total </b></td>
 <td class="content" align="right"><?php echo $Total_dr; ?></td>
 <td class="content" align="right"><?php echo $Total_cr;  ?></td>
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