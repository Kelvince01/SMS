<?php
extract ($_POST);
// Insert class Details
$sql="select subject_name from subject where subject_name='$subject_name'";
$re=mysqli_query($con1,$sql);
if(mysqli_num_rows($re) > 0) {
header('location: /sms/index.php?view=academics&info=duplicate');
}
else {
$query="INSERT INTO subject (subject_name,group_id,department_id,code_id)
VALUES ('$subject_name','$group','$department','$knec_code')";
echo $query;
$result=mysqli_query($con1,$query) or die(mysqli_error($con1));

header('location: /sms/index.php?view=academics&info=success');
}
//give success message

?>