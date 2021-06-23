<?php
session_start();
$_SESSION['LoggedIn']='LogOut';
session_destroy();
header('location:login.php?info=logout&tab=logout');

?>