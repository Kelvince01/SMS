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
$receipt_no='MBPS-'.$code;
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
// get school info
$sql = "SELECT * FROM school_credentials";
$result = mysqli_query($con1,$sql) or die('Cannot get Info1.');
$row1    = mysqli_fetch_assoc($result);
extract($row1);
//select user
$sql = "SELECT * FROM user where user_id='1'";
$result = mysqli_query($con1,$sql) or die('Cannot get Info1.');
$row1    = mysqli_fetch_assoc($result);
extract($row1);

//get receipt details
$sql = "SELECT * FROM fees_payment ORDER BY pay_id DESC LIMIT 1";
$result1 = mysqli_query($con1,$sql) or die('Cannot get Info2.');
$row1    = mysqli_fetch_assoc($result1);
extract($row1);
//select types of payment
//get the active term period first
$sql = "SELECT term_id,term_name,year_name FROM term_period WHERE active='1'";
$result = mysqli_query($con1,$sql) or die('Cannot get Info3.');
$row6    = mysqli_fetch_assoc($result);
extract($row6);

$sql = "SELECT * FROM fee_types WHERE period_id='$term_id'";
$result = mysqli_query($con1,$sql) or die('Cannot get Info4.');
$row7    = mysqli_fetch_assoc($result);
extract($row7);
//get receipt id
//$sql = "SELECT rctpID FROM receipts ORDER BY rctpID DESC LIMIT 1";
//$result = mysqli_query($con1,$sql) or die('Cannot get Info5.');
//$row8    = mysqli_fetch_assoc($result);
//extract($row8);
//$receiptID=$receiptID+1;
//get student details
$adminNo=$_SESSION['adminNo'];
$sql = "SELECT fname,mname,lname,class_name FROM student_details,class WHERE student_details.adminNo='$adminNo' AND student_details.class_id=class.class_id";
$result = mysqli_query($con1,$sql) or die('Cannot get Info7.');
$row12    = mysqli_fetch_assoc($result);
extract($row12);
?>



<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>mySkulMate::Academics</title>
<link rel="stylesheet" href="new_style.css" type="text/css" />
</head>

<body>

<table width="720" border="1" align="center" cellpadding="5" cellspacing="0">
  <tr>
    <td><div  class="totalhead">
      <div class="logo_box"><img src="/sms/images/logo.png" alt="logo" width="120" height="120" border="0" /></div>
      <div class="centreedge" align="center">
        <div class="schhead"><?php echo nl2br(stripslashes('NYANDARUA HIGH SCHOOL')); ?> </div>
        <div class="headother"> <?php echo nl2br(stripslashes('P.O Box 61 OL-KALOU')); ?><br /><br>
             
              <b>Student Report Card</b><br>
			  <b>Report Card No:</b><em><strong><?php echo $code; ?></strong></em><br>
			   <b><?php echo $term_name.' :'.$year_name;?></b>
            </div>
      </div>
      <div class="image_box"><img src="<?php echo $student_photoURL;?>" alt="student picture" width="120" height="120" /></div>
    </div>
        <hr  noshade="noshade"/>
		
        <!--student result data-->
        <table width="600" border="0" cellspacing="0" cellpadding="5">
          <tr>
            <td colspan="3" class="title">Name: <?php echo $fname.' '.$mname.' '.$lname;?></td>
			 <td colspan="3" class="title">Admission Number: <?php echo $adminNo; ?></td>
          </tr>
          <tr>
            <td>Gender: <strong><?php echo strtoupper($gender);?></strong></td>
            <td>Present Class: <strong><?php echo strtoupper($class_name);?></strong> </td>
            <td>&nbsp;</td>
          </tr>
        </table>
		<hr  noshade="noshade"/>
      <br />
<br>
<!--gggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggg-->
        <!--end student bio data-->
		
        <table width="720" border="1" cellspacing="0" cellpadding="5">
          <tr>
            <td width="20%"><strong>PAYMENT DATE</strong></td>
			
            <td width="50"><strong>DESCRIPTION</strong></td>
            <td width="50"><strong>AMOUNT </strong></td>
            
         </tr>
		<tr>
     		<td><?php echo date('d-m-Y');?></td>
			<td>Being Payment of School Fees</td>
			<td><?php $amount?></td>
			

</tr>
			</td></tr>
	   
	    <tr > 
		
    <td colspan="5" align="right"><b>Total Avg</b> </td>
<td align="center"><strong><?php  echo number_format($total,2); ?></strong></td>
<td align="center"><strong><?php $studentProfile_=new studentProfile; $meanPoints=$studentProfile_->studMeanPoints($stud_id,$term_id); echo $meanPoints['key2'];?></strong></td>
<td align="center"><strong><?php $studentPosition=$studentProfile_->studentPosition($term_id,$stud_id); echo $studentPosition;?>
</strong></td>
<td><strong></strong></td>
</tr> 

</table>
	   <hr  noshade="noshade"/>
        <div class="div_pad"><strong>Class Teacher's Comment:</strong></div><br><br>
		<hr  noshade="noshade"/>
      <div class="div_pad"><strong>School Principal's Comment:</strong></div><br><br>
	  
          <hr  noshade="noshade"/>
      <!--ggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggg-->
		
		
		
		        <div class="div_pad fullhead">
				<?php
$sql = "Select end_date FROM term_period where`active`='1'";
$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));
$rw = mysqli_fetch_array($result);
$sql2 = "Select min(start_date) FROM term_period where end_date >'$rw[0]' ";
$resul     = mysqli_query($con1,$sql2) or die(mysqli_error($con1));
$rwz = mysqli_fetch_array($resul);

        ?>
        <p align="left"><b>School Opens on: <?php echo $rwz[0]; ?></b></p>
				

          <div class="signbox" align="center"> <img src="/sms/images/signature.jpg" width="100" height="50" /><br />
              <hr/>
            Authorizing Signature </div>
        </div><p>&copy;   <?php echo $_SESSION['schoolname'];?> <?php echo date('Y. '); ?> :powered by mySkulMate</p></td>
  </tr>
</table>
</body>
</html>
