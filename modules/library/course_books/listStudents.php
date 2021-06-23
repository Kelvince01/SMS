<?php
$class_id=$_GET["class_id"];
include('../../../connection/connect.php');
?>
<select name="stud_id" class="box" id="stud_id">
         <?php
	$query="SELECT  stud_id,fname,mname,lname FROM  student_details,class where class.class_id=student_details.class_id and class_id='$class_id' ";
	$result=mysqli_query($con1,$query);
	while($nt=mysqli_fetch_array($result)){//Array or records stored in $nt
					echo "<option value=$nt[stud_id]>$nt[fname].' '.$nt[mname].' '.$nt[lname]</option>";
					/* Option values are added by looping through the array */
				}
	?>
</select>
