<?php
session_start();
include('../../../connection/connect.php');

//require_once 'common.php';
//require_once 'load_factories.php';
//require_once 'library/config.php';
//require_once 'library/common.php';s=mysqli_fetch_array($execute);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>mySkulMate::Admissions</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="../style.css" media="screen" />
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
		include('../user_menu.php');
		?>
	</div>


<div class="middle">
<div class="demo">

<div id="tabs">
	<ul>
		<li><a href="#tabs-1">Record Student Details</a></li>
		<li><a href="#tabs-2">Allocate Class</a></li>
		<li><a href="#tabs-3">Allocate Subjects</a></li>
		<li><a href="#tabs-4">Allocate Hostel/Dorm</a></li>
		<li><a href="#tabs-5">Allocate Duties</a></li>

	</ul>
		<div id="tabs-1" align="center">
		<p> <h2 class="title">Record Student Details</h2>


			<form action="receipts/produce_receipt.php" method="post" name="frmProduce" id="frmProduce">
    <table width="550" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
        <tr class="entryTableHeader">
            <td colspan="2">Student Demograhic Details</td>
        </tr>
		<tr>
            <td width="150" class="label">Surname</td>
            <td class="content"><input name="surname" type="text" class="box" value = "" id="surname" size="30" maxlength="50" class="required validate-alpha" title="Enter your name"></td>
        </tr>

		        <tr>
            <td width="150" class="label">Middle Name</td>
            <td class="content"><input name="othername" type="text" class="box" value = "" id="othername" size="30" maxlength="50"><span class="required" title="This field is required.">*</span></td>
        </tr>

			<tr>
            <td width="150" class="label">Last Name</td>
            <td class="content"><input name="kin" type="text" class="box" value = "" id="kin" size="30" maxlength="50"><span class="required" title="This field is required.">*</span></td>
        </tr>
			<tr>
            <td width="150" class="label">Other Names</td>
            <td class="content"><input name="nationalid" type="text" class="box" value = "" id="nationalid" size="30" maxlength="50"><span class="required" title="This field is required.">*</span></td>
        </tr>
		<tr>
            <td width="150" class="label">Gender</td>
			<td><select name="cboView" class="box" id="cboView">
			 <option value="" selected>-.- Select -.-</option>
			<option value="product">Male</option>
			<option value="category">Female</option>
		   </select></td>
						</tr>
        <tr>
            <td width="150" class="label">Date of Birth</td>
            <td class="content"><input name="nationalid" type="text" class="box" value = "" id="nationalid" size="30" maxlength="50"><span class="required" title="This field is required.">*</span></td>
        </tr>
       <tr>
            <td width="150" class="label">Ethnicity</td>
            <td class="content"><input name="nationalid" type="text" class="box" value = "" id="nationalid" size="30" maxlength="50"><span class="required" title="This field is required.">*</span></td>
        </tr>
		<tr>
            <td width="150" class="label">Family Status</td>
			<td><select name="cboView" class="box" id="cboView">
			 <option value="" selected>-.- Select -.-</option>
			<option value="product">Single Parent</option>
			<option value="category">Both Parents Alive</option>
			<option value="category">Orphaned</option>
		   </select></td>
             </tr>
			 <tr>
            <td width="150" class="label">Passport Photo</td>
            <td class="content"><input name="fleImage" type="file" class="box" value = "" size="30" maxlength="50"><span class="required" title="This field is required.">*</span></td>
        </tr>
        <tr class="entryTableHeader">
            <td colspan="2">Parents/Guardian Demographic Details</td>
        </tr>
		<tr>
            <td width="150" class="label">Surname</td>
            <td class="content"><input name="shares" type="text" class="box" value = "" onKeyUp="checkNumber(this);" id="shares" size="30" maxlength="50"><span class="required" title="This field is required.">*</span></td>
        </tr>
		<tr>
            <td width="150" class="label">Middle Name</td>
            <td class="content"><input name="shares" type="text" class="box" value = "" onKeyUp="checkNumber(this);" id="shares" size="30" maxlength="50"><span class="required" title="This field is required.">*</span></td>
        </tr>
		<tr>
            <td width="150" class="label">Last Name</td>
            <td class="content"><input name="shares" type="text" class="box" value = "" onKeyUp="checkNumber(this);" id="shares" size="30" maxlength="50"><span class="required" title="This field is required.">*</span></td>
        </tr>
		<tr>
            <td width="150" class="label">Other Names</td>
            <td class="content"><input name="shares" type="text" class="box" value = "" onKeyUp="checkNumber(this);" id="shares" size="30" maxlength="50"><span class="required" title="This field is required.">*</span></td>
        </tr>
		<tr>
            <td width="150" class="label">Marital Status</td>
			<td><select name="cboView" class="box" id="cboView">
			 <option value="" selected>-.- Select -.-</option>
			<option value="product">Single</option>
			<option value="category">Married</option>
			<option value="category">Divorced</option>
		   </select></td>
             </tr>
		<tr>
            <td width="150" class="label">Spouse Name</td>
            <td class="content"><input name="nationalid" type="text" class="box" value = "" id="nationalid" size="30" maxlength="50"><span class="required" title="This field is required.">*</span></td>
        </tr>
		<tr>
            <td width="150" class="label">Occupation</td>
            <td class="content"><input name="nationalid" type="text" class="box" value = "" id="nationalid" size="30" maxlength="50"><span class="required" title="This field is required.">*</span></td>
        </tr>
		<tr>
            <td width="150" class="label">Spouse Occupation</td>
            <td class="content"><input name="nationalid" type="text" class="box" value = "" id="nationalid" size="30" maxlength="50"><span class="required" title="This field is required.">*</span></td>
        </tr>
		<tr class="entryTableHeader">
            <td colspan="2">Parents/Guardian Contact Details</td>
        </tr>
        <tr>
            <td width="150" class="label">Phone No</td>
            <td class="content"><input name="nationalid" type="text" class="box" value = "" id="nationalid" size="30" maxlength="50"><span class="required" title="This field is required.">*</span></td>
        </tr>
       <tr>
            <td width="150" class="label">Poastal Address</td>
            <td class="content"><input name="nationalid" type="text" class="box" value = "" id="nationalid" size="30" maxlength="50"><span class="required" title="This field is required.">*</span></td>
        </tr>
		       <tr>
            <td width="150" class="label">Email Address</td>
            <td class="content"><input name="nationalid" type="text" class="box" value = "" id="nationalid" size="30" maxlength="50"><span class="required" title="This field is required.">*</span></td>
        </tr>

		<tr>
            <td width="150" class="label">Area of Residence</td>
            <td class="content"><input name="nationalid" type="text" class="box" value = "" id="nationalid" size="30" maxlength="50"><span class="required" title="This field is required.">*</span></td>
        </tr>
        <tr>
            <td width="150" class="label">Preffered Contact Method</td>
			<td><select name="cboView" class="box" id="cboView">
			 <option value="" selected>-.- Select -.-</option>
			<option value="product">SMS</option>
			<option value="category">Email</option>
			<option value="category">Poastal Letter</option>
		   </select></td>
             </tr>
			 <tr class="entryTableHeader">
            <td colspan="2">Student Medical Details</td>
        </tr>
         <tr>
            <td width="150" class="label">Medical Condition</td>
            <td class="content"><input name="nationalid" type="text" class="box" value = "" id="nationalid" size="30" maxlength="50"><span class="required" title="This field is required.">*</span></td>
        </tr>
		 <tr>
            <td width="150" class="label">Special Diet</td>
			<td><select name="cboView" class="box" id="cboView">
			 <option value="" selected>-.- Select -.-</option>
			<option value="product">Yes</option>
			<option value="category">No</option>
		   </select></td>
            </tr>
        <tr class="entryTableHeader">
            <td colspan="2">System Parameters</td>
        </tr>
        <tr>
            <td width="150" class="label">Student AdmNo</td>
            <td class="content"><input name="nationalid" type="text" class="box" value = "" id="nationalid" size="30" maxlength="50"><span class="required" title="This field is required.">*</span></td>
        </tr>
          <tr>
            <td width="150" class="label">Student Active</td>
			<td><select name="cboView" class="box" id="cboView">
			 <option value="" selected>-.- Select -.-</option>
			<option value="product">Yes</option>
			<option value="category">No</option>
		   </select></td>
            </tr>
        <tr>
            <td width="150" class="label">Student Status</td>
			<td><select name="cboView" class="box" id="cboView">
			 <option value="" selected>-.- Select -.-</option>
			<option value="product">Fresh Admission</option>
			<option value="category">Transfer</option>
			<option value="category">Re-admission after Suspension</option>
			<option value="category">Re-admission after Expulsion</option>

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
        <input name="save" type="submit" id="save" value="Save">
    </p>
	</td>
	</tr>
    </table>

 <p>&nbsp;</p>

