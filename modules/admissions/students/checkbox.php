<?php
include '../../../connection/connect.php';
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
echo "subject[".$index."]=".$val.'<br>';
switch ($val){
	case 'English Grammer':
	$query="INSERT INTO student_subject (student_id,English_Grammer,`2`,`3`,`4`,`5`,`6`,`7`,`8`,`9`,`10`,`11`,`12`,`13`,`14`,`15`,`16`,`17`,`18`)
	VALUES ('$row1[0]','1','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0')";
	mysqli_query($con1,$query) or die ('Error1');
	break;
    case 'English Functional Writing':
	$query="UPDATE student_subject SET `2`='1' WHERE student_id='$row1[0]'";
	mysqli_query($con1,$query) or die ('Error2');
	break;
	case 'English Creative Writing':
	$query="UPDATE student_subject SET `3`='1' WHERE student_id='$row1[0]'";
	mysqli_query($con1,$query) or die ('Error3');
	break;
	case 'Mathematics':
	$query="UPDATE student_subject SET `4`='1' WHERE student_id='$row1[0]'";
	mysqli_query($con1,$query) or die ('Error3');
	break;
	case 'Kiswahili Insha':
	$query="UPDATE student_subject SET `5`='1' WHERE student_id='$row1[0]'";
	mysqli_query($con1,$query) or die ('Error3');
	break;
	case 'Kiswahili Lugha':
	$query="UPDATE student_subject SET `6`='1' WHERE student_id='$row1[0]'";
	mysqli_query($con1,$query) or die ('Error3');
	break;
	case 'Kiswahili Fasihi':
	$query="UPDATE student_subject SET `7`='1' WHERE student_id='$row1[0]'";
	mysqli_query($con1,$query) or die ('Error3');
	break;
	case 'Biology':
	$query="UPDATE student_subject SET `8`='1' WHERE student_id='$row1[0]'";
	mysqli_query($con1,$query) or die ('Error3');
	break;
	case 'Biological Studies':
	$query="UPDATE student_subject SET `9`='1' WHERE student_id='$row1[0]'";
	mysqli_query($con1,$query) or die ('Error3');
	break;
	case 'Chemistry':
	$query="UPDATE student_subject SET `10`='1' WHERE student_id='$row1[0]'";
	mysqli_query($con1,$query) or die ('Error3');
	break;
	case 'Pysics':
	$query="UPDATE student_subject SET `11`='1' WHERE student_id='$row1[0]'";
	mysqli_query($con1,$query) or die ('Error3');
	break;
	case 'History and Goverment':
	$query="UPDATE student_subject SET `12`='1' WHERE student_id='$row1[0]'";
	mysqli_query($con1,$query) or die ('Error3');
	break;
	case 'Geography':
	$query="UPDATE student_subject SET `13`='1' WHERE student_id='$row1[0]'";
	mysqli_query($con1,$query) or die ('Error3');
	break;
	case 'Christian Religious Education':
	$query="UPDATE student_subject SET `14`='1' WHERE student_id='$row1[0]'";
	mysqli_query($con1,$query) or die ('Error3');
	break;
	case 'Business Studies':
	$query="UPDATE student_subject SET `15`='1' WHERE student_id='$row1[0]'";
	mysqli_query($con1,$query) or die ('Error3');
	break;
	case 'Agriculture':
	$query="UPDATE student_subject SET `16`='1' WHERE student_id='$row1[0]'";
	mysqli_query($con1,$query) or die ('Error3');
	break;
	default:
	$query="INSERT INTO student_subject (student_id,English_Grammer,`2`,`3`,`4`,`5`,`6`,`7`,`8`,`9`,`10`,`11`,`12`,`13`,`14`,`15`,`16`,`17`,`18`)
	VALUES ('$row1[0]','1','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0')";
	mysqli_query($con1,$query) or die ('Error4');
}
}
?>

