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
<?php
$grade_id= $_GET['grade_id'];
extract ($_POST);
// Insert class Details
$sql = "Select * FROM grades where grade_id='$grade_id'";

//break;
$result=mysqli_query($con1,$sql)or die(mysqli_error($con1));
			
while($row = mysqli_fetch_assoc($result)) {
extract($row);


?>	
	
	<td width="100%" valign="top">
<br>
<p> <h2 class="title">Add New Grade Here</h2>


		<form action="/sms/index.php?&grade_id=<?php echo $grade_id;?>&view=process_editGrade" method="post" name="frmaddClass" id="frmaddClass"  enctype="multipart/form-data">
    <table width="550" border="0"  cellpadding="5" cellspacing="1" class="entryTable">
        <tr class="entryTableHeader">
            <td colspan="2">Grade Details</td>
        </tr>
		<tr>
            <td width="150" class="label">Grade Letter</td>
            <td class="content"><input name="grade_letter" type="text" class="box" value = "<?php echo $grade;?>" id="subject_name" size="30" maxlength="50"><span class="required" title="This field is required.">*</span><div id="grade_letter"></div></td>
        </tr>
       <tr>
            <td width="150" class="label">Lower Mark</td>
            <td class="content"><input name="lower_mark" type="text" class="box" value = "<?php echo $min_mark;?>" id="subject_name" size="30" maxlength="50"><span class="required" title="This field is required.">*</span><div id="lower_mark"></div></td>
        </tr>
		<tr>
            <td width="150" class="label">Upper Mark</td>
            <td class="content"><input name="upper_mark" type="text" class="box" value = "<?php echo $max_mark;?>" id="subject_name" size="30" maxlength="50"><span class="required" title="This field is required.">*</span><div id="upper_mark"></div></td>
        </tr>
		  <tr>
            <td width="150" class="label">Grade Comments</td>
            <td class="content"><input name="grade_comments" type="text" class="box" value = "<?php echo $grade_comment;?>" id="subject_name" size="50" maxlength="50"><span class="required" title="This field is required.">*</span><div id="grade_comments"></div></td>
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
<?php }?>