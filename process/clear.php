<td width="100%" valign="top">
<?php
extract($_POST);
$today=date('Y-m-d');

$query="SELECT stud_id,book_condition FROM issued_books WHERE book_id='$book_id'";
$result=mysqli_query($con1,$query);
$row=mysqli_fetch_array($result);
$stud_id=$row[0];


$query="INSERT INTO returned (stud_id,book_id,date,book_condition)
VALUES ('$stud_id','$book_id','$today','$condition')";
mysqli_query($con1,$query) or die (mysqli_error($con1));

$query="UPDATE books SET book_status='Available',book_condition='$condition' WHERE book_id='$book_id' ";
$result=mysqli_query($con1,$query)or die (mysqli_error($con1));



echo "<script language=javascript>alert('Book Cleared!');window.location = '/sms/index.php?view=course_books';</script>";
?>
</td>







