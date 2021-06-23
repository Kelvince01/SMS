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
<title>Top Students Subjectwise for <?php echo $class_name; ?>,<?php echo $term_name.' '.$year_name; ?> </title>
<link rel="stylesheet" href="new_style.css" type="text/css" />
</head>

<body>

<table width="720" border="1" align="center" cellpadding="5" cellspacing="0">
  <tr>
    <td>	  
      <div align="center">
        <div class="schhead"><?php echo nl2br(stripslashes($_SESSION['schoolname'])); ?> </div>
        <div class="headother">
             
              <b><?php echo $class_name; echo $term_name.' '.$year_name; ?>
			   <b>Top Students Per Subject</b>
            </div>
      </div>

        <hr  noshade="noshade"/>
        <table width="720" border="1" cellspacing="0" cellpadding="5" style="white-space:nowrap;">
          <tr>
		 <td>Subjects</td>
		 <td ><strong>Student Name</strong></td>
            <td width=""><strong>Mark</strong></td>
            <td width=""><strong>Grade</strong></td>
		
			
			
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


		
		
		</tr>
	   


</table>
	   <hr  noshade="noshade"/>
        
      <!--ggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggg-->
		
	
        </div><p>&copy;  <?php echo $_SESSION['schoolname'];?> <?php echo date('Y. '); ?> :powered by mySkulMate</p></td>
  </tr>
</table>
</body>
</html>
