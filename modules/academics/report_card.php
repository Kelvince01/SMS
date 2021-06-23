<?php
session_start();
include('../../connection/connect.php');
//$gradebk_id=$_GET['gradebk_id'];
//get grade book details
extract($_POST);
$sql = "SELECT class_name,class.class_id,subject_name,exam_type,term_name,year_name FROM gradebk,class,exams,term_period,SUBJECT
WHERE gradebk.class_id=class.class_id AND gradebk.exam_id=exams.exam_id AND gradebk.term_id=term_period.term_id
AND gradebk.subject_id=subject.subject_id and gradebk_id='1' ";
$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));
$row = mysqli_fetch_assoc($result);
extract($row);
$sql = "SELECT stud_id from student_details where adminNo='$adminNo' ";
$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));
$row = mysqli_fetch_assoc($result);
extract($row);
$sql = "SELECT term_id from term_period where term_name='$term_name' ";
$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));
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
<p> <h2 class="title">Report Card</h2>
<?php
//$stud_id='1';
$sql = "SELECT SUM(((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/22))AS total,student_marks.stud_id,adminNo,fname,mname,lname
				FROM student_marks,student_details
				WHERE student_marks.stud_id=student_details.stud_id and student_details.stud_id='$stud_id'
				GROUP BY student_marks.stud_id ORDER BY total DESC ";
			$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));
			$row = mysqli_fetch_assoc($result);
            extract($row);
//english

