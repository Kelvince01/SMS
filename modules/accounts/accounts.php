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
<title>mySkulMate::Accounting</title>
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

		<li><a href="#tabs-1">Fees</a></li>
		<li><a href="#tabs-2">Expenses</a></li>
		<li><a href="#tabs-2">Income</a></li>
		<li><a href="#tabs-2">Assets Management</a></li>

	</ul>
		<div id="tabs-1" align="center">
		<p> <h2 class="title">Classes Details</h2>
		<?php
			include '/sms/connection/connect.php';
			$sql = "Select * FROM class ORDER by class_id ASC ";
			$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));


			?>

<form action="receipts/produce_receipt.php" method="post" name="" id="">
<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" class="entryTable">
<tr><td><a href="">New</a></td></tr>
<tr align="center" class="entryTableHeader">
<th width="20%" >Class</th>
<th width="15%">Capacity</th>
<th width="15%">Girls</th>
<th width="15%" >Boys</th>
<th width="15%" >Remaning</th>
<th align="center">Details</th>
</tr>
<?php
if (mysqli_num_rows($result) > 0) {
$i = 0;

while($row = mysqli_fetch_assoc($result)) {
extract($row);
$now=$capacity-($girls+$boys);
if ($i%2) {
	$class = 'row1';
} else {
	$class = 'row2';
}
$i += 1;
?>
<tr class="<?php echo $class; ?>">
<td align="center"><?php echo $class_name;?> </td>
<td align="center"><?php echo $capacity;?> </td>
<td align="center"><?php echo $girls;?> </td>
<td align="center"><?php echo $boys;?> </td>
<td align="center"><?php echo $now;?> </td>
<td align="center"><a href="">Details</a></td></tr>

 <?php
}
}
else{
	echo 'No duties for now.';
}
?>
</table>

 <p>&nbsp;</p>

	</div>

	<div id="tabs-2">
	<p> <?php
	include '/sms/connection/connect.php';
$sql = "Select subject_id, subject_name FROM subject ORDER by subject_id ASC ";
$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));


?>
 <h2>Subjects On Offer in this School</h2>
<table width="70%" border="0" align="center" cellpadding="1" cellspacing="1" class="entryTable">
<tr><td><a href="">New</a></td></tr>
<tr align="center" class="entryTableHeader">
<th  align="center" >Subject ID</th>
<th  align="center">Subject Name</th>
<th  align="center">Details</th>
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
