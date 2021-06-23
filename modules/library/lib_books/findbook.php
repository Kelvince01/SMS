<?php
session_start();
include('../../../connection/connect.php');

$book_no=$_REQUEST['book_no'];
$query="SELECT title FROM lib_books WHERE book_no LIKE '%$book_no%'";
$result=mysqli_query($con1,$query);

?>
<select name="book">
<option>Select Book</option>
<? while($row=mysqli_fetch_array($result)) { ?>
<option value><?=$row['title']?></option>
<? } ?>
</select>
