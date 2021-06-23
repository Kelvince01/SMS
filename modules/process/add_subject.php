<td width="80%" valign="top">
<?php
$student_name=$_POST['student_name'];
$code = explode(' ', $student_name);
$fname=$code[0];
$mname=$code[1];
$lname=$code[2];

//select gender of student
$query="SELECT stud_id FROM student_details WHERE fname='$fname' AND mname='$mname' AND lname='$lname'";
$result=mysqli_query($con1,$query);
$row1=mysqli_fetch_array($result);

foreach($_POST['subject'] as $index => $val){
//echo "subject[".$index."]=".$val.'<br>';

switch ($val){
	case 'English':
	$query="INSERT INTO student_subjects (stud_id,english,kiswahili,maths,SocialStudies,Science)
	VALUES ('$row1[0]','1','0','0','0','0')";
	mysqli_query($con1,$query) or die (mysqli_error($con1));
	break;
	case 'Mathematics':
	$query="UPDATE student_subjects SET `maths`='1' WHERE stud_id='$row1[0]'";
	mysqli_query($con1,$query) or die (mysqli_error($con1));
	break;
	case 'Kiswahili':
	$query="UPDATE student_subjects SET `kiswahili`='1' WHERE stud_id='$row1[0]'";
	mysqli_query($con1,$query) or die (mysqli_error($con1));
	break;
	case 'Social Studies/CRE':
	$query="UPDATE student_subjects SET `SocialStudies`='1' WHERE stud_id='$row1[0]'";
	mysqli_query($con1,$query) or die (mysqli_error($con1));
	break;
	case 'Science':
	$query="UPDATE student_subjects SET `Science`='1' WHERE stud_id='$row1[0]'";
	mysqli_query($con1,$query) or die ('Error3');
	break;
	case 'NW':
	$query="UPDATE student_subjects SET `NW`='1' WHERE stud_id='$row1[0]'";
	mysqli_query($con1,$query) or die ('Error3');
	break;
	case 'READING':
	$query="UPDATE student_subjects SET `READING`='1' WHERE stud_id='$row1[0]'";
	mysqli_query($con1,$query) or die ('Error3');
	break;
	case 'CREATIVE':
	$query="UPDATE student_subjects SET `CREATIVE`='1' WHERE stud_id='$row1[0]'";
	mysqli_query($con1,$query) or die ('Error3');
	break;
	case 'ENVT':
	$query="UPDATE student_subjects SET `ENVT`='1' WHERE stud_id='$row1[0]'";
	mysqli_query($con1,$query) or die ('Error3');
	break;

	default:
	$query="INSERT INTO student_subjects (stud_id,english,kiswahili,maths,SocialStudies,Science,NW,READING,CREATIVE,ENVT)
	VALUES ('$row1[0]','0','0','0','0','0','0','0','0','0')";
	mysqli_query($con1,$query) or die ('Error4');
}
}
header('location:/sms/index.php?info=success&view=admissions#tabs-3');
?>


  
</td>

