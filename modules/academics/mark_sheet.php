<td width="80%" valign="top">
<?php
extract($_POST);

$sql = "SELECT term_id,term_name from term_period where term_name='$term_name' ";
$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));
$row = mysqli_fetch_assoc($result);
$term_name2=$row['term_name'];
$_SESSION['term_name']=$term_name2;
$year_name=$_POST['year_name'];
$_SESSION['year_name']= $year_name;
extract($row);

$sql1 = "select class.class_id,class.class_name from class join gradebk on gradebk.class_id join student_marks on student_marks.gradebk_id and class_name='$class_name'";
$result1     = mysqli_query($con1,$sql1) or die(mysqli_error($con1));
$row1 = mysqli_fetch_assoc($result1);
$class_name2=$row1['class_name'];
$_SESSION['class_name']=$class_name2;
extract($row1);

?>

<p> <h2 class="title">Merit List</h2>
         <?php
			
			$sql = "SELECT SUM((cat_1+cat_2+mid_term+end_term)/4)AS total,student_marks.stud_id,adminNo,fname,mname,lname
				FROM student_marks,student_details
				WHERE student_marks.stud_id=student_details.stud_id and term_id='$term_id' and class_id='$class_id'
				GROUP BY student_marks.stud_id ORDER BY total DESC ";
				
			$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));


			?>
	
<form action="sms/modules/academics/print_markSheet.php" method="post" name="" id="">
<p>Class: <?php echo $class_name; ?>&nbsp;&nbsp;|&nbsp;&nbsp; <?php echo $term_name.' '.$year_name; ?></p>
<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" class="entryTable">
<tr align="center" class="entryTableHeader">
<th width="" >Pst</th>
<th width="" >No</th>
<th width="20%">Name</th>
<?php 
$sql = "SELECT DISTINCT(subject_name),subject.subject_id FROM subject,student_marks where student_marks.subject_id=subject.subject_id";
$result1     = mysqli_query($con1,$sql) or die(mysqli_error($con1));
?>
<?php
$subjectArray = array();
if (mysqli_num_rows($result1) > 0) {
	$i = 0;

	while($row1 = mysqli_fetch_assoc($result1)) {
		extract($row1);
		$subjectArray [] =$subject_id;
if ($i%2) {
	$class = 'row1';
} else {
	$class = 'row2';
}
$i += 1;
?>
<th width="" ><?php echo strtoupper($subject_name);?></th>
 <?php
}
}
?>
<th width="">Total</th>
<th width="">AVG</th>




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
<td width="" align="center"><?php echo $i;?></td>
<td width="" align="center"><?php echo $adminNo;?></td>
<td align="center" width="20%" ><?php echo $fname. ' '.$mname.' '.$lname;?></td>

<?php
if(sizeof($subjectArray)>0)
{
	$k = 0;
	foreach ($subjectArray as $subject_id) 
	{
		if ($k%2)
		{
			$class = 'row1';
		}
		else
		{
			$class = 'row2';
		}
		$k += 1;
		$gradeTable=gradeTable($subject_id);
		$studentProfile_=new studentProfile;
		$average=$studentProfile_->getSubjectAverage($stud_id,$subject_id,$term_id,$gradeTable);

?>
 	<td align="center"><?php echo $average;?></td>
<?php
  	}
}
?>
<td align="center"><?php echo number_format($total,0);?></td>
<td><?php $meanPoints=$studentProfile_->studMeanPoints($stud_id,$term_id); echo $meanPoints['key2'];?></td>
</tr>

 <?php
}
}

else{
	echo 'Details not found.';
}
?>

</table>
<p><div align="left"><a href="/sms/modules/academics/print_markSheet.php" target="_blank">Printable Version</a></div></p>
</form></p>
</td>

