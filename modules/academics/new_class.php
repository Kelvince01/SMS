<script>function addClassValidation(){

if((document.frmaddClass.cname.value=="")||(document.frmaddClass.cname.value==null))
	{
		document.getElementById("cname").innerHTML=("*Please enter classname*");
		document.frmaddClass.cname.focus();
        return false;
	}
if((document.frmaddClass.capacity.value=="")||(document.frmaddClass.capacity.value==null))
	{
		document.getElementById("capacity").innerHTML=("*Please enter capacity*");
		document.frmaddClass.capacity.focus();
        return false;
	}	
	
}


	</script>
<td width="100%" valign="top">
<br>
<p> <h2 class="title">Add New Class Here</h2>


		<form action="" method="post" name="frmaddClass" id="frmaddClass"  enctype="multipart/form-data">
    <table width="550" border="0"  cellpadding="5" cellspacing="1" class="entryTable">
        <tr class="entryTableHeader">
            <td colspan="2">Class Details</td>
        </tr>
		<tr>
            <td width="150" class="label">Class Name</td>
            <td class="content"><input name="cname" type="text" class="box" value = "" id="fname" size="30" maxlength="50" class="" title="Enter your name" required><div id="cname"></div></td>
        </tr>

		  <tr>
            <td width="150" class="label">Class For</td>
			<td><select name="class_for" class="box" id="class_for" required>
			 <option value="" selected>-.- Select -.-</option>
			  <option value="babyclass">babyclass</option>
			 <option value="preunit">preunit</option>
			<option value="Class 1">Class 1</option>
			<option value="Class 2">Class 2</option>
			<option value="Class 3">Class 3</option>
			<option value="Class 4">Class 4</option>
			<option value="Class 5">Class 5</option>
			<option value="Class 6">Class 6</option>
			<option value="Class 7">Class 7</option>
			<option value="Class 8">Class 8</option>
		   </select></td>
						</tr>

			<tr>
            <td width="150" class="label">Capacity</td>
            <td class="content"><input name="capacity" type="text" class="box" onkeypress="return event.charCode >= 48 && event.charCode <= 57" id="capacity" size="30" maxlength="50" required><span class="" title="This field is required.">*</span><div id="capacity"></div></td>
        </tr>
		<tr>
            <td width="150" class="label">Active</td>
			<td><select name="status" class="box" id="gender" required>
			 <option value="" selected>-.- Select -.-</option>
			<option value="1">Yes</option>
			<option value="0">No</option>
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
        <input name="save" type="submit" id="save" onclick="return addClassValidation()" value="Save Details">
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
// Insert class Details
$sql="select class_name from class where class_name='$cname'";
$re=mysqli_query($con1,$sql);
if(mysqli_num_rows($re) > 0) {
header('location: /sms/index.php?view=academics&info=duplicate');
}
else {
$query="INSERT INTO class (class_name,class_for,class_status,capacity,girls,boys)
VALUES ('$cname','$class_for','$status','$capacity','0','0')";
echo $query;
$result=mysqli_query($con1,$query) or die(mysqli_error($con1));

header('location: /sms/index.php?view=academics&info=success');
}

}

//give success message

?>