<td width="100%" valign="top">
<?php
extract($_POST);
//select intials to add to book number
$query="SELECT intials FROM school_credentials ";
$result=mysqli_query($con1,$query);
$row=mysqli_fetch_array($result);
$intials=$row[0];
$year=date('Y');
//$bkNo=$intials-$bkNo-$class-$year;
//select subject id
$query="SELECT subject_id FROM subject where subject_name='$subject' ";
$result=mysqli_query($con1,$query);
$row=mysqli_fetch_array($result);
$subject_id=$row[0];
//make class id

$query="INSERT INTO books (book_id,book_no,book_title,subject_id,ISBN,author,book_condition,class_id,book_status)
VALUES ('NULL','$bkNo','$bkTitle','$subject_id','$isbnNO','$author','$condtion','$class','Available')";
mysqli_query($con1,$query) or die ('error updating database,check your inputs(insert)');

$query="SELECT count FROM books_count WHERE subject_id='$subject' AND class_id='$class'";
$result=mysqli_query($con1,$query);
if (mysqli_num_rows($result) > 0) {//books already exists for this class and subject
$row=mysqli_fetch_array($result);
$count=$row[0];
$count1=$count+1;

$query="UPDATE books_count SET count='$count1' WHERE subject='$subject' AND class='$class'";
mysqli_query($con1,$query) or die ('error updating database,check your inputs(count update)');
?>
<p align="center"class='success'>Book already exists, count updated instead.</p><br>
<?php
}
else{//first entry
$query="INSERT INTO books_count (count_id,subject_id,class_id,count)
VALUES ('NULL','$subject_id','$class','1')";
mysqli_query($con1,$query) or die ('error updating database,check your inputs(insert)');
?>
<p align="center"class='success'>Book Details added successfully</p><br>
<?php
}


?>
</td>


