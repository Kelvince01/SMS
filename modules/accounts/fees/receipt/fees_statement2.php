<?php
session_start();
$adminNo=$_GET['adminNo'];
require_once('../../../../connection/connect.php');
require_once('../../../../common/functions.php');


//select user
$sql = "SELECT * FROM user where user_type_id='1' || user_type_id='2' || user_type_id='5'";
$result = mysqli_query($con1,$sql) or die('Cannot get Info1.');
$row1    = mysqli_fetch_assoc($result);
extract($row1);

//select types of payment
//get the active term period first
$sql = "SELECT term_id,term_name,year_name FROM term_period WHERE active='1'";
$result = mysqli_query($con1,$sql) or die('Cannot get Info3.');
$row6    = mysqli_fetch_assoc($result);
extract($row6);

$sql = "SELECT fname,mname,lname,class_name,class_for FROM student_details,class WHERE student_details.adminNo='$adminNo' AND student_details.class_id=class.class_id";
$result = mysqli_query($con1,$sql) or die('Cannot get Info7.');
$row12    = mysqli_fetch_assoc($result);
extract($row12);

//prepare receipt
$sql = "SELECT * , DATE_FORMAT( pay_date,  '%d/%m/%Y' ) AS pay_date FROM fees_payment WHERE adminNo =  '$adminNo' AND term_id =  '$term_id'
       ORDER BY pay_id DESC ";
$result = mysqli_query($con1,$sql) or die('Cannot get Info.');
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>mySkulMate::Receipt</title>
<link rel="stylesheet" href="new_style.css" type="text/css" />
</head>

<body>

<table width="820" border="1" align="center" cellpadding="5" cellspacing="0">
  <tr>
    <td>		
        <!--student result data-->
        <table width="600" border="0" cellspacing="0" cellpadding="5">
          <tr>
		   <p align="center" class="schhead"><b>Detailed Fees Statement</b></p><br>
		   <hr  noshade="noshade"/>
            <td colspan="3" class="title">Name: <?php echo $fname.' '.$mname.' '.$lname;?></td>
			 <td colspan="3" class="title">Admission Number: <?php echo $adminNo; ?></td>
          </tr>
          <tr>
            <td>Term Period: <strong><?php echo $term_name.' : '.$year_name;?></strong></td>
            <td>Present Class: <strong><?php echo strtoupper($class_name);?></strong> </td>
            <td>&nbsp;</td>
          </tr>
        </table>
		<hr  noshade="noshade"/>

<!--gggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggg-->
        <!--end student bio data-->
		
        <table width="100%" border="1" cellspacing="0" cellpadding="3">
          <tr>
            <td width="10%"><strong>Receipt Number</strong></td>
            <td width="5%"><strong>Date</strong></td>
			<td width="30%"><strong>Details</strong></td>
			<td width="50"><strong>Amount Paid</strong></td>
			<td ><strong>Payment Mode</strong></td>
			<td width="50"><strong>No</strong></td>
			<td width="50"><strong>Bank</strong></td>
			<td width="50"><strong>Received By</strong></td>
            
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
			<td><?php echo $receipt_no;?></td>
			<td><?php echo $pay_date;?></td>
			<td><?php echo 'Being Payment of School Fees';?></td>
			<td><?php echo number_format($amount,2);?></td>
			<td><?php echo $payment_mode;?></td>
			<td><?php echo $no;?></td>
			<td><?php echo $bank;?></td>
			<td><?php if(!empty($full_name)){echo $full_name;}?></td>
		    </tr>
<?php
  }
}
else{
echo 'No Payment information for now.';
}
?>
			</td></tr>
	   
	 
		<?php  
$query="SELECT SUM(amount) as total FROM fees_payment  WHERE term_id='$term_id' and adminNo='$adminNo' order by pay_id DESC LIMIT 1 ";
$row=mysqli_query($con1,$query);
$row=mysqli_fetch_assoc($row);
extract($row); 
/////
$query="SELECT SUM(amount) as total1 FROM fee_periods WHERE term_name='".$term_name."' and class_for='".$class_for."'";
$row=mysqli_query($con1,$query);
$row=mysqli_fetch_assoc($row);
extract($row);
 
?>    


</table><br>
<table width="700" border="1" cellspacing="0" cellpadding="5" align="center">
          <tr>
    <td><b>Total Paid</b> </td>
	 <td ><b>Payable Amount</b> </td>
	 <td><b>Balance</b> </td>
	 </tr>
	 <tr>
<td align="center"><strong><?php if(empty($total)){$total=0; } echo number_format($total,2); ?></strong></td>
<td align="center"><strong><?php if(empty($total1)){$total1=0; }echo number_format($total1,2); ?></strong></td>
<td align="center"><strong><?php  echo number_format(($total1-$total),2); ?></strong></td>
</tr></table><br>

	   
      <tr><td> </div>
      <p align="left"><b><b><em>For queries, please contact our financial department</em> </b></p>
          <hr  noshade="noshade"/>
      <!--ggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggg-->
		
		
		
		        <div class="div_pad fullhead">
				
				

          <div class="signbox" align="center"> <img src="/sms/images/signature.jpg" width="100" height="50" /><br />
              <hr/>
            Authorizing Signature </div>
        </div><p>&copy;  <?php $nam = $credit->creds(); echo $nam['key1']; ?> <?php echo date('Y. '); ?> :powered by mySkulMate</p></td></tr></td>
 
</table>
</body>
</html>
