<?php
$exam_id= $_GET['exam_id'];
extract ($_POST);
// delete class Details
$sql="delete from exams where exam_id='$exam_id'";
//echo $sql;
//break;
$re=mysqli_query($con1,$sql)or die(mysqli_error($con1));


header('location: /sms/index.php?view=academics&info=deleted');

//give success message

?>