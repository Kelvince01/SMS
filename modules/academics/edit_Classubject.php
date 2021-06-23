<?php
$cst_id= $_GET['cst_id'];
extract ($_POST);
// Insert class Details
$sql="SELECT class_name,class_subject_teacher.class_id,class_subject_teacher.teacher_id,class_subject_teacher.subject_id,subject_name,teacher_name FROM class_subject_teacher,teacher,class,SUBJECT WHERE 
subject.subject_id=class_subject_teacher.subject_id AND teacher.teacher_id=class_subject_teacher.teacher_id AND class.class_id=class_subject_teacher.class_id and class_subject_teacher.cst_id='$cst_id'";
//echo $cst_id;
//break;
$result=mysqli_query($con1,$sql)or die(mysqli_error($con1));
			
while($row = mysqli_fetch_assoc($result)) {
extract($row);


?>

<td width="100%" valign="top">
<br>
<p> <h2 class="title">Allocate Teacher to Subject Here</h2>


		<form action="/sms/index.php?&cst_id=<?php echo $cst_id;?>&view=process_editClass_subject" method="post" name="frmaddClass" id="frmaddClass"  enctype="multipart/form-data">
    <table width="550" border="0"  cellpadding="5" cellspacing="1" class="entryTable">
        <tr class="entryTableHeader">
            <td colspan="2">Allocation Details</td>
        </tr>
		<tr>    <td width="150" class="label">Subject Name<span style="color:red;">*</span></td>
				<td><select name="subject_id">
				<?php 
					$query1="SELECT subject_id,subject_name FROM subject ";
				$result = mysqli_query($con1,$query1);
			// printing the list box select command

			while($nt=mysqli_fetch_array($result)){//Array or records stored in $nt
			echo "<option value=$nt[subject_id]>$nt[subject_name]</option>";
			/* Option values are added by looping through the array */
			}
			// Closing of list box 
			?>	
			</select></td>
			</tr>
         <tr>
				<td width="150" class="label">Class Name<span style="color:red;">*</span></td>
				<td><select name="class_id">
				<?php echo '<option value="'.$class_id.'">'.$class_name.'</option>';
				
				$query1="SELECT class_id,class_name FROM class ";
				$result = mysqli_query($con1,$query1);
			// printing the list box select command

			while($nt=mysqli_fetch_array($result)){//Array or records stored in $nt
			echo "<option value=$nt[class_id]>$nt[class_name]</option>";
			/* Option values are added by looping through the array */
			}
			// Closing of list box 
			?>	
			</select></td>
			</tr>
		 <tr>
				<td width="150" class="label">Teacher Name<span style="color:red;">*</span></td>
				<td><select name="teacher_id">
			<?php	echo '<option value="'.$teacher_id.'">'.$teacher_name.'</option>';
				
				$query1="SELECT teacher_id,teacher_name FROM teacher ";
				$result = mysqli_query($con1,$query1);
			// printing the list box select command

			while($nt=mysqli_fetch_array($result)){//Array or records stored in $nt
			echo "<option value=$nt[teacher_id]>$nt[teacher_name]</option>";
			/* Option values are added by looping through the array */
			}
			// Closing of list box 
			?>	
			</select></td>
			</tr>
                <tr>
		<td width="150" class="label"></td>
            <td class="content"><label >Fields Marked with<span class="required" title="This field is required.">*</span> are required.</td>
        </tr>
		<tr>
		<td height="43">&nbsp;</td>
		<td>
		<p align="left">
        <input name="save" type="submit" id="save" value="Save Details">
    </p>
	</td>
	</tr>
    </table>
</form>
 <p>&nbsp;</p>

</p>
</td>
<?php }?>