<td width="80%" valign="top">
<?php
extract($_POST);
$user_id= $_SESSION['UserID'];
 if (!isset($_SESSION["visits"])) 
        $_SESSION["visits"] = 0;
    $_SESSION["visits"] = $_SESSION["visits"] + 1;


if ($_SESSION["visits"] > 1){
//pageWasRefreshed dont run queries again
header("Location:/sms/modules/accounts/fees/receipt/fees_statement.php");
  
} else {   //run query
   $today=date('Y-m-d');
//generate receipt no
$possible = '123456789BCDEFGHJKMNPQRSTVWXYZ';
		$code = '';
		$i = 0;
		
		while ($i < 5) { 
			$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
			$i++;
		}
$receipt_no=$_SESSION['initials'].'-'.$code;
//
$sql = "SELECT class_id FROM student_details WHERE adminNo='$adminNo' Limit 1";
$result = mysqli_query($con1,$sql) or die('Cannot get Info3.');
$row1    = mysqli_fetch_assoc($result);

extract($row1);
//active term
$sql = "SELECT term_id,term_name,year_name FROM term_period WHERE active='1'";
$result = mysqli_query($con1,$sql) or die('Cannot get Info3.');
$row6    = mysqli_fetch_assoc($result);
extract($row6);

if ($adminNo != "" && $amount > 0){

$query="INSERT INTO fees_payment (adminNo,amount,pay_date,payment_mode,no,user_id,bank,term_id,receipt_no)
VALUES ('$adminNo','$amount','$today','$mode','$mode_no','$user_id','$bank','$term_id','$receipt_no')";

mysqli_query($con1,$query) or die ('error updating database,check your inputs1');

//update income account
$query="INSERT INTO income (details,date_received,amount,received_by)
VALUES ('Fees paid by student of adminNo $adminNo','$today','$amount','$user_id')";
mysqli_query($con1,$query) or die ('error updating database,check your inputs2');

//Sucess use in receipt page
$_SESSION['adminNo']=$adminNo;
$_SESSION['receipt_no']=$receipt_no;
header("Location:/sms/modules/accounts/fees/receipt/fees_statement.php");
}else{?>
<p align='center'class='alert'><?php echo 'Cannnot process fee without admission number'; ?></p>
<?php } ?>
 </td>
  
<?php   
} ?>




