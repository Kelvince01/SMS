<?php
session_start();
ob_start();
include('../../../connection/connect.php');
include ('../../../common/functions.php');
if($_SESSION['LoggedIn'] != 'True'){
		header("location:/sms/modules/security/logout.php");
		}
//isLoggedIn();?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">

<title>MySkulMate</title>	
<link rel="stylesheet" href="../../../sm_css.css" type="text/css">
<link rel="stylesheet" type="text/css" href="../../../jq/jquery.autocomplete.css" />	
<script type="text/javascript" src="../../../jq/jquery.js"></script>
<script type='text/javascript' src='../../../jq/jquery.autocomplete.js'></script>
<script type='text/javascript' src='../../../jq/highlight.js'></script>
<script type="text/javascript">
$().ready(function() {
	$("#search_term2").autocomplete("studsearch.php", {
		width: 260,
		matchContains: true,
		selectFirst: false
	});
});
function confirmSubmit()
{
    if (confirm('Student will be permanently deleted from the records!!Click okay to proceed'))
    {
        return true;
    }
    return false;
}
</script>
</head>
<body rightmargin="5px" leftmargin="5px" topmargin="5px" bottommargin="0" marginheight="5px" marginwidth="5px">
<div id="wrap">
<div id="top"> </div>
<div id="contentt">
<div align="right" style="background-color:#95B9C7; height:80px;">
<div style="float:left; padding:4px; background-color:#95B9C7;"><img src="../../../school_logo.jpg" alt="logo" width="70" height="70" border="1"></div>
  
  <div style="float:left; padding:5px; margin-top:40px; font-size:16px; font-weight:bold; color:#000000;">
 &nbsp;&nbsp; <u></u>&nbsp;&nbsp;
   <u></u>&nbsp;&nbsp;
   <u></u>&nbsp;&nbsp;
   <u></u>&nbsp;&nbsp;
   <u><?php echo $_SESSION['schoolname'];?></u>
  </div>
  <div style="float:right; color:#FFFFFF;">
  <div style="float:right; padding:4px; background-color:#95B9C7;"><img src="<?php echo $_SESSION['student_photoURL'];?>" alt="logo" width="70" height="70" border="1"></div>
 
  <span class="msg"><?php $time=getDayTime(); echo $time; ?>&nbsp;</span><?php echo date("D M j Y g:i a");?></div><br>
</div>

<div class="nav_bar">
  <div style="width:inherit; float:left;"> Welcome <strong><?php echo $_SESSION['full_name'];?></strong>  </div>
  <div style="float:left; margin-left:100px;"><?php $termPeriod= getActiveTerm ();  ?><strong>&nbsp;&nbsp;Term/Semester: &nbsp;</strong><?php echo $termPeriod['key2'];?>&nbsp;&nbsp; <?php echo $termPeriod['key1'];?></div>
  <div style="width:inherit; float:right; margin-right:20px"><strong><?php echo $_SESSION['userName']; echo '['.$_SESSION['User_type'].']'?></strong>[ <a href="/sms/modules/security/logout.php">logout</a> ]</div>
</div>

<table width="100%" height="80%" border="0" cellpadding="4" cellspacing="0">
  <tbody><tr>
  <!--left Column| Menu Bar-->
    <td width="20%" valign="top" bgcolor="#DDDDDD" nowrap="nowrap"><!--admin menu-->
