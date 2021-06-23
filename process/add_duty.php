<td width="80%" valign="top">
<?php
$student_name=$_POST['student_name'];
$code = explode(' ', $student_name);
$fname=$code[0];
$mname=$code[1];
$lname=$code[2];
$duty_id=$_POST['duty_id'];
//select student details
$query="SELECT stud_id,gender,class_id FROM student_details WHERE fname='$fname' AND mname='$mname' AND lname='$lname'";
$result=mysqli_query($con1,$query) or die(mysqli_error($con1));
$row1=mysqli_fetch_array($result);

//update students to include hostel allocated
$query2="UPDATE student_details SET duty_id='$duty_id' WHERE stud_id='$row1[0]'";
mysqli_query($con1,$query2) or die(mysqli_error($con1));

?>
<p align="center"class='success'>Duty allocated!</p><br>
</td>