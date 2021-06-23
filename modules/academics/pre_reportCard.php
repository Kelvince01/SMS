<td width="100%" valign="top">
<br>
<p> <h2 class="title">Specify student here</h2>

	     <?php 
	if ($_SESSION['User_type']=="admin" || $_SESSION['User_type']=="super_admin" || $_SESSION['User_type']=="teacher" ){ ?>
		<form method="post" action ="/sms/modules/academics/transcripall.php" target="_blank" >
<div>Print By Class: <select name ="class_name" onchange="this.form.submit()">
<?php
$query1= " SELECT distinct class_name FROM class";
	$result = mysqli_query($con1,$query1);
	while($row=mysqli_fetch_array($result)){
		echo "<option selected>".$row['class_name']."</option>";
		}
?>
</select></div>
</form>
		<?php }?>

<?php	
	if ($_SESSION['User_type']=="student"){ 
	$query1= " SELECT concat(fname,' ',mname)as fullname,adminNo FROM student_details WHERE concat(fname,' ',mname) like'%".$_SESSION['full_name']."%' ";
	$result = mysqli_query($con1,$query1);
	$nt=mysqli_fetch_assoc($result);
	extract($nt);
?>
	
		<form action="/sms/modules/academics/transcript2.php?&adminNo=<?php echo $adminNo;?>" method="post" name="frmStdDetails" id="frmStdDetails">
		<?php }
	if ($_SESSION['User_type']!="student"){ ?>
		<form action="/sms/modules/academics/transcript.php" target="_blank" method="post" name="frmStdDetails" id="frmStdDetails">
		<?php }?>	
		<br>
    <table width="200" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
  
		<tr class="entryTableHeader">
            <td colspan="2">Student Details</td>
        </tr>
	<?php	
	if ($_SESSION['User_type']=="student"){ 
	
	?>
            <tr>
            <td width="150" class="label">Student AdminNo</td>
            <td class="content"><?php echo $adminNo;?></td>
        </tr>
      <?php }  
		
	else{ ?>
		<tr>
            <td width="150" class="label">Student AdminNo</td>
            <td class="content"><input name="adminNo" type="text" class="box" maxlength="4" value = "" ><span class="required" title="This field is required.">*</span></td>
        </tr>
<?php	}?>	
		<tr>
		<td height="43">&nbsp;</td>
		<td>
		<p align="left">
        <input name="save" type="submit" id="save" value="Continue">
    </p>
	</td>
	</tr>
    </table>
</form>
</p>
</td>