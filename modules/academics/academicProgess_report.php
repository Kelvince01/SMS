<?php
session_start();
include('../../connection/connect.php');
include ('../../common/functions.php');

$adminNo=$_POST['adminNo'];		
$sel_sql= "SELECT student_details.*,class.class_name,class.class_for FROM student_details left join class on student_details.class_id= class.class_id WHERE student_details.adminNo='$adminNo'";
$sel_result     = mysqli_query($con1,$sel_sql);
if(mysqli_num_rows($sel_result)==0) {
header('location: /sms/index.php?view=pre_academicProgress&info=no_record');
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
    <td>    
      <div  align="center">
        <div class="schhead"><?php echo strtoupper($_SESSION['schoolname']); ?> </div>
        <div class="headother">
			   <b>Student Academic Progressive Report</b>
            </div>
      </div>

	<table width="100%" border="0" cellspacing="0" cellpadding="5">
          <tr>
            <td><b>Name: </b> <?php echo $fname.' '.$mname.' '.$lname;?></td>
			 <td><b>Admission Number:</b> <?php echo $adminNo; ?></td>
            <td><b>Present Class:</b> <?php echo strtoupper($class_name);?> </td>
          </tr>
        </table>
        <hr  noshade="noshade"/>
		<?php 
		$query="SELECT DISTINCT year_name from student_marks,
        		term_period where student_marks.term_id=term_period.term_id";
		$result     = mysqli_query($con1,$query) or die(mysqli_error($con1));

		if (mysqli_num_rows($result) > 0) {
			$i = 0;

			while($row = mysqli_fetch_assoc($result))
				{
					extract($row);

					if ($i%2) 
					{
						$class = 'row1';
					}
					else
					{
					    $class = 'row2';
					}
					$i += 1;
		?>
      <h2><?php echo 'Year: '.$year_name;?></h2>
	   

        <!--end student bio data-->
        <table width="700" border="1" cellspacing="0" cellpadding="5" >
		 <tbody>
		 <tr>
			<td width="20%">&nbsp;</td>
			 <td colspan="7" align="center"><b>1st Term  </b> </td> <td colspan="7" align="center"><b>2nd Term  </b>
			 </td> <td colspan="7" align="center"><b>3rd Term  </b> </td>	
			 </tr>
          <tr>
		 
		    <td width="20%"><b>Subjects</b></td>
			<td width="50"><b>C.A.T 1 </b></td>
            <td width="50"><b>C.A.T 2 </b></td>
            <td width="50"><b>MID TERM</b></td>
			<td width="50"><b>END TERM</b></td>
			<td width="50"><b>AVRG</b></td>
			<td width="50"><b>M.G. </b></td>
			<td width="50"><b>CLASS PSTN </b></td>
			
			<!-- for second term -->
			<td width="50"><b>C.A.T 1 </b></td>
            <td width="50"><b>C.A.T 2 </b></td>
            <td width="50"><b>MID TERM</b></td>
			<td width="50"><b>END TERM</b></td>
			<td width="50"><b>AVRG</b></td>
			<td width="50"><b>M.G. </b></td>
			<td width="50"><b>CLASS PSTN </b></td>
			
			<!-- for third term -->
			<td width="50"><b>C.A.T 1 </b></td>
            <td width="50"><b>C.A.T 2 </b></td>
            <td width="50"><b>MID TERM</b></td>
			<td width="50"><b>END TERM</b></td>
			<td width="50"><b>AVRG</b></td>
			<td width="50"><b>M.G. </b></td>
			<td width="50"><b>CLASS PSTN </b></td>
			
         </tr>
            <?php 
		$subject_query="SELECT * from subject";
		$subject_result     = mysqli_query($con1,$subject_query) or die(mysqli_error($con1));
		if (mysqli_num_rows($subject_result) > 0) {
	$i = 0;

	while($subject_row = mysqli_fetch_assoc($subject_result)) {
		extract($subject_row);

		//$i += 1;
		?>		 
         	<tr>
			<!-- for first term -->
			<?php 
			$lowerSubject = array('ENGLISH','READING','N/W','CREATIVE','ENVT');

			if($class_for =="babyclass" ||  $class_for =="preunit" )
			{
				
				if(in_array(strtoupper($subject_name), $lowerSubject))
				{
					$get_termID="SELECT term_id from term_period where year_name='$year_name' and term_name='Term 1'";
					$res=mysqli_query($con1,$get_termID);
					$rows=mysqli_fetch_assoc($res);
					extract($rows);
					
					?>
					<td width="20%"><?php echo $subject_name;?></b></td>
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
					<?php 
					$get_termID="SELECT term_id from term_period where year_name='$year_name' and term_name='Term 3'";
					$res=mysqli_query($con1,$get_termID);
					$rows=mysqli_fetch_assoc($res);
					extract($rows);
					
					?>
					<!-- for third term -->
					<td width="50"><?php $examTypeMarks_ =new examTypeMarks(); $cat1_marks=$examTypeMarks_->cat1Marks($term_id,$stud_id,$subject_id); echo $cat1_marks;?></td>
		            <td width="50"><?php $cat2_marks=$examTypeMarks_->cat2Marks($term_id,$stud_id,$subject_id); echo $cat2_marks;?></td>
		            <td width="50"><?php $midtermmarks=$examTypeMarks_->midtermMarks($term_id,$stud_id,$subject_id); echo $midtermmarks;?></td>
					<td width="50"><?php $endtermmarks=$examTypeMarks_->endtermMarks($term_id,$stud_id,$subject_id); echo $endtermmarks;?></td>
					<td width="50"><?php $averageE=$examTypeMarks_->averageGrade($term_id,$stud_id,$subject_id);echo number_format($averageE['key1'],0);?></td>
					<td width="50"><?php echo $averageE['key2'];?></td>
					<td width="50"><?php $position=$examTypeMarks_->classPosition($term_id,$stud_id,$subject_id); echo $position;?></td>
			
			<?php	}//end if(in_array(strtoupper($subject_name), $lowerSubject))
			}
			else
			{
				if(!in_array($subject_name, $lowerSubject))
				{
					$get_termID="SELECT term_id from term_period where year_name='$year_name' and term_name='Term 1'";
					$res=mysqli_query($con1,$get_termID);
					$rows=mysqli_fetch_assoc($res);
					extract($rows);
					
					?>
					<td width="20%"><?php echo $subject_name;?></b></td>
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
					<?php 
					$get_termID="SELECT term_id from term_period where year_name='$year_name' and term_name='Term 3'";
					$res=mysqli_query($con1,$get_termID);
					$rows=mysqli_fetch_assoc($res);
					extract($rows);
					
					?>
					<!-- for third term -->
					<td width="50"><?php $examTypeMarks_ =new examTypeMarks(); $cat1_marks=$examTypeMarks_->cat1Marks($term_id,$stud_id,$subject_id); echo $cat1_marks;?></td>
		            <td width="50"><?php $cat2_marks=$examTypeMarks_->cat2Marks($term_id,$stud_id,$subject_id); echo $cat2_marks;?></td>
		            <td width="50"><?php $midtermmarks=$examTypeMarks_->midtermMarks($term_id,$stud_id,$subject_id); echo $midtermmarks;?></td>
					<td width="50"><?php $endtermmarks=$examTypeMarks_->endtermMarks($term_id,$stud_id,$subject_id); echo $endtermmarks;?></td>
					<td width="50"><?php $averageE=$examTypeMarks_->averageGrade($term_id,$stud_id,$subject_id);echo number_format($averageE['key1'],0);?></td>
					<td width="50"><?php echo $averageE['key2'];?></td>
					<td width="50"><?php $position=$examTypeMarks_->classPosition($term_id,$stud_id,$subject_id); echo $position;?></td>
		<?php	}

			}		
			
			?></tr>
			  <?php
}//end while($subject_row = mysqli_fetch_assoc($subject_result))
}// end if (mysqli_num_rows($subject_result) > 0) {

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
			<td colspan="1" align="right"><b>CLASS PSTN</b> </td>
			<td align="center"><b><?php $cat_1Position=$examTypeMarks_->PositionClass($term_id,$stud_id,'cat_1',$class_name);echo $cat_1Position;?></b></td>			
			<td align="center"><b><?php $cat_1Position=$examTypeMarks_->PositionClass($term_id,$stud_id,'cat_2',$class_name);echo $cat_1Position;?></b></td>
			<td align="center"><b><?php $mid_termPosition=$examTypeMarks_->PositionClass($term_id,$stud_id,'mid_term',$class_name);echo $mid_termPosition;?></b></td>
			<td><b><?php $end_termPosition=$examTypeMarks_->PositionClass($term_id,$stud_id,'end_term',$class_name);echo $end_termPosition;?></b></td>
			<td align="center"><b><?php $average_ =new studentProfile(); $average=$average_->getStudentAverage($term_id,$stud_id); echo $average;?></b></td>
			<td align="center"><b><?php $subjectAnalysis_= new subjectAnalysis(); $grade=$subjectAnalysis_->getGrade($average,$gradeTable); echo $grade;?></b></td>
			<td align="center"><b><?php $position=$average_->studentPosition($term_id,$stud_id); echo $position;?></b></td>
<?php 

			$get_termID="SELECT term_id from term_period where year_name='$year_name' and term_name='Term 2'";
			$res=mysqli_query($con1,$get_termID);
			$rows=mysqli_fetch_assoc($res);
			extract($rows);
			
			?>			
			<td align="center"><b><?php $cat_1Position=$examTypeMarks_->PositionClass($term_id,$stud_id,'cat_1',$class_name);echo $cat_1Position;?></b></td>			
			<td align="center"><b><?php $cat_1Position=$examTypeMarks_->PositionClass($term_id,$stud_id,'cat_2',$class_name);echo $cat_1Position;?></b></td>
			<td align="center"><b><?php $mid_termPosition=$examTypeMarks_->PositionClass($term_id,$stud_id,'mid_term',$class_name);echo $mid_termPosition;?></b></td>
			<td><b><?php $end_termPosition=$examTypeMarks_->PositionClass($term_id,$stud_id,'end_term',$class_name);echo $end_termPosition;?></b></td>
			<td align="center"><b><?php $average_ =new studentProfile(); $average=$average_->getStudentAverage($term_id,$stud_id); echo $average;?></b></td>
			<td align="center"><b><?php $subjectAnalysis_= new subjectAnalysis(); $grade=$subjectAnalysis_->getGrade($average,$gradeTable); echo $grade;?></b></td>
			<td align="center"><b><?php $position=$average_->studentPosition($term_id,$stud_id); echo $position;?></b></td>
<?php 
			$get_termID="SELECT term_id from term_period where year_name='$year_name' and term_name='Term 3'";
			$res=mysqli_query($con1,$get_termID);
			$rows=mysqli_fetch_assoc($res);
			extract($rows);
			
			?>			
			<td align="center"><b><?php $cat_1Position=$examTypeMarks_->PositionClass($term_id,$stud_id,'cat_1',$class_name);echo $cat_1Position;?></b></td>			
			<td align="center"><b><?php $cat_1Position=$examTypeMarks_->PositionClass($term_id,$stud_id,'cat_2',$class_name);echo $cat_1Position;?></b></td>
			<td align="center"><b><?php $mid_termPosition=$examTypeMarks_->PositionClass($term_id,$stud_id,'mid_term',$class_name);echo $mid_termPosition;?></b></td>
			<td><b><?php $end_termPosition=$examTypeMarks_->PositionClass($term_id,$stud_id,'end_term',$class_name);echo $end_termPosition;?></b></td>			
			<td align="center"><b><?php $average_ =new studentProfile(); $average=$average_->getStudentAverage($term_id,$stud_id); echo $average;?></b></td>
			<td align="center"><b></b><?php $subjectAnalysis_= new subjectAnalysis(); $grade=$subjectAnalysis_->getGrade($average,$gradeTable); echo $grade;?></td>
			<td align="center"><b></b><?php $position=$average_->studentPosition($term_id,$stud_id); echo $position;?></td>
		</tr>
		<tr>
			<!-- for term one -->
			<?php 
			$get_termID="SELECT term_id from term_period where year_name='$year_name' and term_name='Term 1'";
			$res=mysqli_query($con1,$get_termID);
			$rows=mysqli_fetch_assoc($res);
			extract($rows);

			$gradeTable=gradeTable($subject_id);
			?>
			<td colspan="1" align="right"><b>STREAM PSTN</b> </td>
			<td align="center"><b><?php $cat_1Position=$examTypeMarks_->PositionStream($term_id,$stud_id,'cat_1',$class_for);echo $cat_1Position;?></b></td>			
			<td align="center"><b><?php $cat_1Position=$examTypeMarks_->PositionStream($term_id,$stud_id,'cat_2',$class_for);echo $cat_1Position;?></b></td>
			<td align="center"><b><?php $mid_termPosition=$examTypeMarks_->PositionStream($term_id,$stud_id,'mid_term',$class_for);echo $mid_termPosition;?></b></td>
			<td><b><?php $end_termPosition=$examTypeMarks_->PositionStream($term_id,$stud_id,'end_term',$class_for);echo $end_termPosition;?></b></td>
			<td align="center"><b><?php $average_ =new studentProfile(); $average=$average_->getStudentAverage($term_id,$stud_id); echo $average;?></b></td>
			<td align="center"><b><?php $subjectAnalysis_= new subjectAnalysis(); $grade=$subjectAnalysis_->getGrade($average,$gradeTable); echo $grade;?></b></td>
			<td align="center"><b><?php $position=$average_->studentPosition($term_id,$stud_id); echo $position;?></b></td>
<?php 

			$get_termID="SELECT term_id from term_period where year_name='$year_name' and term_name='Term 2'";
			$res=mysqli_query($con1,$get_termID);
			$rows=mysqli_fetch_assoc($res);
			extract($rows);
			
			?>			
			<td align="center"><b><?php $cat_1Position=$examTypeMarks_->PositionStream($term_id,$stud_id,'cat_1',$class_for);echo $cat_1Position;?></b></td>			
			<td align="center"><b><?php $cat_1Position=$examTypeMarks_->PositionStream($term_id,$stud_id,'cat_2',$class_for);echo $cat_1Position;?></b></td>
			<td align="center"><b><?php $mid_termPosition=$examTypeMarks_->PositionStream($term_id,$stud_id,'mid_term',$class_for);echo $mid_termPosition;?></b></td>
			<td><b><?php $end_termPosition=$examTypeMarks_->PositionStream($term_id,$stud_id,'end_term',$class_for);echo $end_termPosition;?></b></td>
			<td align="center"><b><?php $average_ =new studentProfile(); $average=$average_->getStudentAverage($term_id,$stud_id); echo $average;?></b></td>
			<td align="center"><b><?php $subjectAnalysis_= new subjectAnalysis(); $grade=$subjectAnalysis_->getGrade($average,$gradeTable); echo $grade;?></b></td>
			<td align="center"><b><?php $position=$average_->studentPosition($term_id,$stud_id); echo $position;?></b></td>
<?php 
			$get_termID="SELECT term_id from term_period where year_name='$year_name' and term_name='Term 3'";
			$res=mysqli_query($con1,$get_termID);
			$rows=mysqli_fetch_assoc($res);
			extract($rows);
			
			?>			
			<td align="center"><b><?php $cat_1Position=$examTypeMarks_->PositionStream($term_id,$stud_id,'cat_1',$class_for);echo $cat_1Position;?></b></td>			
			<td align="center"><b><?php $cat_1Position=$examTypeMarks_->PositionStream($term_id,$stud_id,'cat_2',$class_for);echo $cat_1Position;?></b></td>
			<td align="center"><b><?php $mid_termPosition=$examTypeMarks_->PositionStream($term_id,$stud_id,'mid_term',$class_for);echo $mid_termPosition;?></b></td>
			<td><b><?php $end_termPosition=$examTypeMarks_->PositionStream($term_id,$stud_id,'end_term',$class_for);echo $end_termPosition;?></b></td>			
			<td align="center"><b><?php $average_ =new studentProfile(); $average=$average_->getStudentAverage($term_id,$stud_id); echo $average;?></b></td>
			<td align="center"><b></b><?php $subjectAnalysis_= new subjectAnalysis(); $grade=$subjectAnalysis_->getGrade($average,$gradeTable); echo $grade;?></td>
			<td align="center"><b></b><?php $position=$average_->studentPosition($term_id,$stud_id); echo $position;?></td>
		</tr>
        </table>
        <!--
	   <hr  noshade="noshade"/>
        <div class="div_pad"><b>Class Teacher's Comment:</b></div><br><br>
		<hr  noshade="noshade"/>
      <div class="div_pad"><b>School Principal's Comment:</b></div><br><br>
	  
          <hr  noshade="noshade"/> -->
		  <?php
	//	  print_r($rows);return;
}
}

?>
	   
        
      <!--ggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggg-->
		
	
        </div><p>&copy;  <?php echo strtoupper($_SESSION['schoolname']); ?> <?php echo date('Y. '); ?> :powered by mySkulMate</p></td>
  </tr>
</table>
</body>
</html>
