 <?php
session_start();
 	$User_Name = $_SESSION['userName'];
	$User_Level = $_SESSION['UserLevel'];
	echo '<h2>Main Menu</h2>';
	echo '<br><h4>&nbsp;&nbsp;Welcome <font color="green">' . $User_Name . ',</font></h4><table width="100%">';
	echo '<tr height="20"><td>&nbsp;&nbsp;&raquo;&nbsp;<a href="/alpha/">Home</a></td></tr>';
	echo '<tr height="20"><td>&nbsp;&nbsp;&raquo;&nbsp;<a href="/alpha/modules/patients/">Patients</a></td></tr>';
	echo '<tr height="20"><td>&nbsp;&nbsp;&raquo;&nbsp;<a href="/alpha/modules/store/store.php">Store</a></td></tr>';
	echo '<tr height="20"><td>&nbsp;&nbsp;&raquo;&nbsp;<a href="/alpha/modules/accounts/finances.php">Finances</a></td></tr>';
	echo '<tr height="20"><td>&nbsp;&nbsp;&raquo;&nbsp;<a href="/alpha/modules/reports/report_index.php">Reports</a></td></tr>';
	echo '<tr height="20"><td>&nbsp;&nbsp;&raquo;&nbsp;<a href="/alpha/modules/config/config.php">System Administration</a></td></tr>';
	echo '<tr height="20"><td>&nbsp;&nbsp;&raquo;&nbsp;<a href="/alpha/modules/security/logout.php">Sign Out</a></td></tr>';
	echo '</table><br/>';
  ?>

