<script>function addClassValidation(){

if((document.frmaddClass.subject_name.value=="")||(document.frmaddClass.subject_name.value==null))
	{
		alert("*Please enter classname*");
		document.frmaddClass.subject_name.focus();
        return false;
	}
if((document.frmaddClass.knec_code.value=="")||(document.frmaddClass.knec_code.value==null))
	{
		document.getElementById("knec_code").innerHTML=("*Please enter knec_code*");
		document.frmaddClass.knec_code.focus();
        return false;
	}	
	
}

	</script>
<?php

$subject_id= $_GET['subject_id'];				
$sql = "SELECT subject.*, subject_name, group_name, department FROM subject, subject_group, departments WHERE 
        subject.group_id=subject_group.group_id and subject.department_id=departments.department_id AND  `subject_id` =  '$subject_id' ";
//echo $sql;
//break;
		$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));

while($row = mysqli_fetch_assoc($result)) {
extract($row);?>
<td width="100%" valign="top">
<br>
<p> <h2 class="title">Edit Subject Here</h2>


		<form action="/sms/index.php?&subject_id=<?php echo $subject_id;?>&view=process_editSubject" method="post" name="frmaddClass" id="frmaddClass"  enctype="multipart/form-data">
    <table width="550" border="0"  cellpadding="5" cellspacing="1" class="entryTable">
        <tr class="entryTableHeader">
            <td colspan="2">Subject Details</td>
        </tr>
		<tr>
            <td width="150" class="label">Subject Name</td>
            <td class="content"><input name="subject_name" type="text" class="box" value = "<?php echo $subject_name?>" id="subject_name" size="30" maxlength="50"><span class="required" title="This field is required.">*</span><div id="subject_name"></div></td>
        </tr>

		  <tr>
            <td width="150" class="label">Subject Group<span class="required" title="This field is required.">*</span></td>
			<td><select name="group_id" class="box" id="class_for">
			<?php
			$active_val  =$group_id;
			 if($active_val == 1){
			   $active_char = 'GROUP I';
			 }elseif($active_val == 2){
			 $active_char = 'GROUP II';
			 }elseif($active_val == 3){
			 $active_char = 'GROUP III';
			 }else{
			 $active_char = 'GROUP IV';
			 }
			 echo '<option value="'.$active_val.'">'.$active_char.'</option>';
			
			?>
			
			<option value="1">GROUP I</option>
			<option value="2">GROUP II</option>
			<option value="3">GROUP III</option>
			<option value="4">GROUP IV</option>
			<option value="5">GROUP V</option>
		   </select></td>
						</tr>
        <tr>
            <td width="150" class="label">Department<span class="required" title="This field is required.">*</span></td>
			<td><select name="department" class="box" id="class_for">
			<?php
			$active_val  =$department;
			 if($active_val == 1){
			   $active_char = 'Languages';
			 }elseif($active_val == 2){
			 $active_char = 'Sciences';
			 }elseif($active_val == 3){
			 $active_char = 'Humanities';
			 }else{
			 $active_char = 'Technicals';
			 }
			 echo '<option value="'.$active_val.'">'.$active_char.'</option>';
			
			?>
			<option value="1">Languages</option>
			<option value="2">Sciences</option>
			<option value="3">Humanities</option>
			<option value="4">Technicals</option>
		   </select></td>
						</tr>
			<tr>
            <td width="150" class="label">KNEC Code</td>
            <td class="content"><input name="knec_code" type="text" class="box" value = "<?php echo $code_id?>" id="lname" size="30" maxlength="50"><span class="required" title="This field is required.">*</span><div id="knec_code"></div></td>
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
<?php } ?>