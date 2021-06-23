<?php
session_start();
include '../../connection/connect.php';
include '../../common/functions.php';
//generate reportcardNo no
$possible = '123456789BCDEFGHJKMNPQRSTVWXYZ';
		$code = '';
		$i = 0;
		
		while ($i < 5) { 
			$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
			$i++;
		}
$adminNo=$_GET['adminNo'];		
$sel_sql= "SELECT student_details.*,class.class_name,hostel.hostel_name FROM student_details,class,hostel WHERE student_details.adminNo='$adminNo'";
$sel_result     = mysqli_query($con1,$sel_sql) or die(mysqli_error($con1));
$sel_row = mysqli_fetch_assoc($sel_result);
extract($sel_row);		
//get active term
$sql_period="SELECT * from term_period where active='1'";
$result_period=mysqli_fetch_assoc(mysqli_query($con1,$sql_period));
extract($result_period);
		
$sql = "SELECT SUM((cat_1+cat_2+mid_term+end_term)/2)AS total,student_marks.stud_id,adminNo,fname,mname,lname
				FROM student_marks,student_details
				WHERE student_marks.stud_id=student_details.stud_id and term_id='$term_id' and class_id='$class_id' and student_marks.stud_id='$stud_id'";
			$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));
			$row = mysqli_fetch_assoc($result);
            extract($row);
	
?>



<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>mySkulMate::Academics</title>
<link rel="stylesheet" href="new_style.css" type="text/css" />
</head>

<body>

<table width="720" border="1" align="center" cellpadding="5" cellspacing="0">
  <tr>
    <td><div  class="totalhead">
      <div class="logo_box"><img src="<?php $logo = $credit->creds(); echo  $logo['key4'];?>" alt="logo" width="80" height="80" border="0" /></div>
      <div class="centreedge" align="center">
        <div class="schhead"><?php $nam = $credit->creds(); echo  nl2br(stripslashes($nam['key1']));?> </div>
        <div class="headother"> <?php $addres = $credit->creds(); echo nl2br(stripslashes($addres['key2'])); ?><br />
             
              Student Report Card<br>
			  Report Card No:<em><strong><?php echo $code; ?></strong></em><br>
			   <?php echo $term_name.' :'.$year_name;?></b>
            </div>
      </div>
      <div class="image_box"><!--<img src="<?php echo $student_photoURL;?>" alt="student picture" width="120" height="120" />
      --></div>
    </div>
		
        <!--student result data-->
        <table width="100%" border="0" cellspacing="0" cellpadding="5">
          <tr>
            <td colspan="2" >Name: <?php echo $fname.' '.$mname.' '.$lname;?></td>
			 <td>Admission Number: <?php echo $adminNo; ?></td>
            <td>Present Class: <strong><?php echo strtoupper($class_name);?></strong> </td>
          </tr>
        </table>
		<hr  noshade="noshade"/>
      <br />
<!--	 
      <table width="720" border="1" cellspacing="0" cellpadding="5" >
           <tr>
            <td><strong>Former School</strong></td>
			
            <td><strong>K.C.P.E Index No.</strong></td>
            
            <td><strong>Subjects Taken</strong></td>
			<td><strong>K.C.P.E Year</strong></td>
			<td><strong>English</strong></td>
			<td ><strong>Kiswahili</strong></td>
			<td><strong>Maths</strong></td>
			<td><strong>Science</strong></td>
			<td ><strong>Social Studies</strong></td>
			<td ><strong>Total Marks</strong></td>
         </tr>
		 <?php 
		 $sql_kcpe="SELECT * FROM kcpe_marks WHERE stud_id='$stud_id'";
		 $result_kcpe=(mysqli_query($con1,$sql_kcpe));
		
if (mysqli_num_rows($result_kcpe) > 0) {
$i = 0;

while($row_kcpe = mysqli_fetch_assoc($result_kcpe)) {
extract($row_kcpe);
if ($i%2) {
	$class = 'row1';
} else {
	$class = 'row2';
}
$i += 1;
$query="SELECT grade as english FROM grades WHERE '$english_marks'<=max_mark AND '$english_marks'>=min_mark";
$rw=mysqli_query($con1,$query);
$re=mysqli_fetch_assoc($rw);
extract($re);
//
$query="SELECT grade as kiswahili FROM grades WHERE '$kiswahili_marks'<=max_mark AND '$kiswahili_marks'>=min_mark";
$rw=mysqli_query($con1,$query);
$re=mysqli_fetch_assoc($rw);
extract($re);
//
$query="SELECT grade as maths FROM grades WHERE '$maths_marks'<=max_mark AND '$maths_marks'>=min_mark";
$rw=mysqli_query($con1,$query);
$re=mysqli_fetch_assoc($rw);
extract($re);
//
$query="SELECT grade as science FROM grades WHERE '$science_marks'<=max_mark AND '$science_marks'>=min_mark";
$rw=mysqli_query($con1,$query);
$re=mysqli_fetch_assoc($rw);
extract($re);
//
$query="SELECT grade as social FROM grades WHERE '$socialstudies_marks'<=max_mark AND '$socialstudies_marks'>=min_mark";
$rw=mysqli_query($con1,$query);
$re=mysqli_fetch_assoc($rw);
extract($re);
//
$average=$kcpe_marks/$kcpe_subjects;
$query="SELECT grade as average FROM grades WHERE '$average'<=max_mark AND '$average'>=min_mark";
$rw=mysqli_query($con1,$query);
$re=mysqli_fetch_assoc($rw);
extract($re);
?>
<tr class="<?php echo $class; ?>">
<td><?php echo $primary_school;?> </td>
<td><?php echo $kcpe_index;?> </td>
<td><?php echo $kcpe_subjects;?> </td>
<td><?php echo $kcpe_year;?> </td>
<td><?php echo $english_marks.$english;?> </td>
<td><?php echo $kiswahili_marks.$kiswahili;?> </td>
<td><?php echo $maths_marks.$maths;?> </td>
<td><?php echo $science_marks.$science;?> </td>
<td><?php echo $socialstudies_marks.$social;?> </td>
<td><?php echo $kcpe_marks.$average;?> </td>
</tr>
 <?php
}
}
else{
	echo 'No duties for now.';
}
?>
	
          
        </table><br>
