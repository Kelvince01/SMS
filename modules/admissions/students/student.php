<td width="80%" valign="top">
<!--insert data page-->
<div>
	<div class="menu_str">
		<a href="/sms/modules/admissions/students/students_list2.php">Students List</a></div>
	
	<div class="menu_str">
	<a href="/sms/modules/admissions/students/parent_list.php">Parent's List</a></div> 
	
</div>
<br>
<br>

<div id="tabs">
	<ul>
		<li><a href="#tabs-1">New Student </a></li>
		<li><a href="#tabs-2">Allocate Class</a></li>
		<li><a href="#tabs-3">Allocate Subjects</a></li>
		<!--<li><a href="#tabs-4">Allocate House</a></li>
		<li><a href="#tabs-5">Allocate Duties</a></li> -->
		<li><a href="#tabs-6">Additional Info</a></li>
		



	</ul>
		<div id="tabs-1">
		<?php include 'new_student.php'; ?>
	</div>

	<div id="tabs-2">
        <?php include 'allocate_class.php'; ?>
		</div>
	<div id="tabs-3">
	<?php include 'allocate_subject.php';?>
</div>
<!--
	<div id="tabs-4">
		<?php include 'allocate_hostel.php';?>	
		</div>
<div id="tabs-5">
	<?php include 'allocate_duty.php';?>	
</div> -->
<div id="tabs-6"> 
	<?php include 'more_info.php';?>

</div>
</div>

<!--wrapper table-->
</td>