</form></p>
	</div>

	<div id="tabs-2">
	<p> <h2 class="title">Allocate Student A Class</h2>
         <?php
			include '/sms/connection/connect.php';
			$sql = "Select * FROM class ORDER by class_id ASC ";
			$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));


			?>
	<br>
<form action="receipts/produce_receipt.php" method="post" name="" id="">
<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" class="entryTable">
<tr align="center" class="entryTableHeader">
<th width="20%" >Class</th>
<th width="15%">Capacity</th>
<th width="15%">Girls</th>
<th width="15%" >Boys</th>
<th width="15%" >Remaning</th>
<th align="center">Allocate</th>
</tr>
<?php
if (mysqli_num_rows($result) > 0) {
$i = 0;

while($row = mysqli_fetch_assoc($result)) {
extract($row);
$now=$capacity-($girls+boys);
if ($i%2) {
	$class = 'row1';
} else {
	$class = 'row2';
}
$i += 1;
?>
<tr class="<?php echo $class; ?>">
<td width="20%"><?php echo $class_name;?> </td>
<td align="center"><?php echo $capacity;?> </td>
<td align="center"><?php echo $girls;?> </td>
<td align="center"><?php echo $boys;?> </td>
<td align="center"><?php echo $now;?> </td>
<td align="center"><input type="radio" name="radio[]" value="<?php echo $class_id?>"></td></tr>
 <?php
}
}
else{
	echo 'No duties for now.';
}
?>
</table>

 <p>&nbsp;</p>

