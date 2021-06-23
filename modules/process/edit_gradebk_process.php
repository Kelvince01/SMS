<td width="100%" valign="top">
<?php	
$gradebk_id= $_GET['gradebk_id'];	
	
//Extract form details
extract ($_POST);
//get active term

$sql_period="SELECT * from term_period where year_name='$year2' and term_name='$term_name2'";
$result_period=mysqli_fetch_assoc(mysqli_query($con1,$sql_period));
extract($result_period);
//select subject details
$sql_subject="SELECT subject_id from subject where subject_name='$subject2'";
$result_subject=mysqli_fetch_assoc(mysqli_query($con1,$sql_subject));
extract($result_subject);
//select class details
$sql_class="SELECT class_id from class where class_name='$class2'";
$result_class=mysqli_fetch_assoc(mysqli_query($con1,$sql_class));
extract($result_class);

//generate grade book name
$gradebk=$subject2.'_'.$class2.'_'.$term_name2.'_'.$year2;
//check if gradebook already exists
$query="SELECT gradebk from gradebk where gradebk='$gradebk'";
$result=mysqli_query($con1,$query);
$Num_Of_Records=mysqli_num_rows($result);

//if item already exists
	if ($Num_Of_Records > 0)
	{
header('location:/sms/index.php?info=duplicate&view=academics#tabs-6');

	}
else{//create the gradebook
$sql="update gradebk set gradebk='$gradebk',subject_id='$subject_id',class_id='$class_id',term_id='$term_id' where gradebk_id='$gradebk_id'";
//echo $sql;
//break;
mysqli_query($con1,$sql)or die(mysqli_error($con1));
$sql2="update  student_marks set subject_id='$subject_id',term_id='$term_id' where gradebk_id='$gradebk_id'";
mysqli_query($con1,$sql2)or die(mysqli_error($con1));
header('location:/sms/index.php?info=edited&view=academics#tabs-6');
}	
//give success message
?>
</td>
