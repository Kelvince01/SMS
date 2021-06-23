 <?php
 	$User_Name = $_SESSION['Username'];
	$User_Level = $_SESSION['UserLevel'];
	echo '<h2>Admissions</h2>';
	echo '<br><h4>&nbsp;&nbsp;Welcome <font color="green">' . $User_Name . ',</font></h4><table width="100%">';
	echo '<tr height="20"><td>&nbsp;&nbsp;&raquo;&nbsp;<a href="/sms/">Home</a></td></tr>';
	echo '<tr height="20"><td>&nbsp;&nbsp;&raquo;&nbsp;<a href="/sms/modules/academics/academics.php">Academics</a></td></tr>';
	echo '<tr height="20"><td>&nbsp;&nbsp;&raquo;&nbsp;<a href="/sms/modules/inputs.php">Parents </a></td></tr>';
	echo '<tr height="20"><td>&nbsp;&nbsp;&raquo;&nbsp;<a href="/sms/modules/issue_booked.php">Medical Details</a></td></tr>';
	echo '<tr height="20"><td>&nbsp;&nbsp;&raquo;&nbsp;<a href="/sms/modules/user.php">Medical Attendance</a></td></tr>';

	echo '</table><br/>';
  ?>

