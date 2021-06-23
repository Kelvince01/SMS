<?php
session_start();
$gradebk_id=$_GET['gradebk_id'];
include('../../connection/connect.php');
function grade($mark){
	include('../../connection/connect.php');
$query="SELECT * FROM grades WHERE min_mark<='$mark' AND max_mark>='$mark' ";
$result=mysqli_query($con1,$query) or die (mysqli_error($con1));
$row=mysqli_fetch_array($result);
$grade=$row['grade'];
return $grade;
}
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
</head>
<body>
<div id="" width="1000">
<div id=""> </div>
<div id="">
<!-- end header -->



<div class="" width="1000">
<div class="" width="1000">
<div id="" align="center">
		<p> <h2 class="title">Form 1N English Gradebk Term 1 Year 2011</h2>
		<?php
			include '/sms/connection/connect.php';
			$sql = "SELECT CAT1_mark,CAT2_mark,END_TERM_mark,MID_TERM_mark
,adminNo,fname,mname,lname,student_mark.gradebk_id
 FROM student_mark,student_details WHERE student_details.stud_id=student_mark.student_id AND student_mark.gradebk_id=1 ORDER BY student_id";
			$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));


			?>

<form action="receipts/produce_receipt.php" method="post" name="" id="">
<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" class="entryTable">
<tr align="center" class="entryTableHeader">
<th width="4%" >Admin No</th>
<th width="15%">Student Name</th>
<th width="5%">CAT1 Mark</th>
<th width="5%" >CAT2 Mark</th>
<th width="5%" >Total</th>
<th width="5%" >Average</th>
<th width="5%" >MidTerm Mark</th>
<th width="5%" >Total</th>
<th width="5%" >EndTerm Mark</th>
<th width="5%" >Average</th>
<th width="5%" >Grade</th>
<th width="2%" >Class Position</th>
<th width="5%" >Stream Position</th>
<th width="5%" >Previous Term Mark</th>
<th width="8%" >Improvement Index</th>
<th width="20%" >Comments</th>
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
<td align="center"><?php echo $adminNo;?> </td>
<td align="center"><?php echo $fname.' '.$mname.' '.$lname;?> </td>
<td align="center"><?php echo $CAT1_mark;?> </td>
<td align="center"><?php echo $CAT2_mark;?> </td>
<td align="center"><?php echo $CAT1_mark+$CAT2_mark;?> </td>
<td align="center"><?php echo ($CAT1_mark+$CAT2_mark)/2;?></td>
<td align="center"><?php echo $MID_TERM_mark;?> </td>
<td align="center"><?php echo $MID_TERM_mark+(($CAT1_mark+$CAT2_mark)/2);?> </td>
<td align="center"><?php echo $END_TERM_mark;?> </td>
<td align="center"><?php echo ($END_TERM_mark+($MID_TERM_mark+(($CAT1_mark+$CAT2_mark)/2)))/2;?> </td>
<td align="center"><?php $mark=($END_TERM_mark+($MID_TERM_mark+(($CAT1_mark+$CAT2_mark)/2)))/2; $x=grade($mark); echo $x;?> </td>
<td align="center"><a href="">Details</a></td>
<td align="center"><?php echo $girls;?> </td>
<td align="center"><?php echo $boys;?> </td>
<td align="center"><?php echo $now;?> </td>
<td align="center"><a href="">Details</a></td>




 <?php
}
}
else{
	echo 'No duties for now.';
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
