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

//select leding details
$query="SELECT max_days FROM lib_lending_cost WHERE active='1'";
$result=mysqli_query($con1,$query);
$row=mysqli_fetch_array($result);
$max_days=$row[0];
//calculate date due
$duedate = strtotime ( '+'.$max_days.' day' , strtotime ( $today ) ) ;
$duedate = date ( 'Y-m-j' , $duedate );
//check if day is saturday
if(date('l', strtotime($duedate))=='Saturday'){
$duedate = strtotime ( '+2 day' , strtotime ( $duedate ) ) ;
$duedate = date ( 'Y-m-j' , $duedate );
}
//check if day is Sunday
if(date('l', strtotime($duedate))=='Sunday'){

$duedate = strtotime ( '+1 day' , strtotime ( $duedate ) ) ;
$duedate = date ( 'Y-m-j' , $duedate );
}


//record issue
$query="INSERT INTO lib_issued (adminNo,book_no,issue_date,issurer,book_condition,book_status,date_due)
VALUES ('$adminNo','$book_no','$today','$userName','$condition','issued','$duedate')";
mysqli_query($con1,$query) or die (mysqli_error($con1));

$query="UPDATE lib_books SET book_status='issued' WHERE book_no='$book_no' ";
$result=mysqli_query($con1,$query);
echo "<script language=javascript>alert('Book Issued to admission number $adminNo!');window.location = 'index.php';</script>";
?>








