<?php
extract ($_POST);
// Insert class Details
$sql="select class_name from class where class_name='$cname'";
$re=mysqli_query($con1,$sql);
if(mysqli_num_rows($re) > 0) {
header('location: /sms/index.php?view=academics&info=duplicate');
}
else {
$query="INSERT INTO class (class_name,class_for,class_status,capacity,girls,boys)
VALUES ('$cname','$class_for','$status','$capacity','0','0')";
echo $query;
$result=mysqli_query($con1,$query) or die(mysqli_error($con1));

header('location: /sms/index.php?view=academics&info=success');
}
//give success message

?>