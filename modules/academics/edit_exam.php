<script>function addClassValidation(){

if((document.frmaddClass.exam_name.value=="")||(document.frmaddClass.exam_name.value==null))
	{
		document.getElementById("exam_name").innerHTML=("*Please enter exam name*");
		document.frmaddClass.exam_name.focus();
        return false;
	}	
if((document.frmaddClass.total_marks.value=="")||(document.frmaddClass.total_marks.value==null))
	{
		document.getElementById("exam_name").innerHTML=("*Please enter total marks*");
		document.frmaddClass.total_marks.focus();
        return false;
	}

	
}

	</script>
<?php
$exam_id=$_GET['exam_id'];
extract ($_POST);	
//echo $exam_id;

$sql = "Select * FROM exams where exam_id='$exam_id' ";
$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));
			
while($row = mysqli_fetch_assoc($result)) {
extract($row);
//echo $exam_type;

?>	
<td width="100%" valign="top">
<br>
<p> <h2 class="title">Add New Exam Here</h2>


		<form action="/sms/index.php?&exam_id=<?php echo $exam_id;?>&view=process_editExam" method="post" name="frmaddClass" id="frmaddClass"  enctype="multipart/form-data">
    <table width="550" border="0"  cellpadding="5" cellspacing="1" class="entryTable">
        <tr class="entryTableHeader">
            <td colspan="2">Exam Details</td>
        </tr>
		<tr>
            <td width="150" class="label">Exam Name</td>
            <td class="content"><input name="exam_name" type="text" class="box" value = "<?php echo $exam_type;?>" id="subject_name" size="30" maxlength="50"><span class="required" title="required.">*</span><div id="exam_name"></div></td>
        </tr>
       <tr>
            <td width="150" class="label">Total Marks</td>
            <td class="content"><input name="total_marks" type="text" class="box" value = "<?php echo $total_marks;?>" id="total_marks" size="30" maxlength="50"><span class="required" title="This field is required.">*</span><div id="total_marks"></div></td>
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