<?php
session_start();
include '../connection/connect.php';
if (isset($_POST['Save']))
{
      extract($_POST);
	  $username=$_SESSION['Username'];
	$Query= "SELECT * FROM ".$_SESSION['Produce']."user WHERE username = '" .$username. "' and password = '" .md5($password)."'"; 
	$Result=mysqli_query($con1, $Query);
	$Num_Of_Records=mysqli_num_rows($Result);
	if ($Num_Of_Records > 0)
	{
		$Query1="update ".$_SESSION['Produce']."user set password = '" .md5($newpassword)."' where username='" .$username. "'";
		mysqli_query($con1, $Query1) or die(mysqli_error($con1));
		header("location:user.php?msg=success");
	}
	else
	{
		header("location:user.php?msg=fail");
	}
}
?>