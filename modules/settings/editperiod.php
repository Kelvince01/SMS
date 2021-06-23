
	<?php
$id=$_GET['term_id'];
extract ($_POST);	
//echo $exam_id;

$sql = "Select * FROM term_period where term_id= $id ";
$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));
			
while($row = mysqli_fetch_assoc($result)) {
extract($row);
//echo $exam_type;

?>	
<td width="100%" valign="top">
<br>
<p> <h2 class="title">Edit Period Details</h2>


		<form action="" method="post" name="frmaddClass" id="frmaddClass"  enctype="multipart/form-data">
    <table width="550" border="0"  cellpadding="5" cellspacing="1" class="entryTable">
        <tr class="entryTableHeader">
            <td colspan="2">Period Details</td>
        </tr>
		  <tr>
            <td width="150" class="label">Term Name</td>
			<td><select name="term_name" class="box" id="term_name">
			 <?php echo "<option selected>$row[term_name]</option>";?>
			<option value="Term 1">Term 1</option>
			<option value="Term 2">Term 2</option>
			<option value="Term 3">Term 3</option>
		   </select></td>
						</tr>

			<tr>
            <td width="150" class="label">Year</td>
            <td class="content"><input name="year" type="text" class="box" value = "<?php echo $year_name;?>" id="year" size="30" maxlength="50"><span class="required" title="This field is required.">*</span><div id="capacity"></div></td>
        </tr>
		<tr>
            <td width="150" class="label">Active</td>
			<td><select name="active" class="box" id="active">
		    <option selected><?php if($row['active']==0){echo "No";}else{echo "Yes";} ?></option>
			<option value="1">Yes</option>
			<option value="0">No</option>
		         </select></td>
		</tr>
		<tr>
            <td width="150" class="label">Start Date</td>
            <td class="content"><input name="start_date" type="text" class="box" value = "<?php echo $start_date;?>" id="datepicker" size="30" maxlength="50"><span class="required" title="This field is required.">*</span><div id="capacity"></div></td>
        </tr>
        <tr>
            <td width="150" class="label">End Date</td>
            <td class="content"><input name="end_date" type="text" class="box" value = "<?php echo $end_date;?>" id="datepicker2" size="30" maxlength="50"><span class="required" title="This field is required.">*</span><div id="capacity"></div></td>
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
<?php 
}
?>
 <p>&nbsp;</p>

</p>
</td>
<script>function addClassValidation(){

if((document.frmaddClass.tname.value=="")||(document.frmaddClass.tname.value==null))
	{
		document.getElementById("Period").innerHTML=("*Please enter Term name*");
		document.frmaddClass.tname.focus();
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
<?php 
if(isset($_POST['save'])){
    extract ($_POST);
    if($active=="1"){
$sql="update term_period set active= 0 where active= 1"; 
$result=mysqli_query($con1,$sql) or die(mysqli_error($con1));
    }
$sql="update term_period set term_name ='$term_name',year_name='$year_name',active='$active',start_date='$start_date',end_date='$end_date'
 where term_id='$term_id'";
$result=mysqli_query($con1,$sql) or die(mysqli_error($con1));

echo'<script>window.location=" /sms/index.php?info=edited&view=settings"</script>';
}
?>  