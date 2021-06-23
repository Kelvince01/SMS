<p> <h2 class="title">Record additional Student Details</h2>


		<form action="/sms/index.php?view=process_add_moreinfo" method="post" name="frmStdDetails" id="frmStdDetails"  enctype="multipart/form-data">
    <table width="550" border="0" cellpadding="5" cellspacing="1" class="entryTable">
	<tr><td><select name="student_name">
         <?php
		
		 //get the student who was recently added and do not have a class yet
	$query1="SELECT stud_id, fname, mname, lname FROM student_details WHERE stud_id NOT IN (SELECT stud_id FROM kcpe_marks) ";
	$result1=mysqli_query($con1,$query1);
	$rowArray=array();
	$rowId=2;
	while($row1=mysqli_fetch_array($result1)){
		$rowArray[$rowId]=$row1['fname'].' '.$row1['mname'].' '.$row1['lname'];
		//$rowId=$rowId+1;
    //	$rowArray=getArray();
		echo "<option selected>".$rowArray[2]."</option>";
		for($index=100;$index<=count($rowArray);$index++){
			echo "<option>".$rowArray[$index]."</option>";
		}
    }
	?>
</select></td></tr>
        <tr class="entryTableHeader">
            <td colspan="2">Primary School Information</td>
        </tr>
		<tr>
            <td width="150" class="label">Primary School Name</td>
            <td class="content"><input name="pname" type="text" class="box" value = "" id="pname" size="30" maxlength="50" required></td>
        </tr>

		        <tr>
            <td width="150" class="label">K.C.P.E Index No.</td>
            <td class="content"><input name="index_no" type="text" class="box" value = "" id="index_no" size="30" maxlength="50" required><span class="" title="This field is required.">*</span></td>
        </tr>

			<tr>
            <td width="150" class="label">K.C.P.E Marks</td>
            <td class="content"><input name="kcpe_marks" type="text" class="box" value = "" id="kcpe_marks" size="30" maxlength="50" required><span class="" title="This field is required.">*</span></td>
        </tr>
		<tr>
            <td width="150" class="label">K.C.P.E Subjects</td>
            <td class="content"><input name="kcpe_subjects" type="text" class="box" value = "" id="kcpe_marks" size="30" maxlength="50" required><span class="" title="This field is required.">*</span></td>
        </tr>
			<tr>
            <td width="150" class="label">K.C.P.E Year</td>
            <td class="content"><input name="kcpe_year" type="text" class="box" value = "" id="kcpe_year" size="30" maxlength="50" required><span class="" title="This field is required.">*</span></td>
        </tr>
        <tr class="entryTableHeader">
            <td colspan="2">K.C.P.E Subject Marks</td>
        </tr>
		<tr>
            <td width="150" class="label">English</td>
            <td class="content"><input name="english_mark" type="text" class="box" value = "" onKeyUp="checkNumber(this);" id="shares" size="30" maxlength="50"><span class="" title="This field is required.">*</span></td>
        </tr>
		<tr>
            <td width="150" class="label">Kiswahili</td>
            <td class="content"><input name="kiswahili_mark" type="text" class="box" value = "" onKeyUp="checkNumber(this);" id="shares" size="30" maxlength="50" required><span class="" title="This field is required.">*</span></td>
        </tr>
		<tr>
            <td width="150" class="label">Mathematics</td>
            <td class="content"><input name="maths_mark" type="text" class="box" value = "" onKeyUp="checkNumber(this);" id="shares" size="30" maxlength="50" required><span class="" title="This field is required.">*</span></td>
        </tr>
		<tr>
            <td width="150" class="label">Science</td>
            <td class="content"><input name="science_mark" type="text" class="box" value = "" onKeyUp="checkNumber(this);" id="shares" size="30" maxlength="50" required><span class="" title="This field is required.">*</span></td>
        </tr>
		<tr>
            <td width="150" class="label">Social Studies</td>
            <td class="content"><input name="socialstudies_mark" type="text" class="box" value = "" onKeyUp="checkNumber(this);" id="shares" size="30" maxlength="50" required><span class="" title="This field is required.">*</span></td>
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



