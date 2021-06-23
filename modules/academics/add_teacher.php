
<td width="100%" valign="top">
<br>
 <h2 class="title">Add Teacher</h2>


		<form action="" method="post" name="frmaddteacher" id="frmaddteacher"  enctype="multipart/form-data">
    <table width="550" border="0"  cellpadding="5" cellspacing="1" class="entryTable">
        <tr class="entryTableHeader">
            <td colspan="2">Teacher Details</td>
        </tr>
        <tr>
            <td width="150" class="label">Teacher Name</td>
            <td class="content"><input name="teacher_name" type="text" class="box" id="teacher_name" size="30" maxlength="50" required><span class="required" title="required.">*</span><div id="exam_name"></div></td>
        </tr>
<input name="tscNo" type="hidden" value="n/a"  >
         <tr>
            <td width="150" class="label">Initials</td>
            <td class="content"><input name="intials" type="text" class="box" id="intials" size="30" maxlength="50" required><span class="required" title="required.">*</span><div id="exam_name"></div></td>
        </tr>
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

</td>
<?php
if(isset($_POST['save'])){
	extract ($_POST);
	$query="INSERT INTO teacher (teacher_name,tscNo,intials)
	VALUES ('$teacher_name','$tscNo','$intials')";
	mysqli_query($con1,$query) or die (mysqli_error($con1));
//header('location:/sms/index.php?info=success&view=admissions#tabs-3');	
echo'<script>window.location=" /sms/index.php?info=success&view=add_subject_allocation#tabs-3"</script>';
}
?>  


