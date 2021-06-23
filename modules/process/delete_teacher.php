<?php
$teacher_id=$_GET['teacher_id'];
// Insert class Details
$sql="delete from teacher where teacher_id='$teacher_id'";
//echo $sql;
//break;
$re=mysqli_query($con1,$sql)or die(mysqli_error($con1));


header('location: /sms/index.php?view=teacher&info=deleted');

//give success message

?>