<div class="menu_inc">
  <!--Menu Header-->
  <div class="menu_item_main"><a href="../../../index.php">Home</a> </div>
  <hr>
  <!--Menu Items-->
     <?php if ($_SESSION['User_type']=="admin" || $_SESSION['User_type']=="super_admin" ){ echo '  <div class="menu_item"><a href="../../../index.php?view=admissions">Admissions </a></div> ';} ?>
   <hr noshade="noshade">
  <?php if ($_SESSION['User_type']=="admin" || $_SESSION['User_type']=="super_admin" || $_SESSION['User_type']=="parent"|| $_SESSION['User_type']=="student" || $_SESSION['User_type']=="teacher"){ echo '     <div class="menu_item"><a href="../../../index.php?view=academics"> Academics</a></div>  ';} ?>
   <!--Student Administration Menu-->
     
    <!--Library Menu-->
   <hr noshade="noshade">
 <?php if ($_SESSION['User_type']=="admin" || $_SESSION['User_type']=="super_admin" || $_SESSION['User_type']=="clerk" || $_SESSION['User_type']=="librarian" || $_SESSION['User_type']=="student"){ echo '  <div class="menu_item"><a href="../../../index.php?view=library">Library Management</a></div>  ';} ?>
     <!--Mini Account Menu-->
   <hr noshade="noshade">
<?php if ($_SESSION['User_type']=="admin" || $_SESSION['User_type']=="super_admin" || $_SESSION['User_type']=="parent" || $_SESSION['User_type']=="clerk" || $_SESSION['User_type']=="student"){ echo '   <div class="menu_item"><a href="../../../index.php?view=accounts">Accounts Office</a></div> ';} ?>
 <hr noshade="noshade">
 <?php if ($_SESSION['User_type']=="admin" || $_SESSION['User_type']=="super_admin" || $_SESSION['User_type']=="clerk" || $_SESSION['User_type']=="librarian" || $_SESSION['User_type']=="student"){echo ' <div class="menu_item"><a href="../../../index.php?view=add_user">Manage Users</a></div> ';} ?>
   <hr noshade="noshade">
           	<!--Message Menu-->
  
  

   <div class="menu_item"><a href="/sms/modules/security/logout.php"> Sign Out</a></div>
      <hr noshade="noshade">
<!--end main div-->  
</div></td>
	<!--right Column | Data Column-->
   <?php
//include_once 'message.php';   
//require_once $content;	

?>



<td width="100%" valign="top" >
<h2>Students List</h2>


<form  autocomplete="off" method="post" action="">
<table border="0" cellspacing="1" cellpadding="4" class="entryTable">
<td><img src="/sms/images/view.png"/>Search Student:
<input type="text" name="search_term" id="search_term2">
<input type="submit" name="action2" value="Search" class="page">
</td><td><a href="/sms/modules/admissions/students/students_list2.php"><input type="button" name="" value="Back to List" class="page"></td></tr>
</table>
</form>
<?php
extract($_POST);
?>
<DIV STYLE="overflow: auto; height: 500; 
            border-left: 1px gray solid; border-bottom: 1px gray solid; 
            padding:0px; margin: 0px">
<table width="98%" border="0" cellpadding="1" cellspacing="1" id="theList" class="entryTable">

<tr align="center" class="entryTableHeader">
<th width="" >#</th>
<th width="">AdmNo</th>
<th width="15%">Name</th>
<th width="15%" >PName</th>
<th width="5%" >Class</th>
<th width="" >Admn Year</th>
<th width="" >Fees Balance</th>
<th width="" >In Sch</th>

</tr>

<?php


