
			<?php
			//include '/sms/connection/connect.php';
			$sql = "SELECT DISTINCT gradebk,gradebk_id,subject_name,class_name,term_name,year_name
FROM gradebk,SUBJECT,class,exams,term_period WHERE gradebk.subject_id=subject.subject_id
AND gradebk.class_id=class.class_id and term_period.active='1'";
			$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));


			?>
 <h2>Mark Books</h2>
<form action="receipts/produce_receipt.php" method="post" name="" id="">
<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" class="entryTable">
<tr><td><a href="">New</a></td></tr>
<tr align="center" class="entryTableHeader">
<th width="20%" >Mark BookID</th>
<th width="15%">Mark Book</th>
<th width="15%">Subject</th>
<th width="15%" >Class</th>
<th align="center">Term</th>


</tr>
<?php
if (mysqli_num_rows($result) > 0) {
$i = 0;

while($row = mysqli_fetch_assoc($result)) {
extract($row);
//$now=$required_manpower-$allocated;
if ($i%2) {
	$class = 'row1';
} else {
	$class = 'row2';
}
$i += 1;
?>
<tr class="<?php echo $class; ?>">
<td align="center"><?php echo $gradebk_id;?> </td>
<td align="center"><A HREF="add_marks.php?gradebk_id=<?php echo $gradebk_id; ?>"><?php echo $gradebk;?></a> </td>
<td align="center"><?php echo $subject_name;?> </td>
<td align="center"><?php echo $class_name;?> </td>
<td align="center"><?php echo $term_name.' '.$year_name;?> </td>
 <?php
}
}
else{
	echo 'No Grade Books for now.';
}
?>
</table>

 <p>&nbsp;</p>

</form></p>