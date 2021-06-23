<script>
function confirmSubmit()
{
    if (confirm('Are you sure you want to delete this record?'))
    {
        return true;
    }
    return false;
}
</script>
<td width="80%" valign="top">
<!--insert data page-->

<div class="demo">

<div id="tabs">
	<ul>

		<li><a href="#tabs-1">Classes</a></li>
		<li><a href="#tabs-2">Subjects</a></li>
		<li><a href="#tabs-3">CST</a></li>
		<li><a href="#tabs-4">Exams</a></li>
		<li><a href="#tabs-5">Grades</a></li>
	<?php if ($_SESSION['User_type']=="admin" || $_SESSION['User_type']=="super_admin" || $_SESSION['User_type']=="teacher"){ ?>	
		<li><a href="#tabs-6">Mark Books</a></li> <?php } ?>
		<li><a href="#tabs-7">Merit List</a></li> 
	<?php if ($_SESSION['User_type']=="admin" || $_SESSION['User_type']=="super_admin" || $_SESSION['User_type']=="parent" || $_SESSION['User_type']=="teacher" || $_SESSION['User_type']=="student"){ ?> 	
	<li><a href="#tabs-8">Performance Anaylsis</a></li> <?php } ?>


	</ul>
		<div id="tabs-1" >

	<p> <h2 class="title">Classes Details</h2>
		<?php
			//include '/sms/connection/connect.php';
			$sql = "Select * FROM class ORDER by class_id,class_status ASC ";
			$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));


			?>

<form action="/sms/index.php?view=process_addClass" method="post" name="" id="">
<table width="90%" border="0" cellpadding="1" cellspacing="1" id="theList" class="entryTable">
<?php if ($_SESSION['User_type']=="admin" || $_SESSION['User_type']=="super_admin"){?> 
<tr>
    <td><a href="/sms/index.php?view=add_class" class="add">New Class</a></td>
    <td colspan="4"><a href="/sms/index.php?view=move_class" class="add">Move Students to Next Class</a></td
</tr>
<?php } ?>
<tr align="center" class="entryTableHeader">
<th width="20%" >Class</th>
<th width="10%">Capacity</th>
<th width="10%">Girls</th>
<th width="10%" >Boys</th>
<th width="15%" >Remaning</th>
<th width="15%" >status</th>
<?php if ($_SESSION['User_type']!="student"){ ?><th align="">Actions</th> <?php } ?>
</tr>
<?php
if (mysqli_num_rows($result) > 0) {
$i = 0;

while($row = mysqli_fetch_assoc($result)) {
extract($row);
//select capacity
$query="SELECT COUNT(gender)AS total1,gender as boys FROM student_details WHERE class_id='$class_id' and gender='male' GROUP BY gender ";
$re=mysqli_query($con1,$query);
if (mysqli_num_rows($re) > 0) {
$rw = mysqli_fetch_assoc($re);
extract($rw);
}
else{
$total1=0;
}
$query1="SELECT COUNT(gender)AS total2,gender as girls FROM student_details WHERE class_id='$class_id' and gender='female' GROUP BY gender";
$re1=mysqli_query($con1,$query1);
if (mysqli_num_rows($re1) > 0) {
$rw1 = mysqli_fetch_assoc($re1);
extract($rw1);
}
else{
$total2=0;
}
$now=$capacity-($total1+$total2);
if ($i%2) {
	$class = 'row1';
} else {
	$class = 'row2';
}
$i += 1;
?>
<tr class="<?php echo $class; ?>">
<td align="center"><?php echo $class_name;?> </td>
<td align="center"><?php echo $capacity;?> </td>
<td align="center"><?php echo $total2;?> </td>
<td align="center"><?php echo $total1;?> </td>
<td align="center"><?php echo $now;?> </td>
<td align="center"><?php if ($class_status=='1'){echo 'active';}else{echo 'N/A';} ?> </td>
<?php if ($_SESSION['User_type']!="student"){ echo ' <td align="center">
<a href="/sms/index.php?&class_id= '.$class_id.' &view=edit_classes"><img src="/sms/images/update.png"/>Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="/sms/index.php?&class_id= '.$class_id.'&view=delete_class" onclick="return confirmSubmit();"><img src="/sms/images/delete.jpg"/></a>Delete</td></tr>
 ';} ?>

 <?php
}
}
else{
	echo 'No classes for now.';
}
?>
</table>

 <p>&nbsp;</p>

	</div>

	<div id="tabs-2">
	<p> <?php
	
$sql = "SELECT subject.*, subject_name, group_name, department FROM subject, subject_group, departments WHERE 
        subject.group_id=subject_group.group_id and subject.department_id=departments.department_id ";
$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));


