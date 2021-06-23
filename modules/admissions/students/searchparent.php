<?php
session_start();
ob_start();
include('../../../connection/connect.php');
include ('../../../common/functions.php');
if($_SESSION['LoggedIn'] != 'True'){ header("location:/sms/modules/security/logout.php");}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">

<title>MySkulMate</title>	
<link rel="stylesheet" href="../../../sm_css.css" type="text/css">
  <link rel="stylesheet" href="../../../modules/admissions/jquery/development-bundle/themes/base/jquery.ui.all.css">
<script src="../../../modules/admissions/jquery/development-bundle/ui/jquery.ui.tabs.js"></script>	
<link rel="stylesheet" type="text/css" href="../../../jq/jquery.autocomplete.css" />	
<script type="text/javascript" src="../../../jq/jquery.js"></script>
<script type='text/javascript' src='../../../jq/jquery.autocomplete.js'></script>
<script type='text/javascript' src='../../../jq/highlight.js'></script>
<script type="text/javascript">
$().ready(function() {
	$("#search_term").autocomplete("parsearch.php", {
		width: 260,
		matchContains: true,		
		selectFirst: false
	});
});
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
   <u>PIONEER STUDENTS INFORMATION SYSTEM</u>
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
<td width="100%" valign="top" background="./mySchoolManager 1.0  School Information Management System_files/td_back.jpg">
<h2>Parents List</h2>
<form action="" method="post">
<table border="0" cellspacing="1" cellpadding="4" class="entryTable">
<td><img src="/sms/images/view.png"/>Search Parent:
<input type="text" name="search_term" id="search_term">
<input type="submit" name="action2" value="Search" class="page">
</td><td><a href="/sms/modules/admissions/students/parent_list.php"><input type="button" name="" value="Back to List" class="page"></td></tr>
</table>
</form>
<DIV STYLE="overflow: auto; height: 500; 
            border-left: 1px gray solid; border-bottom: 1px gray solid; 
            padding:0px; margin: 0px">
<table width="98%" border="0" cellpadding="1" cellspacing="1" id="theList" class="entryTable">

<tr align="center" class="entryTableHeader">
<th width="" >#</th>
<th width="20%">Parent Name</th>
<th >Adm No.</th>
<th width="20%" >Student Name</th>
<th width="" >Phone</th>
<th width="" >Address</th>
<th width="" >Contact</th>
<th >In Sch</th>

</tr>
<?php 
extract($_POST);
$sql="SELECT * FROM parent_details WHERE concat(fname,' ',mname,' ',lname) LIKE '%".$search_term."%' OR spouse_name LIKE '%".$search_term."%'  ORDER BY parent_id ASC";
$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));
if (mysqli_num_rows($result) > 0) {
$i = 0;

while($row = mysqli_fetch_assoc($result)) {
extract($row);
//parents name
$query1="SELECT fname,mname ,lname,adminNo  from student_details where parent_id='$parent_id'";

//break;
$result1=mysqli_query($con1,$query1);
$row1 = mysqli_fetch_array($result1);
$pfname=$row1[0];
$pmname=$row1[1];
$plname=$row1[2];
$sadm=$row1[3];
//
if ($i%2) {
	$class = 'row1';
} else {
	$class = 'row2';
}
$i += 1;
?>
<tr class="<?php echo $class; ?>">
<td align=""><?php echo $parent_id;?> </td>
<td align=""><?php echo $fname. ' '.strtoupper($mname[0]).'. '.$lname;?></td>
<td align=""><?php echo $sadm;?> </td>
<td align=""><?php echo $pfname. ' '.strtoupper($pmname[0]).'. '.$plname;?> </td>
<td align=""><?php echo $phoneNo;?> </td>
<td align=""><?php echo $postalAddress;?> </td>
<td align="center"><?php echo $contact_method;?> </td>
<td align="center"><?php if($active==1){ echo 'YES';} else { echo 'NO';}?> </td>

</tr>

 <?php
}
}
else{
	echo 'No Parents match that name.';
}
?>
</table>
</div>

</td>
