<?php
session_start();
//$adminNo=$_SESSION['adminNo'];
include('../../../../connection/connect.php');

// get school info
$sql = "SELECT * FROM school_credentials";
$result = mysqli_query($con1,$sql) or die('Cannot get Info1.');
$row1    = mysqli_fetch_assoc($result);
extract($row1);


//select types of payment
//get the active term period first
$sql = "SELECT term_id,term_name,year_name FROM term_period WHERE active='1'";
$result = mysqli_query($con1,$sql) or die('Cannot get Info3.');
$row6    = mysqli_fetch_assoc($result);
extract($row6);

//prepare receipt
$sql = "SELECT *  FROM fee_types WHERE period_id =  '$term_id' ORDER BY feetype_id ";
$result = mysqli_query($con1,$sql) or die('Cannot get Info.');
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>mySkulMate::Fees Structure</title>
<link rel="stylesheet" href="new_style.css" type="text/css" />
</head>

<body>

<table width="720" border="1" align="center" cellpadding="5" cellspacing="0">
  <tr>
    <td><div  class="totalhead">
    <div class="logo_box"><img src="/sms/images/logo.png" alt="logo" width="120" height="120" border="0" /></div>
      <div class="centreedge" align="center">
	    
        <div class="schhead"><b><?php echo nl2br(stripslashes($name)); ?></b></div>
		<div class="schhead"><b><?php echo nl2br(stripslashes($address)); ?></b></div>
       
             
              <b>School Fees Structure</b><br>
			  <b>Term Period:</b> <?php echo $term_name.' : '.$year_name;?></b>
            </div>
      </div>
       </div>
        <hr  noshade="noshade"/>
		
        <br>
<!--gggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggg-->
        <!--end student bio data-->
		
        <table width="700" border="1" cellspacing="0" cellpadding="5">
          <tr>
            <td width="50%" align="center"><strong>Item</strong></td>
            <td width="50" align="center"><strong>Amount</strong></td>
            
         </tr>
		 <?php
		if (mysqli_num_rows($result) > 0) {
	$i = 0;

	while($row = mysqli_fetch_assoc($result)) {
		extract($row);
if ($i%2) {
	$class = 'row1';
} else {
	$class = 'row2';
}
$i += 1;
?>
         	<tr>
			<td align="center"><?php echo $type;?></td>
			<td align="center"><?php echo number_format($payable_amount,2);?></td>
		    </tr>
<?php
  }
}
else{
echo 'No Details for now.';
}
?>
			</td></tr>
	   
	 
		<?php  
 
/////
$query="SELECT SUM(payable_amount) as total1 FROM fee_types  WHERE period_id='$term_id'";
$row=mysqli_query($con1,$query);
$row=mysqli_fetch_assoc($row);
extract($row);
 
?>    

<td colspan="1" align="right"><b>Total Payable</b> </td>
<td align="center"><strong><?php  echo number_format($total1,2); ?></strong></td>

</table><br>

      <tr><td>  <div class="div_pad"><strong>You can pay school Fees Through:</strong></div>
      <div class="div_pad"><strong><b>MPESA: </b></strong><?php echo $MPESA_no; ?></div>
	  <div class="div_pad"><strong><b>Direct Deposit: </strong></b><?php echo $Bank_account; ?></div>
	   <div class="div_pad"><strong><b>Banker's Cheque: </strong></b> Payable to the school</div>
	  <p align="left"><b><b>NOTE: CASH PAYMENTS WILL NOT BE ACCEPTED</b></p>
          <hr  noshade="noshade"/>
      <!--ggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggg-->
		
		
		
		        <div class="div_pad fullhead">
				<p align="left"><b><b>School Fees Payable on or before 20th Jan 2011</b></p>
				

          <div class="signbox" align="center"> <img src="/sms/images/signature.jpg" width="100" height="50" /><br />
              <hr/>
            Authorizing Signature </div>
        </div><p>&copy;  NYANDARUA HIGH SCHOOL <?php echo date('Y. '); ?> :powered by mySkulMate</p></td></tr></td>
 
</table>
</body>
</html>
