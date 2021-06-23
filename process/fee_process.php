<td width="80%" valign="top">
<?php
extract($_POST);
$user_id='1';
$today=date('Y-m-d');
//generate receipt no
$possible = '123456789BCDEFGHJKMNPQRSTVWXYZ';
		$code = '';
		$i = 0;
		
		while ($i < 5) { 
			$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
			$i++;
		}
$receipt_no='NHYS-'.$code;
//record payment
$sql = "SELECT term_id,term_name,year_name FROM term_period WHERE active='1'";
$result = mysqli_query($con1,$sql) or die('Cannot get Info3.');
$row6    = mysqli_fetch_assoc($result);
extract($row6);
$query="INSERT INTO fees_payment (adminNo,amount,pay_date,payment_mode,no,user_id,bank,term_id,receipt_no)
VALUES ('$adminNo','$amount','$today','$mode','$mode_no','$user_id','$bank','$term_id','$receipt_no')";
mysqli_query($con1,$query) or die ('error updating database,check your inputs1');

//update income account
$query="INSERT INTO income (details,date_received,amount,received_by)
VALUES ('Fees paid by student of adminNo $adminNo','$today','$amount','$user_id')";
mysqli_query($con1,$query) or die ('error updating database,check your inputs2');

//Sucess Message
$_SESSION['adminNo']=$adminNo;
?>
<p align="center"class='success'>Fees processed Successfully.</p><br>

<p align="center">  
  &nbsp;&nbsp;<input name="btnCancel" type="button" id="btnCancel" value="Serve another Student" onClick="window.location.href='index.php';" class="box">  
 &nbsp;&nbsp;<input name="btnCancel" type="button" id="btnCancel" value="Edit Details" onClick="window.location.href='index.php';" class="box">  
 &nbsp;&nbsp;<input name="btnCancel" type="button" id="btnCancel" value="Cancel This Transaction" onClick="window.location.href='index.php?view=cancelsale';" class="box">
 &nbsp;&nbsp;<input name="btnCancel" type="button" id="btnCancel" value="No Receipt" onClick="window.location.href='/E-Shop/modules/receipt/index.php?view=post_receipt&receipt=NO';" class="box">  
 &nbsp;&nbsp;<input name="btnCancel" type="button" id="btnCancel" value="Issue Receipt" onClick="window.location.href='/sms/modules/accounts/fees/receipt/receipt_print.php';" class="box">  

 </td>