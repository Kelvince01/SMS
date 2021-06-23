<?php
session_start();
include('../../../connection/connect.php');

//Extract form details
$student_id=$_GET['stud_id'];
$marks=$_POST['marks'];
$date=date('Y-m-d');
// Insert marks Details
$query="INSERT INTO student_marks (stud_id,gradebk_id,marks,corrected,date_entered,user_id,certified)
VALUES ('$student_id','1','$marks','0','$date','1','1')";
$result=mysqli_query($con1,$query) or die(mysqli_error($con1));
//give success message
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
<?php
}
?>