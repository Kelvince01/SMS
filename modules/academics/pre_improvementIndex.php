<td width="80%" valign="top">
<?php
?>
<p> <h2 class="title">Select appropriate details here</h2>


		<form action="/sms/index.php?view=class_analysis" method="post" name="frmStdDetails" id="frmStdDetails">
		<br>
    <table width="550" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
            <tr class="entryTableHeader">
            <td colspan="2"> Select your preferences </td>
        </tr>
            <tr><td width="150" class="label">Class</td>
			<td><select name="class_name" class="box" id="class_name">
			 <option value="" selected>-.- Select -.-</option>
			<option value="Form 1">Form One</option>
			<option value="Form 2">Form Two</option>
			<option value="Form 3">Form Three</option>
			<option value="Form 4">Form Four</option>
		   </select></td>
						</tr>
			<tr><td width="150" class="label">Term</td>
			<td><select name="term_name" class="box" id="term_name">
			 <option value="" selected>-.- Select -.-</option>
			<option value="Term 1">Term One</option>
			<option value="Term 2">Term Two</option>
			<option value="Term 2">Term Three</option>
			
		   </select></td>
						</tr>
			<tr><td width="150" class="label">Year</td>
			<td><select name="year_name" class="box" id="year_name">
			 <option value="" selected>-.- Select -.-</option>
			<option value="2010">2010</option>
			<option value="2011">2011</option>
			<option value="2012">2012</option>
			
		   </select></td>
						</tr>			
        
		<tr>
		<td height="43">&nbsp;</td>
		<td>
		<p align="left">
        <input name="save" type="submit" id="save" value="Generate Analysis">
    </p>
	</td>
	</tr>
    </table>
</form>
</p>
</td>

