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

<p> <h2 class="title">Select your preferences here</h2>


		<form action="mark_sheet.php" method="post" name="frmStdDetails" id="frmStdDetails">
		<br>
    <table width="550" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
        
            <tr><td width="150" class="label">Class</td>
			<td><select name="class_name" class="box" id="class_name">
			 <option value="" selected>-.- Select -.-</option>
			<option value="Form 1">Form One</option>
			<option value="Form 2">Form Two</option>
			<option value="Form 3">Form Three</option>
			<option value="Form 4">Form Four</option>
		   </select></td>
						</tr>
			<tr><td width="150" class="label">Term</td>
			<td><select name="term_name" class="box" id="term_name">
			 <option value="" selected>-.- Select -.-</option>
			<option value="Term 1">Term One</option>
			<option value="Term 2">Term Two</option>
			<option value="Term 2">Term Three</option>
			
		   </select></td>
						</tr>
			<tr><td width="150" class="label">Year</td>
			<td><select name="year_name" class="box" id="year_name">
			 <option value="" selected>-.- Select -.-</option>
			<option value="2010">2010</option>
			<option value="2011">2011</option>
			<option value="2012">2012</option>
			
		   </select></td>
						</tr>			
        
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
