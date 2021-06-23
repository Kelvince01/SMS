<script>function addClassValidation(){

if((document.frmaddClass.subject_name.value=="")||(document.frmaddClass.subject_name.value==null))
	{
		alert("*Please enter subject name*");
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
<td width="100%" valign="top">
<br>
<p> <h2 class="title">Add New Subject Here</h2>


		<form action="/sms/index.php?view=process_addsubject" method="post" name="frmaddClass" id="frmaddClass"  enctype="multipart/form-data">
    <table width="550" border="0"  cellpadding="5" cellspacing="1" class="entryTable">
        <tr class="entryTableHeader">
            <td colspan="2">Subject Details</td>
        </tr>
		<tr>
            <td width="150" class="label">Subject Name</td>
            <td class="content"><input name="subject_name" type="text" class="box" value = "" id="subject_name" size="30" maxlength="50"><span class="required" title="This field is required.">*</span></td>
        
		</tr>

		  <tr>
            <td width="150" class="label">Subject Group<span class="required" title="This field is required.">*</span></td>
			<td><select name="group" class="box" id="class_for">
			 <option value="" selected>-.- Select -.-</option>
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
			 <option value="" selected>-.- Select -.-</option>
			<option value="1">Languages</option>
			<option value="2">Sciences</option>
			<option value="3">Humanities</option>
			<option value="4">Technicals</option>
		   </select></td>
						</tr>
			<tr>
            <td width="150" class="label">KNEC Code</td>
            <td class="content"><input name="knec_code" type="text" class="box" value = "" id="lname" size="30" maxlength="50"><span class="required" title="This field is required.">*</span><div id="knec_code"></div></td>
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