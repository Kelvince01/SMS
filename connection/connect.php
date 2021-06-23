<?php
$con1=mysqli_connect("127.0.0.1:3306",'root','','sms');
   if(!$con1) return 'Failed to connect to the database.';
   //mysqli_select_db('sms',$con1);
  mysqli_query($con1, "SET NAMES 'utf8';");
  mysqli_query($con1,"SET CHARACTER SET 'utf8';");

?>