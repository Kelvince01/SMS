<td width="80%" valign="top">
<?php
extract($_POST);
			//validation of form						
 if(is_numeric($fname) || preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/',$fname) ){
echo "<script language=javascript>alert( 'Please enter a valid surname');window.location = '/sms/index.php?view=admissions';</script>";
	}
else if(is_numeric($mname) || preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/',$mname) ){
echo "<script language=javascript>alert( 'Please enter a valid middle name');window.location = '/sms/index.php?view=admissions';</script>";
	}
else if(is_numeric($lname) || preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/',$lname) ){
echo "<script language=javascript>alert( 'Please enter a valid last name');window.location = '/sms/index.php?view=admissions';</script>";
  }	

else if(is_numeric($pfname) || preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/',$pfname) ){
echo "<script language=javascript>alert( 'Please enter a valid Parents surname');window.location = '/sms/index.php?view=admissions';</script>";
  }	

else if(is_numeric($pmname) || preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/',$pmname) ){
echo "<script language=javascript>alert( 'Please enter a valid Parents first name');window.location = '/sms/index.php?view=admissions';</script>";
	}	
else if(is_numeric($plname) || preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/',$plname) ){
echo "<script language=javascript>alert( 'Please enter a valid Parents last name');window.location = '/sms/index.php?view=admissions';</script>";
}
else if(!is_numeric($phone_no) || !preg_match('/^[0-9]{10}+$/',$phone_no) || preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/',$phone_no)){
echo "<script language=javascript>alert( 'Please enter a valid mobile number');window.location = '/sms/index.php?view=admissions';</script>";
}

else if(!filter_var($email_address,FILTER_VALIDATE_EMAIL)){
echo "<script language=javascript>alert( 'Please enter a valid email address');window.location = '/sms/index.php?view=admissions';</script>";
	}	

//validation ya mobile{



else{		

					
//Extract form details
$fName=$_POST['fname'];
$mName=$_POST['mname'];
$lName=$_POST['lname'];
$adminNo=$_POST['adminNo'];
$gender=$_POST['gender'];
$date_of_birth=$_POST['dob'];
$family_status=$_POST['family_status'];
$pFname=$_POST['pfname'];
$pMname=$_POST['pmname'];
$pLname=$_POST['plname'];
$pother=$_POST['pother'];
$pmarital_status=$_POST['pmarital_status'];
$spouse_name=$_POST['spouse_name'];
$occupation=$_POST['occupation'];
$spouse_occupation=$_POST['spouse_occupation'];
$phone_no=$_POST['phone_no'];
$postal_address=$_POST['postal_address'];
$email_address=$_POST['email_address'];
$residence=$_POST['residence'];
$contact=$_POST['contact'];
$medical_condition=$_POST['medical_condition'];
$special_diet=$_POST['special_diet'];
$student_active=$_POST['student_active'];
$student_status=$_POST['student_status'];
$admission_year=$_POST['admission_year'];
$date=date('Y-m-d');

//Check if Student alreay exists
$query="SELECT * FROM student_details WHERE adminNo='".$adminNo."' Limit 1 ";
$result=mysqli_query($con1,$query);
$Num_Of_Records=mysqli_num_rows($result);
//if item already exists
	if ($Num_Of_Records > 0)
	{
		echo "**A Student with the same Admission No already exists. A Student may only be registered once**";
	}
	//Add Student
else{

$_SESSION['adminNo']=$adminNo;

if(!empty($_FILES['student_photo']['name'])) 	{
					$new_Sdir  = "admissions/students/student_photos/";
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
					 $upload2file='/sms/modules/'.$new_Sdir .$uploadfile;
					 if ($transfer) 
							{
							   echo "The student_photo image was successfully uploaded.\n";
							   echo '<br>Click <a href="'.$new_Sdir.$uploadfile.'">here</a> to view the file'; 
							   $student_photourlsrc = $upload2file;
							} 
							else 
							{
								$student_photourlsrc = "";
							   echo "<br>The student_photo Image was not transfered!\n";
							} 
		   }	 
		else {die('**The file you are uploading is invalid**');}			
}else{
	$student_photourlsrc = "";
}
							//end file upload for student_photo


// Insert Student Details
$query="INSERT INTO student_details (adminNo,fname,mname,lname,others,gender,dob,class_id,parent_id,active,admission_year,status,student_photoURL)
VALUES ('$adminNo','$fName','$mName','$lName','','$gender','$date_of_birth','0','0','$student_active','$admission_year','$student_status','$student_photourlsrc')";

$result=mysqli_query($con1,$query) or die(mysqli_error($con1));
//Insert Parents Details
$query="INSERT INTO parent_details (fname,mname,lname,otherNames,marital_status,spouse_name,occupation,spouse_occupation,phoneNo,postalAddress,email_address,residence,contact_method,active,responsibility)
VALUES ('$pFname','$pMname','$pLname','$pother','$pmarital_status','$spouse_name','$occupation','$spouse_occupation','$phone_no','$postal_address','$email_address','$residence','$contact','1','none')";
$result=mysqli_query($con1,$query) or die(mysqli_error($con1));
//Select last parent id inserted
$query="SELECT parent_id FROM parent_details  ORDER BY parent_id DESC LIMIT 1";
$result=mysqli_query($con1,$query) or die ('error');
$row=mysqli_fetch_array($result);
if (mysqli_num_rows($result) > 0) {
$parent_id=$row[0];
//Update student details,to add parent id
$query="UPDATE student_details SET parent_id='$parent_id' WHERE adminNo='$adminNo'";
mysqli_query($con1,$query) or die ('Couldnt update student details');
}
//Update medical details_table
//get student id first
$query="SELECT stud_id FROM student_details where adminNo='$adminNo'";
$result=mysqli_query($con1,$query) or die ('error');
$row=mysqli_fetch_array($result);
if (mysqli_num_rows($result) > 0) {
$stud_id=$row[0];
//insert medical conditions now
$query="INSERT INTO medical_history (student_id,medical_condition,special_diet)
VALUES ('$stud_id','$medical_condition','$special_diet')";
$result=mysqli_query($con1,$query) or die(mysqli_error($con1));
}?>
<p align="center"class='success'>Student details added Successfully.</p><br>
<?php
}
}
?>
</td>