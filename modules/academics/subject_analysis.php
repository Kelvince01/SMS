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

<p> <h2 class="title">Subject Analysis for <?php echo $class_name; ?>,<?php echo $term_name.' '.$year_name; ?> </h2>
<form action="" method="post" name="" id="">
<p>Class: <?php echo $class_name; ?>&nbsp;&nbsp;|&nbsp;&nbsp; <?php echo $term_name.' '.$year_name; ?></p>
<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" class="entryTable" style="white-space:nowrap;">
<tr align="center" class="entryTableHeader">
<th> Subjects</th>
<?php 
$sql = "SELECT grade FROM grades ";
$result1     = mysqli_query($con1,$sql) or die(mysqli_error($con1));
?>
<?php
if (mysqli_num_rows($result1) > 0) {
	$i = 0;

	while($row1 = mysqli_fetch_assoc($result1)) {
		extract($row1);
if ($i%2) {
	$class = 'row1';
} else {
	$class = 'row2';
}
$i += 1;
?>
<th width="" ><?php echo $grade;?></th>
 <?php
}
}
?>
<th width="">T.P</th>
<th width="">STD</th>
<th width="">M.P</th>
<th width="">M.G</th>
<th width="">M.S</th>
<th width="">H.M</th>
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
$gradeTable=gradeTable($subject_id);
$subjectAnalysis_ = new subjectAnalysis();
$query="SELECT grade from grades";
$query_result=mysqli_query($con1,$query);
	while($row_query = mysqli_fetch_assoc($query_result)) {
		extract($row_query);
		$grade_count=$subjectAnalysis_->countGrade($subject_id,$grade,$term_id,$class_id,$gradeTable);
		$i += 1;
?>
<td align="center"><?php echo $grade_count;?></td>
<?php
}
$gradeTable='grades';
?>
<td align="center"><?php $total_points=$subjectAnalysis_->totalPoints($term_id,$subject_id,$class_id,$gradeTable); echo $total_points;?></td>
<td align="center"><?php $total_students=$subjectAnalysis_->totalStudents($class_id); echo $total_students;?></td>
<td align="center"><?php if($total_students>0){ $mean_points=number_format(($total_points/$total_students),1);
 echo $mean_points;} else { $mean_points='0.0'; echo $mean_points;}?></td>
<td align="center"><?php $mean_grade=$subjectAnalysis_->getMeanGrade($mean_points,$gradeTable); echo $mean_grade;?></td>
<td align="center"><?php $mean_score=$subjectAnalysis_->getMeanScore($subject_id,$term_id,$gradeTable); echo number_format($mean_score,3);?></td>
<td align="center"><?php $highest_mark=$subjectAnalysis_->highestScore($subject_id,$term_id,$gradeTable); echo $highest_mark;?></td>
<?php
}
}
?>

</tr>

</table>
<p>Key: T.P->Total Points;STD->Total Students;M.P->Mean Points;M.G->Mean Grade;M.S->Mean Score;H.M->Highest Mark</p>
<p><div align="left" id="print" ><a href="/sms/modules/academics/print_subjectAnalysis.php" target="_blank">Printable Version</a></div></p>
</form></p>
</td>

