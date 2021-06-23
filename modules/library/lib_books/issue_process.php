<?php
session_start();
extract($_POST);
include('../../../connection/connect.php');

$code = explode(' ', $name);
$fname=$code[0];
$mname=$code[1];
$lname=$code[2];

$today=date('Y-m-d');
//select book deatils
$query="SELECT title,book_condition FROM book WHERE book_no='$book_no'";
$result=mysqli_query($con1,$query);
$row=mysqli_fetch_array($result);
$condition=$row[1];
$title=$row[0];

//select student details
$query="SELECT stud_id,adminNo,class_name FROM student_details,class WHERE fname='$fname' AND mname='$mname' AND lname='$lname' AND student_details.class_id=class.class_id";
$result=mysqli_query($con1,$query);
$row=mysqli_fetch_array($result);
$adminNo=$row[1];
$class=$row[2];
$query="INSERT INTO issued (adminNo,name,class,book_no,date,issurer,book_condition,book_status,subject)
VALUES ('$adminNo','$name','$class','$book_no','$today','$userName','$condition','issued','$subject')";
mysqli_query($con1,$query) or die (mysqli_error($con1));

$query="UPDATE book SET book_status='issued' WHERE book_no='$book_no' ";
$result=mysqli_query($con1,$query);
echo "<script language=javascript>alert('Book Issued to $name admission number $admNo!');window.location = 'index.php';</script>";
?>