?>
 <h2>Subjects On Offer in this School</h2>
<table width="90%" border="0"  cellpadding="1" cellspacing="1" id="theList" class="entryTable">
<?php if ($_SESSION['User_type']=="admin" || $_SESSION['User_type']=="super_admin" ){?> <tr><td><a href="/sms/index.php?view=add_subject" class="add">New Subject</a></td></tr> <?php } ?>
<tr align="center" class="entryTableHeader">
<th  align="center" >Subject ID</th>
<th  align="center">Subject Name</th>
<th  align="center">Group Name</th>
<th  align="center">Department</th>
<th  align="center">KNEC Code</th>
<?php if ($_SESSION['User_type']!="student"){ ?> <th  align="center">Actions</th><?php } ?>
</tr>
<?php
if (mysqli_num_rows($result) > 0) {
	$i = 0;

	while($row = mysqli_fetch_assoc($result)) {
		extract($row);
if ($i%2) {
	$class = 'row1';
} else {
	$class = 'row2';
}
$i += 1;
?>
<tr class="<?php echo $class; ?>">
<td align="center"><?php echo $subject_id;?> </td>
<td align="center"><?php echo $subject_name;?></td>
<td align="center"><?php echo $group_name;?></td>
<td align="center"><?php echo $department;?></td>
<td align="center"><?php echo $code_id;?></td>
<td align="center">
<?php if ($_SESSION['User_type']!="student"){  ?>
<a href="/sms/index.php?&subject_id=<?php echo $subject_id;?>&view=edit_subject"><img src="/sms/images/update.png"/>Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="/sms/index.php?&subject_id=<?php echo$subject_id;?>&view=delete_subject" onclick="return confirmSubmit();"><img src="/sms/images/delete.jpg"/>Delete</a></td></tr>

 <?php
 }
}
}
else{
echo 'No Subjects for now.';
}
?>
</table>
</form>

 <p>&nbsp;</p>
</p>
		</div>
			<div id="tabs-3">
	<p> <?php
	
$sql = "SELECT cst_id,class_name,subject_name,teacher_name FROM class_subject_teacher,teacher,class,SUBJECT WHERE 
subject.subject_id=class_subject_teacher.subject_id AND teacher.teacher_id=class_subject_teacher.teacher_id AND class.class_id=class_subject_teacher.class_id ";
$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));


?>
 <h2>Class Subject Teacher Allocation</h2>
<table width="90%" border="0" cellpadding="1" id="theList" cellspacing="1" class="entryTable">
<tr><?php if ($_SESSION['User_type']=="admin" || $_SESSION['User_type']=="super_admin" ){?>
 <td><a href="/sms/index.php?view=add_subject_allocation" class="add">New CST Allocation</a></td>
 <td><a href="/sms/index.php?view=add_teacher" class="add">New Teacher</a></td> 
 <td><a href="/sms/index.php?view=teacher" class="add">Teacher Details</a></td> 
 <?php }?>
