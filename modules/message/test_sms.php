<?php
include '../../connection/connect.php';
include '../../common/functions.php';
$number='0721713555';
$adminNo='0001';
$sel_sql= "SELECT student_details.*,class.class_name,hostel.hostel_name FROM student_details,class,hostel WHERE student_details.adminNo='$adminNo'";
$sel_result     = mysqli_query($con1,$sel_sql) or die(mysqli_error($con1));
$sel_row = mysqli_fetch_assoc($sel_result);
extract($sel_row);		
//get active term
$sql_period="SELECT * from term_period where active='1'";
$result_period=mysqli_fetch_assoc(mysqli_query($con1,$sql_period));
extract($result_period);
		
$sql = "SELECT SUM((cat_1+cat_2+mid_term+end_term)/2)AS total,student_marks.stud_id,adminNo,fname,mname,lname
				FROM student_marks,student_details
				WHERE student_marks.stud_id=student_details.stud_id and term_id='$term_id' and class_id='$class_id' and student_marks.stud_id='$stud_id'";
			$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));
			$row = mysqli_fetch_assoc($result);
            extract($row);
	
//get the marks
$sql = "SELECT subject_name,subject_id FROM subject ";
$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));
if (mysqli_num_rows($result) > 0) {
	$i = 0;
     $message_part2='';
	while($row = mysqli_fetch_assoc($result)) {
		extract($row);
if ($i%2) {
	$class = 'row1';
} else {
	$class = 'row2';
}
$i += 1;
			
		
		$examTypeMarks_=new examTypeMarks();
     
		 $cat_1=$examTypeMarks_->cat1Marks($term_id,$stud_id,$subject_id);
			$cat_2=$examTypeMarks_->cat2Marks($term_id,$stud_id,$subject_id);
			 $mid_term=$examTypeMarks_->midtermMarks($term_id,$stud_id,$subject_id);
			 $end_term=$examTypeMarks_->endtermMarks($term_id,$stud_id,$subject_id);
			$average=$examTypeMarks_->averageGrade($term_id,$stud_id,$subject_id);
			$average= number_format($average['key1'],1);
			$grade= $average['key2'];
		   $classPosition=$examTypeMarks_->classPosition($term_id,$stud_id,$subject_id);
  $message_part2_=strtoupper(substr($subject_name, 0, 3)).' :'.$average.$grade;
  $message_part2=$message_part2.'; '.$message_part2_;
  }//end while  
}//end if
else{
echo 'No details for now.';
}
$total_Avg=number_format($total,2);
$studentProfile_=new studentProfile; 
$meanPoints=$studentProfile_->studMeanPoints($stud_id,$term_id); 
$meanPoints= $meanPoints['key2'];
$studentPosition=$studentProfile_->studentPosition($term_id,$stud_id);
$message_part3='TOTAL:'.$total.' MEAN POINTS:'.$meanPoints.' PST:'.$studentPosition;
$message_part1='NAME: '.$fname.' '.$mname.' '.$lname. ' '.$adminNo.' '.$class_name.' '.$term_name.' :'.$year_name;
$message=$message_part1.' '.$message_part2.' '.$message_part3.' Sent from Nyandarua High School';
echo $message;
function sendSMS($number,$message) //sends specified SMS message to the specified recipient
{
  $Namba=urlencode($number);
	$Message=urlencode($message);
	file("http://localhost:8011/send/sms/".$Namba."/".$Message."/");
}
sendSMS($number,$message);
echo 'message sent';

?>