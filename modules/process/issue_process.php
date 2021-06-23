<td width="100%" valign="top">
<?php
$today=date('Y-m-d');
//select book deatils
extract ($_POST);
$query="SELECT book_title,book_condition,book_no FROM books WHERE book_id='$book_id'";
$result=mysqli_query($con1,$query);
$row=mysqli_fetch_array($result);
$condition=$row[1];
$title=$row[0];
$book_no=$row[2];
//select student details
$query="SELECT stud_id,adminNo FROM student_details WHERE stud_id='$stud_id'";
$result=mysqli_query($con1,$query);
$row=mysqli_fetch_array($result);
$adminNo=$row[1];
$query="INSERT INTO issued_books (book_id,stud_id,date_issued,issued_by,book_condition)
VALUES ('$book_id','$stud_id','$today','Admin','$condition')";
mysqli_query($con1,$query) or die (mysqli_error($con1));

$query="UPDATE books SET book_status='issued' WHERE book_id='$book_id' ";
$result=mysqli_query($con1,$query);
echo "<script language=javascript>alert('Book Issued!');window.location = '/sms/index.php?view=course_books';</script>";
?>
</td>







