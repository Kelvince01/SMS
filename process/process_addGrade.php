<?php
extract ($_POST);
// Insert class Details
$sql="select * from grades where grade='$grade_letter'";
$re=mysqli_query($con1,$sql);
if(mysqli_num_rows($re) > 0) {
header('location: /sms/index.php?view=academics&info=duplicate');
}
else {
$query="INSERT INTO grades (grade,max_mark,min_mark,grade_comment)
VALUES ('$grade_letter','$upper_mark','$lower_mark','$grade_comments')";
echo $query;
$result=mysqli_query($con1,$query) or die(mysqli_error($con1));

header('location: /sms/index.php?view=academics&info=success');
}
//give success message

?>