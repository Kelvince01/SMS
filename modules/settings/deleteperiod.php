<?php 
$con1 = mysqli_connect('localhost','root','','sms');
$term_id= $_GET['term_id'];

$sql="delete from term_period where term_id=$term_id"; 
$result=mysqli_query($con1,$sql) or die(mysqli_error($con1));
echo'<script>window.location=" /sms/index.php?info=edited&view=settings"</script>';

?>  