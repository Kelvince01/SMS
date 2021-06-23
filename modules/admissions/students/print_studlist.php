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
<table width="100%" border="1" cellpadding="1" cellspacing="0"  >
<tr align="center"  >

   <td > <p class="schhead"><b><?php $nam = $credit->creds(); echo $nam['key1']; ?></b></p></td>
 
 </tr>

<td width="" valign="top" align="center" >
<p style=" margin-top:5px;font-size:16px; font-weight:bold; color:#000000;">Students List</p>


<?php
$lowend= -199999;
$lowend = $_GET['amt']; 
$classid= $_GET['classid'];
?>
<DIV STYLE=" height: auto; 
            border-left: 1px gray solid; border-bottom: 1px gray solid; 
            padding:0px; margin: 0px">
<table width="100%" border="1" cellpadding="1" cellspacing="0" >

<tr align="center" class="">
<th width="" >#</th>
<th width="">AdmNo</th>
<th width="">Name</th>
<th width="" >PName</th>
<th width="" >Class</th>
<th width="" >Admn Year</th>
<th width="" >Fees Balance</th>
<th width="" >In Sch</th>

</tr>

<?php
if(!empty($classid) && $classid !="All"){
$sql = "Select * FROM student_details where class_id= $classid ORDER by stud_id ASC ";
}else{
$sql = "Select * FROM student_details ORDER by stud_id ASC ";	
}
$result = mysqli_query($con1,$sql) or die(mysqli_error($con1));
if (mysqli_num_rows($result) > 0) {
$i = 0;

while($row = mysqli_fetch_assoc($result)) {
extract($row);
//parents name
$query1="SELECT fname,mname ,lname from parent_details where parent_id='$parent_id'";
$result1=mysqli_query($con1,$query1);
$row1 = mysqli_fetch_array($result1);
$pfname=$row1[0];
$pmname=$row1[1];
$plname=$row1[2];
//active term
$query="SELECT * FROM term_period  WHERE active='1'";
$row=mysqli_query($con1,$query);
$row=mysqli_fetch_assoc($row);
extract($row); 

//fee for new students -admission & uniform
  $sql    = "SELECT admission, uniform  FROM fees_newstudent WHERE period_id='$term_id'";
  $resulta   = mysqli_query($con1,$sql) or die('Cannot get Info7.');
  $rowa   = mysqli_fetch_assoc($resulta);
  if($rowa == null)
  {
    $admission =0;
    $uniform=0; 
  }
  else
  {
    extract($rowa);
  }

//class name
$query1="SELECT class_name,class_for from class where class_id='$class_id'";
$result1=mysqli_query($con1,$query1);
if (mysqli_num_rows($result1) > 0) {
$row1 = mysqli_fetch_assoc($result1);
extract($row1);
}
else
{
$class_name='NOT ALLOCATED';
}
//get new students and chek payment status
$sql2    = "SELECT term_id as termid  FROM paid WHERE stud_id='$stud_id'";
$result2   = mysqli_query($con1,$sql2) or die('Cannot get Info7.');
if (mysqli_num_rows($result2) == 0) {
    $paidstudent ="never" ;
    $termid=""; 
}else{
$row2 = mysqli_fetch_assoc($result2);
extract($row2)  ;
if($termid == $term_id) $paidstudent ="paid";
else $paidstudent ="not";

}
//get fee types
$sql3    = "SELECT tb2.type FROM fee_periods tb1 inner join fee_types tb2 on tb1.feetype_id = tb2.feetype_id WHERE term_name='".$term_name."' and class_for='".$class_for."'";
$result3   = mysqli_query($con1,$sql3) or die('Cannot get Info7.');
$typearray =array();
if (mysqli_num_rows($result3) > 0) {
while($row = mysqli_fetch_array($result3)) {
$typearray[] = $row[0];
}
}
//
$query="SELECT COALESCE( SUM( amount ) , 0 ) as total FROM fees_payment  WHERE term_id='$term_id' and adminNo='$adminNo' order by pay_id DESC LIMIT 1 ";
$row=mysqli_query($con1,$query);
$row=mysqli_fetch_assoc($row);
extract($row); 
/////
$query="SELECT COALESCE( SUM( amount ) , 0 ) as total1 FROM fee_periods WHERE term_name='".$term_name."' and class_for='".$class_for."'";
$row=mysqli_query($con1,$query);
$row=mysqli_fetch_assoc($row);
extract($row); 

$lower_primary= array('Class 1','Class 2','Class 3','babyclass','preunit');

if($admission_year == date('Y') && $paidstudent !="not" && $total1 != 0 && !in_array($class_for, $lower_primary)){
   if(sizeof($typearray>0)){
      if(in_array('UNIFORM', $typearray)) $total1 += $uniform;
      if(in_array('ADMISSION', $typearray)) $total1 += $admission;
     }
}

$balz=($total1-$total);
if ($balz>=$lowend){

?>
<tr class="">
<td align="center"><?php echo $stud_id;?> </td>
<td align=""><?php echo $adminNo;?> </td>
<td align=""><?php echo $fname. ' '.$mname.' '.$lname;?></td>
<td align=""><?php echo $pfname. ' '.$pmname.' '.$plname;?> </td>
<td align=""><?php echo $class_name;?> </td>
<td align="center"><?php echo $admission_year;?> </td>
<td align="center"><?php  echo number_format(($balz),2); ?> </td>
<td align="center"><?php if($active==1){ echo 'YES';} else { echo 'NO';}?> </td>

</tr>


 <?php
 }//balz
}
}
else{
	echo 'No Students for now.';
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