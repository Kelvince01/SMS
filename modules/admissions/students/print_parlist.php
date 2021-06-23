<?php
session_start();
ob_start();
include('../../../connection/connect.php');
include ('../../../common/functions.php');
$credit= new credential();
if($_SESSION['LoggedIn'] != 'True'){
		header("location:/sms/modules/security/logout.php");
		}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>MySkulMate Student List</title>	
<link rel="stylesheet" href="/sms/modules/academics/new_style.css" type="text/css">
<script src="/sms/modules/admissions/jquery/development-bundle/jquery-1.9.1.js"></script>
<script> 
$(document).ready( function printpage() {
  window.print();      });
</script>
 </head>
<body>
<table width="" border="1" cellpadding="1" cellspacing="0"  >
<tr align="center"  >

   <td > <p class="schhead"><b><?php $nam = $credit->creds(); echo $nam['key1']; ?></b></p></td>
 
 </tr>

<td width="" valign="top" align="center" >
<p style=" margin-top:5px;font-size:16px; font-weight:bold; color:#000000;">Parents List</p>

<DIV STYLE=" height: auto; 
            border-left: 1px gray solid; border-bottom: 1px gray solid; 
            padding:0px; margin: 0px">
<table width="" border="1" cellpadding="1" cellspacing="0" >

<tr align="center" class="entryTableHeader">
<th width="" >#</th>
<th width="20%">Parent Name</th>
<th >Adm No.</th>
<th width="20%" >Student Name</th>
<th width="" >Phone</th>
<th width="" >Address</th>
<th width="" >Contact</th>
<th >In Sch</th>

</tr>

<?php

$sql = "Select * FROM parent_details ORDER by parent_id ASC ";
$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));
 if (mysql_num_rows($result) > 0) {
$i = 0;

while($row = mysqli_fetch_assoc($result)) {
extract($row);
//students name & adm
$query1="SELECT fname,mname ,lname,adminNo from student_details where parent_id='$parent_id'";
$result1=mysqli_query($con1,$query1);
$row1 = mysqli_fetch_array($result1);
$pfname=$row1[0];
$pmname=$row1[1];
$plname=$row1[2];
$sadm=$row1[3];

?>
<tr class="">
<td align="center"><?php echo $parent_id;?> </td>
<td align=""><?php echo $fname. ' '.strtoupper($mname[0]).'. '.$lname;?></td>
<td align=""><?php echo $sadm;?> </td>
<td align=""><?php echo $pfname. ' '.strtoupper($pmname[0]).'. '.$plname;?> </td>
<td align=""><?php echo $phoneNo;?> </td>
<td align=""><?php echo $postalAddress;?> </td>
<td align="center"><?php echo $contact_method;?> </td>
<td align="center"><?php if($active==1){ echo 'YES';} else { echo 'NO';}?> </td>

</tr>

 <?php
 }//balz
}else{
	echo 'No Parents for now.';
}
?>
</table>
</div>
</td>
</tr>
<tr>
<td align="center"><p>&copy;  <?php $nam = $credit->creds(); echo $nam['key1']; ?> <?php echo date('Y. '); ?> :powered by mySkulMate</p></td></tr>
</table>

</table>
</body></html>