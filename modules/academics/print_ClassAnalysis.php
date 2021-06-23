<?php
session_start();
include('../../connection/connect.php');
include ('../../common/functions.php');
$term_name=$_SESSION['term_name'];
$class_name=$_SESSION['class_name'];
$year_name=$_SESSION['year_name'];
$sql = "SELECT term_id from term_period where term_name='$term_name' ";
$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));
$row = mysqli_fetch_assoc($result);
extract($row);

$sql = "select class.class_id from class join gradebk on gradebk.class_id join student_marks on student_marks.gradebk_id and class_name='$class_name'";
$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));
$row = mysqli_fetch_assoc($result);
extract($row);
?>


<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Class Analysis for <?php echo $class_name; ?>,<?php echo $term_name.' '.$year_name; ?> </title>
<link rel="stylesheet" href="new_style.css" type="text/css" />
</head>

<body>

<table width="720" border="1" align="center" cellpadding="5" cellspacing="0">
  <tr>
    <td><div align="center">
        <div class="schhead"><?php echo nl2br(stripslashes($_SESSION['schoolname'])); ?> </div>
        <div class="headother">
             
              <b><?php echo $class_name; echo $term_name.' '.$year_name; ?>
			   <b>Class Analysis</b>
            </div>
      </div>
        <hr  noshade="noshade"/>
        <table width="720" border="1" cellspacing="0" cellpadding="5" style="white-space:nowrap;">
          <tr>
		 <td>Grades</td>
          
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
<td width="" ><?php echo $grade;?></td>
 <?php
}
}
?>
		
            <td ><strong>T.P</strong></td>
            <td width=""><strong>STD</strong></td>
            <td width=""><strong>M.P</strong></td>
			<td width=""><strong>M.G</strong></td>
			
			
         </tr>
<tr>
<td>Count</td>
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
?>
<td align="center"><?php $total_points=$classAnalysis->totalPoints($term_id,$class_id); echo $total_points;?></td>
<td align="center"><?php $total_students=$classAnalysis->totalStudents($class_id); echo $total_students;?></td>
<td align="center"><?php $mean_points=$total_points/$total_students; echo number_format($mean_points,3);?></td>
<td align="center"><?php $mean_grade=$classAnalysis->getMeanGrade($mean_points); echo $mean_grade;?></td>


</tr>

		
		
		</tr>
	   


</table>
	   <hr  noshade="noshade"/>
        
      <!--ggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggg-->
		<p>Key: T.P->Total Points;STD->Total Students;M.P->Mean Points;M.G->Mean Grade;M.S->Mean Score;H.M->Highest Mark</p>
	
        </div><p>&copy;  <?php echo  $_SESSION['schoolname']; ?> <?php echo date('Y. '); ?> :powered by mySkulMate</p></td>
  </tr>
</table>
</body>
</html>
