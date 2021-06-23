<?php
session_start();
include('../../../connection/connect.php');
extract($_GET);
$m=explode(' ',$student_name);
$query="SELECT stud_id FROM student_details WHERE fname='$m[0]' AND mname='$m[1]' AND lname='$m[2]' ";
$result=mysqli_query($con1,$query);
$row=mysqli_fetch_array($result);
$intials=$row[0];
$date=date('Y-m-d');

//add book to issued books
$query="INSERT INTO issued_books (issue_id,book_id,date_issued,issued_by,book_condition)
VALUES ('NULL','$book_id','$date','$user_id','$book_condition')";
mysqli_query($con1,$query) or die (mysqli_error($con1));

header("location:course_books.php?info=success&tab=issue");

?>



