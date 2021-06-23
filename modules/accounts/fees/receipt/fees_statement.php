<?php
session_start();
$connect 	 		 = realpath('../../../../connection/connect.php');
$functions 	 		 = realpath('../../../../common/functions.php');
$mysql_security 	 = realpath('../../../../common/mysql_security.php');

require_once($connect);
require_once($functions);
require_once($mysql_security);
unset($_SESSION['visits']);
if(!empty($_SESSION['receipt_no'])){
$receipt_no = $_SESSION['receipt_no'];
}
if(empty($_POST['adminNo'])){
$adminNo = $_SESSION['adminNo'];
}else{
$adminNo	= mysqli_entities_fix_string($_POST['adminNo']);
}
$credit		= new credential();

//select types of payment
//get the active term period first
$sql 	 = "SELECT term_id,term_name,year_name FROM term_period WHERE active='1'";
$result  = mysqli_query($con1,$sql) or die('Cannot get Info3.');
$row6    = mysqli_fetch_assoc($result);

if($row6 != null){
//var_dump($row6);
extract($row6);

//GET STUDENT INFORMATION
$sql 		= "SELECT stud_id ,fname,mname,lname,class_name,class_for,admission_year FROM student_details,class
 WHERE student_details.adminNo='$adminNo' AND student_details.class_id=class.class_id AND student_details.active=1";
$result		= mysqli_query($con1,$sql) or die('Cannot get Info7.');
$row12		= mysqli_fetch_assoc($result);

if($row12 == null){
	header('location:/sms/index.php?view=fees&info=no_record');
}
else{
	extract($row12);
	//fee for new students -admission & uniform
	$sql 		= "SELECT admission, uniform  FROM fees_newstudent WHERE period_id='$term_id'";
    $result		= mysqli_query($con1,$sql) or die('Cannot get Info7.');
    $rowa		= mysqli_fetch_assoc($result);
    if($rowa == null)
    {
	    $admission =0;
	    $uniform=0;	
    }
    else
    {
    	extract($rowa);
    }
    
	//check if newstudent paid
	$sql 		= "SELECT term_id as termid  FROM paid WHERE stud_id='$stud_id'";
    $result		= mysqli_query($con1,$sql) or die('Cannot get Info7.');
    $row7		= mysqli_fetch_assoc($result);
    if($row7 == null){
    $paidstudent ="never";
    $termid="";	
   }else{
   	extract($row7);
   	if($termid==$term_id) $paidstudent ="paid";
   	else $paidstudent ="not";	
   }
	$total_fee_paid	=	0;
	$arrPayments	=	array();
	// GET ALL STUDENT PAYMENTS FOR THAT TERM {ALL FEE IS NOT NECESARILY PAID IN ONE INSTALLMENT}
	$sql 	 = "SELECT pay_date, amount, full_name FROM fees_payment
           LEFT JOIN user ON user.user_id = fees_payment.user_id WHERE adminNo =  '$adminNo' AND term_id = '$term_id' ORDER BY pay_id DESC ";
	$result  = mysqli_query($con1,$sql) or die('Cannot get Info.');
	$ct		 = mysqli_num_rows($result);
	//$rowFee  = mysqli_fetch_assoc($result); // , SUM(amount) AS total_fee_paid
	
	if($ct > 0){
		while($row = mysqli_fetch_assoc($result)){
			$total_fee_paid = $total_fee_paid + $row['amount'];
			$array			=	array("date" => $row['pay_date'] , "amt" => $row['amount'],"receive" =>$row['full_name']);
			$arrPayments[]  =	$array;
		}
	}
	
	//not new student dont add admission fee
	if($admission_year != date('Y') || $paidstudent =="not"){
	$sql 	  = "SELECT tb1.* , tb2.amount FROM fee_types AS tb1 INNER JOIN fee_periods AS tb2 ON tb2.feetype_id = tb1.feetype_id WHERE
	 term_name = '$term_name' AND class_for = '$class_for' AND tb1.type <>'ADMISSION' ORDER BY tb1.type_priority DESC ";
			
	}else{
	// GET PAYMENT TYPES FOR THAT TERM ID
	$sql 	  = "SELECT tb1.* , tb2.amount FROM fee_types AS tb1 INNER JOIN fee_periods AS tb2 ON tb2.feetype_id = tb1.feetype_id WHERE
	 term_name = '$term_name' AND class_for = '$class_for' ORDER BY tb1.type_priority DESC ";	
	}
	$resultx  = mysqli_query($con1,$sql) or die('Cannot get Info.');
	require("disp_receipt.php");
}
}
// IF term id does not exit display error
else{
	echo '<p>An error occured while trying to process receipt';
}

?>