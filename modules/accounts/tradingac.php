<?php
session_start();
include('../../connection/connect.php');
// get  info to prepare statement
extract($_POST);
$date=date('Y-m-d');
$datepicker='2011-05-01';
$datepicker1='2011-05-17';
//get sales details
$sql = "SELECT sum(total_amount) AS sales FROM sales WHERE  sale_date BETWEEN '$datepicker' AND '$datepicker1'";
$result = mysqli_query($con1,$sql) or die(mysqli_error($con1));
$row2    = mysqli_fetch_assoc($result);
extract($row2);
//get purchases details
$sql = "SELECT SUM(total_amount) AS purchases FROM purchase WHERE purchase_date BETWEEN '$datepicker' AND '$datepicker1'";
$result = mysqli_query($con1,$sql) or die(mysqli_error($con1));
$row5    = mysqli_fetch_assoc($result);
extract($row5);
//get opening stock and closing stock
$sql = "SELECT SUM(open_value) AS open_stock,SUM(closing_value) AS closing_stock FROM stock_inventory ";
$result     = mysqli_query($con1,$sql);
$row6   = mysqli_fetch_assoc($result);
extract($row6);
//get discount given out
$sql = "SELECT SUM(trans_amount) AS discount FROM transaction WHERE trans_details LIKE 'Discount%' AND trans_date BETWEEN '$datepicker' AND '$datepicker1' ";
$result     = mysqli_query($con1,$sql);
$row1   = mysqli_fetch_assoc($result);
extract($row1);
//calculate profit
$cost_of_sales=$open_stock+$purchases-$closing_stock;
$profit=$sales-$cost_of_sales-$discount;
//determine whether loss or profit
if($profit<0){
$title='Gross Loss';
$profit=$profit*(-1);
}
else{
$title='Gross Profit';
//prepare statement
//log action
$date=date('Y-m-d: H:i');
$userName=$_SESSION['userName'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML Basic 1.1//EN" "http://www.w3.org/TR/xhtml-basic/xhtml-basic11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title> i-Optician:: Trading A/c Statement </title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="Keywords" content="mobile applications">
<meta name="Description" content="categories.">
<link rel="stylesheet" type="text/css" href="styles.css" media="screen" />
<link rel="stylesheet" type="text/css" href="print.css" media="print" />
<script language="Javascript">
  <!--
  function printpage() {
  window.print();
   }
  //-->
</script>
</head>
<body>
 <table width="100%" border="0" align="center" cellpadding="2">
  <tr><td align="center" id="content"><b><img src="/alpha/images/pic2.jpg"/></td></tr>
 <tr><td align="center" id="content"><b>Trading A/c Statement</td></tr>
<tr><td align="center" id="content"><b>For the Period Starting: <?php echo $datepicker?> and Ending: <?php echo $datepicker1?></td></tr>
<tr></tr>
<tr><td align="center" id="content"><b>Date/Time: </b> <?php echo date('d/m/Y h:i:s a'); ?></td></tr>
<tr></tr>
<form action="" method="post" enctype="multipart/form-data" name="frmAddclient" id="frmAddclient">

<table width="90%" border="0" align="centre" cellpadding="2">  <tr>
   <td align="center" >Opening Balance</td>
   <td align="center" ><?php echo 'Ksh '.$open_stock; ?></td></tr>

 <tr><td align="center" >Purchases</td>
   <td align="center" > <?php echo 'Ksh '.$purchases; ?></td></tr>

   <tr><td align="center" >Closing Stock</td>
   <td align="center" ><?php echo 'Ksh '.$closing_stock ?> </td>
  <tr>
   <td align="center" >Cost of Sales </td>
   <td align="center" ><?php echo 'Ksh '.$cost_of_sales; ?> </td></tr>

   <tr><td align="center" >Trade Discount</td>
   <td align="center" ><?php echo 'Ksh '.$discount; ?> </td></tr>

   <tr><td align="center" >Total Sales </td>
   <td align="center" ><?php echo 'Ksh '.$sales; ?> </td>

   <tr><td align="center" ><?php echo $title ; ?> </td>
   <td align="center" ><?php echo 'Ksh '.$profit;  ?> </td>

   <div class="line" align="center"></div></td></tr><div class="line" align="center"></div></td></tr>
   </form></table><hr width="50%" align="center" size="3" color="#000000"></hr>
	<table align="center"><tr><td height="10"></td></tr>
<tr><td align="center" id="content"><b>Report Produced By:</b> <?php echo $fullName; ?></td></tr>
<tr><td height="10"></td></tr>
<tr><td align="center" id="noprint">
		<p>
        <input name="save" type="button" id="save" value="Print" onclick="printpage();">

    </p>
	</td></tr>
</table>
</table>
</body>
</html>