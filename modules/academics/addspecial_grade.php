<script>
function addClassValidation(){

if((document.frmaddClass.grade_letter.value=="")||(document.frmaddClass.grade_letter.value==null))
	{
		document.getElementById("grade_letter").innerHTML=("*Please enter grade letter*");
		document.frmaddClass.grade_letter.focus();
        return false;
	}
if((document.frmaddClass.lower_mark.value=="")||(document.frmaddClass.lower_mark.value==null))
	{
		document.getElementById("lower_mark").innerHTML=("*Please enter lower mark*");
		document.frmaddClass.lower_mark.focus();
        return false;
	}

if((document.frmaddClass.upper_mark.value=="")||(document.frmaddClass.upper_mark.value==null))
	{
		document.getElementById("upper_mark").innerHTML=("*Please enter upper mark*");
		document.frmaddClass.grade_letter.focus();
        return false;
	}
	
if((document.frmaddClass.grade_comments.value=="")||(document.frmaddClass.grade_comments.value==null))
	{
		document.getElementById("grade_comments").innerHTML=("*Please enter grade comments*");
		document.frmaddClass.grade_comments.focus();
        return false;
	}		
	
}
	</script>
	
	<td width="100%" valign="top">
<br>
<p> <h2 class="title">Add New Special Grade Here</h2>


		<form action="/sms/index.php?view=process_addGrade" method="post" name="frmaddClass" id="frmaddClass"  enctype="multipart/form-data">
    <table width="550" border="0"  cellpadding="5" cellspacing="1" class="entryTable">
        <tr class="entryTableHeader">
            <td colspan="2">Grade Details</td>
        </tr>
		<tr>
            <td width="150" class="label">Grade Letter</td>
            <td class="content"><input name="grade_letter" type="text" class="box" value = "" id="subject_name" size="30" maxlength="50"><span class="required" title="This field is required.">*</span><div id="grade_letter"></div></td>
        </tr>
       <tr>
            <td width="150" class="label">Lower Mark</td>
            <td class="content"><input name="lower_mark" type="text" class="box" value = "" id="subject_name" size="30" maxlength="50"><span class="required" title="This field is required.">*</span><div id="lower_mark"></div></td>
        </tr>
		<tr>
            <td width="150" class="label">Upper Mark</td>
            <td class="content"><input name="upper_mark" type="text" class="box" value = "" id="subject_name" size="30" maxlength="50"><span class="required" title="This field is required.">*</span><div id="upper_mark"></div></td>
        </tr>
		  <tr>
            <td width="150" class="label">Grade Comments</td>
            <td class="content"><input name="grade_comments" type="text" class="box" value = "" id="subject_name" size="50" maxlength="50"><span class="required" title="This field is required.">*</span><div id="grade_comments"></div></td>
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