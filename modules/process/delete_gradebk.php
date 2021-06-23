<td width="100%" valign="top">
<?php	
$gradebk_id= $_GET['gradebk_id'];	
	$sql="delete from gradebk where gradebk_id='$gradebk_id'";
//echo $sql;
//break;
mysqli_query($con1,$sql)or die(mysqli_error($con1));
?>
<p align="center"class='success'>Mark book deleted successfully</p><br>

</td>