<tr  class="entryTableHeader">
<th >Subject Name</th>
<th >Class Name</th>
<th  >Teacher Name</th>
<?php if ($_SESSION['User_type']=="admin" || $_SESSION['User_type']=="super_admin" ){?> <th >Actions</th> <?php } ?>
</tr>
<?php
if (mysqli_num_rows($result) > 0) {
	$i = 0;

	while($row = mysqli_fetch_assoc($result)) {
		extract($row);
if ($i%2) {
	$class = 'row1';
} else {
	$class = 'row2';
}
$i += 1;
?>
<tr class="<?php echo $class; ?>">
<td align=""><?php echo $subject_name;?></td>
<td align="center"><?php echo $class_name;?></td>
<td align=""><?php echo $teacher_name;?> </td>
<?php if ($_SESSION['User_type']=="admin" || $_SESSION['User_type']=="super_admin" ){ ?>
<td align="center">
<a href="/sms/index.php?&cst_id=<?php echo $cst_id;?>&view=edit_Classubject"><img src="/sms/images/update.png"/>Edit </a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="/sms/index.php?&cst_id=<?php echo $cst_id;?>&view=delete_Classubject" onclick="return confirmSubmit();"><img src="/sms/images/delete.jpg"/> Delete</a></td></tr>
<?php }?>
</tr>
 <?php
}
}
else{
echo 'No Subjects for now.';
}
?>
</table>
</form>

 <p>&nbsp;</p>
</p>
		</div>

	<div id="tabs-4">
	<?php
	
$sql = "Select * FROM exams ORDER by exam_id ASC ";
$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));


?>
 <h2>Available Exam Groups</h2>
<table width="90%" border="0" id="theList" cellpadding="1" cellspacing="1" class="entryTable">
<tr><?php if ($_SESSION['User_type']=="admin" || $_SESSION['User_type']=="super_admin" || $_SESSION['User_type']=="teacher"){?> <td><a href="/sms/index.php?view=add_exam" class="add">New Exam Group</a></td></tr> <?php } ?>
<tr align="center" class="entryTableHeader">
<th  align="center" >Exam ID</th>
<th  align="center">Exam Name</th>
<th  align="center">Total Marks</th>
<?php if ($_SESSION['User_type']=="admin" || $_SESSION['User_type']=="super_admin" || $_SESSION['User_type']=="teacher"){?>  <th  align="center">Actions</th> <?php } ?>
</tr>
<?php
if (mysqli_num_rows($result) > 0) {
	$i = 0;

	while($row = mysqli_fetch_assoc($result)) {
		extract($row);
if ($i%2) {
	$class = 'row1';
} else {
	$class = 'row2';
}
$i += 1;
?>
<tr class="<?php echo $class; ?>">
<td align="center"><?php echo $exam_id;?> </td>
<td align="center"><?php echo $exam_type;?></td>
<td align="center"><?php echo $total_marks;?></td>
<td align="center">
<?php if ($_SESSION['User_type']=="admin" || $_SESSION['User_type']=="super_admin" || $_SESSION['User_type']=="teacher"){ ?> 
<a href="/sms/index.php?&exam_id=<?php echo $exam_id;?>&view=edit_exam"><img src="/sms/images/update.png"/>Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="/sms/index.php?&exam_id=<?php echo$exam_id;?>&view=delete_exam" onclick="return confirmSubmit();"><img src="/sms/images/delete.jpg"/>Delete</a></td>
<?php } ?>
</tr>

 <?php
}
}
else{
echo 'No exams for now.';
}
?>
</table>
</form>
</div>
	<div id="tabs-5">



			<?php
			
			$sql = "Select * FROM grades ORDER by grade_id ASC ";
			$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));


			?>
 <h2>Grading System</h2>
