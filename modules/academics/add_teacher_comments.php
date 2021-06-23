<?php
session_start();
include '../../connection/connect.php';
			
//Extract form details
//$student_id=$_GET['stud_id'];
//$gradebk_id=$_SESSION['gradebk_id'];
foreach($_POST['details'] as $index => $val){
echo "details[".$index."]=".$val.'<br>';
$date=date('Y-m-d');
//Insert marks Details
$query="UPDATE student_marks SET teacher_comments='$val' where stud_id='$index' and term_id='1' and subject_id='1'";
$result=mysqli_query($con1,$query) or die(mysqli_error($con1));

}

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
