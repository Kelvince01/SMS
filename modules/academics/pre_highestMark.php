<td width="80%" valign="top">
<?php
?>
<p> <h2 class="title">Select appropriate details here</h2>


		<form action="/sms/index.php?view=highest_mark" method="post" name="frmStdDetails" id="frmStdDetails">
		<br>
    <table width="550" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
            <tr class="entryTableHeader">
            <td colspan="2"> Select your preferences </td>
        </tr>
            <tr><td width="150" class="label">Class</td>
			<td><select name="class_name" class="box" id="class_name">
			  <?php
            $query1= "SELECT class_name FROM class where class_status=1";
            $result = mysqli_query($con,$query1) or die(mysqli_error($con));
            while($nt=mysqli_fetch_array($result)){//Array or records stored in $nt
            echo "<option>$nt[class_name]</option>";
            /* Option values are added by looping through the array */
            } ?>           
           </select></td>
						</tr>
			<tr><td width="150" class="label">Term</td>
			<td><select name="term_name" class="box" id="term_name">
			 <option value="" selected>-.- Select -.-</option>
			<option value="Term 1">Term One</option>
			<option value="Term 2">Term Two</option>
			<option value="Term 3">Term Three</option>
			
		   </select></td>
						</tr>
			<tr><td width="150" class="label">Year</td>
			<td><input type="text" name="year_name" class="box" id="yearpicker"></td>
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

