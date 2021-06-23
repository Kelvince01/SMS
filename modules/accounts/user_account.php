<script>function addClassValidation(){

if((document.frmaddClass.full_name.value=="")||(document.frmaddClass.full_name.value==null))
	{
		document.getElementById("full_name").innerHTML=("*Please enter full_name*");
		document.frmaddClass.full_name.focus();
        return false;
	}
if((document.frmaddClass.Username.value=="")||(document.frmaddClass.Username.value==null))
	{
		document.getElementById("Username").innerHTML=("*Please enter Username*");
		document.frmaddClass.Username.focus();
        return false;
	}	
if((document.frmaddClass.password.value=="")||(document.frmaddClass.password.value==null))
	{
		document.getElementById("password").innerHTML=("*Please enter password*");
		document.frmaddClass.password.focus();
        return false;
	}	
	
}

	</script>
<td width="100%" valign="top">
<div id="tabs">
	<ul>
	<?php if ($_SESSION['User_type']=="admin" || $_SESSION['User_type']=="super_admin" ){ ?>
		<li><a href="#tabs-1">User Account</a></li>
		<li><a href="#tabs-2">Student Account</a></li><?php }?>
		<li><a href="#tabs-3">Edit User Accounts</a></li>
	</ul>
	<?php if ($_SESSION['User_type']=="admin" || $_SESSION['User_type']=="super_admin" ){ ?>
		<div id="tabs-1" align="center">

 <h2 class="title">Create a New User Account</h2>
<form  method="post" action="/sms/index.php?view=add_user" enctype="multipart/form-data" name="frmaddClass" id="frmaddClass">
<table width="200" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
        <tr class="entryTableHeader">
            <td colspan="2"></td>
        </tr>
		<tr>
            <td width="150" class="label">Full Name</td>  
 <td class="content"><input name="full_name" type="text" class="box" value = "" id="subject_name" size="30" maxlength="50" required><span class="" title="required.">*</span><div id="full_name"></div></td>
        </tr>			
        <tr>
            <td width="150" class="label">Username</td>  
 <td class="content"><input name="userName" type="text" class="box" value = "" id="subject_name" size="30" maxlength="50" required><span class="" title="required.">*</span><div id="userName"></div></td>
        </tr> 
		 <tr>
            <td width="150" class="label">Password</td>  
 <td class="content"><input name="password" type="password" class="box" value = "" id="subject_name" size="30" maxlength="50" required><span class="" title="required.">*</span><div id="password"></div></td>
        </tr> 
		<tr>
		<td width="150" class="label">User Type<span style="color:red;">*</span></td>
				<td><select name="user_type_id" required>
				<?php 
					$query1="SELECT user_type_id,userType FROM usertype ";
				$result = mysqli_query($con1,$query1);
			
			while($nt=mysqli_fetch_array($result)){
			echo "<option value=$nt[user_type_id]>$nt[userType]</option>";
			
			}
			
			?>	
			</select></td>
             </tr> 
		 <tr>
            <td width="150" class="label">Passport Photo</td>
            <td class="content"><input name="student_photo" type="file" class="box" value = "" size="30" maxlength="50"></td>
        </tr>
		<tr>
		<td height="43">&nbsp;</td>
		<td>
		<p align="left">
        <input name="save" type="submit" id="save" value="Save Details" onclick="return addClassValidation()">
    </p>
	</td>
	</tr>
    </table>
</form>
</div>
 


<div id="tabs-2" align="center">

 <h2 class="title">Create Student Account</h2>
<form  method="post" action="/sms/index.php?view=add_user" enctype="multipart/form-data" name="frmaddClass">
<table width="200" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
        <tr class="entryTableHeader">
            <td colspan="2"></td>
        </tr>
		<tr>
		<td width="150" class="label">Full Name<span style="color:red;">*</span><div id="full_name"></div></td>
				<td><select name="full_name">
				<?php 
					$query1="SELECT concat(fname,' ',mname)as fullname FROM student_details ";
				$result = mysqli_query($con1,$query1);
			while($nt=mysqli_fetch_array($result)){//Array or records stored in $nt
			echo "<option value=$nt[fullname]>$nt[fullname]</option>";
						}
			?>	
			</select></td>
             </tr> 		
        <tr>
            <td width="150" class="label">Username</td>  
 <td class="content"><input name="userName" type="text" class="box" id="userName" size="30" maxlength="50" required><span class="" title="required.">*</span><div id="userName"></div></td>
        </tr> 
		 <tr>
            <td width="150" class="label">Password</td>  
 <td class="content"><input name="password" type="password" class="box" id="password" size="30" maxlength="50" required><span class="" title="required.">*</span><div id="password"></div></td>
        </tr> 
		<tr>
		<td width="150" class="label">User Type<span style="color:red;">*</span></td>
				<td><select name="user_type_id">
				<option value="6" selected required>-.- student -.-</option>			
			</select></td>
             </tr> 
		 <tr>
            <td width="150" class="label">Profile Picture</td>
            <td class="content"><input name="student_photo" type="file" class="box" value = "" size="30" maxlength="50"></td>
        </tr>
		<tr>
		<td height="43">&nbsp;</td>
		<td>
		<p align="left">
        <input name="save" type="submit" id="save" onclick="return addClassValidation()" value="Save Details">
    </p>
	</td>
	</tr>
    </table>
</form>
</div>
<?php }?>
<div id="tabs-3">

 <h2 class="title">Edit User Account</h2>
