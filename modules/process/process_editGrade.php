<?php
$grade_id= $_GET['grade_id'];

extract ($_POST);
// Insert class Details
$sql="update grades set grade ='$grade_letter',max_mark='$upper_mark',min_mark='$lower_mark',grade_comment='$grade_comments' where grade_id='$grade_id'";
 
//echo $sql;
//break;
$result=mysqli_query($con1,$sql) or die(mysqli_error($con1));

header('location: /sms/index.php?view=academics&info=edited');

//give success message

?>