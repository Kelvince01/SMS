<?php 
 $credits= new credential();
 $nam = $credits->creds();
    $schoolname = $nam['key1'];
    $initials=$nam['key5'];
    $_SESSION['schoolname']=$schoolname;
    $_SESSION['initials'] = $initials;
  ?> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">

<title>MySkulMate</title>

<link rel="stylesheet" href="sm_css.css" type="text/css">
  <link rel="stylesheet" href="/sms/jq/jquery-ui.css">
	<script src="/sms/jq/jquery3.js"></script>
  <script src="/sms/jq/jquery-ui.js"></script>
 	<script src="/sms/jq/highlight.js"></script>
	<script>
	$(function() {
		$( "#tabs" ).tabs();
		});
		function printpage() {
	window.print();
  
			}
		</script>
	<script>
	$(function() {
	$( "tr #hi" ).hide();
	$( "#family_status" ).change(function(){
	var status =$( this ).val();
	if(status =="both_alive"){	$("tr #hi").fadeIn();	}
	if(status =="single_parent" || status =="orphaned"){	$("tr #hi").hide();	}
				});
	});	
	</script>
		<script>
	$(function() {
		$( "#datepicker" ).datepicker({changeMonth: true,changeYear: true,dateFormat: 'yy-mm-dd'});
		$( "#datepicker2" ).datepicker({changeMonth: true,changeYear: true,dateFormat: 'yy-mm-dd'});
		$( "#datepicker3" ).datepicker({changeMonth: true,changeYear: true, dateFormat: 'yy-mm-dd'});
    $( "#yearpicker" ).datepicker({changeYear: true, dateFormat: 'yy'});
	});
	</script>
<body rightmargin="5px" leftmargin="5px" topmargin="5px" bottommargin="0" marginheight="5px" marginwidth="5px">
<div id="wrap">
<div id="top"> </div>
<div id="contentt">
<div align="right" style="background-color:#95B9C7; height:80px;">
<div style="float:left; padding:4px; background-color:#95B9C7;"><img src="school_logo.jpg" alt="logo" width="70" height="70" border="1"></div>
  
  <div style="float:left; padding:5px; margin-top:40px; font-size:16px; font-weight:bold; color:#000000;">
 &nbsp;&nbsp; <u></u>&nbsp;&nbsp;
   <u></u>&nbsp;&nbsp;
   <u></u>&nbsp;&nbsp;
   <u></u>&nbsp;&nbsp;
   <u><?php echo $schoolname; ?></u>
  </div>
  <div style="float:right; color:#FFFFFF;">
  <div style="float:right; padding:4px; background-color:#95B9C7;"><img src="<?php echo $_SESSION['student_photoURL'];?>" alt="account pic" width="70" height="70" border="1"></div>
 
  <span class="msg"><?php $time=getDayTime(); echo $time; ?>&nbsp;</span><?php echo date("D M j Y g:i a");?></div><br>
</div>
<div class="nav_bar">
  <div style="width:inherit; float:left;"> Welcome <strong><?php echo $_SESSION['full_name'];?></strong>  </div>  
  <div style="float:left; margin-left:100px;"><?php $termPeriod= getActiveTerm ();?><strong>&nbsp;&nbsp;Term/Semester: &nbsp;</strong><?php echo $termPeriod['key2'];?>&nbsp;&nbsp; <?php echo $termPeriod['key1'];?></div>
  <div style="width:inherit; float:right; margin-right:20px"><strong><?php echo $_SESSION['userName']; echo '['.$_SESSION['User_type'].']'?></strong>[ <a href="modules/security/logout.php">logout</a> ]</div>
</div>

<?php if($content=='home.php'){?>
<table width="80%" height="80%" border="0" cellpadding="4" cellspacing="0">
  <tbody><tr>
	<!--right Column | Data Column-->
   <?php
include_once 'message.php';   
require_once $content;	 
?>
</tr></tbody></table>
<?php
}
else{?>

<table width="100%" height="80%" border="0" cellpadding="4" cellspacing="0">
  <tbody><tr>
  <!--left Column| Menu Bar-->
    <td width="20%" valign="top" bgcolor="#DDDDDD" nowrap="nowrap"><!--admin menu-->
<div class="menu_inc">
  <!--Menu Header-->
  <div class="menu_item_main"><a href="index.php">Home</a> </div>
  <hr>
  <!--Menu Items-->
     <?php if ($_SESSION['User_type']=="admin" || $_SESSION['User_type']=="super_admin" ){ echo '  <div class="menu_item"><a href="index.php?view=admissions">Admissions </a></div> ';} ?>
   <hr noshade="noshade">
  <?php if ($_SESSION['User_type']=="admin" || $_SESSION['User_type']=="super_admin" || $_SESSION['User_type']=="parent"|| $_SESSION['User_type']=="student" || $_SESSION['User_type']=="teacher"){ echo '     <div class="menu_item"><a href="index.php?view=academics"> Academics</a></div>  ';} ?>
   <!--Student Administration Menu-->
     
    <!--Library Menu-->
   <hr noshade="noshade">
 <?php if ($_SESSION['User_type']=="admin" || $_SESSION['User_type']=="super_admin" || $_SESSION['User_type']=="clerk" || $_SESSION['User_type']=="librarian" || $_SESSION['User_type']=="student"){ echo '  <div class="menu_item"><a href="index.php?view=library">Library Management</a></div>  ';} ?>
     <!--Mini Account Menu-->
   <hr noshade="noshade">
<?php if ($_SESSION['User_type']=="admin" || $_SESSION['User_type']=="super_admin" || $_SESSION['User_type']=="parent" || $_SESSION['User_type']=="clerk" || $_SESSION['User_type']=="student"){ echo '   <div class="menu_item"><a href="index.php?view=fees">Accounts Office</a></div> ';} ?>
 <hr noshade="noshade">
 <?php if ($_SESSION['User_type']=="admin" || $_SESSION['User_type']=="super_admin" || $_SESSION['User_type']=="clerk" || $_SESSION['User_type']=="librarian" || $_SESSION['User_type']=="student"){echo ' <div class="menu_item"><a href="index.php?view=add_user">Manage Users</a></div> ';} ?>
   <hr noshade="noshade">
           	<!--Message Menu-->
  
  

   <div class="menu_item"><a href="modules/security/logout.php"> Sign Out</a></div>
      <hr noshade="noshade">
<!--end main div-->  
</div></td>
	<!--right Column | Data Column-->
   <?php
include_once 'message.php';   
require_once $content;	

?>

</tr></tbody></table>
<?php
}
?>
<div id="footer" align="center"><a href="" target="_blank">info@schoolmanager.com</a></div>
</div>
<div id="bottom"> 
</div>
</div>
</body></html>