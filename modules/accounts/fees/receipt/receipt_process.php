<?php
session_start();
include('../../../../connection/connect.php');
//get info
$code=$_SESSION['code'];	
$rec_id=$_SESSION['rec_id'];
$date=date('Y-m-d');
$amount=$_SESSION['amount'];
// get school info
$sql = "SELECT * FROM school_credetials";
$result = mysqli_query($con1,$sql) or die('Cannot get Info1.');
$row1    = mysqli_fetch_assoc($result);
extract($row1);
$receiptNo=$intials.'-'.$code;
//record receipt details
$query="INSERT INTO receipts (receiptNo,date_paid,fee_payment_id,amount) VALUES ('$receiptNo','$date','$rec_id','$amount')";
mysqli_query($con1,$query) or die ('error updating database');
//log action

//give message
?>
<p><br><br><br><br></p>
<p align="center"class='alert'>Receipt Book updated Successfully.</p><br>
<p align="center">  
  &nbsp;&nbsp;<input name="btnCancel" type="button" id="btnCancel" value="Serve Again" onClick="window.location.href='/E-Shop/modules/stock/';" class="box">  

 </p> 