<form  method="post" action="/sms/index.php?view=add_user" enctype="multipart/form-data" name="frmaddClass">
<table width="200" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
        <tr class="entryTableHeader">
            <td colspan="2"></td>
        </tr>
		<tr>
		<td width="150" class="label">Full Name<span style="color:red;" >*</span></td>
				<td>
				<?php 
					$query0='SELECT full_name from user where user_id="'.$_SESSION['UserID'].'" ';
					
				$result0 = mysqli_query($con1,$query0);
			$nt0=mysqli_fetch_assoc($result0);//Array or records stored in $nt
			extract($nt0);
			 
			?><input name="full_name" type="text" class="box" value = "<?php echo $full_name; ?>" id="subject_name" size="30" maxlength="50" required>	
			</td>
             </tr> 		
        <tr>
            <td width="150" class="label">Username</td>  
 			<td class="content"><?php 
					$query3='SELECT userName from user where user_id="'.$_SESSION['UserID'].'" ';
					$result3 = mysqli_query($con1,$query3);
					$nt3=mysqli_fetch_assoc($result3);//Array or records stored in $nt
					extract($nt3);	 
			?>
		 <input name="userName" type="text" class="box" value = "<?php echo $userName; ?>" id="subject_name" size="30" maxlength="50" required>
 			<span class="required" title="required.">*</span><div id="userName"></div></td>
        </tr> 
		 <tr>
            <td width="150" class="label">Password</td>  
 <td class="content"><input name="password" type="password" class="box" value ="" id="subject_name" size="30" maxlength="50" required><span class="" title="required.">*</span><div id="password"></div></td>
        </tr> 
		<?php if ($_SESSION['User_type']=="admin" || $_SESSION['User_type']=="super_admin" ){ ?>
		 <tr>
		<td width="150" class="label">User Type<span style="color:red;">*</span></td>
				<td><select name="user_type_id" required>
				<?php 
					$query1="SELECT user_type_id,userType FROM usertype ";
				$result = mysqli_query($con1,$query1);
			// printing the list box select command

			while($nt=mysqli_fetch_array($result)){//Array or records stored in $nt
			echo "<option value=$nt[user_type_id]>$nt[userType]</option>";
			/* Option values are added by looping through the array */
			}
			// Closing of list box 
			?>	
			</select></td>
             </tr> 
		 
		 <tr> <?php }?>
            <td width="150" class="label">Profile Picture</td>
            <td class="content"><input name="student_photo" type="file" class="box" size="30" maxlength="50" ></td>
        </tr>
		<tr>
		<td height="43">&nbsp;</td>
		<td>
		<p align="left">
        <input name="edit" type="submit" id="save" value="Save Details" onclick="return addClassValidation()">
    </p>
	</td>
	</tr>
    </table>
</form>
</div>
</div>	
</td>					
<?php

	

