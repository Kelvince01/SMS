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
	$query="INSERT INTO student_subjects (stud_id,english,`kiswahili`,`maths`,`biology`,`chemistry`,`physics`,`geography`,`history`,`cre`,`agriculture`,`bs`)
	VALUES ('$row1[0]','1','0','0','0','0','0','0','0','0','0','0')";
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
	case 'Biology':
	$query="UPDATE student_subjects SET `biology`='1' WHERE stud_id='$row1[0]'";
	mysqli_query($con1,$query) or die (mysqli_error($con1));
	break;
	case 'Chemistry':
	$query="UPDATE student_subjects SET `chemistry`='1' WHERE stud_id='$row1[0]'";
	mysqli_query($con1,$query) or die ('Error3');
	break;
	case 'Physics':
	$query="UPDATE student_subjects SET `physics`='1' WHERE stud_id='$row1[0]'";
	mysqli_query($con1,$query) or die ('Error3');
	break;
	case 'History':
	$query="UPDATE student_subjects SET `history`='1' WHERE stud_id='$row1[0]'";
	mysqli_query($con1,$query) or die ('Error3');
	break;
	case 'Geography':
	$query="UPDATE student_subjects SET `geography`='1' WHERE stud_id='$row1[0]'";
	mysqli_query($con1,$query) or die ('Error3');
	break;
	case 'C.R.E':
	$query="UPDATE student_subjects SET `cre`='1' WHERE stud_id='$row1[0]'";
	mysqli_query($con1,$query) or die ('Error3');
	break;
	case 'B/S':
	$query="UPDATE student_subjects SET `bs`='1' WHERE stud_id='$row1[0]'";
	mysqli_query($con1,$query) or die ('Error3');
	break;
	case 'Agriculture':
	$query="UPDATE student_subjects SET `agriculture`='1' WHERE stud_id='$row1[0]'";
	mysqli_query($con1,$query) or die ('Error3');
	break;
	default:
	$query="INSERT INTO student_subjects (stud_id,english,`kiswahili`,`maths`,`biology`,`chemistry`,`physics`,`geography`,`history`,`cre`,`agriculture`,`bs`)
	VALUES ('$row1[0]','0','0','0','0','0','0','0','0','0','0','0')";
	mysqli_query($con1,$query) or die ('Error4');
}
}

?>

<p align="center"class='success'>Student allocated subjects successfully</p><br>
  
</td>

