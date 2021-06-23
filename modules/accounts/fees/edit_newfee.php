
	<?php
$id=$_GET['id'];
extract ($_POST);	

$sql = "Select fees_newstudent.*,t.term_name,t.year_name FROM  fees_newstudent inner join term_period t ON fees_newstudent.period_id =t.term_id WHERE id=$id ORDER BY  period_id ASC  ";
$result = mysqli_query($con1,$sql) or die(mysqli_error($con1));
			
while($row = mysqli_fetch_assoc($result)) {
extract($row);
?>	
<td width="100%" valign="top">
<br>
<p> <h2 class="title">Edit Student Fee MarkUp</h2>


		<form action="" method="post" name="frmaddClass" id="frmaddClass"  enctype="multipart/form-data">
    <table width="550" border="0"  cellpadding="5" cellspacing="1" class="entryTable">
        <tr class="entryTableHeader">
            <td colspan="2">Period Details</td>
        </tr>
		  <tr>
            <td width="150" class="label">Term Name</td>
			<td><input name="term_name"  class="box" value="<?php echo $term_name;?>" disabled="true">
			</td>
			</tr>

			<tr>
            <td width="150" class="label">Year</td>
            <td class="content"><input name="year" class="box" type="text" disabled="true" value = "<?php echo $year_name;?>" >
            </td>
        </tr>
		<tr>
            <td width="150" class="label">Uniform</td>
            <td class="content"><input name="uniform" type="text" class="box" value = "<?php echo $uniform;?>" ></td>
        </tr>
        <tr>
            <td width="150" class="label">Admission</td>
            <td class="content"><input name="admission" type="text" class="box" value = "<?php echo $admission;?>" ></td>
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
<?php 
}
?>
 <p>&nbsp;</p>

</p>
</td>

<?php 
if(isset($_POST['save'])){
    extract ($_POST);
$sql="update fees_newstudent set admission=$admission,uniform=$uniform where id= $id"; 
$result=mysqli_query($con1,$sql) or die(mysqli_error($con1));
echo'<script>window.location=" /sms/index.php?info=edited&view=newfee"</script>';
}
?>  