 <?php
 	$User_Name = $_SESSION['Username'];
	$User_Level = $_SESSION['UserLevel'];
	echo '<h2>Admissions</h2>';
	echo '<br><h4>&nbsp;&nbsp;Welcome <font color="green">' . $User_Name . ',</font></h4><table width="100%">';
	echo '<tr height="20"><td>&nbsp;&nbsp;&raquo;&nbsp;<a href="/sms/modules/accounts/fees/fees.php">Fees Collection</a></td></tr>';
	echo '<tr height="20"><td>&nbsp;&nbsp;&raquo;&nbsp;<a href="/sms/modules/accounts/income.php">Accounts</a></td></tr>';
	echo '<tr height="20"><td>&nbsp;&nbsp;&raquo;&nbsp;<a href="/sms/modules/acounts/">Financial Reports</a></td></tr>';
	

	echo '</table><br/>';
  ?>

