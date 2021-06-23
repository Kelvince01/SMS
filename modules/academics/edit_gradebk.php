<?php
$gradebk_id= $_GET['gradebk_id'];
extract ($_POST);
// Insert class Details
$sql = "SELECT * from gradebk where gradebk_id='$gradebk_id'";

//break;
$result=mysqli_query($con1,$sql)or die(mysqli_error($con1));
			
while($row = mysqli_fetch_assoc($result)) {
extract($row);
$code=explode('_',$gradebk);
$termname1=$code[2];
$year1=$code[3];
$sql_subject="SELECT subject_name from subject where subject_id='$subject_id'";
$result_subject=mysqli_fetch_assoc(mysqli_query($con1,$sql_subject));
extract($result_subject);
//select class details
$sql_class="SELECT class_name from class where class_id='$class_id'";
$result_class=mysqli_fetch_assoc(mysqli_query($con1,$sql_class));
extract($result_class);

?>	
<td width="100%" valign="top">
<br>
<p> <h2 class="title">Edit Mark Book Here</h2>


		<form action="/sms/index.php?&gradebk_id=<?php echo $gradebk_id; ?>&view=edit_gradebk_process" method="post" name="frmaddClass" id="frmaddClass"  enctype="multipart/form-data">
    <table width="550" border="0"  cellpadding="5" cellspacing="1" class="entryTable">
        <tr class="entryTableHeader">
            <td colspan="2">Mark Book Details</td>
        </tr>
		<tr>
            <td width="150" class="label">Exam Name</td>
            <td><select name="subject2" class="box" id="subject_id">
			 <?php 			
				$query1="Select * FROM subject where subject_id <>'$subject_id' ORDER by subject_id ASC ";
				$result = mysqli_query($con1,$query1);
				// printing the list box select command
					echo "<option selected>$result_subject[subject_name]</option>/n";
				while($nt=mysqli_fetch_array($result)){//Array or records stored in $nt
					echo "<option value=$nt[subject_id]>$nt[subject_name]</option>";
					/* Option values are added by looping through the array */
				}
				// Closing of list box
				?>
		   </select></td>
	
        </tr> 
       <tr><td width="150" class="label">Class</td>
			<td><select name="class2" class="box" id="class_id">
			 
			<?php 
				
				$query1="Select * FROM class where class_id <>'$class_id'ORDER by class_id ASC ";
				$result = mysqli_query($con1,$query1);
				// printing the list box select command
					echo "<option selected>$result_class[class_name]</option>/n";
				while($nt=mysqli_fetch_array($result)){//Array or records stored in $nt
					echo "<option value=$nt[class_id]>$nt[class_name]</option>";
					/* Option values are added by looping through the array */
				}
				// Closing of list box
				?>
		   </select></td>
			</tr>
			<tr><td width="150" class="label">Term</td>
			<td><select name="term_name2" class="box" id="term_name2">
			 <option selected><?php echo $termname1;?></option>
			 <option value='Term 1'>Term 1</option>
			 <option value='Term 2'>Term 2</option>
			 <option value='Term 3'>Term 3</option>
			
		   </select></td>
			</tr>
			<tr><td width="150" class="label">Year</td>
			<td><select name="year2" class="box" id="year2">
			 
			<?php 
				
				$query1="Select distinct(year_name) FROM  term_period where year_name <> '$year1'ORDER by year_name ASC ";
				$result = mysqli_query($con1,$query1);
				// printing the list box select command
                echo "<option seleted>$year1</option>/n";
				while($nt=mysqli_fetch_array($result)){//Array or records stored in $nt
					echo "<option value=$nt[year_name]>$nt[year_name]</option>";
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
<?php }?>