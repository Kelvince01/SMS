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

<p> <h2 class="title">Analysis for <?php echo $class_name; ?>,<?php echo $term_name.' '.$year_name; ?> </h2>
<form action="" method="post" name="" id="">
<p>Class: <?php echo $class_name; ?>&nbsp;&nbsp;|&nbsp;&nbsp; <?php echo $term_name.' '.$year_name; ?></p>
<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" class="entryTable" style="white-space:nowrap;">
<tr align="center" class="entryTableHeader">
<th>Values</th>
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

?>
<th width="">T.P</th>
<th width="">STD</th>
<th width="">M.P</th>
<th width="">M.G</th>
</tr>

<tr class="<?php echo $class; ?>">
<td></td>
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
$classAnalysis = new classAnalysis();
	$grade_count=$classAnalysis->countGrade($term_id,$class_id,$grade);
	
?>
<td align="center"><?php echo $grade_count;?></td>
<?php
}
}
}
?>
<td align="center"><?php $total_points=$classAnalysis->totalPoints($term_id,$class_id); echo $total_points;?></td>
<td align="center"><?php $total_students=$classAnalysis->totalStudents($class_id); echo $total_students;?></td>
<td align="center"><?php $mean_points=$total_points/$total_students; echo number_format($mean_points,3);?></td>
<td align="center"><?php $mean_grade=$classAnalysis->getMeanGrade($mean_points); echo $mean_grade;?></td>


</tr>

</table>
<p>Key: T.P->Total Points;STD->Total Students;M.P->Mean Points;M.G->Mean Grade</p>
<p><div align="left"><a href="/sms/modules/academics/print_ClassAnalysis.php" id="print" target="_blank">Printable Version</a></div></p>
</form></p>
</td>

