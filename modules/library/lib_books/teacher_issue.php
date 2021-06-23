<?php
session_start();
include('../../../connection/connect.php');
extract($_POST);
$today=date('Y-m-d');
//confirm teacher id
$query="SELECT name,teachID FROM teacher WHERE name='$name'";
$result=mysqli_query($con1,$query);
$row=mysqli_fetch_array($result);
//if correct issue book else refuse
if ($tid != $row[1]){
echo "<script language=javascript>alert('Wrong ID Entered; Enter it Again!');window.location = 'teachercheck.php';</script>";
}
else{
$query="UPDATE teacher SET last_date_used='$today'";
mysqli_query($con1,$query) or die ('error updating database,check your inputs');

$subject=$_POST['subject'];
$class=$_POST['class'];
$copies=$_POST['copies'];
$today=date('Y-m-d');


$query="INSERT INTO teacher_issue (name,date,subject,class,copies,author)
VALUES ('$name','$today','$subject','$class','$copies','$author')";
mysqli_query($con1,$query) or die ('error updating database,check your inputs');

echo "<script language=javascript>alert('Books Issued!');window.location = 'index.php';</script>";
}

?>








