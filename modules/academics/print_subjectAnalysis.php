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
<title>Subject Analysis for <?php echo $class_name; ?> , <?php echo $term_name.' '.$year_name; ?> </title>
<link rel="stylesheet" href="new_style.css" type="text/css" />
</head>

<body>

<table width="720" border="1" align="center" cellpadding="5" cellspacing="0">
  <tr>
    <td>	  
      <div align="center" class="headother">
        <div><?php echo nl2br(stripslashes($_SESSION['schoolname'])); ?> </div>
        <div >
             
              <b><?php echo $class_name. ' , ' .$term_name.' '.$year_name; ?>
			   <b>Subject Analysis</b>
            </div>
      </div>
	   
        <hr  noshade="noshade"/>
        <table width="720" border="1" cellspacing="0" cellpadding="5" style="white-space:nowrap;">
          <tr>
		  <td width=""><strong>#</strong></td>
          <td width="" style="white-space:nowrap;" ><strong>SUBJECTS</strong></td>
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
			<td width=""><strong>M.S</strong></td>
			<td width=""><strong>H.M</strong></td>
			
         </tr>
	
		<?php 
$sql = "SELECT (sum((cat_1+cat_2+mid_term+end_term)/2 ))/count(stud_id) AS mean_score,subject_name,subject.subject_id,class_id
FROM student_marks,SUBJECT,gradebk WHERE student_marks.term_id='$term_id' and 
subject.subject_id=student_marks.subject_id and student_marks.gradebk_id=gradebk.gradebk_id and gradebk.class_id='$class_id'
 group by student_marks.subject_id order by mean_score DESC";
$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));
?>
<?php
if (mysqli_num_rows($result) > 0) {
	$i = 0;
     $j=0;
	while($row = mysqli_fetch_assoc($result)) {
		extract($row);
if ($i%2) {
	$class = 'row1';
} else {
	$class = 'row2';
}
$i += 1;
$j++;
?>
<tr>
<td align="center"><?php echo $j; ?> </td>
<td align="center"><?php echo $subject_name;?> </td>
<?php
$gradeTable='grades';
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
?>
<td align="center"><?php $total_points=$subjectAnalysis_->totalPoints($term_id,$subject_id,$class_id,$gradeTable); echo $total_points;?></td>
<td align="center"><?php $total_students=$subjectAnalysis_->totalStudents($class_id); echo $total_students;?></td>
<td align="center"><?php if($total_students>0){ $mean_points=number_format(($total_points/$total_students),3);
 echo $mean_points;} else { $mean_points='0.0'; echo $mean_points;}?></td>
<td align="center"><?php $mean_grade=$subjectAnalysis_->getMeanGrade(number_format($mean_points,1),$gradeTable); echo $mean_grade;?></td>
<td align="center"><?php $mean_score=$subjectAnalysis_->getMeanScore($subject_id,$term_id,$gradeTable); echo number_format($mean_score,3);?></td>
<td align="center"><?php $highest_mark=$subjectAnalysis_->highestScore($subject_id,$term_id,$gradeTable); echo $highest_mark;?></td>
<?php
}
}
?>

</tr>
		
		
		</tr>
	   


</table>
	   <hr  noshade="noshade"/>
        
      <!--ggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggg-->
		<p>Key: T.P->Total Points;STD->Total Students;M.P->Mean Points;M.G->Mean Grade;M.S->Mean Score;H.M->Highest Mark</p>
	
        </div><p>&copy;  <?php echo $_SESSION['schoolname'];?> <?php echo date('Y. '); ?> :powered by mySkulMate</p></td>
  </tr>
</table>
</body>
</html>
