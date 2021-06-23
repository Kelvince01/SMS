<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php echo $school_name;?>::Subject Configuration</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
<link rel="stylesheet" type="text/css" href="../../assests/css/style.css" media="screen" />
<link type="text/css" href="../../datepicker/all.css" rel="stylesheet" />
<script type="text/javascript" src="../../datepicker/jquery.js"></script>
<script type="text/javascript" src="../../datepicker/core.js"></script>
<script type="text/javascript" src="../../datepicker/datepicker.js"></script>
<script type="text/javascript" src="cart-ajax.js"></script>
<script type="text/javascript" src="common.js"></script>
</head>

<script type="text/javascript">
	$(function() {
		$("#datepicker").datepicker({showOn: 'button', buttonImage: '../images/calendar.gif', buttonImageOnly: true});
	});
	 </script>
<body>	
<div id="wrap">

<div id="top"> </div>
<div id="contentt">
<div id="logo" align="center">
<img src="../images/logo.jpg"/>

</div>
<!-- end header -->

<div class="left">
		 <?php
		//include('user_menu.php');		
		?>
	</div>


<div class="middle">
		
			<h2 class="title">Add  Subject Groups</h2>
			<br>
			
			<form action="receipts/produce_receipt.php" method="post" name="frmProduce" id="frmProduce" onSubmit="return validate(this);" onreset="farmer.focus();">
    <table width="550" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
        <tr class="entryTableHeader"> 
            <td colspan="2">Subject Group Details</td>
        </tr>
		<tr> 
            <td width="150" class="label">Group Name</td>
            <td class="content"><input name="surname" type="text" class="box" value = "" id="surname" size="30" maxlength="50"><span class="required" title="This field is required.">*</span></td>
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
    
</form>
                   				
			</div>
			
	
	
	<div>
</div>

</body>
</html>