$sql="SELECT * FROM student_details WHERE concat(fname,' ',mname,' ',lname) LIKE '%".$search_term."%' OR concat(fname,' ',mname) 
LIKE '%".$search_term."%' or concat(mname,' ',lname) LIKE '%".$search_term."%' OR adminNo = '".$search_term."'  ORDER BY stud_id ASC";
$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));
if (mysqli_num_rows($result) > 0) {
$i = 0;

while($row = mysqli_fetch_assoc($result)) {
extract($row);
//parents name
$query1="SELECT fname,mname ,lname from parent_details where parent_id='$parent_id'";
$result1=mysqli_query($con1,$query1);
$row1 = mysqli_fetch_array($result1);
$pfname=$row1[0];
$pmname=$row1[1];
$plname=$row1[2];
//active term
$query="SELECT * FROM term_period  WHERE active='1'";
$row=mysqli_query($con1,$query);
$row=mysqli_fetch_assoc($row);
extract($row); 

//fee for new students -admission & uniform
  $sql    = "SELECT admission, uniform  FROM fees_newstudent WHERE period_id='$term_id'";
    $result   = mysqli_query($con1,$sql) or die('Cannot get Info7.');
    $rowa   = mysqli_fetch_assoc($result);
    if($rowa == null)
    {
      $admission =0;
      $uniform=0; 
    }
    else
    {
      extract($rowa);
    }
    
//class name
$query1="SELECT class_name,class_for from class where class_id='$class_id'";
$result1=mysqli_query($con1,$query1);
if (mysqli_num_rows($result1) > 0) {
$row1 = mysqli_fetch_assoc($result1);
extract($row1);
}
else
{
$class_name='NOT ALLOCATED';
}
//get new students and chek payment status
$sql2    = "SELECT term_id as termid  FROM paid WHERE stud_id='$stud_id'";
$result2   = mysqli_query($con1,$sql2) or die('Cannot get Info7.');
if (mysqli_num_rows($result2) == 0) {
    $paidstudent ="never" ;
    $termid=""; 
}else{
$row2 = mysqli_fetch_assoc($result2);
extract($row2)  ;
if($termid == $term_id) $paidstudent ="paid";
else $paidstudent ="not";

}
//get fee types
$sql3    = "SELECT tb2.type FROM fee_periods tb1 inner join fee_types tb2 on tb1.feetype_id = tb2.feetype_id WHERE term_name='".$term_name."' and class_for='".$class_for."'";
$result3   = mysqli_query($con1,$sql3) or die('Cannot get Info7.');
$typearray =array();
if (mysqli_num_rows($result3) > 0) {
while($row = mysqli_fetch_array($result3)) {
$typearray[] = $row[0];
}
}
$query="SELECT COALESCE( SUM( amount ) , 0 ) as total FROM fees_payment  WHERE term_id='$term_id' and adminNo='$adminNo' order by pay_id DESC LIMIT 1 ";
$row=mysqli_query($con1,$query);
$row=mysqli_fetch_assoc($row);
extract($row); 
/////
$query="SELECT COALESCE( SUM( amount ) , 0 ) as total1 FROM fee_periods WHERE term_name='".$term_name."' and class_for='".$class_for."'";
$row=mysqli_query($con1,$query);
$row=mysqli_fetch_assoc($row);
extract($row); 
$lower_primary= array('Class 1','Class 2','Class 3','babyclass','preunit');

if($admission_year == date('Y') && $paidstudent !="not" && $total1 != 0 && !in_array($class_for, $lower_primary)){
   if(sizeof($typearray>0)){
      if(in_array('UNIFORM', $typearray)) $total1  +=  $uniform;
      if(in_array('ADMISSION', $typearray)) $total1 +=  $admission;
     }
 }
if ($i%2) {
	$class = 'row1';
} else {
	$class = 'row2';
}
$i += 1;
?>
<tr class="<?php echo $class; ?>">
<td align="center"><?php echo $stud_id;?> </td>
<td align=""><?php echo $adminNo;?> </td>
<td align=""><?php echo $fname. ' '.strtoupper($mname[0]).'. '.$lname;?></td>
<td align=""><?php echo $pfname. ' '.strtoupper($pmname[0]).'. '.$plname;?> </td>
<td align=""><?php echo $class_name;?> </td>
<td align="center"><?php echo $admission_year;?> </td>
<td align="center"><?php  echo number_format(($total1-$total),2); ?> </td>
<td align="center"><?php if($active==1){ echo 'YES';} else { echo 'NO';}?> </td>

</tr>


 <?php
}
}
else{
	echo 'No Students match your search criteria now.';
}
?>
</table>
</div>
</form>
</td>
</tr></tbody></table>
<div id="footer" align="center"><a href="" ></a></div>
</div>
<div id="bottom"> 
</div>
</div>
</body></html>