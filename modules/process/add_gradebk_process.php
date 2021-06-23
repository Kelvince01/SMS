<td width="100%" valign="top">
<?php			
//Extract form details
extract ($_POST);
//get active term
$sql_period="SELECT * from term_period where active='1'";
$result_period=mysqli_fetch_assoc(mysqli_query($con1,$sql_period));
extract($result_period);
//select subject details
$sql_subject="SELECT subject_name from subject where subject_id='$subject_id'";
$result_subject=mysqli_fetch_assoc(mysqli_query($con1,$sql_subject));
extract($result_subject);
//select class details
$sql_class="SELECT class_name from class where class_id='$class_id'";
$result_class=mysqli_fetch_assoc(mysqli_query($con1,$sql_class));
extract($result_class);

//generate grade book name
$gradebk=$subject_name.'_'.$class_name.'_'.$term_name.'_'.$year_name;
//check if gradebook already exists
$query="SELECT gradebk from gradebk where gradebk='$gradebk'";
$result=mysqli_query($con1,$query);
$Num_Of_Records=mysqli_num_rows($result);
//if item already exists
	if ($Num_Of_Records > 0)
	{
	$sql="INSERT INTO gradebk (gradebk,subject_id,class_id,term_id) VALUES ('$gradebk','$subject_id','$class_id','$term_id')";
	echo $sql;
		?>
<p align="center"class='success'>Grade book Already Exists!</p><br>
<?php


	}
else{//create the gradebook
$sql="INSERT INTO gradebk (gradebk,subject_id,class_id,term_id) VALUES ('$gradebk','$subject_id','$class_id','$term_id')";
mysqli_query($con1,$sql);
?>
<p align="center"class='success'>Grade book added successfully</p><br>
<?php
}	
//give success message
?>
</td>
