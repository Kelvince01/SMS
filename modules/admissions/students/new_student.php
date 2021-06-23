
<p> <h2 class="title">Add New Student Here</h2>


		<form action="/sms/index.php?view=add_student" method="post" name="frmStdDetails" id="frmStdDetails"  enctype="multipart/form-data">
    <table width="550" border="0"  cellpadding="5" cellspacing="1" class="entryTable">
      
	  <tr class="entryTableHeader">
	  
            <td colspan="4">Student Details</td>
        </tr>
		<tr>
            <td width="150" class="label">Surname</td>
            <td class="content"><input name="fname" type="text" class="box" id="fname" size="30" maxlength="50"  required><span class="required" >*</span></td>
             <td width="150" class="label">First Name</td>
            <td class="content"><input name="mname" type="text" class="box" id="fname" size="30" maxlength="50"  required><span class="required" >*</span></td>
        </tr>
		<tr>
            <td width="150" class="label">Middle Name</td>
            <td class="content"><input name="lname" type="text" class="box" id="lname" size="30" maxlength="50"><div id="lname"></div></td>
            <td width="150" class="label">Admission No</td>
            <td class="content"><input name="adminNo" type="text" class="box" id="adminNo" size="30" maxlength="50" required><span class="required" >*</span></td>
        </tr>
		<tr>
            <td width="150" class="label">Gender</td>
			<td><select name="gender" class="box" id="gender" required>
			 <option value="" selected>-.- Select -.-</option>
			<option value="male">Male</option>
			<option value="female">Female</option>
		   </select><span class="required">*</span></td>
            <td width="150" class="label">Date of Birth</td>
            <td class="content"><input name="dob" type="text" class="box" id="datepicker" size="30" maxlength="50" required><span class="required" >*</span></td>
        </tr>
		<tr>
            <td width="150" class="label">Family Status</td>
			<td><select name="family_status" class="box" id="family_status" required>
			 <option value="" selected>-.- Select -.-</option>
			<option id="2" value="single_parent">Single Parent</option>
			<option value="both_alive">Both Parents Alive</option>
			<option value="orphaned">Orphaned</option>
		   </select><span class="required">*</span></td>
            <td width="150" class="label">Passport Photo</td>
            <td class="content"><input name="student_photo" type="file" class="box" size="30" maxlength="50"></td>
        </tr>
		
        <tr class="entryTableHeader">
            <td colspan="4">Parents/Guardian Details</td>
        </tr>
		<tr>
            <td width="150" class="label">Surname</td>
            <td class="content"><input name="pfname" type="text" class="box"  id="shares" size="30" maxlength="50" required><span class="required" >*</span></td>
            <td width="150" class="label">First Name</td>
            <td class="content"><input name="pmname" type="text" class="box" id="shares" size="30" maxlength="50" required><span class="required" >*</span></td>
        </tr>
		<tr>
            <td width="150" class="label">Last Name</td>
            <td class="content"><input name="plname" type="text" class="box" id="shares" size="30" maxlength="50"></td>
            <td width="150" class="label">Other Names</td>
            <td class="content"><input name="pother" type="text" class="box"  id="shares" size="30" maxlength="50"></td>
        </tr>
		<tr>
            <td width="150" class="label">Marital Status</td>
			<td><select name="pmarital_status" class="box" id="pmarital_status" required>
			 <option value="" selected>-.- Select -.-</option>
			<option value="single"  >Single</option>
			<option value="married">Married</option>
			<option value="divorced">Divorced</option>
		   </select><span class="required">*</span></td>
             </tr>
		<tr id="hi">
            <td width="150" class="label">Spouse Name</td>
            <td class="content"><input name="spouse_name" type="text" class="box" id="spouse_name" size="30" maxlength="50" ><span class="required" >*</span></td>
            <td width="150"  class="label">Spouse Occupation</td>
            <td class="content" ><input name="spouse_occupation" type="text" class="box" id="spouse_occupation" size="30" maxlength="50"></td>
        </tr>
		<tr>
            <td width="150" class="label">Occupation</td>
            <td class="content"><input name="occupation" type="text" class="box" id="occupation" size="30" maxlength="50"></td>
        </tr><span id="sp"></span>

</div>
		<tr class="entryTableHeader">
            <td colspan="4">Parents/Guardian Contact Details</td>
        </tr>
        <tr>
            <td width="150" class="label">Phone No</td>
            <td class="content"><input name="phone_no" type="text" class="box" id="phone_no" size="30" maxlength="15" required><span class="required" >*</span></td>
            <td width="150" class="label">Postal Address</td>
            <td class="content"><input name="postal_address" type="text" class="box" value = "" id="poastal_address" size="30" maxlength="50"><span class="required" >*</span></td>
        </tr>
		<tr>
            <td width="150" class="label">Email Address</td>
            <td class="content"><input name="email_address" type="text" class="box" value = "" id="email_address" size="30" maxlength="50" required><span class="required" >*</span></td>
            <td width="150" class="label">Area of Residence</td>
            <td class="content"><input name="residence" type="text" class="box" value = "" id="residence" size="30" maxlength="50" required><span class="required" >*</span></td>
        </tr>
        <tr>
            <td width="150" class="label">Preferred Contact Method</td>
			<td><select name="contact" class="box" id="contact" required>
			 <option value="" selected>-.- Select -.-</option>
			<option value="sms">SMS</option>
			<option value="email">Email</option>
			<option value="postal_letter">Postal Letter</option>
		   </select><span class="required" >*</span></td>
             </tr>
			 <tr class="entryTableHeader">
            <td colspan="4">Student Medical Details</td>
        </tr>
         <tr>
            <td width="150" class="label">Medical Condition</td>
            <td class="content"><input name="medical_condition" type="text" class="box"  id="medical_condition" size="30" maxlength="50"></td>
            <td width="150" class="label">Special Diet</td>
			<td><select name="special_diet" class="box" id="special_diet">
			 <option value="" selected>-.- Select -.-</option>
			<option value="yes">Yes</option>
			<option value="no">No</option>
		   </select></td>
            </tr>
        <tr class="entryTableHeader">
            <td colspan="4">System Parameters</td>
        </tr>
          <tr>
            <td width="150" class="label">Student Active</td>
			<td><select name="student_active" class="box" id="student_active" required>
			 <option value="" selected>-.- Select -.-</option>
			<option value="1">Yes</option>
			<option value="0">No</option>
		   </select><span class="required" >*</span></td>
            <td width="150" class="label">Student Status</td>
			<td><select name="student_status" class="box" id="student_status" required>
			 <option value="" selected>-.- Select -.-</option>
			<option value="Fresh Admission">Fresh Admission</option>
			<option value="transfer">Transfer</option>
			<option value="suspension">Re-admission after Suspension</option>
			<option value="expulsion">Re-admission after Expulsion</option>
			<option value="expulsion">Registration of existing Students</option>

		   </select><span class="required" >*</span></td>
                </tr>	
				 <tr>
            <td width="150" class="label">Year of Admission</td>
            <td class="content"><input name="admission_year" type="text" class="box" id="admission_year" size="30" maxlength="50" required><span class="required" >*</span></td>
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
	</div>
    </table>
</form>
 <p>&nbsp;</p>

</p>