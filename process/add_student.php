<td width="80%" valign="top">
<?php
//remember to take off dashboard reports if you wont link them.
//this part will take care of images
				//check if file exceeds maximum allowed
				if ($_FILES['student_photo']['error'] == UPLOAD_ERR_FORM_SIZE )
					{
						$errorList[] = "The Student Photo File exceeds required size";
					} 
					 
					$uploadfile =  uniq(basename($_FILES['student_photo']['name']));
					$transfer = move_uploaded_file($_FILES['student_photo']['tmp_name'],$uploadfile );
					
					 
					
							if ($transfer) 
							{
							   echo "The student_photo image is valid, and was successfully uploaded.\n";
							   echo "<br>student_photo image was uploaded to " .$uploadfile;
							   echo '<br>Click <a href="'.$uploadfile.'">here</a> to view the file 
							    <br><span><br>student_photo Image Uploaded: </span>'.$_FILES['student_photo']['name'].', a '.$_FILES['student_photo']['size'].' byte file with a mime
							   type of '.$_FILES['student_photo']['type'];
								$student_photourlsrc = $uploadfile;
								echo "<br>";
							} 
							else 
							{
								$student_photourlsrc = "";
							   echo "<br>The student_photo Image was not transfered!\n";
							} //end file upload for student_photo
				
				
			
				
					
					// check for errors
					// if none found...
					
//Extract form details
$fName=$_POST['fname'];
$mName=$_POST['mname'];
$lName=$_POST['lname'];
$other_names=$_POST['other'];
$gender=$_POST['gender'];
$date_of_birth=$_POST['dob'];
$family_status=$_POST['family_status'];
//$passport=$_POST['passport'];
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
$query="SELECT fname,mname,lname FROM student_details WHERE fname='".$fName."' AND mname='".$mName."' AND lname='".$lName."' ";
$result=mysqli_query($con1,$query);
$Num_Of_Records=mysqli_num_rows($result);
//if item already exists
	if ($Num_Of_Records > 0)
	{
		echo "**A Student with the same name already exists. A Student may only be registered once**";
	}
	//Add Student
else{
//Get last adminNo and create a one for the the student we are adding
$query="SELECT adminNo FROM student_details  ORDER BY stud_id DESC LIMIT 1";
$result=mysqli_query($con1,$query) or die ('error');
$row=mysqli_fetch_array($result);
if (mysqli_num_rows($result) > 0) {
$adminNo=$row[0];
//increament last adminNo for the current student
$adminNo=$adminNo+1;
}
//add leading zeros to the adminNo
if ($adminNo<10)
{
$zero='000';
}
elseif($adminNo==10 && $adminNo<100)
{
$zero='00';
}
elseif($adminNo==100 && $adminNo<1000)
{
$zero='0';
}
else{
$zero='';
}
$adminNo=$zero.$adminNo;
$_SESSION['adminNo']=$adminNo;
// Insert Student Details
$query="INSERT INTO student_details (adminNo,fname,mname,lname,others,gender,dob,class_id,parent_id,active,admission_year,status,student_photoURL)
VALUES ('$adminNo','$fName','$mName','$lName','$other_names','$gender','$date_of_birth','0','0','$student_active','$admission_year','$student_status','$student_photourlsrc')";
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
}
?>
<p align="center"class='success'>Student details added Successfully.</p><br>
<?php
}
?>
</td>