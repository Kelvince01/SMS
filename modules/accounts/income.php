  <link rel="stylesheet" href="/sms/jq/jquery.autocomplete.css">
<td width="80%" valign="top">
<div class="demo">

<div id="tabs">
	<ul>
		<li><a href="#tabs-1">Add New Account</a></li>
		<li><a href="#tabs-2">Make An Entry</a></li>
		
	</ul>
		<div id="tabs-1">
		<p> <h2>Add a New Account</h2>
		<form action="" method="post" name="frmAccount" id="frmAccount" >
    <table width="550" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
        <tr class="entryTableHeader">
            <td colspan="2">Account Details</td>
        </tr>

		<tr>
            <td width="150" class="label">Account Name:</td>
            <td class="content"> <input type="text" name="account_name" id="account_name" required>
            <span class="required" title="This field is required.">*</span></td>
        </tr>
		
		<tr>
		<td width="150" class="label"></td>
            <td class="content"><label >Fields Marked with<span class="required" title="This field is required.">*</span> are required.</td>
        </tr>
		<tr>
		<td height="43">&nbsp;</td>
		<td>
		<p align="left">
        <input name="addincome" type="submit" id="save" value="Save Details">
		<input name="clear" type="reset" id="cancel" value="Clear Fields">
    </p>
	</td>
	</tr>
    </table>
</form>
 <p>&nbsp;</p>

</p>
	</div>

	<div id="tabs-2" >
<p> <h2>Make an Entry to an Account Here</h2>


		<form action="" method="post" name="frmPatientDiagnosis" id="frmPatientDiagnosis" onsubmit="return checkfrmPatientDiagnosis(this);">
    <table width="550" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
        <tr class="entryTableHeader">
            <td colspan="2">Transaction Details</td>
        </tr>
		<tr>
            <td width="150" class="label" >Account Name<span class="required" title="This field is required.">*</span></td>
			<td><select name="account_name1" class="box" id="account_name1" required>
			
			<?php
	$query="SELECT * FROM tblaccount order by account_name ASC ";
	$result=mysqli_query($con1,$query);
	while($row=mysqli_fetch_array($result)){
			echo "<option value ='".$row[0]."'>".$row[1]."</option>";
    }
	?>
		   </select></td>
						</tr>
         <tr>
            <td width="150" class="label">Entry Date</td>
            <td class="content"><input name="datepicker" type="text" class="box" value = "" id="datepicker" size="30" maxlength="100" required><span class="required">*</span></td>
       </tr>
		  <tr>
			<td width="150" class="label">Details</td>
            <td class="content"><textarea name="details" cols="30" rows="5" class="box" value = "" id="details" ></textarea></span></td>
        </tr>
		<tr>
            <td width="150" class="label">Amount</td>
            <td class="content"><input name="amount" type="text" class="box" value = "" id="amount" size="30" maxlength="50" required class="required" ><span class="required" >*</span></td>
        </tr>
		<tr>
            <td width="150" class="label">Payment Mode</td>
            <td class="content"><select name="payment_type" required>
            <option value="cash">Cash</option>
            <option value="bank">Bank</option>
            </select>
            <span class="required" title="This field is required.">*</span></td>
        </tr>
		<tr>
            <td width="150" class="label">Debit/Credit</td>
            <td class="content"><select name="debit" class="box" id="drcr" required>
            <option value="dr">Debit</option>
            <option value="cr">Credit</option>
            </select>
            </td>
        </tr>
        <tr>
		<td width="150" class="label"></td>
            <td class="content"><label >Fields Marked with<span class="required" title="This field is required.">*</span> are required.</td>
        </tr>
		<tr>
		<td height="43">&nbsp;</td>
		<td>
		<p align="left">
		<input name="account_type" type="hidden" id="account_type" value="income">
        <input name="save" type="submit" id="save" value="Make Entry">
		<input name="clear" type="reset" id="cancel" value="Clear Fields">
    </p>
	</td>
	</tr>
    </table>
</form>
 <p>&nbsp;</p>

</p>
		</div>

</div>
</td>
<?php
if (isset($_POST['addincome'])) {
	extract($_POST);
$query="SELECT account_name FROM tblaccount WHERE account_name='$account_name'";
$result=mysqli_query($con1,$query);
$Num_Of_Records=mysqli_num_rows($result);
//if item already exists
	if ($Num_Of_Records > 0)
	{ echo'<script>window.location=" /sms/index.php?info=duplicate&view=income"</script>';
	}
else{
$account_no= $initials.'/'.trim($account_name,' ').'/'.date('m/Y');
// Insert Patient Details
$query="INSERT INTO tblaccount (account_name)
VALUES ('$account_name')";
$result=mysqli_query($con1,$query) or die(mysqli_error($con1));
//give success message
echo'<script>window.location=" /sms/index.php?info=success&view=income"</script>';
}
}
if (isset($_POST['save'])) {
	$myterm =getActiveTerm (); //get active term
$activeterm = $myterm['key3'];
	extract($_POST);
	if ($debit == 'dr')
	{
		$query="INSERT INTO tbltransactions VALUES ('',$account_name1,$amount,0,'$datepicker',$activeterm,'$details','$payment_type')";
        $result=mysqli_query($con1,$query) or die(mysqli_error($con1));
		echo'<script>window.location=" /sms/index.php?info=success&view=income"</script>';
	}else{
		$query="INSERT INTO tbltransactions VALUES ('',$account_name1,0,$amount,'$datepicker',$activeterm,'$details','$payment_type')";
        $result=mysqli_query($con1,$query) or die(mysqli_error($con1));
		echo'<script>window.location=" /sms/index.php?info=success&view=income"</script>';
}
}
?>

<script type='text/javascript' src='/sms/jq/jquery.autocomplete.js'></script>
<script type="text/javascript">
	$("#account_name").autocomplete("/sms/modules/accounts/searchaccount.php", {
		width: 260,
		matchContains: true,
		selectFirst: false
	});

</script>