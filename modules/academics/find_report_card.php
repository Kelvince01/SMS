<?php
if(isSet($_POST['content']))
{
$student=$_POST['content'];
include('../../connection/connect.php');
//$student=$_POST['comment'];
//$gradebk_id=$_GET['gradebk_id'];
//get grade book details
$sql = "SELECT * from student_details where fname='$student' OR mname='$student' or lname='$student' or adminNo='$student'" ;
$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));
$row = mysqli_fetch_assoc($result);
extract($row);
//require_once 'common.php';
//require_once 'load_factories.php';
//require_once 'library/config.php';
//require_once 'library/common.php';s=mysqli_fetch_array($execute);
?>

<p> <h2 class="title">Report Card</h2>
<?php
$sql = "SELECT SUM(((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2))AS total,student_marks.stud_id,adminNo,fname,mname,lname
				FROM student_marks,student_details
				WHERE student_marks.stud_id=student_details.stud_id and student_details.stud_id='$stud_id'
				GROUP BY student_marks.stud_id ORDER BY total DESC ";
			$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));
			$row = mysqli_fetch_assoc($result);
            extract($row);
//english

$query="SELECT cat_1 as catE,cat_2 AS cat2E,mid_term AS midE,end_term AS endE,((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2) AS averageE,grade as gradeSW,fname,mname,lname,adminNo,subject_name
FROM student_marks,student_details,grades,subject
WHERE student_marks.stud_id=student_details.stud_id AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)<=max_mark AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)>=min_mark
AND subject.subject_id=student_marks.subject_id AND student_marks.stud_id='$stud_id'AND subject.subject_id='1' AND term_id='1'";
$result1=mysqli_query($con1,$query);
$row1 = mysqli_fetch_assoc($result1);
extract($row1);
//kiswahili
$query="SELECT cat_1 as catS,cat_2 AS cat2S,mid_term AS midS,end_term AS endS,((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2) AS averageSW,grade as gradeSW,fname,mname,lname,adminNo,subject_name
FROM student_marks,student_details,grades,subject
WHERE student_marks.stud_id=student_details.stud_id AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)<=max_mark AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)>=min_mark
AND subject.subject_id=student_marks.subject_id AND student_marks.stud_id='$stud_id'AND subject.subject_id='2' AND term_id='1'";
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
FROM student_marks,student_details,grades,subject
WHERE student_marks.stud_id=student_details.stud_id AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)<=max_mark AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)>=min_mark
AND subject.subject_id=student_marks.subject_id AND student_marks.stud_id='$stud_id'AND subject.subject_id='3' AND term_id='1'";
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
FROM student_marks,student_details,grades,subject
WHERE student_marks.stud_id=student_details.stud_id AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)<=max_mark AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)>=min_mark
AND subject.subject_id=student_marks.subject_id AND student_marks.stud_id='$stud_id'AND subject.subject_id='4' AND term_id='1'";
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
FROM student_marks,student_details,grades,subject
WHERE student_marks.stud_id=student_details.stud_id AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)<=max_mark AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)>=min_mark
AND subject.subject_id=student_marks.subject_id AND student_marks.stud_id='$stud_id'AND subject.subject_id='5' AND term_id='1'";
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
FROM student_marks,student_details,grades,subject
WHERE student_marks.stud_id=student_details.stud_id AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)<=max_mark AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)>=min_mark
AND subject.subject_id=student_marks.subject_id AND student_marks.stud_id='$stud_id'AND subject.subject_id='6' AND term_id='1'";
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
FROM student_marks,student_details,grades,subject
WHERE student_marks.stud_id=student_details.stud_id AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)<=max_mark AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)>=min_mark
AND subject.subject_id=student_marks.subject_id AND student_marks.stud_id='$stud_id'AND subject.subject_id='7' AND term_id='1'";
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
FROM student_marks,student_details,grades,subject
WHERE student_marks.stud_id=student_details.stud_id AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)<=max_mark AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)>=min_mark
AND subject.subject_id=student_marks.subject_id AND student_marks.stud_id='$stud_id'AND subject.subject_id='8' AND term_id='1'";
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
FROM student_marks,student_details,grades,subject
WHERE student_marks.stud_id=student_details.stud_id AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)<=max_mark AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)>=min_mark
AND subject.subject_id=student_marks.subject_id AND student_marks.stud_id='$stud_id'AND subject.subject_id='9' AND term_id='1'";
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
FROM student_marks,student_details,grades,subject
WHERE student_marks.stud_id=student_details.stud_id AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)<=max_mark AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)>=min_mark
AND subject.subject_id=student_marks.subject_id AND student_marks.stud_id='$stud_id'AND subject.subject_id='10' AND term_id='1'";
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
FROM student_marks,student_details,grades,subject
WHERE student_marks.stud_id=student_details.stud_id AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)<=max_mark AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)>=min_mark
AND subject.subject_id=student_marks.subject_id AND student_marks.stud_id='$stud_id'AND subject.subject_id='11' AND term_id='1'";
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
$query="SELECT COUNT(DISTINCT subject_id) AS total_sub FROM student_marks where stud_id='1'";
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
		<th width='20%'>subject</th>
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
AND subject.subject_id=student_marks.subject_id AND subject.subject_id='$subject_id' AND term_id='1' and student_marks.stud_id='1'";
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
$gradeE='E';
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
$sq = "SELECT ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2) AS averageE,stud_id as stud_a FROM student_marks WHERE
subject_id='$subject_id' AND term_id='1' ORDER BY averageE DESC";
$resu    = mysqli_query($con1,$sq) or die(mysqli_error($con1));
if (mysqli_num_rows($resu) > 0) {
	$j = 0;
while($ro = mysqli_fetch_assoc($resu)) {
		extract($ro);

if($stud_a==$stud_id){echo $j; $j=$j+1; }
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
echo 'No subjects for now.';
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
WHERE student_marks.stud_id=student_details.stud_id AND term_id='1'
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
<td colspan="3" align="right"><b>School Opens on: 12:12:2011</b> </td>
<td align="right"></td></tr> 
</table></td></tr>		
<p>&nbsp;</p>
<?php
}
?>
