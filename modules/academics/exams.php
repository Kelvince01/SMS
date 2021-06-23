<?php
	
$sql = "Select * FROM exams ORDER by exam_id ASC ";
$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));


?>
 <h2>Available Exam Groups</h2>
<table width="70%" border="0" align="center" cellpadding="1" cellspacing="1" class="entryTable">
<tr><td><a href="">New</a></td></tr>
<tr align="center" class="entryTableHeader">
<th  align="center" >Exam ID</th>
<th  align="center">Exam Name</th>
<th  align="center">Total Marks</th>
<th  align="center"></th>
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
<td align="center"><?php echo $exam_id;?> </td>
<td align="center"><?php echo $exam_type;?></td>
<td align="center"><?php echo $total_marks;?></td>
<td align="center"><a href="">Details</a></td></tr>
 <?php
}
}
else{
echo 'No exams for now.';
}
?>
</table>
</form>