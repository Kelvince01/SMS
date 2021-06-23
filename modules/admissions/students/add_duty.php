<?php
include '../../../connection/connect.php';
$student_name=$_POST['student_name'];
$code = explode(' ', $student_name);
$fname=$code[0];
$mname=$code[1];
$lname=$code[2];
$duty_id=$_POST['duty_id'];
//select hostel details
$query="SELECT allocated FROM duty WHERE duty_id='$duty_id'";
$result=mysqli_query($con1,$query) or die(mysqli_error($con1));
$row=mysqli_fetch_array($result);
$allocation=$row['allocated'];
//select student details
$query="SELECT stud_id,gender,class_id FROM student_details WHERE fname='$fname' AND mname='$mname' AND lname='$lname'";
$result=mysqli_query($con1,$query) or die(mysqli_error($con1));
$row1=mysqli_fetch_array($result);

//update students to include hostel allocated
$query2="UPDATE student_details SET duty_id='$duty_id' WHERE stud_id='$row1[0]'";
mysqli_query($con1,$query2) or die(mysqli_error($con1));

//update duty to increase count
$allocation=$allocation+1;
echo $allocation.'here';
echo $duty_id;
echo $allocation.'here again';
$query="UPDATE duty SET allocated='$allocation' WHERE duty_id='$duty_id'";
mysqli_query($con1,$query) or die(mysqli_error($con1));
?>
<p><br><br><br><br></p>
<p align="center"class='alert'>Item Added Successfully.</p><br>
<p align="center">
  &nbsp;&nbsp;<input name="btnCancel" type="button" id="btnCancel" value="Back" onClick="window.location.href='index.php';" class="box">
 <input name="btnCancel" type="button" id="btnCancel" value="Sell Item" onClick="window.location.href='index.php';" class="box">
<input name="btnCancel" type="button" id="btnCancel" value="Edit Details" onClick="window.location.href='index.php';" class="box">

 </p>

          </td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
