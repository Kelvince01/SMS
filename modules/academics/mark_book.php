<?php
session_start();
include('../../connection/connect.php');
//$gradebk_id=$_GET['gradebk_id'];
//get grade book details
$sql = "SELECT class_name,class.class_id,subject_name,exam_type,term_name,year_name FROM gradebk,class,exams,term_period,SUBJECT
WHERE gradebk.class_id=class.class_id AND gradebk.exam_id=exams.exam_id AND gradebk.term_id=term_period.term_id
AND gradebk.subject_id=subject.subject_id and gradebk_id='1' ";
$result = mysqli_query($con1,$sql) or die(mysqli_error($con1));
$row = mysqli_fetch_assoc($result);
extract($row);
//require_once 'common.php';
//require_once 'load_factories.php';
//require_once 'library/config.php';
//require_once 'library/common.php';s=mysqli_fetch_array($execute);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>mySkulMate::Academics</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
<link type="text/css" href="/sms/datepicker/all.css" rel="stylesheet" />
<script src="../validation/scriptaculous/lib/prototype.js" type="text/javascript"></script>
<script src="../validation/scriptaculous/src/effects.js" type="text/javascript"></script>
<script type="text/javascript" src="../validation/fabtabulous.js"></script>
<script type="text/javascript" src="../validation/validation.js"></script>
<script type="text/javascript" src="/sms/datepicker/jquery.js"></script>
<script type="text/javascript" src="/sms/datepicker/core.js"></script>
<script type="text/javascript" src="/sms/datepicker/datepicker.js"></script>
<link rel="stylesheet" href="/sms/modules/admissions/jquery/development-bundle/themes/base/jquery.ui.all.css">
	<script src="/sms/modules/admissions/jquery/development-bundle/jquery-1.5.1.js"></script>
	<script src="/sms/modules/admissions/jquery/development-bundle/ui/jquery.ui.core.js"></script>
	<script src="/sms/modules/admissions/jquery/development-bundle/ui/jquery.ui.widget.js"></script>
	<script src="/sms/modules/admissions/jquery/development-bundle/ui/jquery.ui.tabs.js"></script>

	<script>
	$(function() {
		$( "#tabs" ).tabs();
	});
	</script>
	<SCRIPT TYPE="text/javascript">
<!--
function popup(mylink, windowname)
{
if (! window.focus)return true;
var href;
if (typeof(mylink) == 'string')
   href=mylink;
else
   href=mylink.href;
window.open(href, windowname, 'width=400,height=200,scrollbars=yes');
return false;
}
//-->
</SCRIPT>
</head>
<body>
<div id="wrap">

<div id="top"> </div>
<div id="contentt">
<div id="logo" align="center">
<img src="/sms/images/logo.png"/>

</div>
<!-- end header -->
<div class="left">
		 <?php
		include('user_menu.php');
		?>
	</div>


<div class="middle">
<div class="demo">
<p> <h2 class="title">Mark Sheet</h2>
         <?php
			
			$sql = "SELECT student_marks.stud_id,((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2) AS averageE,grade AS gradeE,fname,mname,lname,adminNo,subject_name,teacher_comments
FROM student_marks,student_details,grades,SUBJECT
WHERE student_marks.stud_id=student_details.stud_id AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)<=max_mark AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)>=min_mark
AND subject.subject_id=student_marks.subject_id AND subject.subject_id='1' AND term_id='1' ORDER by averageE DESC";
			$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));


			?>
	<br>
<form action="add_teacher_comments.php" method="post" name="" id="">
<p>Class: <?php echo $class_name; ?>&nbsp;&nbsp;|&nbsp;&nbsp;Subject: <?php echo $subject_name; ?> &nbsp;&nbsp;  <?php echo $term_name.' '.$year_name; ?></p>
<table width="100%" border="0" align="center" cellpadding="1" cellspacing="3" class="entryTable">
<tr align="center" class="entryTableHeader">
<th width="20%" >Pst</th>
<th width="20%" >No</th>
<th width="15%">Name</th>
<th width="15%">Terminal Avg</th>
<th width="15%">Last Term</th>
<th width="15%">Comment</th>
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
<td align="center"><?php echo $i; ?></td>
<td width="20%" align="center"><?php echo $adminNo;?></td>
<td align="center" width="" ><?php echo $fname. ' '.strtoupper($mname[0]).'. '.$lname;?></td>
<td align="center" width=""><?php echo number_format($averageE,2).' '.$gradeE;?></td>
<td align="center" width="">0</td>
<td align="center" width=""><textarea name='details[<?php echo $stud_id;?>]' cols='30' rows='2'><?php if($teacher_comments==''){ echo 'Add Your Comments Here';} else { echo $teacher_comments;}?></textarea></td>

</tr>

 <?php
}
?>
<td align="right"><input name="save" type="submit" id="save" value="Add Comments"></a></td></tr>
<?php
}

else{
	echo 'No students for now or marks already entered for all students.';
}
?>
</table>

 <p>&nbsp;</p>

</form></p>
</div>
</div><!-- end div specific -->




<div style="clear: both;">&nbsp;</div>
</div>
<!-- start footer -->
<div id="bottom"> </div>
<div id="footer">
&copy; <?php echo date('Y. '); ?> mySkulMate

</div>
	</div>
<!-- end footer -->
</body>
</html>
