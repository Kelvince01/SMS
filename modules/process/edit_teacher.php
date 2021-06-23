
<td width="100%" valign="top">
<br>
<?php
$teacher_id=$_GET['teacher_id'];
//extract ($_POST);   
//echo $exam_id;

$sql = "Select * FROM teacher where teacher_id='$teacher_id' ";
$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));
            
while($row = mysqli_fetch_assoc($result)) {
extract($row);
//echo $exam_type;

?>  
 <h2 class="title">Edit Teacher Details</h2>


		<form action="" method="post" name="frmaddteacher" id="frmaddteacher"  enctype="multipart/form-data">
    <table width="550" border="0"  cellpadding="5" cellspacing="1" class="entryTable">
        <tr class="entryTableHeader">
            <td colspan="2">Teacher Details</td>
        </tr>
        <tr>
            <td width="150" class="label">Teacher Name</td>
            <td class="content"><input name="teacher_name" type="text" class="box" id="teacher_name" value = "<?php echo $teacher_name;?>" size="30" maxlength="50" required><span class="required" title="required.">*</span><div id="exam_name"></div></td>
        </tr>
		 <tr>
            <td width="150" class="label">TSC No</td>
            <td class="content"><input name="tscNo" type="text" class="box" id="tscNo" value = "<?php echo $tscNo;?>" size="30" maxlength="50" required><span class="required" title="required.">*</span><div id="exam_name"></div></td>
        </tr>
         <tr>
            <td width="150" class="label">Initials</td>
            <td class="content"><input name="intials" type="text" class="box" id="intials" value = "<?php echo $intials;?>" size="30" maxlength="50" required><span class="required" title="required.">*</span><div id="exam_name"></div></td>
        </tr>
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
 <?php }?>

</td>
<?php 
if(isset($_POST['save'])){
    extract ($_POST);
$sql="update teacher set teacher_name ='$teacher_name',tscNo='$tscNo',intials='$intials'
 where teacher_id='$teacher_id'"; 
$result=mysqli_query($con1,$sql) or die(mysqli_error($con1));

echo'<script>window.location=" /sms/index.php?info=edited&view=teacher"</script>';
}
?>  



