<td width="100%" valign="top">
<?php
extract($_POST);
$today=date('Y-m-d');
//confirm teacher id
$query="SELECT teacher_name,tscNo, teacher_id FROM teacher WHERE teacher_name='$name'";
$result=mysqli_query($con1,$query);
$row=mysqli_fetch_array($result);
//if correct issue book else refuse
if ($tid != $row[1]){
echo "<script language=javascript>alert('Wrong ID Entered; Enter it Again!');window.location = 'teachercheck.php';</script>";
}
else{
$subject=$_POST['subject'];
$class=$_POST['class'];
$copies=$_POST['copies'];
$today=date('Y-m-d');


$query="INSERT INTO teacher_issue (teacher_id,subject,copies,author,class,date_issued,issuerer)
VALUES ('".$row[2]."','$subject','$copies','$author','$class','$today','1')";
mysqli_query($con1,$query) or die ('error updating database,check your inputs');

echo "<script language=javascript>alert('Books Issued!');window.location = '/sms/index.php?view=course_books';</script>";
}

?>
</td>






