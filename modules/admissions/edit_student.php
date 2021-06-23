<?php
 $stud_id= $_GET['stud_id'];
$sql="select * from student_details where stud_id = $stud_id";
$row = mysqli_query($con1,$sql) or die(mysqli_error($con1));
$res= mysqli_fetch_assoc($row);
extract($res);
$query1="SELECT class_id,class_name from class where class_id='$class_id'";
$result1=mysqli_query($con1,$query1);
$row1 = mysqli_fetch_assoc($result1);
extract($row1);
$query2="SELECT * from student_subjects where stud_id='$stud_id'";
$result2=mysqli_query($con1,$query2);
$row2 = mysqli_fetch_assoc($result2);
extract($row2);
?>
<td width="80%" valign="top">
<p> <h2 class="title">Edit Student Info</h2>


        <form action="" method="post" name="frmStdDetails" id="frmStdDetails"  enctype="multipart/form-data">
    <table width="550" border="0"  cellpadding="5" cellspacing="1" class="entryTable">
      
      <tr class="entryTableHeader">
      
            <td colspan="4">Student Details</td>
        </tr>
        <tr>
            <td width="150" class="label">Surname</td>
            <td class="content"><input name="fname" type="text" class="box" value = "<?php echo $fname;?>" id="fname" size="30" maxlength="50" required  ><span class="required" >*</span></td>
             <td width="150" class="label">First Name</td>
            <td class="content"><input name="mname" type="text" class="box" value = "<?php echo $mname;?>" id="fname" size="30" maxlength="50"  required><span class="required" >*</span></td>
        </tr>
        <tr>
            <td width="150" class="label">Middle Name</td>
            <td class="content"><input name="lname" type="text" value = "<?php echo $lname;?>" id="lname" maxlength="50"><div id="lname"></div></td>
            <td width="150" class="label">Admission No</td>
            <td class="content"><input name="adminNo" type="text" id="adminNo" value = "<?php echo $adminNo;?>" maxlength="10" required><span class="required" >*</span></td>
        </tr>
        <tr>
            <td width="150" class="label">Gender</td>
            <td><select name="gender" class="box" id="gender" required>
             <option value="" selected>-.- Select -.-</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
           </select><span class="required">*</span></td>
            <td width="150" class="label">Date of Birth</td>
            <td class="content"><input name="dob" type="text" class="box" value =  "<?php echo $dob;?>" id="datepicker" required><span class="" title="This field is required.">*</span></td>
        </tr>
        <tr>
            <td width="150" class="label">Year of Admission</td>
            <td class="content"><input name="admission_year" type="text" class="box" value = "<?php echo $admission_year;?>" id="admission_year" maxlength="4" required><span class="required" >*</span></td>
            <td width="150" class="label">Class Name</td>
                <td><select name="class_id">
                <?php echo '<option value="'.$class_id.'">'.$class_name.'</option>';                
                $query1="SELECT class_id,class_name FROM class ";
                $result = mysqli_query($con1,$query1);
            while($nt=mysqli_fetch_array($result)){//Array or records stored in $nt
            echo "<option value=$nt[class_id]>$nt[class_name]</option>";
            }?>  
            </select></td>
        </tr>  
       
        <tr>
        <td width="150" ></td>
            <td class="content">Fields Marked with<span class="required" title="This field is required.">*</span> are required.</td>
        </tr>

         <tr class="entryTableHeader">
      
            <td colspan="4">Subject Allocation</td>
        </tr>
        <tr>
            <td width="150" class="label">English</td>
            <td class="content"><input name="subject[]" type="checkbox" value = "english" <?php if ($english== 1) echo 'checked';?> ></td>
            <td width="150" class="label">Math</td>
            <td class="content"><input name="subject[]" type="checkbox" value = "maths"  <?php if ($maths== 1) echo 'checked';?>></td>
        </tr>
        <tr>
            <td width="150" class="label">Kiswahili</td>
            <td class="content"><input name="subject[]" type="checkbox" value = "kiswahili" <?php if ($kiswahili== 1) echo 'checked';?>></td>
            <td width="150" class="label">Science</td>
            <td class="content"><input name="subject[]" type="checkbox" value = "Science"  <?php if ($Science== 1) echo 'checked';?>></td>
        </tr>
        <tr>
            <td width="150" class="label">SocialStudies</td>
            <td class="content"><input name="subject[]" type="checkbox" value = "SocialStudies" <?php if ($SocialStudies== 1) echo 'checked';?>></td>
            <td width="150" class="label">READING</td>
            <td class="content"><input name="subject[]" type="checkbox" value = "READING" <?php if ($READING== 1) echo 'checked';?>></td></td>
        </tr>
        <tr>
            <td width="150" class="label">CREATIVE</td>
            <td class="content"><input name="subject[]" type="checkbox" value = "CREATIVE" <?php if ($CREATIVE== 1) echo 'checked';?>></td>
            <td width="150" class="label">N/W</td>
            <td class="content"><input name="subject[]" type="checkbox" value = "NW" <?php if ($NW== 1) echo 'checked';?>></td></td>
        </tr>
         <tr>
            <td width="150" class="label">ENVT</td>
            <td class="content"><input name="subject[]" type="checkbox" value = "ENVT" <?php if ($ENVT== 1) echo 'checked';?>></td>            
        </tr>
        <tr>
        <td height="43">&nbsp;</td>
        <td>
        <p align="left">
        <input name="save" type="submit" id="save" value="Save Details">
    </p>
    </td>
    </tr>
    </div>
    </table>
