<?php
session_start();
include '../../connection/connect.php';
include '../../common/functions.php';
$credit= new credential();
//generate reportcardNo no
$possible = '123456789BCDEFGHJKMNPQRSTVWXYZ';
		$code = '';
		$i = 0;
		
		while ($i < 5) { 
			$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
			$i++;
		}
		$class_name=$_POST['class_name'];
//get active term
$sql_period="SELECT * from term_period where active='1'";
$result_period=mysqli_fetch_assoc(mysqli_query($con1,$sql_period));
extract($result_period);

$sqll="SELECT adminNo
FROM student_details s
INNER JOIN class c ON s.class_id = c.class_id
AND c.class_name ='".$class_name."'";
$ret= mysqli_query($con1,$sqll) or die(mysqli_error($con1));
$ct = mysqli_num_rows($ret);
if($ct>0)
{
  while($rwz = mysqli_fetch_assoc($ret))
  {
    extract($rwz);
    $sel_sql= "SELECT student_details.*,class.class_for FROM student_details left join class on student_details.class_id= class.class_id WHERE student_details.adminNo='$adminNo'";
    $sel_result     = mysqli_query($con1,$sel_sql) or die(mysqli_error($con1));
    $sel_row = mysqli_fetch_assoc($sel_result);
    if ($sel_row == null)
    {
      header("location:/sms/index.php?view=pre_reportCard&info=no_record");
      echo "No such record";
    }

    extract($sel_row);		
?>

<html  xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>mySkulMate::Report</title>
<link rel="stylesheet" href="new_style.css" type="text/css" />
</head>

<body onload="print()" >
<table width="720" border="1" align="center" cellpadding="5" cellspacing="0">
  <tr>
    <td>
     <div  class="totalhead">
      <div class="logo_box"><img src="<?php $logo = $credit->creds(); echo  $logo['key4'];?>" alt="logo" width="100" height="100" border="0" /></div>
      <div class="centreedge" align="center">
        <div class="schhead"><?php $nam = $credit->creds(); echo  nl2br(stripslashes($nam['key1']));?> </div>
        <div class="headother"> <?php $addres = $credit->creds(); echo nl2br(stripslashes($addres['key2'])); ?><br />
          Student Report Card<br>
			    Report Card No:<em><strong><?php echo $code; ?></strong></em><br>
			 </div>
      </div>
      <div class="image_box"></div>
    </div>
    </td>
    </tr>
    <tr>
    <td>
       <table width="100%" class="headother"  border="0" cellspacing="0" cellpadding="5">
          <tr>
            <td colspan="2" >Name: <?php echo $fname.' '.$mname.' '.$lname;?></td>
          </tr>
          <tr>
			      <td>Admission Number: <?php echo $adminNo; ?></td>
		      </tr>
          <tr>
            <td>Present Class: <strong><?php echo strtoupper($class_name);?></strong> </td>
          </tr>
          <tr>
            <td><?php echo $term_name.' :'.$year_name;?></td>
          </tr>
        </table>
		<hr  noshade="noshade"/>
		<?php
    $sql = "SELECT subject_name,subject_id FROM subject ";
    $result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));
    ?>
        <table width="100%" border="1" cellspacing="0" cellpadding="5">
          <tr>
            <td width="20%"><strong>Subjects</strong></td>			
            <td width="50"><strong>C.A.T 1 </strong></td>
            <td width="50"><strong>C.A.T 2 </strong></td>
            <td width="50"><strong>MID TERM</strong></td>
			      <td width="50"><strong>END TERM</strong></td>
         </tr>
	<?php
		if (mysqli_num_rows($result) > 0)
      {
        while($row = mysqli_fetch_assoc($result))
          {
            extract($row);

  ?>
    <tr>
						
	<?php 
		$examTypeMarks_=new examTypeMarks();
    $lowerSubject = array('ENGLISH','READING','NW','CREATIVE','ENVT');

      if($class_for =="babyclass" ||  $class_for =="preunit" )
      {
        
        if(in_array(strtoupper($subject_name), $lowerSubject))
          { ?>
            <td><?= $subject_name; ?></td>
            <td><?php $cat_1=$examTypeMarks_->cat1Marks($term_id,$stud_id,$subject_id);echo $cat_1;?></td>
            <td><?php $cat_2=$examTypeMarks_->cat2Marks($term_id,$stud_id,$subject_id);echo $cat_2;;?></td>
            <td><?php $mid_term=$examTypeMarks_->midtermMarks($term_id,$stud_id,$subject_id);echo $mid_term;?></td>
            <td><?php $end_term=$examTypeMarks_->endtermMarks($term_id,$stud_id,$subject_id);echo $end_term;?></td>
            
      <?php }
      }
      else
      {
        if(!in_array($subject_name, $lowerSubject))
          { ?>
            <td><?= $subject_name; ?></td>
            <td><?php $cat_1=$examTypeMarks_->cat1Marks($term_id,$stud_id,$subject_id);echo $cat_1;?></td>
            <td><?php $cat_2=$examTypeMarks_->cat2Marks($term_id,$stud_id,$subject_id);echo $cat_2;;?></td>
            <td><?php $mid_term=$examTypeMarks_->midtermMarks($term_id,$stud_id,$subject_id);echo $mid_term;?></td>
            <td><?php $end_term=$examTypeMarks_->endtermMarks($term_id,$stud_id,$subject_id);echo $end_term;?></td>
      <?php
          }
      }

      ?>
     		
</tr>
<?php
  }
}
else{
echo 'No Subjects for now.';
}
?>
			</td></tr>
