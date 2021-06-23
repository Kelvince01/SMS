<?php
session_start();
include('../../../connection/connect.php');

//Extract form details
extract ($_POST);
$student_name=$_POST['student_name'];
$code = explode(' ', $student_name);
$fname=$code[0];
$mname=$code[1];
$lname=$code[2];
//$class_id=$_POST['class_id'];
//select gender of student
$query="SELECT gender,stud_id FROM student_details WHERE fname='$fname' AND mname='$mname' AND lname='$lname'";
$result=mysqli_query($con1,$query);
$row1=mysqli_fetch_array($result);
$stud_id=$row1[1];

//Update student details
$query="INSERT INTO kcpe_marks (stud_id,primary_school,kcpe_index,kcpe_marks,kcpe_subjects,kcpe_year,english_marks,kiswahili_marks,maths_marks,
science_marks,socialstudies_marks) VALUES ('$stud_id','$pname','$index_no','$kcpe_marks','$kcpe_subjects','$kcpe_year','$english_mark','$kiswahili_mark',
'$maths_mark','$science_mark','$socialstudies_mark') ";
mysqli_query($con1,$query) or die ('Couldnt update student details');

//get student id first
header('location: student.php?info=success&tab=addmoreinfo');
?>