</form>
 <p>&nbsp;</p>

</p>
</table>
<?php
if(isset($_POST['save'])){      

extract($_POST);
$query1="update student_details set fname ='$fname',mname='$mname',dob='$dob',lname='$lname',adminNo='$adminNo',admission_year='$admission_year',
 class_id=$class_id where stud_id= $stud_id";
$result1=mysqli_query($con1,$query1) or die(mysqli_error($con1));

$query="Update student_subjects set english=0,kiswahili=0,maths=0,SocialStudies=0,Science=0,READING=0,CREATIVE=0,NW=0 
        where stud_id = $stud_id";
mysqli_query($con1,$query) or die (mysqli_error($con1));

if(isset($_POST['subject'])){  
foreach($_POST['subject'] as $index => $val){
 
switch ($val){
    case 'english':
    $query="Update student_subjects set english=1 where stud_id = $stud_id";
    mysqli_query($con1,$query) or die (mysqli_error($con1));
    break;
    case 'maths':
    $query="UPDATE student_subjects SET `maths`='1' WHERE stud_id=$stud_id";
    mysqli_query($con1,$query) or die (mysqli_error($con1));
    break;
    case 'kiswahili':
    $query="UPDATE student_subjects SET `kiswahili`='1' WHERE stud_id=$stud_id";
    mysqli_query($con1,$query) or die (mysqli_error($con1));
    break;
    case 'SocialStudies':
    $query="UPDATE student_subjects SET `SocialStudies`='1' WHERE stud_id=$stud_id";
    mysqli_query($con1,$query) or die (mysqli_error($con1));
    break;
    case 'Science':
    $query="UPDATE student_subjects SET `Science`='1' WHERE stud_id=$stud_id";
    mysqli_query($con1,$query) or die ('Error3');
    break;
    case 'READING':
    $query="UPDATE student_subjects SET `READING`='1' WHERE stud_id=$stud_id";
    mysqli_query($con1,$query) or die (mysqli_error($con1));
    break;
    case 'CREATIVE':
    $query="UPDATE student_subjects SET `CREATIVE`='1' WHERE stud_id=$stud_id";
    mysqli_query($con1,$query) or die ('Error3');
    break;
    case 'ENVT':
    $query="UPDATE student_subjects SET `ENVT`='1' WHERE stud_id=$stud_id";
    mysqli_query($con1,$query) or die ('Error3');
    break;
    case 'NW':
    $query="UPDATE student_subjects SET `NW`='1' WHERE stud_id=$stud_id";
    mysqli_query($con1,$query) or die ('Error3');
    break;

            }
    }
}
echo'<script>window.location=" /sms/modules/admissions/students/students_list2.php"</script>';
}

?>