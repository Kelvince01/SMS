<?php
session_start();
include('../../connection/connect.php');
include ('../../common/functions.php');
$credit= new credential();
$school_details	=	$credit->creds();
//extract($_POST);
$term_name2=$_SESSION['term_name'];
$class_name2=$_SESSION['class_name'];
$year_name2=$_SESSION['year_name']; 
 
$sql = "SELECT term_id from term_period where term_name='$term_name2' ";
$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));
$row = mysqli_fetch_assoc($result);
extract($row);

$sql = "select class.class_id from class join gradebk on gradebk.class_id join student_marks on student_marks.gradebk_id and class_name='$class_name2'";
$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));
$row = mysqli_fetch_assoc($result);

extract($row);

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>mySkulMate::Merit List</title>
<link rel="stylesheet" href="new_style.css" type="text/css" />
</head>

<body>

<table width="720" border="1" align="center" cellpadding="5" cellspacing="0">
  <tr>
    <td>
      <div align="center">
        <div class="schhead"><?php echo nl2br(stripslashes( $_SESSION['schoolname'])); ?> </div>
        <div class="headother"> <?php echo $school_details['key2']; // School Adress?><br />
             
              <b><?php echo $class_name2;?> Merit List</b><br>
			   <b><?php echo $term_name2.' :'.$year_name2;?></b>
            </div>
      </div>
        <hr  noshade="noshade"/>
		
        <!--student result data-->
		  <?php
			
			$sql = "SELECT SUM((cat_1+cat_2+mid_term+end_term)/2)AS total,student_marks.stud_id,adminNo,fname,mname,lname,gender
				FROM student_marks,student_details
				WHERE student_marks.stud_id=student_details.stud_id and term_id='$term_id' and class_id='$class_id'
				GROUP BY student_marks.stud_id ORDER BY total DESC ";
			 
			$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));


			?>
        <table width="600" border="0" cellspacing="0" cellpadding="5">
        </table>
      <br />
	
<!--gggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggg-->
        <!--end student bio data-->
        <table width="720" border="1" cellspacing="0" cellpadding="5" style="white-space:nowrap;">
          <tr>
		  <td width=""><strong>#</strong></td>
		  <td width=""><strong>ADMNO</strong></td>
          <td width="20%" style="white-space:nowrap;" ><strong>STUDENT NAME</strong></td>
			<td width=""><strong>G</strong></td>
			<td width=""><strong>STRM</strong></td>
            <?php 
$sql = "SELECT DISTINCT (subject_name),subject.subject_id FROM subject,student_marks where student_marks.subject_id=subject.subject_id";
$result1     = mysqli_query($con1,$sql) or die(mysqli_error($con1));
?>
<?php
if (mysqli_num_rows($result1) > 0) {
	$i = 0;

	while($row1 = mysqli_fetch_assoc($result1)) {
		extract($row1);
if ($i%2) {
	$class = 'row1';
} else {
	$class = 'row2';
}
$i += 1;
?>
<th width="" ><?php echo strtoupper(substr($subject_name, 0, 3));?></th>
 <?php
}
}
?>
			<td width=""><strong>TOTAL</strong></td>
			<td width=""><strong>M.G.</strong></td>
			
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
			<td><?php echo $i;?></td>
			<td><?php echo $adminNo;?></td>
			<td ><?php echo $fname. ' '.strtoupper($mname[0]).'. '.$lname;?></td>
			<td ><?php if($gender=='male'){ echo 'M';} else { echo 'F';}?></td>
			<td>N/A</td>
			<?php 
$sql_sub = "SELECT DISTINCT (subject_name),subject.subject_id FROM subject,student_marks where student_marks.subject_id=subject.subject_id ";
$result_sub     = mysqli_query($con1,$sql_sub) or die(mysqli_error($con1));
?>
<?php
if (mysqli_num_rows($result_sub) > 0) {
	$k = 0;

	while($row_sub = mysqli_fetch_assoc($result_sub)) {
		extract($row_sub);
if ($k%2) {
	$class = 'row1';
} else {
	$class = 'row2';
}
$k += 1;
$gradeTable=gradeTable($subject_id);
$studentProfile_=new studentProfile;
$average=$studentProfile_->getSubjectAverage($stud_id,$subject_id,$term_id,$gradeTable);

?>
<td align="center"><?php echo $average;
?></td>
<?php
  }
}
?>
<td align="center"><?php echo number_format($total,0);?></td>
<td><?php $meanPoints=$studentProfile_->studMeanPoints($stud_id,$term_id); echo $meanPoints['key2'];?></td>
</tr>

 <?php
}
}

else{
	echo 'Details not found.';
}
?>
			</td></tr>
	   


</table>
	   <hr  noshade="noshade"/>
        
      <!--ggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggg-->
		
	
        </div><p>&copy;  <?php echo $_SESSION['schoolname'];?> <?php echo date('Y. '); ?> :powered by mySkulMate</p></td>
  </tr>
</table>
</body>
</html>