if(isset($_POST['save']))
{
$full_name =$_POST['full_name'];
$userName  =$_POST['userName'];
$password  =$_POST['password'];
//$password=hash('sha512',$password);
$password  = sha1($password);

$user_type_id=$_POST['user_type_id'];
 //validation
	

if(!empty($_FILES['student_photo']['name'])) 	{
	$new_Sdir  = "modules/security/users/";
if (!file_exists($new_Sdir)) {
	   $mode          = 0777;
       mkdir($new_Sdir , $mode , TRUE) or die('Error Creating folder in server');
	 }
$fileSize   = $_FILES["student_photo"]["size"];	 
$minSize   = 10000;   //min size 100kbs
$maxSize   = 2000000;  // max size 2mbs


if($fileSize < $minSize){

die('**Image Is too small should be bigger than 100kb**');
}
else if($fileSize > $maxSize){
die('**Image Is too big max size 2mb**');
}
$type  = $_FILES["student_photo"]["type"];
 if (($type == "image/gif")|| ($type == "image/jpeg")|| ($type == "image/png")|| ($type == "image/pjpeg")) {
      	   $type = substr($type, 6); 
                  $uploadfile =  uniq(basename($_FILES['student_photo']['name']));
					$transfer = move_uploaded_file($_FILES['student_photo']['tmp_name'],$new_Sdir .$uploadfile );
					//move_uploaded_file($_FILES['new_pic']['tmp_name'], "UserFiles/".$img_by."/temp/".$newname.".".$type);
					 $student_photourlsrc='/sms/'.$new_Sdir .$uploadfile;
					 
		   }	 
		else {die('**The file you are uploading is invalid**');}
	}else{
		$student_photourlsrc="";
	}


$insert="INSERT INTO user VALUES ('','$full_name','$userName','$password', '$user_type_id',1,'$student_photourlsrc') ";
mysqli_query($con1,$insert) or die("User Registration failed<br/>".mysqli_error($con1));
echo '<p align="center" class="success">User Registration successfully</p><br>';

}



if(isset($_POST['edit']))
{
$full_name=$_POST['full_name'];
$userName=$_POST['userName'];
$password=$_POST['password'];
$password  = sha1($password);
 
 if(is_numeric($full_name) || preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/',$full_name) ){
 echo "<script language=javascript>alert( '***Please enter a valid name***');window.location = '/sms/index.php?view=add_user';</script>";
	}
	
	$new_Sdir  = "modules/security/users/";
	if(!empty($_FILES['student_photo']['name'])) 	{
if (!file_exists($new_Sdir)) {
	   $mode          = 0777;
       mkdir($new_Sdir , $mode , TRUE) or die('Error Creating folder in server');
	 }
$fileSize   = $_FILES["student_photo"]["size"];	 
$minSize   = 10000;   //min size 100kbs
$maxSize   = 2000000;  // max size 2mbs


 if($fileSize > $maxSize){
die('**Image Is too big max size 2mb**');
}
$type  = $_FILES["student_photo"]["type"];
 if (($type == "image/gif")|| ($type == "image/jpeg")|| ($type == "image/png")|| ($type == "image/pjpeg")) {
      	   $type = substr($type, 6); 
                  $uploadfile =  uniq(basename($_FILES['student_photo']['name']));
					$transfer = move_uploaded_file($_FILES['student_photo']['tmp_name'],$new_Sdir .$uploadfile );
					//move_uploaded_file($_FILES['new_pic']['tmp_name'], "UserFiles/".$img_by."/temp/".$newname.".".$type);
					 $student_photourlsrc='/sms/'.$new_Sdir .$uploadfile;
					 
		   }	 
		else {die('**The file you are uploading is invalid**');}
		}else{
		$student_photourlsrc="";
	}

if ($_SESSION['User_type']=="admin" || $_SESSION['User_type']=="super_admin" ){
$user_type_id=$_POST['user_type_id'];
$insert="update user set full_name='$full_name',userName='$userName',password='$password',user_type_id='$user_type_id',status=1,student_photoURL='$student_photourlsrc' where user_id='".$_SESSION['UserID']."'";
mysqli_query($con1,$insert) or die("User Account Update failed<br/>".mysqli_error($con1));
echo '<p align="center" class="success">User Account successfully Updated</p><br>';

}else{
$insert="update user set full_name='$full_name',userName='$userName',password='$password',status=1,student_photoURL='$student_photourlsrc' where user_id='".$_SESSION['UserID']."'";
mysqli_query($con1,$insert) or die("User Account Update failed<br/>".mysqli_error($con1));
echo '<p align="center" class="success">User Account successfully Updated</p><br>';
}

}
?>		
