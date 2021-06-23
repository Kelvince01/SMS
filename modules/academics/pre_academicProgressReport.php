<td width="100%" valign="top">
<br>
<p> <h2 class="title">Specify student here</h2>
    <?php	
	if ($_SESSION['User_type']=="student"){ 
	$query1= " SELECT concat(fname,' ',mname)as fullname,adminNo FROM student_details WHERE concat(fname,' ',mname) like'%".$_SESSION['full_name']."%' ";
	
	$result = mysqli_query($con1,$query1);
			// printing the list box select command

			$nt=mysqli_fetch_assoc($result);
	extract($nt);
	//echo $adminNo;
	
	?>
		<form action="/sms/modules/academics/academicProgess_report2.php?&adminNo=<?php echo $adminNo;?>" method="post" name="frmStdDetails" id="frmStdDetails">
		
			<?php }
	if ($_SESSION['User_type']!="student"){ ?>
		<form action="/sms/modules/academics/academicProgess_report.php" method="post" name="frmStdDetails" target ="_blank" id="frmStdDetails">
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