$query="SELECT cat_1 as catE,cat_2 AS cat2E,mid_term AS midE,end_term AS endE,((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2) AS averageE,grade as gradeE,fname,mname,lname,adminNo,subject_name
FROM student_marks,student_details,grades,SUBJECT
WHERE student_marks.stud_id=student_details.stud_id AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)<=max_mark AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)>=min_mark
AND subject.subject_id=student_marks.subject_id AND student_marks.stud_id='$stud_id'AND subject.subject_id='1' AND term_id='$term_id'";
$result1=mysqli_query($con1,$query);
$row1 = mysqli_fetch_assoc($result1);
extract($row1);
//kiswahili
$query="SELECT cat_1 as catS,cat_2 AS cat2S,mid_term AS midS,end_term AS endS,((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2) AS averageSW,grade as gradeSW,fname,mname,lname,adminNo,subject_name
FROM student_marks,student_details,grades,SUBJECT
WHERE student_marks.stud_id=student_details.stud_id AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)<=max_mark AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)>=min_mark
AND subject.subject_id=student_marks.subject_id AND student_marks.stud_id='$stud_id'AND subject.subject_id='2' AND term_id='$term_id'";
$result1=mysqli_query($con1,$query);
if (mysqli_num_rows($result1) > 0) {
$row1 = mysqli_fetch_assoc($result1);
extract($row1);
}
else{
$averageSW='--';
}
//mathematics
$query="SELECT ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2) AS averageMT,grade as gradeMT,fname,mname,lname,adminNo,subject_name
FROM student_marks,student_details,grades,SUBJECT
WHERE student_marks.stud_id=student_details.stud_id AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)<=max_mark AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)>=min_mark
AND subject.subject_id=student_marks.subject_id AND student_marks.stud_id='$stud_id'AND subject.subject_id='3' AND term_id='$term_id'";
$result1=mysqli_query($con1,$query);
if (mysqli_num_rows($result1) > 0) {
$row1 = mysqli_fetch_assoc($result1);
extract($row1);
}
else{
$averageMT='--';
$gradeMT='--';
}
//biology
$query="SELECT ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2) AS averageBIO,grade as gradeBIO,fname,mname,lname,adminNo,subject_name
FROM student_marks,student_details,grades,SUBJECT
WHERE student_marks.stud_id=student_details.stud_id AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)<=max_mark AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)>=min_mark
AND subject.subject_id=student_marks.subject_id AND student_marks.stud_id='$stud_id'AND subject.subject_id='4' AND term_id='$term_id'";
$result1=mysqli_query($con1,$query);
if (mysqli_num_rows($result1) > 0) {
$row1 = mysqli_fetch_assoc($result1);
extract($row1);
}
else{
$averageBIO='--';
$gradeBIO='--';
}
//chem
$query="SELECT ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2) AS averageCHE,grade as gradeCHE,fname,mname,lname,adminNo,subject_name
FROM student_marks,student_details,grades,SUBJECT
WHERE student_marks.stud_id=student_details.stud_id AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)<=max_mark AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)>=min_mark
AND subject.subject_id=student_marks.subject_id AND student_marks.stud_id='$stud_id'AND subject.subject_id='5' AND term_id='$term_id'";
$result1=mysqli_query($con1,$query);
if (mysqli_num_rows($result1) > 0) {
$row1 = mysqli_fetch_assoc($result1);
extract($row1);
}
else{
$averageCHE='--';
$gradeCHE='--';
}
//phy
$query="SELECT ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2) AS averagePH,grade as gradePH,fname,mname,lname,adminNo,subject_name
FROM student_marks,student_details,grades,SUBJECT
WHERE student_marks.stud_id=student_details.stud_id AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)<=max_mark AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)>=min_mark
AND subject.subject_id=student_marks.subject_id AND student_marks.stud_id='$stud_id'AND subject.subject_id='6' AND term_id='$term_id'";
$result1=mysqli_query($con1,$query);
if (mysqli_num_rows($result1) > 0) {
$row1 = mysqli_fetch_assoc($result1);
extract($row1);
}
else{
$averagePH='--';
$gradePH='--';
}
//geo
$query="SELECT ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2) AS averageGE,grade as gradeGE,fname,mname,lname,adminNo,subject_name
FROM student_marks,student_details,grades,SUBJECT
WHERE student_marks.stud_id=student_details.stud_id AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)<=max_mark AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)>=min_mark
AND subject.subject_id=student_marks.subject_id AND student_marks.stud_id='$stud_id'AND subject.subject_id='7' AND term_id='$term_id'";
$result1=mysqli_query($con1,$query);
if (mysqli_num_rows($result1) > 0) {
$row1 = mysqli_fetch_assoc($result1);
extract($row1);
}
else{
$averageGE='--';
$gradeGE='--';
}
//hist
$query="SELECT ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2) AS averageHI,grade as gradeHI,fname,mname,lname,adminNo,subject_name
FROM student_marks,student_details,grades,SUBJECT
WHERE student_marks.stud_id=student_details.stud_id AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)<=max_mark AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)>=min_mark
AND subject.subject_id=student_marks.subject_id AND student_marks.stud_id='$stud_id'AND subject.subject_id='8' AND term_id='$term_id'";
$result1=mysqli_query($con1,$query);
if (mysqli_num_rows($result1) > 0) {
$row1 = mysqli_fetch_assoc($result1);
extract($row1);
}
else{
$averageHI='--';
$gradeHI='--';
}
//cre
$query="SELECT ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2) AS averageCR,grade as gradeCR,fname,mname,lname,adminNo,subject_name
FROM student_marks,student_details,grades,SUBJECT
WHERE student_marks.stud_id=student_details.stud_id AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)<=max_mark AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)>=min_mark
AND subject.subject_id=student_marks.subject_id AND student_marks.stud_id='$stud_id'AND subject.subject_id='9' AND term_id='$term_id'";
$result1=mysqli_query($con1,$query);
if (mysqli_num_rows($result1) > 0) {
$row1 = mysqli_fetch_assoc($result1);
extract($row1);
}
else{
$averageCR='--';
$gradeCR='--';
}
//agri
$query="SELECT ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2) AS averageAG,grade as gradeAG,fname,mname,lname,adminNo,subject_name
FROM student_marks,student_details,grades,SUBJECT
WHERE student_marks.stud_id=student_details.stud_id AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)<=max_mark AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)>=min_mark
AND subject.subject_id=student_marks.subject_id AND student_marks.stud_id='$stud_id'AND subject.subject_id='10' AND term_id='$term_id'";
$result1=mysqli_query($con1,$query);
if (mysqli_num_rows($result1) > 0) {
$row1 = mysqli_fetch_assoc($result1);
extract($row1);
}
else{
$averageAG='--';
$gradeAG='--';
}
//b/s
$query="SELECT ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2) AS averageBS,grade as gradeBS,fname,mname,lname,adminNo,subject_name
FROM student_marks,student_details,grades,SUBJECT
WHERE student_marks.stud_id=student_details.stud_id AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)<=max_mark AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)>=min_mark
AND subject.subject_id=student_marks.subject_id AND student_marks.stud_id='$stud_id'AND subject.subject_id='11' AND term_id='$term_id'";
$result1=mysqli_query($con1,$query);
if (mysqli_num_rows($result1) > 0) {
$row1 = mysqli_fetch_assoc($result1);
extract($row1);
}
else{
$averageBS='--';
$gradeBS='--';
}
//total marks

