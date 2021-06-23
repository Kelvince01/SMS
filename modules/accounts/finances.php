<?php
session_start();
include('../../connection/connect.php');
if($_SESSION['LoggedIn'] != 'True'){
	echo "<script language=javascript>alert('Login First!'); window.location = '/alpha/modules/security/login.php'; </script>";
}
//require_once 'common.php';
//require_once 'load_factories.php';
//require_once 'library/config.php';
//require_once 'library/common.php';s=mysqli_fetch_array($execute);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>i-PIS::Finances</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
<link rel="stylesheet" href="/alpha/modules/patients/jquery/development-bundle/themes/base/jquery.ui.all.css">
  	<script src="/sms/modules/admissions/jquery/development-bundle/jquery-1.5.1.js"></script>
	<script src="/sms/modules/admissions/jquery/development-bundle/ui/jquery.ui.core.js"></script>
	<script src="/alpha/modules/patients/jquery/development-bundle/ui/jquery.ui.widget.js"></script>
	<script src="/alpha/modules/patients/jquery/development-bundle/ui/jquery.ui.datepicker.js"></script>
	<script src="/alpha/modules/patients/jquery/development-bundle/ui/jquery.ui.tabs.js"></script>

	<script>
	$(function() {
		$( "#tabs" ).tabs();
	});
	</script>
	<script>
	$(function() {
		$( "#datepicker" ).datepicker({
			changeMonth: true,
			changeYear: true
		});
		$( "#format" ).change(function() {
			$( "#datepicker" ).datepicker( "yy-mm-dd", "dateFormat", $( this ).val() );
		});
		$( "#datepicker2" ).datepicker({
			changeMonth: true,
			changeYear: true
		});
		$( "#datepicker3" ).datepicker({
			changeMonth: true,
			changeYear: true
		});
	});
	</script>

	<script type="text/javascript" src="find_account.js"></script>
	<script type="text/javascript" src="validate.js"></script>
	</head>
<body>
<div id="wrap">

<div id="top"> </div>
<div id="contentt">
<div id="logo" align="center">
<img src="/alpha/images/pic2.jpg"/>

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
		<li><a href="#tabs-1">Financial Statements</a></li>

	</ul>
		<div id="tabs-1" align="left">
	
<p><ul>
		<li><a href="cashbk.php">Cash Book</a></li>
		<li><a href="tradingac.php">Trading A/c</a></li>
		<li><a href="pre_patient_stmnt.php">Patients Statement</a></li>
		<li><a href="trial_bal.php">Trial Balance</a></li>
		<li><a href="stock_inventory.php">Stock Inventory</a></li>

</ul></p>
</div>
</div>
</div>
</div><!-- end div specific -->




<div style="clear: both;">&nbsp;</div>
</div>
<!-- start footer -->
<div id="bottom"> </div>
<div id="footer">
&copy; <?php echo date('Y. '); ?> i-Optician
</div>
	</div>
<!-- end footer -->
</body>
</html>