</table>

<div><p></p></div>

<table width="100%" border="1" cellspacing="0" cellpadding="5">
 <colgroup>
    <col style="width: 20%" />
    <col style="width: 20%" />
    <col style="width: 20%" />
    <col style="width: 20%" />
    <col style="width: 20%" />
  </colgroup> 	

<tr >
    <td ><b>Totals</b> </td>
<td align="center"><strong><?php $cat_1Total=$examTypeMarks_->totals($term_id,$stud_id,'cat_1');echo $cat_1Total;?></strong></td>
<td align="center"><strong><?php $cat_2Total=$examTypeMarks_->totals($term_id,$stud_id,'cat_2');echo $cat_2Total;?></strong></td>
<td align="center"><strong><?php $mid_termTotal=$examTypeMarks_->totals($term_id,$stud_id,'mid_term');echo $mid_termTotal;?></strong></td>
<td><strong><?php $end_termTotal=$examTypeMarks_->totals($term_id,$stud_id,'end_term');echo $end_termTotal;?></strong></td>
</tr>

<tr >
    <td ><b>Average</b> </td>
<td align="center"><strong><?php $cat_1Total=$examTypeMarks_->totals($term_id,$stud_id,'cat_1');echo $cat_1Total/5;?></strong></td>
<td align="center"><strong><?php $cat_2Total=$examTypeMarks_->totals($term_id,$stud_id,'cat_2');echo $cat_2Total/5;?></strong></td>
<td align="center"><strong><?php $mid_termTotal=$examTypeMarks_->totals($term_id,$stud_id,'mid_term');echo $mid_termTotal/5;?></strong></td>
<td><strong><?php $end_termTotal=$examTypeMarks_->totals($term_id,$stud_id,'end_term');echo $end_termTotal/5;?></strong></td>
</tr>
	  
</table>

<div><p></p></div>

<table width="100%" border="1" cellspacing="0" cellpadding="5">
 <colgroup>
    <col style="width: 20%" />
    <col style="width: 20%" />
    <col style="width: 20%" />
    <col style="width: 20%" />
    <col style="width: 20%" />
  </colgroup> 	   
<tr> 
		
  <td ><b>Pstn in Class</b> </td>
<td align="center"><b><?php $cat_1Position=$examTypeMarks_->PositionClass($term_id,$stud_id,'cat_1',$class_name);echo $cat_1Position;?></b></td>
<td align="center"><b><?php $cat_2Position=$examTypeMarks_->PositionClass($term_id,$stud_id,'cat_2',$class_name);echo $cat_2Position;?></b></td>
<td align="center"><b><?php $mid_termPosition=$examTypeMarks_->PositionClass($term_id,$stud_id,'mid_term',$class_name);echo $mid_termPosition;?></b></td>
<td><strong><?php $end_termPosition=$examTypeMarks_->Position($term_id,$stud_id,$subject_id,'end_term');echo $end_termPosition;?></strong></td>
</tr>
<tr>
    <td ><b>Pstn in Stream</b> </td>
<td align="center"><strong><?php $cat_1Position=$examTypeMarks_->PositionStream($term_id,$stud_id,'cat_1',$class_for);echo $cat_1Position;?></strong></td>
<td align="center"><strong><?php $cat_2Position=$examTypeMarks_->PositionStream($term_id,$stud_id,'cat_2',$class_for);echo $cat_2Position;?></strong></td>
<td align="center"><strong><?php $mid_termPosition=$examTypeMarks_->PositionStream($term_id,$stud_id,'mid_term',$class_for);echo $mid_termPosition;?></strong></td>
<td><strong><?php $end_termPosition=$examTypeMarks_->PositionStream($term_id,$stud_id,'end_term',$class_for);echo $end_termPosition;?></strong></td>
</tr> 
</table>

	<hr  noshade="noshade"/>
    <div class="div_pad fullhead"><strong>Class Teacher's Comment:</strong></div><br><br>
	<hr  noshade="noshade"/>		
    <div class="div_pad fullhead"><strong>School Principal's Comment:</strong></div><br><br>

	<hr  noshade="noshade"/>

 <div align="center">
      Email : Mwimbiboardingp@yahoo.com
      <p>&copy;  <?php $nam = $credit->creds(); echo $nam['key1']; ?> <?php echo date('Y. '); ?> :powered by Skulsys</p>
 </div>
    </td>
  </tr>
</table>
<div> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
<div class="pagey"></div>
<?php }
}else echo"<script>alert('No student records');
</script>";
?>

</body>
</html>
