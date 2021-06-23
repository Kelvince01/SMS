<?php
$class_id= $_GET['class_id'];
extract ($_POST);
// Insert class Details
$sql="delete from class where class_id='$class_id'";
//echo $sql;
//break;
$re=mysqli_query($con1,$sql)or die(mysqli_error($con1));


header('location: /sms/index.php?view=academics&info=deleted');

//give success message

?>