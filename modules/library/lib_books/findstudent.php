<?php
session_start();
include('../../../connection/connect.php');

$adminNo=$_REQUEST['adminNo'];
$query="SELECT fname,mname,lname FROM student_details WHERE adminNo='$adminNo'";
$result=mysqli_query($con1,$query);

?>
<select name="student">
<option>Select Student</option>
<? while($row=mysqli_fetch_array($result)) { ?>
<option value><?=$row['fname'].' '.$row['mname'].' '.$row['lname']?></option>
<? } ?>
</select>
