<?php
$cst_id= $_GET['cst_id'];

extract ($_POST);
// Insert class Details
$sql="delete from class_subject_teacher where cst_id='$cst_id'"; 
//echo $sql;
//break;
$result=mysqli_query($con1,$sql) or die(mysqli_error($con1));

header('location: /sms/index.php?view=academics&info=deleted#tabs-3');

//give success message

?>