$total=$averageSW+$averageE+$averageMT+$averageBIO+$averageCHE+$averagePH+$averagePH+$averageGE+$averageHI+$averageCR+$averageAG+$averageBS;

//average
$query="SELECT COUNT(DISTINCT subject_id) AS total_sub FROM student_marks where stud_id='$stud_id'";
$rw=mysqli_query($con1,$query);
$re=mysqli_fetch_assoc($rw);
extract($re);
$average=$total/$total_sub;
//mean grade
$query="SELECT grade FROM grades WHERE '$average'<=max_mark AND '$average'>=min_mark";
$rw=mysqli_query($con1,$query);
$re=mysqli_fetch_assoc($rw);
extract($re);
//report card
echo "<tr><td><table width='600' border='0' align='left' cellpadding='5' cellspacing='1' class='entryTable'>
		<tr class='entryTableHeader'> 
            <td colspan='4'>" .$fname . "  " .$mname . " " .$lname . " Academic Profile </td>
        </tr>";
		
		echo "<tr>";
  echo "<td class='label'>Total Marks</td>";
  echo "<td class='content'>" .number_format($total,2). "</td></tr>";
  echo "<tr>";
  echo "<td class='label'>Average Mark</td>";
  echo "<td class='content'>" .number_format($average,2). "</td></tr>";
  echo "<tr>";
  echo "<td class='label'>Mean Grade</td>";
  echo "<td class='content'>" .$grade. "</td></tr>";
echo "<tr>";
  echo "<td class='label'>Last Term</td>";
  echo "<td class='content'>0</td></tr>";
  
  echo "<tr>";
  echo "<td class='label'>General Comment</td>";
  echo "<td class='content'>No Comments</td></tr>";
 
  
echo "</table></td></tr></br>";
//get subjects
$sql = "SELECT subject_name,subject_id FROM subject ";
$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));
?>
<tr><td><table width='600' border='0' align='left' cellpadding='5' cellspacing='1' class='entryTable'>
<tr class='entryTableHeader'> 
<td colspan='4' align='center'>Report Card Details</td>
        </tr>
		<tr>
		<th width='20%'>Subject</th>
		<th width='15%'>CAT 1 </th>
		<th width='15%'>CAT 2</th>
		<th width='15%'>MID-TERM</th>
		<th width='15%'>END_TERM</th>
		<th width='15%'>AVRG</th>
		<th width='15%'>M.GRADE</th>
		<th width='15%'>CLASS PSTN</th>
		<th width='15%'>LAST TERM</th>
		<th width='15%'>TR'S.COMMENTS</th>
		<th width='15%'>TR'S INTIALS</th>
		
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
<td class='content' align='center'><?php echo $subject_name;?></td>
<?php 
$query="SELECT cat_1,cat_2,mid_term ,end_term,((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2) AS averageE,grade AS gradeE,fname,mname,lname,adminNo,subject_name
FROM student_marks,student_details,grades,subject
WHERE student_marks.stud_id=student_details.stud_id AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)<=max_mark AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)>=min_mark
AND subject.subject_id=student_marks.subject_id AND subject.subject_id='$subject_id' AND term_id='$term_id' and student_marks.stud_id='1'";
$re=mysqli_query($con1,$query);
if (mysqli_num_rows($re) > 0) {
$rw=mysqli_fetch_assoc($re);
extract($rw);
}
else{
$cat_1='--';
$cat_2='--';
$mid_term='--';
$end_term='--';
$averageE='--';
$gradeE='--';
}
//get class position

?>

