<?php
extract ($_POST);
// Insert class Details
$sql="select * from class_subject_teacher where teacher_id='$teacher_id' and subject_id='$subject_id' and class_id='$class_id'";
$re=mysqli_query($con1,$sql);
if(mysqli_num_rows($re) > 0) {
header('location: /sms/index.php?view=academics&info=duplicate');
}
else {
$query="INSERT INTO class_subject_teacher (class_id,teacher_id,subject_id)
VALUES ('$class_id','$teacher_id','$subject_id')";
echo $query;
$result=mysqli_query($con1,$query) or die(mysqli_error($con1));

header('location: /sms/index.php?view=academics&info=success');
}
//give success message

?>