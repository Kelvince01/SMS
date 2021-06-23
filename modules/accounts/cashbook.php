<?php
session_start();
include('../../connection/connect.php');
include('../../common/functions.php');
isLoggedIn();
$myterm =getActiveTerm (); //get active term
$activeterm = $myterm['key3'];
$credit= new credential();

//get user who is logged in

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
<title>Skulsys|Cash Book </title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="Keywords" content="mobile applications">
<meta name="Description" content="categories.">
<link rel="stylesheet" type="text/css" href="styles.css" media="screen" />
<link rel="stylesheet" type="text/css" href="print.css" media="print" />
</head>
<body>
<p>&nbsp;</p>

 <table width="80%" border="0" align="center" cellpadding="0">
 <tr><td align="center" id="content"><div style="padding:4px; background-color:#95B9C7;"><img src="/sms/school_logo.jpg" alt="logo" width="70" height="70" ></div></td></tr>
<tr><td align="center" id="content"><b><?php $nam = $credit->creds(); echo  nl2br(stripslashes($nam['key1']));?></td></tr>
<tr><td align="center" id="content"><b>Cash Book Accounting As At  <?php  echo date('d M Y'); ?></td></tr>

<tr></tr>
<tr></tr>

<br>

 <tr><td><table align="center" border="1" cellspacing="0" cellpadding="0" class="entryTable" width="100%">
 <tr><p align="center">Cash Book</p></tr>
  <tr id="content2" class="content" align="left"> 
   <th width="10%" align="center">Date</th>
   <th width="20%" align="center">Details</th>
   <th width="10%" align="center">Cash</th>
   <th width="10%" align="center">Bank</th>
   <th width="10%" align="center">Date</th>
   <th width="20%" align="center">Details</th>
   <th width="10%" align="center">Cash</th>
   <th width="10%" align="center">Bank</th>
   
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
  <td class="content" width="10%" align="center"><?php if($dr > 0){ echo $date;} else { echo '';} ?></td>
  <td class="content" width="20%" align="center"><?php 
  if($details!=''){$details = '- '.$details;} 
  if($dr > 0){ echo $account_name .$details;}else { echo '';} ?></td>
  <td class="content" width="10%" align="center"><?php if($dr > 0 && $payment_type=='cash'){ echo $dr;} else { echo '';} ?></td>
  <td class="content" width="10%" align="center"><?php if($dr > 0 && $payment_type=='bank'){ echo $dr;} else { echo '';} ?></td>
  <td class="content" width="10%" align="center"><?php if($cr > 0){ echo $date;} else { echo '';} ?></td>
  <td class="content" width="20%" align="center"><?php if($cr > 0){ echo $account_name .$details;}else { echo '';} ?></td>
  <td class="content" width="10%" align="center"><?php if($cr > 0 && $payment_type=='cash'){ echo $cr;} else { echo '';} ?></td>
  <td class="content" width="10%" align="center"><?php if($cr > 0 && $payment_type=='bank'){ echo $cr;} else { echo '';} ?></td> 
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
$sql = "SELECT sum(dr) as cash_dr,sum(cr) as cash_cr FROM tbltransactions WHERE payment_type='cash' and term_id=".$activeterm."";
$result = mysqli_query($con1,$sql) or die('Cannot get Info7.');
$row13    = mysqli_fetch_assoc($result);
extract($row13);
//put together important details for saving into the db
$sql = "SELECT sum(dr) as bank_dr,sum(cr) as bank_cr FROM tbltransactions WHERE payment_type='bank' and term_id=".$activeterm."";
$result = mysqli_query($con1,$sql) or die('Cannot get Info7.');
$row13    = mysqli_fetch_assoc($result);
extract($row13);

?>
 
<tr id="content" align="center">     
 <td class="content" width="10%" align="center"></td>
 <td class="content" width="20%" align="center"><b><?php if($cash_dr<$cash_cr || $bank_dr<$bank_cr){echo 'Balance c/d'; }?></b></td>
 <td class="content" width="10%" align="center"><?php if($cash_dr<$cash_cr){echo $cash_cr - $cash_dr; } ?></td>
 <td class="content" width="10%" align="center"><?php if($bank_dr<$bank_cr){echo $bank_cr - $bank_dr; }?></td>
 <td class="content" width="10%" align="center"></td>
 <td class="content" width="20%" align="center"><b><?php if($cash_dr>$cash_cr || $bank_dr>$bank_cr){echo 'Balance c/d'; }?></b></td>
 <td class="content" width="10%" align="center"><?php if($cash_dr>$cash_cr){echo $cash_dr- $cash_cr; }?></td>
 <td class="content" width="10%" align="center"><?php if($bank_dr>$bank_cr){echo $bank_dr- $bank_cr; }?></td>
 </tr> 
 <tr id="content" align="center">     
 <td class="content" width="10%" align="center"></td>
 <td class="content" width="20%" align="center"></td>
 <td class="content" width="10%" align="center"><u><?php if($cash_dr<$cash_cr){echo $cash_cr;}else{echo $cash_dr;}?></u></td>
 <td class="content" width="10%" align="center"><u><?php if($bank_dr<$bank_cr){echo $bank_cr;}else{echo $bank_dr;}?></u></td>
 <td class="content" width="10%" align="center"></td>
 <td class="content" width="20%" align="center"></td>
 <td class="content" width="10%" align="center"><u><?php if($cash_dr>$cash_cr){echo $cash_dr;}else{echo $cash_cr;}?></u></td>
 <td class="content" width="10%" align="center"><u><?php if($bank_dr>$bank_cr){echo $bank_dr;}else{echo $bank_cr;}?></u></td>
 </tr> 
 <tr id="content" align="center">     
 <td class="content" width="10%" align="center"></td>
 <td class="content" width="20%" align="center"><b><?php if($cash_dr>$cash_cr || $bank_dr>$bank_cr){echo 'Balance b/d'; }?></b></td>
 <td class="content" width="10%" align="center"><?php if($cash_dr>$cash_cr){echo $cash_dr- $cash_cr; }?></td>
 <td class="content" width="10%" align="center"><?php if($bank_dr>$bank_cr){echo $bank_dr- $bank_cr; }?></td>
 <td class="content" width="10%" align="center"></td>
 <td class="content" width="20%" align="center"><b><?php if($cash_dr<$cash_cr || $bank_dr<$bank_cr){echo 'Balance b/d'; }?></b></td>
 <td class="content" width="10%" align="center"><?php if($cash_dr<$cash_cr){echo $cash_cr - $cash_dr; }?></td>
 <td class="content" width="10%" align="center"><?php if($bank_dr<$bank_cr){echo $bank_cr - $bank_dr; }?></td>
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
<script language="Javascript">
  function printpage() {
  window.print();
  }
</script>