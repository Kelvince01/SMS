<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php echo $school_name;?>::Student Regstration</title>
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
		
			<h2 class="title">Record Student Details</h2>
			<br>
			
			<form action="receipts/produce_receipt.php" method="post" name="frmProduce" id="frmProduce" onSubmit="return validate(this);" onreset="farmer.focus();">
    <table width="550" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
        <tr class="entryTableHeader"> 
            <td colspan="2">Student Demograhic Details</td>
        </tr>
		<tr> 
            <td width="150" class="label">Surname</td>
            <td class="content"><input name="surname" type="text" class="box" value = "" id="surname" size="30" maxlength="50"><span class="required" title="This field is required.">*</span></td>
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
    
</form>
                   				
			</div>
			
	
	
	<div>
</div>

</body>
</html>