</form></p>
		</div>
	<div id="tabs-3">
	<?php
	include '/sms/connection/connect.php';
$sql = "Select subject_id, subject_name FROM subject ORDER by subject_id ASC ";
$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));


?>
 <h2>Subjects On Offer in this School</h2>
	<br>
<form action="receipts/produce_receipt.php" method="post" name="frmProduce" id="frmProduce">
<table width="70%" border="0" align="center" cellpadding="1" cellspacing="1" class="entryTable">
<tr align="center" class="entryTableHeader">
<th padding:2px align="center" >Subject ID</th>
<th padding:2px align="center">Subject Name</th>
<th padding:2px align="center">Allocate</th>
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
<td align="center"><?php echo $subject_id;?> </td>
<td align="center"><?php echo $subject_name;?></td>
<td align="center"><input type="checkbox" name="checkbox[<?php echo $subject_id;?>]" value="<?php echo $subject_name?>"></td></tr>
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



			<?php
			include '/sms/connection/connect.php';
			$sql = "Select * FROM hostel ORDER by hostel_id ASC ";
			$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));


			?>
 <h2>Hostels and The current occupancy</h2>
	<br>
<form action="receipts/produce_receipt.php" method="post" name="" id="">
<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" class="entryTable">
<tr align="center" class="entryTableHeader">
<th padding:2px align="center" >Hostel</th>
<th width="20%" >Total Bed Capacity</th>
<th width="15%">Form One</th>
<th width="15%">Form Two</th>
<th width="15%" >Form Three</th>
<th width="15%" >Form Four</th>
<th width="35%">Remaining Beds</th>
<th align="center">Allocate</th>
</tr>
<?php
if (mysqli_num_rows($result) > 0) {
$i = 0;

while($row = mysqli_fetch_assoc($result)) {
extract($row);
$now=$Form_One+$Form_Two+$Form_Three+$Form_Four;
$balance=$capacity-$now;
if ($i%2) {
	$class = 'row1';
} else {
	$class = 'row2';
}
$i += 1;
?>
<tr class="<?php echo $class; ?>">
<td width="20%"><?php echo $hostel_name;?> </td>
<td align="center"><?php echo $capacity;?> </td>
<td align="center"><?php echo $Form_One;?> </td>
<td align="center"><?php echo $Form_Two;?> </td>
<td align="center"><?php echo $Form_Three;?> </td>
<td align="center"><?php echo $Form_Four;?> </td>
<td align="center"><?php echo $balance;?> </td>
<td align="center"><input type="radio" name="radio[]" value="<?php echo $hostel_name?>"></td></tr>
 <?php
}
}
else{
	echo 'No hostels for now.';
}
?>
</table>

 <p>&nbsp;</p>

</form></p>
		</div>
<div id="tabs-5">



			<?php
			include '/sms/connection/connect.php';
			$sql = "Select * FROM duty ORDER by duty_id ASC ";
			$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));


			?>
 <h2>Duty and Current Allocation</h2>
	<br>
<form action="receipts/produce_receipt.php" method="post" name="" id="">
<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" class="entryTable">
<tr align="center" class="entryTableHeader">
<th width="20%" >Duty</th>
<th width="15%">Manpower</th>
<th width="15%">Current Allocation</th>
<th width="15%" >Required Manpower</th>
<th align="center">Allocate</th>
</tr>
<?php
if (mysqli_num_rows($result) > 0) {
$i = 0;

while($row = mysqli_fetch_assoc($result)) {
extract($row);
$now=$required_manpower-$allocated;
if ($i%2) {
	$class = 'row1';
} else {
	$class = 'row2';
}
$i += 1;
?>
<tr class="<?php echo $class; ?>">
<td width="20%"><?php echo $duty;?> </td>
<td align="center"><?php echo $required_manpower;?> </td>
<td align="center"><?php echo $allocated;?> </td>
<td align="center"><?php echo $now;?> </td>
<td align="center"><input type="radio" name="radio[]" value="<?php echo $duty_id?>"></td></tr>
 <?php
}
}
else{
	echo 'No duties for now.';
}
?>
</table>

 <p>&nbsp;</p>

</form></p>
</div>
</div>
</div>
</div><!-- end div specific -->
	

	

<div style="clear: both;">&nbsp;</div>
</div>
<!-- start footer -->
<div id="bottom"> </div>
<div id="footer">
&copy; <?php echo date('Y. '); ?> Kilimo-Online

</div>
	</div>
<!-- end footer -->
</body>
</html>
