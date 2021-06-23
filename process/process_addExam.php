<?php
extract ($_POST);
// Insert class Details
$sql="select * from exam where exam_type='$exam_name'";
$re=mysqli_query($con1,$sql);
if(mysqli_num_rows($re) > 0) {
header('location: /sms/index.php?view=academics&info=duplicate');
}
else {
$query="INSERT INTO exams (exam_code,exam_type,total_marks)
VALUES ('$exam_name','$exam_name','$total_marks')";
echo $query;
$result=mysqli_query($con1,$query) or die(mysqli_error($con1));

header('location: /sms/index.php?view=academics&info=success');
}
//give success message

?>