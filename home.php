<td width="100%" valign="top">
<!--insert data page-->
<div style="padding: 2px 0 2px 300px;">
<table width="100%" border="1" cellpadding="1" cellspacing="1" align="center">

<tr><td>
<?php if ($_SESSION['User_type']=="admin" || $_SESSION['User_type']=="super_admin" ){ echo '
<a href="index.php?view=admissions"><img src="images/admissions.png" width="120" height="120"></a> ';} ?>
<?php if ($_SESSION['User_type']=="admin" || $_SESSION['User_type']=="super_admin" || $_SESSION['User_type']=="teacher"){ echo '
<a href="/sms/modules/admissions/students/students_list2.php"> <img src="images/student_details.png" width="120" height="120"></a> ';} ?>
<?php if ($_SESSION['User_type']=="admin" || $_SESSION['User_type']=="super_admin" || $_SESSION['User_type']=="parent"|| $_SESSION['User_type']=="student" || $_SESSION['User_type']=="teacher"){ echo '  
<a href="index.php?view=academics"><img src="images/academics.png" width="110" height="110"></a> ';} ?>
<?php if ($_SESSION['User_type']=="admin" || $_SESSION['User_type']=="super_admin" || $_SESSION['User_type']=="clerk" || $_SESSION['User_type']=="librarian" || $_SESSION['User_type']=="student"){ echo '
 <a href="index.php?view=library"><img src="images/library.png" width="110" height="110"></a> ';} ?>
<?php if ($_SESSION['User_type']=="admin" || $_SESSION['User_type']=="super_admin" || $_SESSION['User_type']=="parent" || $_SESSION['User_type']=="clerk" || $_SESSION['User_type']=="student"){ echo '
 <a href="index.php?view=fees"><img src="images/accounts.png" width="120" height="120"></a> ';} ?>

 <?php if ($_SESSION['User_type']=="admin" || $_SESSION['User_type']=="super_admin" || $_SESSION['User_type']=="clerk" || $_SESSION['User_type']=="librarian" || $_SESSION['User_type']=="student"){echo '
 <a href="index.php?view=add_user"><img src="images/manage_users.png" width="120" height="120"></a> ';} ?>
  <?php if ($_SESSION['User_type']=="admin" || $_SESSION['User_type']=="super_admin" || $_SESSION['User_type']=="clerk" || $_SESSION['User_type']=="librarian" || $_SESSION['User_type']=="student"){echo '
 <a href="index.php?view=settings"><img src="images/settings.png" width="120" height="120"></a> ';} ?>

<!--<img src="images/humanresource.png" width="120" height="120">

<img src="images/manage_users.png" width="120" height="120">
<img src="images/settings.png" width="120" height="120">-->
</td> </tr>
 </table>
</div>



<!--wrapper table-->
</td>