-->
        <!--end student bio data-->
		<?php

$sql = "SELECT subject_name,subject_id FROM subject ";
$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));
?>
        <table width="720" border="1" cellspacing="0" cellpadding="5">
          <tr>
            <td width="20%"><strong>Subjects</strong></td>
			
            <td width="50"><strong>C.A.T 1 </strong></td>
            <td width="50"><strong>C.A.T 2 </strong></td>
            <td width="50"><strong>MID TERM</strong></td>
			<td width="50"><strong>END TERM</strong></td>
			<!--<td width="50"><strong>AVRG</strong></td>
			<td width="50"><strong>M.G. </strong></td>
			<td width="50"><strong>CLASS PSTN </strong></td>
			<td width="50"><strong>LAST TERM</strong></td>
			<td width="60%"><strong>TR'S.COMMENTS</strong></td>
			<td width="50"><strong>T.I</strong></td> -->
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
			<td><?php echo $subject_name;?></td>
			
			<?php 
		$examTypeMarks_=new examTypeMarks();

		?>
     		<td><?php $cat_1=$examTypeMarks_->cat1Marks($term_id,$stud_id,$subject_id);echo $cat_1;?></td>
			<td><?php $cat_2=$examTypeMarks_->cat2Marks($term_id,$stud_id,$subject_id);echo $cat_2;;?></td>
			<td><?php $mid_term=$examTypeMarks_->midtermMarks($term_id,$stud_id,$subject_id);echo $mid_term;?></td>
			<td><?php $end_term=$examTypeMarks_->endtermMarks($term_id,$stud_id,$subject_id);echo $end_term;?></td>
		<!--	<td><?php $average=$examTypeMarks_->averageGrade($term_id,$stud_id,$subject_id);echo $average['key1'];?></td>
			<td><?php echo $average['key2'];?></td>
			<td><?php $classPosition=$examTypeMarks_->classPosition($term_id,$stud_id,$subject_id);echo $classPosition;?></td>
<td></td>

<td><?php $teacher_comments=$examTypeMarks_->teacherComments($term_id,$stud_id,$subject_id);echo $teacher_comments;?></td>
<td>
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
</td> -->
</tr>
<?php
  }
}
else{
echo 'No Subjects for now.';
}
?>
			</td></tr>


<tr >
    <td ><b>Totals</b> </td>
<td align="center"><strong><?php $cat_1Total=$examTypeMarks_->totals($term_id,$stud_id,'cat_1');echo $cat_1Total;?></strong></td>
<td align="center"><strong><?php $cat_2Total=$examTypeMarks_->totals($term_id,$stud_id,'cat_2');echo $cat_2Total;?></strong></td>
<td align="center"><strong><?php $mid_termTotal=$examTypeMarks_->totals($term_id,$stud_id,'mid_term');echo $mid_termTotal;?></strong></td>
<td><strong><?php $end_termTotal=$examTypeMarks_->totals($term_id,$stud_id,'end_term');echo $end_termTotal;?></strong></td>
</tr>
	   
<tr> 
		
    <td ><b>Pstn in Stream</b> </td>
<td align="center"><strong><?php $cat_1Position=$examTypeMarks_->Position($term_id,$stud_id,$subject_id,'cat_1');echo $cat_1Position;?></strong></td>
<td align="center"><strong><?php $cat_2Position=$examTypeMarks_->Position($term_id,$stud_id,$subject_id,'cat_2');echo $cat_2Position;?></strong></td>
<td align="center"><strong><?php $mid_termPosition=$examTypeMarks_->Position($term_id,$stud_id,$subject_id,'mid_term');echo $mid_termPosition;?></strong></td>
<td><strong><?php $end_termPosition=$examTypeMarks_->Position($term_id,$stud_id,$subject_id,'end_term');echo $end_termPosition;?></strong></td>
</tr> 

</table>

	   <hr  noshade="noshade"/>
        <div class="div_pad"><strong>Class Teacher's Comment:</strong></div><br><br>
		<hr  noshade="noshade"/>
      <div class="div_pad"><strong>School Principal's Comment:</strong></div><br><br>
	  
          <hr  noshade="noshade"/>

		
		<!--
		
		        <div class="div_pad fullhead">
				<?php
$sql = "Select end_date FROM term_period where`active`='1'";
$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));
$rw = mysqli_fetch_array($result);
$sql2 = "Select min(start_date) FROM term_period where end_date >'$rw[0]' ";
$resul     = mysqli_query($con1,$sql2) or die(mysqli_error($con1));
$rwz = mysqli_fetch_array($resul);

				?>
				<p align="left"><b>School Opens on: <?php echo $rwz[0]; ?></b></p>
				

          <div class="signbox" align="center"> <img src="/sms/images/signature.jpg" width="100" height="50" />
            Authorizing Signature </div> -->
        </div><p>&copy;  <?php $nam = $credit->creds(); echo $nam['key1']; ?> <?php echo date('Y. '); ?> :powered by mySkulMate</p></td>
  </tr>
</table>
</body>
</html>