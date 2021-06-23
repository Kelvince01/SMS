<?php
session_start();
include '../../connection/connect.php';
if (isset($_GET['LogOff']))
	 {
		$_SESSION['LoggedIn']='False';
		
		if (isset($_SESSION['logout_logged']) && $_SESSION['logout_logged']=="False")
		{
		//save to the log
//$log=mysqli_query($con1,"insert into ".$_SESSION['Produce']."log (userID,event,event_type) values ('".$_SESSION['Username']."','Logged out of the system','LOG OUT')");
	
		}
		$_SESSION['logout_logged']="True";
		session_unregister('Produce');
		session_unregister('Username');
	 }
	 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>mySkulMate::Home</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
<link rel="stylesheet" type="text/css" href="../../style.css" media="screen" />
</head>
<body>
<div id="wrap">

<div id="top"> </div>
<div id="contentt">
<div id="logo" align="center">
<img src="/sms/images/logo.png"/>

</div>

<div class="left">
 <?php
							if(isset($_SESSION['LoggedIn']))
							{
								if($_SESSION['LoggedIn']=='Invalid')
								{
								echo '<h2 align="center">Account Login</h2>';
									echo '<tr><td><font class="info" color="red">Invalid Username/Password Combination.</font></td></tr>';
									session_unregister('LoggedIn');
									include('/sms/modules/security/login.php');
								}
								elseif($_SESSION['LoggedIn']=='False')
								{
								echo '<h2 align="center">Account Login</h2>';
									echo '<font class="info" color="green">You have signed out successfully.</font>';
									session_unregister('LoggedIn');
									include('/sms/modules/security/login.php');
								}
								else
								{
									include('user_menu.php');
									$_SESSION['logout_logged']="False";
								}
							}
							else
							{	echo '<h2 align="center">Account Login</h2>';
									include('/sms/modules/security/login.php');
									
							}
						?>
</div>

<div class="middle">
<h2>Welcome to mySkulMate School Information System</h2>
<p><b></b></p>
<div align="center">
<div style="float:right; padding-top:130px;"><b>       </b></div>
<img src="/sms/images/student.jpg" width="350" height="270">
<img src="/sms/images/teachers_large.jpg" width="280" height="270">
</div>
<div align="center">
<div style="float:right; padding-top:100px;"><b>       </b></div>
<img src="/sms/images/school.jpg" width="350" height="280">
<img src="/sms/images/joel_team.jpg" width="280" height="270">
</div>
</div>
<div style="clear: both;"> </div>

</div>
<div id="bottom"> </div>
<div id="footer">
&copy; <?php echo date('Y. '); ?> mySkulMate

</div>
</body>