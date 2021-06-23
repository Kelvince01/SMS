<?php
session_start();
$gradebk_id=$_GET['gradebk_id'];
include('../../connection/connect.php');
function grade($mark){
	include('../../connection/connect.php');
$query1="SELECT * FROM grades WHERE min_mark<='$mark' AND max_mark>='$mark' ";
$result1=mysqli_query($con1,$query1) or die (mysqli_error($con1));
$row1=mysqli_fetch_array($result1);
$grade=$row1['grade'];
return $grade;
}
//construct name for grade book
$q="SELECT class_name,subject_name,term_name,year FROM 
class,gradebk,SUBJECT,term_period WHERE gradebk.class_id=class.class_id
AND gradebk.subject_id=subject.subject_id AND gradebk.gradebk_id='$gradebk_id'";
$re=mysqli_query($con1,$q) or die(mysqli_error($con1));
$r=mysqli_fetch_array($re);

//require_once 'common.php';
//require_once 'load_factories.php';
//require_once 'library/config.php';
//require_once 'library/common.php';s=mysqli_fetch_array($execute);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>mySkulMate::Admissions</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
<link type="text/css" href="/sms/datepicker/all.css" rel="stylesheet" />
</head>
<body>
<div id="" width="1000">
<div id=""> </div>
<div id="">
<!-- end header -->




<div id="" align="center">
		<p> <br><h2 class="title"><?php echo $r['class_name'].' '.$r['subject_name']. ' GradeBook'. ' '.$r['term_period']. ' '.$r['year'];?></h2><br>
		<?php
			include '/sms/connection/connect.php';
			$sql = "SELECT CAT1_mark,CAT2_mark,END_TERM_mark,MID_TERM_mark,adminNo,fname,mname,lname,student_mark.gradebk_id
 FROM student_marks,student_details WHERE student_mark.student_id=student_details.stud_id AND student_mark.gradebk_id='$gradebk_id'";
 $result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));

//Check if exam is active to allow editing and entry of marks
$que="SELECT active FROM exam";
$res=mysqli_query($con1,$que);
$row_e=mysqli_fetch_array($res);
			?>

<form action="receipts/produce_receipt.php" method="post" name="" id="">
<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" class="entryTable">
<tr align="center" class="entryTableHeader">
<th width="4%" >AdminNo</th>
<th width="45%">Name</th>
<th width="1%">CAT1 </th>
<th width="1%" >CAT2 </th>
<th width="1%" >Average</th>
<th width="1%" >MidTerm </th>
<th width="1%" >Total</th>
<th width="1%" >EndTerm </th>
<th width="1%" >Average</th>
<th width="1%" >Grade</th>
<th width="20%" >Comments</th>
<th width='2%'> Actions </th>
</tr>
<?php
if (mysqli_num_rows($result) > 0) {
$i = 0;

while($row = mysqli_fetch_assoc($result)) {
extract($row);
$now=$capacity-($girls+$boys);
if ($i%2) {
	$class = 'row1';
} else {
	$class = 'row2';
}
$i += 1;

?>
<tr class="<?php echo $class; ?>">
<td align="center" ><?php echo $adminNo;?> </td>
<td align="center"><?php echo $fname.' '.$mname.' '.$lname;?> </td>
<td align="center"><?php echo $CAT1_mark;?> </td>
<td align="center"><?php echo $CAT2_mark;?> </td>

<td align="center"><?php echo ($CAT1_mark+$CAT2_mark)/2;?></td>
<td align="center"><?php echo $MID_TERM_mark;?> </td>
<td align="center"><?php echo $MID_TERM_mark+(($CAT1_mark+$CAT2_mark)/2);?> </td>
<td align="center"><?php echo $END_TERM_mark;?> </td>
<td align="center"><?php echo ($END_TERM_mark+($MID_TERM_mark+(($CAT1_mark+$CAT2_mark)/2)))/2;?> </td>
<td align="center"><?php $mark=($END_TERM_mark+($MID_TERM_mark+(($CAT1_mark+$CAT2_mark)/2)))/2; $x=grade($mark); echo $x;?> </td>
<td align="center"><?php echo 'No Comments made';?></td>
<td align="center"><a href="">Edit</a>|<a href="">Delete</a></td>




 <?php
 $gradebk_id='';
}
}
else{
	echo 'No marks for now.';
}
?>
</table>

 <p>&nbsp;</p>

	</div>
</div>
</div>
</div><!-- end div specific -->




<div style="clear: both;">&nbsp;</div>
</div>

	</div>
<!-- end footer -->
</body>
</html>
