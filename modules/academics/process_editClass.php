<?php
$class_id= $_GET['class_id'];
extract ($_POST);
// Insert class Details
$sql="update class set class_name='$cname',class_for='$class_for',class_status='$status',capacity='$capacity' where class_id='$class_id'";
//echo $sql;
//break;
$re=mysqli_query($con1,$sql)or die(mysqli_error($con1));


header('location: /sms/index.php?view=academics&info=success');

//give success message

?>