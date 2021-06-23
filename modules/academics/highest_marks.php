<link rel="stylesheet" href="/sms/sm_css.css" type="text/css">
<td width="80%" valign="top">
<?php
extract($_POST);
$_SESSION['term_name']=$term_name;
$_SESSION['class_name']=$class_name;
$_SESSION['year_name']=$year_name;
$sql = "SELECT term_id from term_period where term_name='$term_name' ";
$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));
$row = mysqli_fetch_assoc($result);
extract($row);

$sql = "select class.class_id from class join gradebk on gradebk.class_id join student_marks on student_marks.gradebk_id and class_name='$class_name'";
$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));
$row = mysqli_fetch_assoc($result);

extract($row);
?>

<p> <h2 class="title">Top Students Subjectwise As Per Exam Averages</h2>
<form action="" method="post" name="" id="">
<p>Class: <?php echo $class_name; ?>&nbsp;&nbsp;|&nbsp;&nbsp; <?php echo $term_name.' '.$year_name; ?></p>
<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" class="entryTable" style="white-space:nowrap;">
<tr align="center" class="entryTableHeader">
<th> Subjects</th>
<th width="">Student</th>
<th width="">Mark</th>
<th width="">Grade</th>
</tr>
<?php 
$sql = "SELECT * FROM subject ";
$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));
?>
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
<td align="center"><?php echo $subject_name;?> </td>
<?php
$subjectAnalysis_ = new subjectAnalysis();
$gradeTable=gradeTable($subject_id);
$mean_score=$subjectAnalysis_->highestScore($subject_id,$term_id,$gradeTable);
$student_name=$subjectAnalysis_->getStudentWithHigestMark($mean_score,$subject_id,$term_id,$gradeTable);
?>
<td align="center"><?php echo $student_name;?></td>
<td align="center"><?php echo $mean_score;?></td>
<td align="center"><?php $grade=$subjectAnalysis_->getGrade($mean_score,$gradeTable); echo $grade;?></td>
<?php
}
}

?>

</tr>

</table>
<p><div align="left" id ="print"><a href="/sms/modules/academics/print_highestMarks.php" target="_blank">Printable Version</a></div></p>
</form></p>
</td>

