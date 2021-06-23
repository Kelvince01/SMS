<td width="80%" valign="top">
<?php
$student_name=$_POST['student_name'];
$code = explode(' ', $student_name);
$fname=$code[0];
$mname=$code[1];
$lname=$code[2];
$hostel_id=$_POST['hostel_id'];
//select hostel details
$query="SELECT * FROM hostel WHERE hostel_id='$hostel_id'";
$result=mysqli_query($con1,$query);
$row=mysqli_fetch_array($result);

//select student details
$query="SELECT stud_id,gender,class_id FROM student_details WHERE fname='$fname' AND mname='$mname' AND lname='$lname'";
$result=mysqli_query($con1,$query);
$row1=mysqli_fetch_array($result);

//update students to include hostel allocated
$query2="UPDATE student_details SET hostel_id='$hostel_id' WHERE stud_id='$row1[0]'";
mysqli_query($con1,$query2);

//update hostel to increase count
//get student class
$query="SELECT class_for FROM class WHERE class_id='$row1[0]'";
$result=mysqli_query($con1,$query) or die (mysqli_error($con1));
$row2=mysqli_fetch_array($result);
if($row2[0]=='Form One'){
$formone=$row[2]+1;
echo 'am here';
$query="UPDATE hostel SET Form_One='$formone'";
mysqli_query($con1,$query);

}
if($row2[0]=='Form Two'){
$formtwo=$row[3]+1;
$query="UPDATE hostel SET Form_Two='$formtwo'";
mysqli_query($con1,$query);

}
if($row2[0]=='Form Three'){
$formthree=$row[4]+1;
$query="UPDATE hostel SET Form_Three='$formthree'";
mysqli_query($con1,$query);

}
if($row2[0]=='Form Four'){
$formfour=$row[5]+1;
$query="UPDATE hostel SET Form_Four='$formform'";
mysqli_query($con1,$query);

}
?>
<p align="center"class='success'>Hostel allocated!.</p><br>
