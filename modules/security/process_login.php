<?php
session_start();
//Save
include '../../connection/connect.php';
if(isset($_POST['login']))
{
      extract($_POST);
	  
	  $userName= stripslashes($userName);
	  $password= stripslashes($password);
	 $userName=mysqli_real_escape_string($con1, $userName);
	 $password  =mysqli_real_escape_string($con1, $password);
     $password  = sha1($password);
	$Query= "SELECT * FROM user WHERE userName='" .$userName."' and password='" .($password)."' and status='1'"; 
	$Result=mysqli_query($con1, $Query)or die(mysqli_error($con1));
	$Num_Of_Records=mysqli_num_rows($Result);
	if ($Num_Of_Records > 0)
	{
		$List = mysqli_fetch_array($Result);

		$fullName = $List['full_name'];
		$User=$List['userName'];
		$User_ID = $List['user_id'];
		$User_TypeID = $List['user_type_id'];
		$student_photoURL=$List['student_photoURL'];
		$_SESSION['full_name']=$fullName;
		$_SESSION['userName'] = $User;
		$_SESSION['UserID'] = $User_ID;
		$_SESSION['UserType'] = $User_TypeID;
		$_SESSION['student_photoURL'] = $student_photoURL;
		$_SESSION['LoggedIn'] = 'True';
		$sql="SELECT userType from usertype where user_type_id='$User_TypeID'";
		$result=mysqli_fetch_assoc(mysqli_query($con1,$sql)) or die (mysqli_error($con1));
		extract($result);
		$_SESSION['User_type']=$userType;
		//save to the log
//$log=mysqli_query("insert into ".$_SESSION['Produce']."log (userID,event,event_type) values ('".$_SESSION['userName']."','Logged into the system','LOG IN')");
		header('location: ../../index.php');
	}
	else
	{
	//save to the log
//$log=mysqli_query("insert into ".$_SESSION['Produce']."log (userID,event,event_type) values ('Host: ".$_SERVER['REMOTE_ADDR']."','Log In Attempt Failed.','FAILED')");
		$_SESSION['LoggedIn'] = 'Invalid';
		header("location:login.php?info=invalid&tab=invalid");
	}
	
}

?>