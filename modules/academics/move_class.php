<td width="100%" valign="top">
<br>
<p> <h2 class="title">Move Students To Next Class</h2>


		<form action="" method="post" name="frmaddClass" id="frmaddClass"  enctype="multipart/form-data">
    <table width="550" border="0"  cellpadding="5" cellspacing="1" class="entryTable">
        <tr class="entryTableHeader">
            <td colspan="2">Class Details</td>
        </tr>
		<tr>
            <td width="150" class="label">Current Class</td>
            <td class="content">
            <select name="currentclass" class="box" id="currentclass" required>
            <?php 
            $sql="select class_name,class_id from class where class_status =1";
            $res =mysqli_query($con1,$sql) or die(mysqli_error($con1));
            while ($row = mysqli_fetch_assoc($res)) :?>
            <option value="<?= $row['class_id']; ?>"><?= $row['class_name'];?></option>
            <?php endwhile; ?>
            ?>
            </select>
            </td>
        </tr>

		 <tr>
            <td width="150" class="label">New Class</td>
            <td class="content">
            <select name="newclass" class="box" id="newclass" required>
            <?php 
            $sql="select class_name,class_id from class where class_status =1";
            $res =mysqli_query($con1,$sql) or die(mysqli_error($con1));
            while ($row = mysqli_fetch_assoc($res)) :?>
            <option value="<?= $row['class_id']; ?>"><?= $row['class_name'];?></option>
            <?php endwhile; ?>
            ?>
            </select>

            </td>
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
<?php
if (isset($_POST['save'])) {
	extract ($_POST);
	
// update student Details
$sql="update student_details set class_id=$newclass where class_id=$currentclass and active=1";
$row=mysqli_query($con1,$sql);// or die(mysqli_error($con1));
$ct = mysql_affected_rows();
if($ct > 0) {
//header('location: /sms/index.php?view=academics&info=duplicate');
echo'<script>alert("Moved '.$ct.' Students");window.location=" /sms/modules/admissions/students/students_list2.php"</script>';
}else{
	echo'<script>alert("No student records were moved")</script>';
}

}