<table width="90%" border="0" cellpadding="1" id="theList" cellspacing="1" class="entryTable">
<?php if ($_SESSION['User_type']=="admin" || $_SESSION['User_type']=="super_admin" || $_SESSION['User_type']=="teacher"){ ?>
<tr>
<td><a href="/sms/index.php?view=add_grade" class="add">New Grade</a></td>
<td><a href="/sms/index.php?view=special_grade" class="add">Special Grades</a></td></tr> <?php } ?>
<tr align="center" class="entryTableHeader">
<th align="center">Grade</th>
<th width="" align="center">Range</th>
<th width=""align="center">Comments</th>
<?php if ($_SESSION['User_type']=="admin" || $_SESSION['User_type']=="super_admin" || $_SESSION['User_type']=="teacher"){ ?><th align="center">Actions</th> <?php } ?>
</tr>
<?php
if (mysqli_num_rows($result) > 0) {
$i = 0;

while($row = mysqli_fetch_assoc($result)) {
extract($row);
if ($i%2) {
	$class = 'row1';
} else {
	$class = 'row2';
}
$i += 1;
?>
<tr class="<?php echo $class; ?>">
<td align="center" ><?php echo $grade;?> </td>
<td align="center"><?php echo $max_mark.'-'.$min_mark;?> </td>
<td align="center"><?php echo $grade_comment;?> </td>

<td align="center"><?php if ($_SESSION['User_type']!="student"){ ?>
<a href="/sms/index.php?&grade_id=<?php echo $grade_id;?>&view=edit_grade"><img src="/sms/images/update.png"/>Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="/sms/index.php?&grade_id=<?php echo $grade_id;?>&view=delete_grade" onclick="return confirmSubmit();"><img src="/sms/images/delete.jpg"/>Delete</a></td></tr>
 <?php
 }
}
}
else{
	echo 'No hostels for now.';
}
?>
</table>

 <p>&nbsp;</p>

</form></p>
		</div>
<div id="tabs-6">



			<?php
			$myclass ='Class 1';
			if ( $_SERVER['REQUEST_METHOD'] == 'POST' ){
				$myclass = ($_POST['class']);
			}			
			$sql = "SELECT DISTINCT gradebk, gradebk_id, subject_name, class_name, term_name, year_name
FROM gradebk, SUBJECT, class, exams, term_period
WHERE gradebk.subject_id = subject.subject_id
AND gradebk.class_id = class.class_id
AND gradebk.term_id = term_period.term_id 
AND class.class_for = '$myclass' 
";
			$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));


			?>
<?php if ($_SESSION['User_type']=="admin" || $_SESSION['User_type']=="super_admin" || $_SESSION['User_type']=="teacher"){ ?>			
 <h2>Mark Books</h2> <?php }?>
 <form method="post" action="/sms/index.php?view=academics#tabs-6" name="classfilter" id="classfilter">
<select name="class" class="box" id="class_id" onchange="classfilter.submit();"  required>
  <?php
	$qry="SELECT DISTINCT class_for FROM  class ";
	$res=mysqli_query($con1,$qry);
	echo "<option selected>$myclass</option>";
	while($nt=mysqli_fetch_array($res)){//Array or records stored in $nt
		echo "<option>$nt[class_for]</option>";
		}?>
</select>
</form>

<form action="receipts/produce_receipt.php" method="post" name="" id="">
<table width="90%" border="0" cellpadding="1" cellspacing="1" id="theList" class="entryTable">

