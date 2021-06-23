<?php
session_start();
include '../../connection/connect.php';

//generate reportcardNo no
$possible = '123456789BCDEFGHJKMNPQRSTVWXYZ';
		$code = '';
		$i = 0;
		
		while ($i < 5) { 
			$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
			$i++;
		}
$stud_id='2';
$sql = "SELECT SUM(((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/22))AS total,student_marks.stud_id,adminNo,fname,mname,lname
				FROM student_marks,student_details
				WHERE student_marks.stud_id=student_details.stud_id and student_details.stud_id='$stud_id'
				GROUP BY student_marks.stud_id ORDER BY total DESC ";
			$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));
			$row = mysqli_fetch_assoc($result);
            extract($row);

//prepare receipt
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
<script language="Javascript">
  <!--
  function printpage() {
  window.print();
  window.location='../produce.php';
  }
  //-->
</script>
</head>
<body>
<p>&nbsp;</p>
 <table width="100%" border="0" align="center" cellpadding="2">
<tr><td id="coop_title" align="center"><b><?php echo nl2br(stripslashes($_SESSION['schoolname'])); ?></b></td></tr>

<tr><td id="coop_title" align="center"><b><?php echo nl2br(stripslashes('P.O Box 60401 CHOGORIA-MAARA DISTRICT')); ?></b></td></tr>
<tr><td align="center" id="content"><b>Report Card</td></tr>
<tr></tr>
<tr><td align="center" id="content"><b>Report Card No:</b><em><strong><?php echo $code; ?></strong></em></td></tr>
<tr><td align="center" id="content"><b>Date/Time:</b> <?php echo date('d/m/Y h:i:s a'); ?></td></tr>
<tr></tr>

<br>
<?php
$stud_id='1';
$term_id='1';
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
$averageSW=0;
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
$averageMT=0;
$gradeMT='E';
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
$averageBIO=0;
$gradeBIO='E';
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
$averageCHE=0;
$gradeCHE='E';
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
$averagePH=0;
$gradePH='E';
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
$averageGE=0;
$gradeGE='E';
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
$averageHI=0;
$gradeHI='E';
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
$averageCR=0;
$gradeCR='E';
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
$averageAG=0;
$gradeAG='E';
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
$averageBS=0;
$gradeBS='E';
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
//get subjects
$sql = "SELECT subject_name,subject_id FROM subject ";
$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));
?>
<tr><td align="center"><table width='650' border='0' align='center' cellpadding='5' cellspacing='1' class='entryTable'>
<TR class='entryTableHeader'><TD align="center"><?php echo $fname.' '.$mname.' '.$lname;?></td>
<td align="center"> <?php echo $adminNo; ?></td>
<td align=""><?php echo  'Form 1';?></td>
<td align="center"><?php echo 'Term 1 2011'; ?></td>
</tr>
</table>
<tr><td align="center"><table width='650' border='0' align='center' cellpadding='5' cellspacing='1' class='entryTable'>
		<tr>
		<th width='20%'>Subject</th>
		<th width='5%'>CAT 1 </th>
		<th width='5%'>CAT 2</th>
		<th width='5%'>MID-TERM</th>
		<th width='5%'>END_TERM</th>
		<th width='5%'>AVRG</th>
		<th width='1%'>M.GRADE</th>
		<th width='5%'>CLASS PSTN</th>
		<th width='5%'>LAST TERM</th>
		<th width='40%'>TR'S.COMMENTS</th>
		<th width='5%'>TR'S INTIALS</th>
		
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
<tr>
<td class='content' align='center'><?php echo $subject_name;?></td>
<?php 
$query="SELECT cat_1,cat_2,mid_term ,end_term,((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2) AS averageE,grade AS gradeE,fname,mname,lname,adminNo,subject_name,teacher_comments
FROM student_marks,student_details,grades,subject
WHERE student_marks.stud_id=student_details.stud_id AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)<=max_mark AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)>=min_mark
AND subject.subject_id=student_marks.subject_id AND subject.subject_id='$subject_id' AND term_id='$term_id' and student_marks.stud_id='$stud_id'";
$re=mysqli_query($con1,$query);
if (mysqli_num_rows($re) > 0) {
$rw=mysqli_fetch_assoc($re);
extract($rw);
}
else{
$cat_1=0;
$cat_2=0;
$mid_term=0;
$end_term=0;
$averageE=0;
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
<td class='content' align=''></td>
<td class='content' align='' width="40%"><?php echo $teacher_comments;?></td>
<td class='content' align='center'>
<?php
$q="SELECT intials FROM teacher,class_subject_teacher WHERE 
teacher.teacher_id=class_subject_teacher.teacher_id AND class_id='1' AND
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
    <td colspan="4" align="right"><b>Total</b> </td>
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
<tr align="center"><td><table width='650' border='0' align='center' cellpadding='5' cellspacing='1' class='entryTable'>
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
<tr class="content"> 
<td colspan="4" align="right"><div id="footer">
&copy;  <?php echo  $_SESSION['schoolname']; ?> <?php echo date('Y. '); ?> :powered by mySkulMate

</div></td>

</table></td></tr>		
<tr><td height="10"></td></tr>
<tr><td align="center" id="noprint">
		<p> 
        <input name="save" type="button" id="save" value="Print" onclick="printpage();">
    </p>
	</td></tr>
	</td>
	</tr>
</table>
<?php $_SESSION['produce_saved']="True";?>
</body></html>