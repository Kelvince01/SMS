<?php
include('../../../connection/connect.php');
extract($_POST);
$today=date('Y-m-d');

$query="SELECT adminNo,book_condition FROM issued WHERE book_no='$book_no'";
$result=mysqli_query($con1,$query);
$row=mysqli_fetch_array($result);
$adminNo=$row[0];


$query="INSERT INTO returned (adminNo,book_no,date,book_condition)
VALUES ('$adminNo','$book_no','$today','$condition')";
mysqli_query($con1,$query) or die (mysqli_error($con1));

$query="UPDATE book SET book_status='Available',book_condition='$condition' WHERE book_no='$book_no' ";
$result=mysqli_query($con1,$query);

$query="UPDATE issued SET book_status='cleared' WHERE book_no='$book_no'";
$result=mysqli_query($con1,$query);

echo "<script language=javascript>alert('Book Cleared!');window.location = 'index.php';</script>";
?>








