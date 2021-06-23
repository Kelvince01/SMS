<?php 
$id= $_GET['id'];

$sql="delete from fees_newstudent where id=$id"; 
$result=mysqli_query($con1,$sql) or die(mysqli_error($con1));
echo'<script>window.location=" /sms/index.php?info=edited&view=newfee"</script>';

?>  