<td class='content' align='center'><?php echo $cat_1;?></td>
<td class='content' align='center'><?php echo $cat_2;?></td>
<td class='content' align='center'><?php echo $mid_term;?></td>
<td class='content' align='center'><?php echo $end_term;?></td>
<td class='content' align='center'><?php echo $averageE;?></td>
<td class='content' align='center'><?php echo $gradeE;?></td>
<td class='content' align='center'><?php 
$sq = "SELECT ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2) AS averageE,stud_id AS stud_a FROM student_marks WHERE
subject_id='$subject_id' AND term_id='$term_id' group by stud_id ORDER BY averageE DESC ";
$resu    = mysqli_query($con1,$sq) or die(mysqli_error($con1));
if (mysqli_num_rows($resu) > 0) {
	$j = 0;
while($ro = mysqli_fetch_assoc($resu)) {
		extract($ro);

if($stud_a==$stud_id){$j=$j+1; echo $j;}
 $j += 1;
}
}
else{
echo '--';
}
?></td>
<td class='content' align='right'></td>
<td class='content' align='right'></td>
<td class='content' align='center'>
<?php
$q="SELECT intials FROM teacher,class_subject_teacher WHERE 
teacher.teacher_id=class_subject_teacher.teacher_id AND class_id='$class_id' AND
subject_id='$subject_id'";
$resu    = mysqli_query($con1,$q) or die(mysqli_error($con1));
if (mysqli_num_rows($resu) > 0) {
$rw=mysqli_fetch_assoc($resu);
extract($rw);
}
else{
$intials=' ';
}
echo $intials;
?>
</td>
</tr>
<?php
  }
}
else{
echo 'No Subjects for now.';
}
?>
  <tr class="content"> 
    <td colspan="4" align="right"><b>Total AVG</b> </td>
<td align="center"><?php  echo number_format($total,2); ?></td>
<td align="center"><?php  echo number_format($average,2); ?></td>
<td align="center"><?php  echo $grade; ?></td>
<td align="center"><?php  
$sq = "SELECT SUM(((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/22))AS total,student_marks.stud_id AS stud_a
FROM student_marks,student_details
WHERE student_marks.stud_id=student_details.stud_id AND term_id='$term_id'
GROUP BY student_marks.stud_id ORDER BY total DESC ";
$resu    = mysqli_query($con1,$sq) or die(mysqli_error($con1));
if (mysqli_num_rows($resu) > 0) {
	$j = 0;
while($ro = mysqli_fetch_assoc($resu)) {
		extract($ro);

if($stud_a==$stud_id){$j=$j+1; echo $j;}
 $j += 1;
}
}
else{
echo '--';
}
?>
</td>
</tr> 

</table></td></tr><tr></tr>
<tr><td><table width='600' border='0' align='left' cellpadding='5' cellspacing='1' class='entryTable'>
<tr class='entryTableHeader'> 
<td colspan='4' align='center'>Comments</td>
</tr>
<tr>
<th width='20%'>Teacher Name</th>
<th>Comment</th>
<th width='15%'>Date/Time</th>
<th width='15%'>Signature</th>
</tr>
<tr>
<td class='content' align='center'>J.Kamau</td>
<td class='content' align='center'>This is a good begining, keep it up!</td>
<td class='content' align='center'>12-04-2011</td>
<td class='content' align='right'>J.K</td>
</tr>
<tr>
<td class='content' align='center'>P.Kamau</td>
<td class='content' align='center'>This is a good begining, keep it up!</td>
<td class='content' align='center'>12-04-2011</td>
<td class='content' align='right'>J.K</td>
</tr>
<tr>
<td class='content' align='center'></td>
<td class='content' align='center'></td>
<td class='content' align='center'></td>
<td class='content' align='right'>sign here</td>
</tr>
<tr class="content"> 
<td colspan="3" align="right">
<?php
$sql = "Select end_date FROM term_period where`active`='1'";
$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));
$rw = mysqli_fetch_array($result);
$sql2 = "Select min(start_date) FROM term_period where end_date >'$rw[0]' ";
$resul     = mysqli_query($con1,$sql2) or die(mysqli_error($con1));
$rwz = mysqli_fetch_array($resul);

				?>
<b>School Opens on: <?php echo $rwz[0]; ?></b></td>
<td align="right"></td></tr> 
</table></td></tr>		
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
