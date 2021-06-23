
	<p> <?php
	
$sql = "SELECT class_name,subject_name,teacher_name FROM class_subject_teacher,teacher,class,SUBJECT WHERE 
subject.subject_id=class_subject_teacher.subject_id AND teacher.teacher_id=class_subject_teacher.teacher_id AND class.class_id=class_subject_teacher.class_id ";
$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));


?>
 <h2>Class Subject Teacher Allocation</h2>
<table width="70%" border="0" align="center" cellpadding="1" cellspacing="1" class="entryTable">
<tr><td><a href="">New</a></td>
<td><a href="">Teacher</a></td>
<td><a href="">Class</a></td>
<td><a href="">Subject</a></td></tr>

<tr align="center" class="entryTableHeader">
<th  align="center">Subject Name</th>
<th  align="center">Class Name</th>
<th  align="center">Teacher Name</th>
<th  align="center">Details</th>
</tr>
<?php
if (mysqli_num_rows($result) > 0) {
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
<td align=""><?php echo $subject_name;?></td>
<td align="center"><?php echo $class_name;?></td>
<td align=""><?php echo $teacher_name;?> </td>
<td align="center"><a href="">Details</a></td></tr>
 <?php
}
}
else{
echo 'No Subjects for now.';
}
?>
</table>
</form>

 <p>&nbsp;</p>
</p>
			