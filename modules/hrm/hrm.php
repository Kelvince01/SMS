<?php
session_start();
include('../../connection/connect.php');

//require_once 'common.php';
//require_once 'load_factories.php';
//require_once 'library/config.php';
//require_once 'library/common.php';s=mysqli_fetch_array($execute);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>mySkulMate::Academics</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
<link type="text/css" href="/sms/datepicker/all.css" rel="stylesheet" />
<script src="../validation/scriptaculous/lib/prototype.js" type="text/javascript"></script>
<script src="../validation/scriptaculous/src/effects.js" type="text/javascript"></script>
<script type="text/javascript" src="../validation/fabtabulous.js"></script>
<script type="text/javascript" src="../validation/validation.js"></script>
<script type="text/javascript" src="/sms/datepicker/jquery.js"></script>
<script type="text/javascript" src="/sms/datepicker/core.js"></script>
<script type="text/javascript" src="/sms/datepicker/datepicker.js"></script>
<link rel="stylesheet" href="/sms/modules/admissions/jquery/development-bundle/themes/base/jquery.ui.all.css">
	<script src="/sms/modules/admissions/jquery/development-bundle/jquery-1.5.1.js"></script>
	<script src="/sms/modules/admissions/jquery/development-bundle/ui/jquery.ui.core.js"></script>
	<script src="/sms/modules/admissions/jquery/development-bundle/ui/jquery.ui.widget.js"></script>
	<script src="/sms/modules/admissions/jquery/development-bundle/ui/jquery.ui.tabs.js"></script>

	<script>
	$(function() {
		$( "#tabs" ).tabs();
	});
	</script>
	<SCRIPT TYPE="text/javascript">
<!--
function popup(mylink, windowname)
{
if (! window.focus)return true;
var href;
if (typeof(mylink) == 'string')
   href=mylink;
else
   href=mylink.href;
window.open(href, windowname, 'width=400,height=200,scrollbars=yes');
return false;
}
//-->
</SCRIPT>
</head>
<body>
<div id="wrap">

<div id="top"> </div>
<div id="contentt">
<div id="logo" align="center">
<img src="/sms/images/logo.png"/>

</div>
<!-- end header -->
<div class="left">
		 <?php
		include('user_menu.php');
		?>
	</div>


<div class="middle">
<div class="demo">

<div id="tabs">
	<ul>

		<li><a href="#tabs-1">Administration</a></li>
		<li><a href="#tabs-2">Employees</a></li>
		<li><a href="#tabs-3">Leave</a></li>
		<li><a href="#tabs-4">Time</a></li>
		<li><a href="#tabs-5">Recruitment</a></li>
        <li><a href="#tabs-6">Performance</a></li>
		<li><a href="#tabs-7">Reports</a></li>

	</ul>
		<div id="tabs-1" align="center">
		
	</div>

	<div id="tabs-2">
	<p> <?php
	
$sql = "Select * FROM employees order by employee_id ASC ";
$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));


?>
 <h2>Employees</h2>
<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" class="entryTable">
<tr><td><a href="">New</a></td></tr>
<tr align="center" class="entryTableHeader">
<th  align="center" >EmpID</th>
<th  align="center">EmpNo</th>
<th  align="center" width="30%">Name</th>
<th  align="center">Job</th>
<th  align="center">Address</th>
<th  align="center">Phone</th>
</tr>
<?php
if (mysqli_num_rows($result) > 0) {
	$i = 0;

	while($row = mysqli_fetch_assoc($result)) {
		extract($row);
if ($i%2) {
	$class = 'row1';
} else {
	$class = 'row2';
}
$i += 1;
?>
<tr class="<?php echo $class; ?>">
<td align="center"><?php echo $employee_id;?> </td>
<td align="center"><?php echo $employee_no;?></td>
<td align="center"><?php echo $fname.' '.$mname.' '.$lname;?></td>
<td align="center"><?php echo $job_id;?></td>
<td align="center"><?php echo $address;?></td>
<td align="center"><?php echo $phone;?></td>
<td align="center"><a href="">Details</a></td></tr>
 <?php
}
}
else{
echo 'No Subjects for now.';
}
?>
</table>
</form>

 <p>&nbsp;</p>
</p>
		</div>
	<div id="tabs-3">
	<?php
	
$sql = "Select * FROM leave_types ORDER by leave_id ASC ";
$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));


?>
 <h2>Available Leave Groups</h2>
<table width="70%" border="0" align="center" cellpadding="1" cellspacing="1" class="entryTable">
<tr><td><a href="">New</a></td>
<td><a href="">Apply</a></td>
<td><a href="">Status</a></td></tr>
<tr align="center" class="entryTableHeader">
<th  align="center" >Leave ID</th>
<th  align="center">Leave Type</th>
<th  align="center">Gender</th>
<th  align="center">Maximum Days Off</th>
<th  align="center"></th>
</tr>
<?php
if (mysqli_num_rows($result) > 0) {
	$i = 0;

	while($row = mysqli_fetch_assoc($result)) {
		extract($row);
if ($i%2) {
	$class = 'row1';
} else {
	$class = 'row2';
}
$i += 1;
?>
<tr class="<?php echo $class; ?>">
<td align="center"><?php echo $leave_id;?> </td>
<td align="center"><?php echo $leave_type;?></td>
<td align="center"><?php echo $leave_gender;?></td>
<td align="center"><?php echo $maximum_days;?></td>
<td align="center"><a href="">Details</a></td></tr>
 <?php
}
}
else{
echo 'No Subjects for now.';
}
?>
</table>
</form>
</div>
	<div id="tabs-4">			
 <h2>Time Sheets</h2>
<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" class="entryTable">
<form action="add_student.php" method="post" name="frmStdDetails" id="frmStdDetails">
    <table width="550" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
        <tr class="entryTableHeader">
            <td colspan="2">Record Employess Time In and Out</td>
        </tr>
		<tr>
            <td width="150" class="label">Employee No</td>
            <td class="content"><input name="emp_no" type="text" class="box" value = "" id="fname" size="30" maxlength="50" class="required validate-alpha" title="Enter your name"></td>
        </tr>
		<tr>
            <td width="150" class="label">Employee Name</td>
            <td class="content"><input name="emp_name" type="text" class="box" value = "" id="fname" size="30" maxlength="50" class="required validate-alpha" title="Enter your name"></td>
        </tr>

		        <tr>
            <td width="150" class="label">Recording</td>
			<td><select name="timesheet" class="box" id="gender">
			 <option value="" selected>-.- Select -.-</option>
			<option value="in">Time In</option>
			<option value="out">Time Out</option>
		   </select></td>
						</tr>
			<tr>
            <td width="150" class="label">Time & Date</td>
            <td class="content"><input name="time" type="text" class="box" value = "" id="fname" size="30" maxlength="50" class="required validate-alpha" title="Enter your name"></td>
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

</table>

 <p>&nbsp;</p>

</form></p>
</div>
	<div id="tabs-5">



			

 <p>&nbsp;</p>

</form></p>
		</div>
	<div id="tabs-6">



			


		</div>
			<div id="tabs-7">



			


		</div>
</div>
</div>
</div><!-- end div specific -->




<div style="clear: both;">&nbsp;</div>
</div>
<!-- start footer -->
<div id="bottom"> </div>
<div id="footer">
&copy; <?php echo date('Y. '); ?> mySkulMate

</div>
	</div>
<!-- end footer -->
</body>
</html>