<?php if ($_SESSION['User_type']=="admin" || $_SESSION['User_type']=="super_admin" || $_SESSION['User_type']=="teacher"){ ?>
<tr>
<td><a href="/sms/index.php?view=add_gradebk" class="add">New Mark Book</a></td>
<td><a href="/sms/index.php?view=newperiod" class="add">New Mark Period</a></td>
<td><a href="/sms/index.php?view=newperiod" class="add">Adjust Mark Period</a></td>
</tr> 
<tr align="center" class="entryTableHeader">
<th>Mark BookID</th>
<th width="30%">Mark Book</th>
<th width="15%">Subject</th>
<th width="15%" >Class</th>
<th align="center">Term</th>
<th align="center">Actions</th>  

</tr>
<?php
}
if (mysqli_num_rows($result) > 0) {
$i = 0;

while($row = mysqli_fetch_assoc($result)) {
extract($row);
//$now=$required_manpower-$allocated;
if ($i%2) {
	$class = 'row1';
} else {
	$class = 'row2';
}
$i += 1;
?> 
 
<tr class="<?php echo $class; ?>"> 
<?php if ($_SESSION['User_type']=="admin" || $_SESSION['User_type']=="super_admin" || $_SESSION['User_type']=="teacher"){ echo '
<td align="center">'.$gradebk_id.'</td> 
<td align="center"><A HREF="/sms/index.php?view=add_marks&gradebk_id='.$gradebk_id.'">'.$gradebk.'</a> </td> 
<td align="center">'.$subject_name.' </td> 
<td align="center">'.$class_name.' </td> 
<td align="center">'.$term_name.' '.$year_name.' </td>  

<td align="center"><a href="/sms/index.php?view=edit_gradebk&gradebk_id='.$gradebk_id.'"><img src="/sms/images/update.png"/></a>Edit&nbsp;&nbsp;&nbsp;
<a href="/sms/index.php?view=delete_gradebk&gradebk_id='.$gradebk_id.'" onclick="return confirmSubmit();"><img src="/sms/images/delete.jpg"/>Delete</a></td></tr>
';} ?>
 <?php
}
}
else{
	echo 'No Grade Books for now.';
}
?>
</table>

 <p>&nbsp;</p>

</form></p>
</div>

	<div id="tabs-7">


<p> <h2 class="title">Generate a merit list here</h2>


		<form action="/sms/index.php?view=mark_sheet" method="post" name="frmStdDetails" id="frmStdDetails">
		<br>
    <table width="550" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
            <tr class="entryTableHeader">
            <td colspan="2"> Select your preferences </td>
        </tr>
            <tr><td width="150" class="label">Class</td>
			<td><select name="class_name" class="box" id="class_name">
			 <?php 
				$query1="SELECT class_name FROM class ";
				$result = mysqli_query($con1,$query1);
			// printing the list box select command

			while($nt=mysqli_fetch_assoc($result)){//Array or records stored in $nt
			extract($nt);
			echo '<option value="'.$class_name.'">'.$class_name.'</option>';
			$class_name2=$nt['class_name'];
$_SESSION['class_name']=$class_name2;
			/* Option values are added by looping through the array */
			}
			// Closing of list box 
			?>	
		   </select></td>
						</tr>
			<tr><td width="150" class="label">Term</td>
			<td><select name="term_name" class="box" id="term_name">
			 <option value="" selected>-.- Select -.-</option>
			<option value="Term 1">Term One</option>
			<option value="Term 2">Term Two</option>
			<option value="Term 3">Term Three</option>
			
		   </select></td>
						</tr>
			<tr><td width="150" class="label">Year</td>
			<td><input type="text" name="year_name" id="yearpicker"></td>
			</tr>			
        
		<tr>
		<td height="43">&nbsp;</td>
		<td>
		<p align="left">
        <input name="save" type="submit" id="save" value="Generate Merit List">
    </p>
	</td>
	</tr>
    </table>
</form>
</p>
			
		</div>
<div id="tabs-8">
<div>

	<div class="menu_str">
	<a href="/sms/index.php?view=pre_reportCard">Report Card</a></div>
	<div class="menu_str">
	<a href="/sms/index.php?view=pre_academicProgress">Student Academic Progress Report</a></div> 
	<div class="menu_str">
	<a href="/sms/index.php?view=pre_subanalysis">Subject analysis
	</a></div>
	<div class="menu_str">
	<a href="/sms/index.php?view=prehighest_marks">Top Student per Subject 
	</a></div>
	<div class="menu_str">
	<a href="/sms/index.php?view=pre_classanalysis">Class analysis
	</a></div>

 

</div>
<br><br>
<br>
</div>		
</div>
</div>
</div><!-- end div specific -->




<div style="clear: both;">&nbsp;</div>
</div>



<!--wrapper table-->
</td>