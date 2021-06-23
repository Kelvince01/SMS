<?php
session_start();
include('../../connection/connect.php');
include ('../../common/functions.php');
$adminNo=$_GET['adminNo'];			
$sel_sql= "SELECT student_details.*,class.class_name,hostel.hostel_name FROM student_details,class,hostel WHERE student_details.adminNo='$adminNo'";
$sel_result     = mysqli_query($con1,$sel_sql);
if(mysqli_num_rows($sel_result)==0) {
header('location: /sms/index.php?view=academics&info=no_record');
}
else{
$sel_row = mysqli_fetch_assoc($sel_result);
extract($sel_row);	
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Student Academic Progressive Report</title>
<link rel="stylesheet" href="new_style.css" type="text/css" />
</head>

<body>

<table width="720" border="1" align="center" cellpadding="5" cellspacing="0">
  <tr>
    <td><div  class="totalhead">
      <div class="logo_box"></div>
	  
      <div class="centreedge" align="center">
        <div class="schhead"><?php echo nl2br(stripslashes('PIONEER HIGH SCHOOL')); ?> </div>
        <div class="headother">
             
              <b>
			   <b>Student Academic Progressive Report</b>
            </div>
      </div>
	   
    </div>
	<table width="80%" border="0" cellspacing="0" cellpadding="5">
          <tr>
            <td colspan="3" class="title">Name: <?php echo $fname.' '.$mname.' '.$lname;?></td>
			 <td colspan="3" class="title">Admission Number: <?php echo $adminNo; ?></td>
         
            <td>Gender: <strong><?php echo strtoupper($gender);?></strong></td>
            <td>Present Class: <strong><?php echo strtoupper($class_name);?></strong> </td>
            <td>&nbsp;</td>
          </tr>
        </table>
        <hr  noshade="noshade"/>
		<?php 
		$query="SELECT DISTINCT(term_period.term_id),term_period.term_name, year_name from student_marks,
        		term_period where student_marks.term_id=term_period.term_id";
		$result     = mysqli_query($con1,$query) or die(mysqli_error($con1));
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
      <h2><?php echo 'Year: '.$year_name;?></h2>
	   
<!--gggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggg-->
        <!--end student bio data-->
        <table width="700" border="1" cellspacing="0" cellpadding="5" >
		 <tbody>
		 <tr>
			<td width="20%">&nbsp;</td>
			 <td colspan="7" align="center"><strong>1st Term  </strong> </td> <td colspan="7" align="center"><strong>2nd Term  </strong>
			 </td> <td colspan="7" align="center"><strong>3rd Term  </strong> </td>	
			 </tr>
          <tr>
		 
		    <td width="20%"><strong>Subjects</strong></td>
			<td width="50"><strong>C.A.T 1 </strong></td>
            <td width="50"><strong>C.A.T 2 </strong></td>
            <td width="50"><strong>MID TERM</strong></td>
			<td width="50"><strong>END TERM</strong></td>
			<td width="50"><strong>AVRG</strong></td>
			<td width="50"><strong>M.G. </strong></td>
			<td width="50"><strong>CLASS PSTN </strong></td>
			
			<!-- for second term -->
			<td width="50"><strong>C.A.T 1 </strong></td>
            <td width="50"><strong>C.A.T 2 </strong></td>
            <td width="50"><strong>MID TERM</strong></td>
			<td width="50"><strong>END TERM</strong></td>
			<td width="50"><strong>AVRG</strong></td>
			<td width="50"><strong>M.G. </strong></td>
			<td width="50"><strong>CLASS PSTN </strong></td>
			
			<!-- for third term -->
			<td width="50"><strong>C.A.T 1 </strong></td>
            <td width="50"><strong>C.A.T 2 </strong></td>
            <td width="50"><strong>MID TERM</strong></td>
			<td width="50"><strong>END TERM</strong></td>
			<td width="50"><strong>AVRG</strong></td>
			<td width="50"><strong>M.G. </strong></td>
			<td width="50"><strong>CLASS PSTN </strong></td>
			
         </tr>
            <?php 
		$subject_query="SELECT * from subject";
		$subject_result     = mysqli_query($con1,$subject_query) or die(mysqli_error($con1));
		if (mysqli_num_rows($subject_result) > 0) {
	$i = 0;

	while($subject_row = mysqli_fetch_assoc($subject_result)) {
		extract($subject_row);
		$i += 1;
		?>		 
         	<tr>
			<!-- for first term --->
			<?php 
			$get_termID="SELECT term_id from term_period where year_name='$year_name' and term_name='Term 1'";
			$res=mysqli_query($con1,$get_termID);
			$rows=mysqli_fetch_assoc($res);
			extract($rows);
			
			?>
			<td width="20%"><?php echo $subject_name;?></strong></td>
			<td width="50"><?php $examTypeMarks_ =new examTypeMarks(); $cat1_marks=$examTypeMarks_->cat1Marks($term_id,$stud_id,$subject_id); echo $cat1_marks;?></td>
            <td width="50"><?php $cat2_marks=$examTypeMarks_->cat2Marks($term_id,$stud_id,$subject_id); echo $cat2_marks;?></td>
            <td width="50"><?php $midtermmarks=$examTypeMarks_->midtermMarks($term_id,$stud_id,$subject_id); echo $midtermmarks;?></td>
			<td width="50"><?php $endtermmarks=$examTypeMarks_->endtermMarks($term_id,$stud_id,$subject_id); echo $endtermmarks;?></td>
			<td width="50"><?php $averageE=$examTypeMarks_->averageGrade($term_id,$stud_id,$subject_id);echo number_format($averageE['key1'],0);?></td>
			<td width="50"><?php echo $averageE['key2'];?></td>
			<td width="50"><?php $position=$examTypeMarks_->classPosition($term_id,$stud_id,$subject_id); echo $position;?></td>
			<!-- for second term -->
			<?php 
			$get_termID="SELECT term_id from term_period where year_name='$year_name' and term_name='Term 2'";
			$res=mysqli_query($con1,$get_termID);
			$rows=mysqli_fetch_assoc($res);
			extract($rows);
			
			?>
			<td width="50"><?php $examTypeMarks_ =new examTypeMarks(); $cat1_marks=$examTypeMarks_->cat1Marks($term_id,$stud_id,$subject_id); echo $cat1_marks;?></td>
            <td width="50"><?php $cat2_marks=$examTypeMarks_->cat2Marks($term_id,$stud_id,$subject_id); echo $cat2_marks;?></td>
            <td width="50"><?php $midtermmarks=$examTypeMarks_->midtermMarks($term_id,$stud_id,$subject_id); echo $midtermmarks;?></td>
			<td width="50"><?php $endtermmarks=$examTypeMarks_->endtermMarks($term_id,$stud_id,$subject_id); echo $endtermmarks;?></td>
			<td width="50"><?php $averageE=$examTypeMarks_->averageGrade($term_id,$stud_id,$subject_id);echo number_format($averageE['key1'],0);?></td>
			<td width="50"><?php echo $averageE['key2'];?></td>
			<td width="50"><?php $position=$examTypeMarks_->classPosition($term_id,$stud_id,$subject_id); echo $position;?></td>
			
			<!-- for third term -->
			<td width="50"><?php $examTypeMarks_ =new examTypeMarks(); $cat1_marks=$examTypeMarks_->cat1Marks($term_id,$stud_id,$subject_id); echo $cat1_marks;?></td>
            <td width="50"><?php $cat2_marks=$examTypeMarks_->cat2Marks($term_id,$stud_id,$subject_id); echo $cat2_marks;?></td>
            <td width="50"><?php $midtermmarks=$examTypeMarks_->midtermMarks($term_id,$stud_id,$subject_id); echo $midtermmarks;?></td>
			<td width="50"><?php $endtermmarks=$examTypeMarks_->endtermMarks($term_id,$stud_id,$subject_id); echo $endtermmarks;?></td>
			<td width="50"><?php $averageE=$examTypeMarks_->averageGrade($term_id,$stud_id,$subject_id);echo number_format($averageE['key1'],0);?></td>
			<td width="50"><?php echo $averageE['key2'];?></td>
			<td width="50"><?php $position=$examTypeMarks_->classPosition($term_id,$stud_id,$subject_id); echo $position;?></td>
			
			</tr>
			  <?php
}
}

?>
			<tr>
			<!-- for term one -->
			<?php 
			$get_termID="SELECT term_id from term_period where year_name='$year_name' and term_name='Term 1'";
			$res=mysqli_query($con1,$get_termID);
			$rows=mysqli_fetch_assoc($res);
			extract($rows);
			$gradeTable=gradeTable($subject_id);
			?>
			<td colspan="5" align="right"><b>Total Avg</b> </td>
			
<td align="center"><strong><?php $average_ =new studentProfile(); $average=$average_->getStudentAverage($term_id,$stud_id); echo $average;?></strong></td>
<td align="center"><strong></strong><?php $subjectAnalysis_= new subjectAnalysis(); $grade=$subjectAnalysis_->getGrade($average,$gradeTable); echo $grade;?></td>
<td align="center"><strong></strong><?php $position=$average_->studentPosition($term_id,$stud_id); echo $position;?></td>
<?php 
			$get_termID="SELECT term_id from term_period where year_name='$year_name' and term_name='Term 2'";
			$res=mysqli_query($con1,$get_termID);
			$rows=mysqli_fetch_assoc($res);
			extract($rows);
			
			?>
			<td colspan="4" align="right"><b>Total Avg</b> </td>			
<td align="center"><strong><?php $average_ =new studentProfile(); $average=$average_->getStudentAverage($term_id,$stud_id); echo $average;?></strong></td>
<td align="center"><strong></strong><?php $subjectAnalysis_= new subjectAnalysis(); $grade=$subjectAnalysis_->getGrade($average,$gradeTable); echo $grade;?></td>
<td align="center"><strong></strong><?php $position=$average_->studentPosition($term_id,$stud_id); echo $position;?></td>
<?php 
			$get_termID="SELECT term_id from term_period where year_name='$year_name' and term_name='Term 3'";
			$res=mysqli_query($con1,$get_termID);
			$rows=mysqli_fetch_assoc($res);
			extract($rows);
			
			?>
			<td colspan="4" align="right"><b>Total Avg</b> </td>			
<td align="center"><strong><?php $average_ =new studentProfile(); $average=$average_->getStudentAverage($term_id,$stud_id); echo $average;?></strong></td>
<td align="center"><strong></strong><?php $subjectAnalysis_= new subjectAnalysis(); $grade=$subjectAnalysis_->getGrade($average,$gradeTable); echo $grade;?></td>
<td align="center"><strong></strong><?php $position=$average_->studentPosition($term_id,$stud_id); echo $position;?></td>

        </table>
	   <hr  noshade="noshade"/>
        <div class="div_pad"><strong>Class Teacher's Comment:</strong></div><br><br>
		<hr  noshade="noshade"/>
      <div class="div_pad"><strong>School Principal's Comment:</strong></div><br><br>
	  
          <hr  noshade="noshade"/>
		  <?php
}
}

?>
	   
        
      <!--ggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggg-->
		
	
        </div><p>&copy;  PIONEER HIGH SCHOOL <?php echo date('Y. '); ?> :powered by mySkulMate</p></td>
  </tr>
</table>
</body>
</html>
