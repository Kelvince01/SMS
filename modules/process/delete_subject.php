<?php
$subject_id= $_GET['subject_id'];
extract ($_POST);
// Insert class Details
$sql="delete from subject where subject_id='$subject_id'";
//echo $sql;
//break;
$re=mysqli_query($con1,$sql)or die(mysqli_error($con1));


header('location: /sms/index.php?view=academics&info=deleted');

//give success message