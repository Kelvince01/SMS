<td width="100%" valign="top">
<br>
<p> <h2 class="title">Add New Mark Book Here</h2>


		<form action="/sms/index.php?view=process_addgradeBk" method="post" name="frmaddClass" id="frmaddClass"  enctype="multipart/form-data">
    <table width="550" border="0"  cellpadding="5" cellspacing="1" class="entryTable">
        <tr class="entryTableHeader">
            <td colspan="2">Mark Book Details</td>
        </tr>
		<tr>
            <td width="150" class="label">Exam Name</td>
            <td><select name="subject_id" class="box" id="subject_id">
			 <option value="" selected>-.- Select Subject -.-</option>
			<?php
			
				$query1="Select * FROM subject ORDER by subject_id ASC ";
				$result = mysqli_query($con1,$query1);
				// printing the list box select command

				while($nt=mysqli_fetch_array($result)){//Array or records stored in $nt
					echo "<option value=$nt[subject_id]>$nt[subject_name]</option>";
					/* Option values are added by looping through the array */
				}
				// Closing of list box
				?>
		   </select></td>
        </tr>
       <tr><td width="150" class="label">Class</td>
			<td><select name="class_id" class="box" id="class_id">
			 <option value="" selected>-.- Select Class -.-</option>
			<?php
			
				$query1="Select * FROM class ORDER by class_id ASC ";
				$result = mysqli_query($con1,$query1);
				// printing the list box select command

				while($nt=mysqli_fetch_array($result)){//Array or records stored in $nt
					echo "<option value=$nt[class_id]>$nt[class_name]</option>";
					/* Option values are added by looping through the array */
				}
				// Closing of list box
				?>
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
        <input name="save" type="submit" id="save" value="Save Details">
    </p>
	</td>
	</tr>
    </table>
</form>
 <p>&nbsp;</p>

</p>
</td>