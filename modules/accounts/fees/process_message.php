<td width="80%" valign="top">
<?php
$processed=$_GET['processed'];
if ($processed==1){header('location: /sms/index.php?view=fees&info=processed');}
//$user_id='1';

//$_SESSION['UserID']=$User_ID;
//echo $_SESSION['UserID'];
//$_SESSION['UserID'] = $User_ID;

//echo $User_ID;

//generate receipt no
$possible = '123456789BCDEFGHJKMNPQRSTVWXYZ';
		$code = '';
		$i = 0;
		
		while ($i < 5) { 
			$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
			$i++;
		}
$receipt_no='PHS-'.$code;
//
$message_id=$_GET['message_id'];
$sql = "SELECT *  FROM mpesa_message WHERE message_id='$message_id'";
$result = mysqli_query($con1,$sql) or die(mysqli_error($con1));
$row6    = mysqli_fetch_assoc($result);
extract($row6);	
//exploade mpesa message
$strip=explode(' ',$message);

$amount=substr_replace($strip[5],' ',0,3);
$amount = preg_replace('#[^0-9]#','',strip_tags($amount));

//get student details for the student whose parent paid
$sql = "SELECT student_details.*  FROM student_details,parent_details WHERE student_details.parent_id=parent_details.parent_id
AND parent_details.mname LIKE '%$strip[7]%' AND parent_details.fname LIKE '%$strip[8]%'";

$result = mysqli_query($con1,$sql) or die(mysqli_error($con1));
$row6    = mysqli_fetch_assoc($result);
//print_r($row6);
//echo $sql;
extract($row6);	
//record payment

$today=date('Y-m-d');
$sql = "SELECT term_id,term_name,year_name FROM term_period WHERE active='1'";
$result = mysqli_query($con1,$sql) or die('Cannot get Info3.');
$row6    = mysqli_fetch_assoc($result);
extract($row6);
//record payment
$query="INSERT INTO fees_payment (adminNo,amount,pay_date,payment_mode,no,user_id,bank,term_id,receipt_no)
VALUES ('$adminNo','$amount','$today','MPESA','$strip[0]',".$_SESSION['UserID'].",'MPESA','$term_id','$receipt_no')";
mysqli_query($con1,$query) or die ('error updating database,check your inputs1');

//update income account
$query="INSERT INTO income (details,date_received,amount,received_by)
VALUES ('Fees paid by student of adminNo $adminNo','$today','$amount',".$_SESSION['UserID'].")";
mysqli_query($con1,$query) or die ('error updating database,check your inputs2');

//update message
$query="UPDATE mpesa_message SET processed='1' WHERE message_id='$message_id'";
mysqli_query($con1,$query);

?>
<p><br></p>
<p align="center"class='success'>Fees Payment By MPESA successfully Processed.</p><br>
<?php
echo 'MPESA Transaction code :'.$strip[0].'<br>';
echo 'Amount Paid :'.$strip[5].'<br>';
echo 'Sent by :'.$strip[7].' '.$strip[8].' of Mobile No:'.$strip[9].'<br>';
echo 'Student Name and Adm No: '.$fname.' '.$mname.' '.$lname.' '.$adminNo.'<br>';
$_SESSION['adminNo']=$adminNo;
?>
<p align="center">  
  &nbsp;&nbsp;<input name="btnCancel" type="button" id="btnCancel" value="Process another Transaction" onClick="window.location.href='index.php?view=fees';" class="box">  
  &nbsp;&nbsp;<input name="btnCancel" type="button" id="btnCancel" value="Cancel This Transaction" onClick="window.location.href='index.php?view=cancelsale';" class="box">
 &nbsp;&nbsp;<input name="btnCancel" type="button" id="btnCancel" value="Issue Receipt" onClick="window.location.href='/sms/modules/accounts/fees/receipt/receipt_print.php';" class="box">  

 </p> 
</td>