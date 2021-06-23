
<td width="100%" valign="top">
<br>
 <h2 class="title">Set Exam Marking Period</h2>


		<form action="" method="post" name="frmaddteacher" id="frmaddteacher"  enctype="multipart/form-data">
    <table width="550" border="0"  cellpadding="5" cellspacing="1" class="entryTable">
        <tr class="entryTableHeader">
            <td colspan="2">Teacher Details</td>
        </tr>
        <tr>
            <td width="150" class="label">Exam</td>
            <td class="content"><select name="exam_id" class="box" id="exam_id">
            <?php
            $query1= "SELECT * FROM  exams";
            $result = mysqli_query($con1,$query1) or die(mysqli_error($con1));
            while($nt=mysqli_fetch_array($result)){//Array or records stored in $nt
            echo "<option value=$nt[exam_id]>$nt[exam_code]</option>";
            /* Option values are added by looping through the array */ 
            } ?>           
           </select></td>
        </tr>
		 <tr>
            <td width="150" class="label">Marking Starts</td>
            <td class="content"><input name="date_from" type="text" class="box" id="datepicker" size="30" maxlength="50" required><span class="required" title="required.">*</span><div id="exam_name"></div></td>
        </tr>
         <tr>
            <td width="150" class="label">Marking Ends</td>
            <td class="content"><input name="date_to" type="text" class="box" id="datepicker2" size="30" maxlength="50" required><span class="required" title="required.">*</span><div id="exam_name"></div></td>
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

</td>
<?php
if(isset($_POST['save'])){
 $sql_period="SELECT term_id from term_period where active='1'";
$result_period=mysqli_fetch_assoc(mysqli_query($con1,$sql_period));
  extract($result_period);
  extract ($_POST);
  $sql="select * from marking_periods where exam_id ='$exam_id' and term_id='$term_id' limit 1";
$re=mysqli_query($con1,$sql);
if(mysqli_num_rows($re) > 0) {
    $query="UPDATE marking_periods set date_from ='$date_from',date_to='$date_to' WHERE exam_id='$exam_id' AND term_id='$term_id'";
    mysqli_query($con1,$query) or die (mysqli_error($con1));
    echo'<script>window.location=" /sms/index.php?info=success&view=add_subject_allocation#tabs-3"</script>';
}else{

	$query="INSERT INTO marking_periods (exam_id,term_id,date_from,date_to)
	VALUES ('$exam_id','$term_id','$date_from','$date_to')";
	mysqli_query($con1,$query) or die (mysqli_error($con1));
//header('location:/sms/index.php?info=success&view=admissions#tabs-3');	
echo'<script>window.location=" /sms/index.php?info=success&view=add_subject_allocation#tabs-3"</script>';
}
}
?>  


