<?php
	$school_details	=	$credit->creds();
	$gawa			=	$total_fee_paid;
	$payable		=	0;
	
	//print_r($school_details);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>mySkulMate::Receipt</title>
	<link rel="stylesheet" href="new_style.css" type="text/css" />
	<link rel="stylesheet" href="msioxstyle.css" type="text/css" />
</head>

<body onload="window.print()">
<div  class="rece-top-cont">
	<div class="rece-mid1-cont">
	<span class="head_s"><?php echo $school_details['key1']; // School Name?></span></br>
		<?php echo $school_details['key2']; // School Adress?>
		
		<!--<h3><img src="<?php echo $school_details['key4']; // School logo?>" /></h3> -->
		</br>OFFICIAL RECEIPT
	</div>
	<!--<div class="clear"><hr class="hr" /></div>-->

	<div  class="rece-mid1-cont">
		<div class="rece-mid1-left">
			<table class="rc-mid-tb">
				<tr><td><label>Date</label></td><td><?php echo date('d/m/Y h:i:s a'); ?></td></tr>
				<tr><td><label>Student</label></td><td><?php echo $fname.' '.$mname.' '.$lname; ?></td></tr>
				<tr><td><label>Class</label></td><td><?php echo strtoupper($class_name); ?></td></tr>
			</table>
		</div>
		<div class="rece-mid1-right">
		<p>Receipt No :  <?php if(!empty($receipt_no)) echo $receipt_no; 
			else echo 'reprint'?></p>
			Reg No:  <?= $adminNo; ?>
		</div>	
	</div>
	<div class="clear"</div>	
	<div class="rece-mid2-cont">
		<table class="table-fee-det">
			<thead>
				<tr><td><h4>Being Payment of</h4></td><td><h4>Total Amount (Ksh)</h4></td><td><h4>Amount Paid(Ksh)</h4></td><td><h4>Balance (Ksh)</h4></td></tr>
			</thead>
			<tbody>
				<?php 
				$lower_primary= array('Class 1','Class 2','Class 3','babyclass','preunit');
				while($row  = mysqli_fetch_assoc($resultx)): ?>
					<?php
					

					//print_r($row);

					//return;
						$balance = 0;
						$paid    = 0;
						//if new student & term he paid is this show 7540
						if($row['type']=='UNIFORM' && $admission_year == date('Y')  && $termid ==$term_id && !in_array($class_for,$lower_primary) )
							$row['amount'] +=  $uniform;
						//if new student & has never paid show 7540
						if($row['type']=='UNIFORM' && $admission_year == date('Y')  &&  $paidstudent =="never"  && !in_array($class_for,$lower_primary)){
							$row['amount'] +=  $uniform;
							
						}
						if($row['type']=='DEV.' && $termid ==$term_id)
							$row['amount'] +=  $admission;
						//if new student & has never paid show 7540
						if($row['type']=='DEV.' &&  $paidstudent =="never"){
							$row['amount']+=  $admission;
							
						}
						
						

						if($gawa >= $row['amount']){
							$paid    = $row['amount'];
							$balance = 0;
							$gawa	 = $gawa - $row['amount'];
						}
						else if($gawa > 0){
							$paid	 = $gawa;
							$balance = $row['amount'] - $gawa;
							$gawa	 = 0;
						}
						else{
							$paid	  = 0;
							$balance  = $row['amount'];
						}
						$payable = $payable + $row['amount'];
					?>
					<tr><td><label><?php echo $row['type']; ?></label></td>
						<td>Ksh. <?php echo $row['amount']; ?></td>
						<td>Ksh. <?php echo $paid; ?></td>
						<td>Ksh. <?php echo $balance; ?></td>
					</tr>
				<?php 	endwhile; ?>
			<!--	<tr>
					<td>&nbsp;</td><td colspan="3"><hr class="hr"/></td>
				</tr>-->
				<?php if(sizeof($arrPayments) > 0): ?>
					<tr>
						<td>&nbsp;</td><td><b><u>Pay date: </u></b></td><td><b><u>Amount</u></b></td>
					</tr>				
					<?php foreach($arrPayments AS $pay): ?>
						<tr>
							<td>&nbsp;</td><td><b><?php echo $pay['date']; ?></b></td><td><?php echo $pay['amt']; ?></td>
						</tr>						
					<?php endforeach; ?>
				<!--	<tr>
						<td>&nbsp;</td><td colspan="3"><hr class="hr"/></td>
					</tr>	-->				
				<?php endif; ?>
				<tr>
					<td>&nbsp;</td><td ><b><u>Payable Amount: </u></b></td><td><b><u>Total Paid: </u></b></td><td><b><u>Balance: </u></b></td>
				</tr>
				<tr>
					<td>&nbsp;</td><td>Ksh. <?php echo $payable; ?></td><td>Ksh. <?php echo $total_fee_paid; ?></td><td>Ksh. <?php  echo number_format(($payable-$total_fee_paid),2); ?> </td>
				</tr><?php
				$sql2 		= "INSERT INTO paid (stud_id,term_id) values ('$stud_id','$term_id')";


				if( $total_fee_paid >= $payable && $admission_year == date('Y') && $paidstudent=="never"){
//if fee paid greater or equal insert into paid for new students to prevent next term reflecting as not paid
 			
						$sql2 		= "INSERT INTO paid (stud_id,term_id) values ('$stud_id','$term_id')";
   					    $result2		= mysqli_query($con1,$sql2) or die('Cannot set fee paid for new student.');
    					}

					?>
				<tr>
					<td>&nbsp;</td><td colspan="3"><b>Received by: </b> <?= $_SESSION['full_name']; ?> </td>

				</tr>				
			</tbody>
		</table>	
	</div>
</div>
<p style="page-break-after:always;"></p>
</body>
</html>