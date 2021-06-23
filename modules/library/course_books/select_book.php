<td width="100%" valign="top">
<form action="/sms/index.php?view=issue_process" method="post" name="frmAddBk" id="frmAddBk">
<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" class="entryTable">
<tr align="center" class="entryTableHeader">
<th width="30%" >Book No</th>
<th width="35%">Book Title</th>
<th width="15%">ISBN</th>
<th width="15%" >Author</th>
<th width="5%" >Book Condition</th>
<th width="5%" >Select</th>
</tr>
<?php

extract($_POST);
echo $subject.' Books';
$query="SELECT books.* FROM books,class,subject Where class.class_id=books.class_id AND subject.subject_id=books.subject_id AND class.class_id='$class_id' and subject_name='$subject' and book_status ='Available'";
$result=mysqli_query($con1,$query) or die (mysqli_error($con1));
if (mysql_num_rows($result) > 0) {
$i = 0;

while($row = mysqli_fetch_assoc($result)) {
extract($row);
if ($i%2) {
	$class = 'row1';
} else {
	$class = 'row2';
}
$i += 1;
?>
<tr class="<?php echo $class; ?>">
<td align="center"><?php echo $book_no;?> </td>
<td align="center"><?php echo $book_title;?> </td>
<td align="center"><?php echo $ISBN;?> </td>
<td align="center"><?php echo $author;?> </td>
<td align="center"><?php echo $book_condition;?> </td>
<td align="center"><input type="radio" name="book_id" value="<?php echo $book_id;?>"></td></tr>

<?php
}
?>
<tr><td align="center">Select Student</td>
<td><select name="stud_id" class="box" id="stud_id">
         <?php
	$query1="SELECT stud_id, fname, mname, lname
FROM student_details, class
WHERE class.class_id = student_details.class_id
AND student_details.class_id =  '$class_id'";
	$result1=mysqli_query($con1,$query1);
	while($nt=mysqli_fetch_array($result1)){//Array or records stored in $nt
					echo "<option value=$nt[stud_id]>$nt[fname] $nt[mname] $nt[lname]</option>";
					/* Option values are added by looping through the array */
				}
	?>
</select>
</td>

</tr>
     <tr>
      	<td colspan="3"><div align="center">
            <input type="submit" value="Issue" >
			<input type="Reset" value="Cancel">
			</div></td>
    </tr>

<?php
}
else{
	echo 'No Books matching class and subject choosen for now.';
}
?>

</table>

</form>
</td>
