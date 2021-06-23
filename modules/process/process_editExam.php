<?php
$exam_id= $_GET['exam_id'];

extract ($_POST);
// Insert class Details
$sql="update exams set exam_code ='$exam_name',exam_type='$exam_name',total_marks='$total_marks' where exam_id='$exam_id'";
 
//echo $sql;
//break;
$result=mysqli_query($con1,$sql) or die(mysqli_error($con1));

header('location: /sms/index.php?view=academics&info=edited');

//give success message

?>