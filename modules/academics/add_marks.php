<?php
$gradebk_id=$_GET['gradebk_id'];
$_SESSION['gradebk_id']=$gradebk_id;
//get grade book details
$sql = "SELECT class_name,class.class_id,subject_name,subject.subject_id,exam_type,term_name,year_name,term_period.term_id FROM gradebk,class,exams,term_period,SUBJECT
WHERE gradebk.class_id=class.class_id AND gradebk.term_id=term_period.term_id
AND gradebk.subject_id=subject.subject_id and gradebk_id='$gradebk_id'  ";
$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));
$row = mysqli_fetch_assoc($result);

extract($row);
//get subject_row to make sure student registered for this subject
if($subject_id=='1'){
$subject='English';
}
elseif($subject_id=='2'){
$subject='Kiswahili';
}
elseif($subject_id=='3'){
$subject='Mathematics';
}
elseif($subject_id=='4'){
$subject='Science';
}
elseif($subject_id=='5'){
$subject='SocialStudies';
}
elseif($subject_id=='6'){
$subject='NW';
}
elseif($subject_id=='7'){
$subject='READING';
}
elseif($subject_id=='8'){
$subject='CREATIVE';
}
elseif($subject_id=='9'){
$subject='ENVT';
}
else{
$subject='bs';
}

?>

<td width="100%" valign="top">
<p> <h2 class="title">Mark Book: Fill/Comment on Student Marks Here</h2>
         <?php
		 //make sure that the student sat for the exam, by selecting students who are registered to study that subject
		
			$sql = "SELECT student_details.stud_id,adminNo,fname,mname,lname FROM student_subjects,student_details 
					WHERE ".$subject."='1' and class_id='$class_id' and student_subjects.stud_id=student_details.stud_id
                   ORDER BY stud_id ASC ";
                   
			$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));

			?>
<form action="/sms/index.php?view=add_marks_process" method="post" name="" id="">
<p>Class: <?php echo $class_name; ?>&nbsp;&nbsp;|&nbsp;&nbsp;Subject: <?php echo $subject_name; ?>&nbsp;&nbsp;|&nbsp;&nbsp;  <?php echo $term_name.' '.$year_name; ?></p>
<table width="100%" border="0" align="center" cellpadding="1" cellspacing="3" class="entryTable">
<tr align="center" class="entryTableHeader">
<th width="" align="center">No</th>
<th width="25%">Name</th>
<th width="">CAT 1</th>
<th width="">CAT 2</th>
<th width="">MID-TERM</th>
<th width="">END-TERM</th>
<th width="">Comments</th>



</tr>
<?php
if (mysqli_num_rows($result) > 0) {
$i = 0;

while($row = mysqli_fetch_assoc($result)) {
extract($row);

$q="SELECT * FROM student_marks where gradebk_id='$gradebk_id' and stud_id='$stud_id' AND subject_id='$subject_id'";
$re = mysqli_query($con1,$q);
if (mysqli_num_rows($re) > 0){
$rw = mysqli_fetch_assoc($re);
extract($rw);
}
else{
$cat_1=0;
$cat_2=0;
$mid_term=0;
$end_term=0;
$teacher_comments='';
}
if ($i%2) {
	$class = 'row1';
} else {
	$class = 'row2';
}
$i += 1;
?>
<tr class="<?php echo $class; ?>">
<td width="" align="center"><?php echo $adminNo;?></td>
<td align="center" width="" ><?php echo $fname. ' '.strtoupper($mname[0]).'. '.$lname;?></td>
<?php /*
$query="select * from marking_periods where exam_id='1' and term_id='$term_id'"; 
//break;
$resulta=mysqli_query($con1,$query); 
$rowa=mysqli_fetch_array($resulta);
$date=date('Y-m-d');
if($date>$rowa[4])
{ */
?>
<!-- <td align="center" width=""><input type="text" name="marks1[<?php echo $stud_id;?>]" value="<?php echo $cat_1;?>" disabled= "true" size="5%"></td> -->
<?php /*
}
else{ */
?>
<td align="center" width=""><input type="text" name="marks1[<?php echo $stud_id;?>]" value="<?php echo $cat_1;?>"  size="5%"></td>

<td align="center" width=""><input type="text" name="marks2[<?php echo $stud_id;?>]" value="<?php echo $cat_2;?>"  size="5%"></td>

<td align="center" width=""><input type="text" name="marks3[<?php echo $stud_id;?>]" value="<?php echo $mid_term;?>"  size="5%"></td>

<td align="center" width=""><input type="text" name="marks4[<?php echo $stud_id;?>]" value="<?php echo $end_term;?>"  size="5%"></td>


<td align="center" width=""><textarea name='details[ <?php echo $stud_id;?>]' cols='15' rows='1'><?php if($teacher_comments==''){ echo 'No comments';} else { echo stripslashes($teacher_comments);} ?></textarea></td></tr>


<td align="right"><input name="save" type="submit" id="save" value="Add Comments"></a></td></tr>

<?php
}
}
else{
	echo 'No students for now or marks already entered for all students.';
}
?>
</table>

 <p>&nbsp;</p>

</form></p>
</td>